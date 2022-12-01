<!DOCTYPE html>
<html>

<head>
    <title>Page Title</title>
    <link rel="stylesheet" type="text/css" href="/VoteSystem/StyleS/Login.css" />
    <link rel="stylesheet" type="text/css" href="/VoteSystem/StyleS/Homepage.css" />
</head>

<body>

    <?php

    include(dirname(__DIR__) . '/VoteSystem/Helpers.php');
    include(dirname(__DIR__) . '/VoteSystem/FormHandlers/action_registration.php');
    

    ?>
    <header>

    <div  class="left_side">
        <h2 >POLL <span>IT</span></h2>
    </div>

    <div id="center">
     
    </div>


    </header>

    <div class="content">
    
    <div class="container">
    <div class="form">
    <h2> Registration</h2> 
    <form id="login" action="#" method="POST">
        <fieldset>
           
            <label for="fname">ID:</label><br>
            <input class="box" type="text" id="ID" name="ID" required><br>
            <label for="pass">Password:</label><br>
            <input class="box" type="password" id="pass" name="pass" required><br>
            <label for="conpass">Confirm Password:</label><br>
            <input class="box" type="password" id="conpass" name="conpass" required><br><br>
            <input type="submit" name="submit">
            <button value="Back"> <a style="text-decoration:none; color:black;" href="login.php"> Go Back </a></button>
        </fieldset>
    </form>


    </div>
    </div>
    </div>
<!--
    <header>
        <h1>Registration Page</h1>
    </header>

    <?php

    err_display_reg();

    ?>


    <form action="#" method="POST">
        <fieldset>
            <legend>Registration Form: </legend>
            <label for="fname">ID:</label><br>
            <input type="text" id="ID" name="ID" required><br>
            <label for="pass">Password:</label><br>
            <input type="password" id="pass" name="pass" required><br>
            <label for="conpass">Confirm Password:</label><br>
            <input type="password" id="conpass" name="conpass" required><br><br>
            <input type="submit" name="submit">
            <button value="Back"> <a style="text-decoration:none; color:black;" href="login.php"> Go Back </a></button>
        </fieldset>
    </form>

-->
</body>

</html>