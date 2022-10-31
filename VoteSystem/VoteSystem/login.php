<!DOCTYPE html>
<html>
    <head>
        <title>Page Title</title>
    </head>
    
    <body>

        <?php
        session_start();
        include("/xampp/htdocs/VoteSystem/Helpers.php");
        require("/xampp/htdocs/VoteSystem/FormHandlers/action_login.php");

    //Display alert if user is being redirected from succesful register
        if(isset($_SESSION['registered'])){
        echo '<script>alert("Account Successfully Created Returning to Login")</script>';
        unset($_SESSION['registered']);
        }
        ?>

        <header>
            <h1>Login Page</h1>
        </header>

        <?php
        err_display_log();
        ?>

        <form action="#" method="POST">
            <fieldset>
            <legend>Login Form: </legend>
            <label for="user">ID:</label><br>
            <input type="text" id="user" name="user" required><br>
            <label for="pass">Password:</label><br>
            <input type="password" id="pass" name="pass" required><br><br>
            <input type="submit" value="Login">
        </form>

           <button value="Register">  <a style="text-decoration:none; color:black;" href="Registration.php"> Register </a></button>
            </fieldset>
    </body>
</html>