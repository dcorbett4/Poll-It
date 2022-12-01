<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="/VoteSystem/StyleS/Homepage.css" />
    <link rel="stylesheet" type="text/css" href="/VoteSystem/StyleS/Login.css" />

</head>

<body>

    <?php
    session_start();
    include(dirname(__DIR__) . '/VoteSystem/Helpers.php');
    require(dirname(__DIR__) . '/VoteSystem/FormHandlers/action_login.php');

    //Display alert if user is being redirected from succesful register
    if (isset($_SESSION['registered'])) {
        echo '<script>alert("Account Successfully Created Returning to Login")</script>';
        unset($_SESSION['registered']);
    }
    ?>

<header>
    <div  class="left_side">
        <h2 >POLL <span>IT</span></h2>
    </div>

    <div id="center">
     
    </div>


</header>

<div class="content">
    
    <?php
    err_display_log();
    ?>

    <div class="container">
    <div class="form">
    <h2> Login</h2> 
    <form id="login"action="#" method="POST">
      
            <label for="user">ID:</label><br>
            <input class="box" type="text" id="user" name="user" required><br>
            <label for="pass">Password:</label><br>
            <input class="box" type="password" id="pass" name="pass" required><br><br>
            <input type="submit" value="Login">


    <button value="Register"> <a style="text-decoration:none; color:black;" href="Registration.php"> Register </a></button>
    </fieldset>

    </div>
    </div>
    </div>

</body>

</html>