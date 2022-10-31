<!DOCTYPE html>
<html>
    <head>
        <title>Page Title</title>
    </head>
    
    <body>
    
        <?php

        include("/xampp/htdocs/VoteSystem/Helpers.php");
        include("/xampp/htdocs/VoteSystem/FormHandlers/action_registration.php");

        ?>

        <header>
            <h1>Registration  Page</h1>
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
            

    </body>
</html>