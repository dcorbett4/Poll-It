<?php

session_start();
$username = $_SESSION['user'];
$id = $_SESSION['id'];
include('C:/xampp/htdocs/VoteSystem/Connection.php');
include('C:/xampp/htdocs/VoteSystem/Helpers.php');

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home Page Title</title>
        <link rel="stylesheet" type="text/css" href="/VoteSystem/StyleS/Homepage.css" /> 
        <link rel="stylesheet" type="text/css" href="/VoteSystem/StyleS/popup_admin_settings.css" />
        <script src="/VoteSystem/Javascript/pop_handler.js"></script> 
    </head>
    
    <body>
    <h2><?php echo $username ?></h2>

    <?php
    profile_pic();
    
    ?>
    <div>
    <h3>HOME</h3>
        <nav>
            <ul>

                <li><a href="/VoteSystem/adminpages/homepage.php"> DASHBOARD</a></li>
                <li><a href="/VoteSystem/adminpages/results.php"> RESULTS</a></li>

            </ul>

        </nav>

        <h3>MANAGE</h3>
        <nav>
            <ul>

                <li><a href="/VoteSystem/adminpages/Manage_Choices.php"> POLL </a></li>
                <li><a href="/VoteSystem/adminpages/Manage_Choices.php"> CHOICES</a></li>
                <li><a href="/VoteSystem/adminpages/Manage_Voters.php"> VOTERS</a></li>
                

            </ul>
        </nav>

        <h3>SETTINGS</h3>
        <nav>
            <ul>
                <li><a href="#"> USER</a></li>
            </ul>
        </nav>

        <form action="/VoteSystem/logout.php" method="POST"> 
      <button type="submit" name="logout" class="btn btn-primary">Logout</button>
        </form>
    </div>

    <div class="popup" id="image_upload">
        <div class="overlay"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup()">&times;</div>
            <h1>Upload New Image</h1>
            <form action="/Votesystem/FormHandlers/action_imageupload.php" method="post" name="image_submit"enctype="multipart/form-data">
                <fieldset>
                    <legend>Upload Image </legend>
                    <label for="img">Choose File:</label><br>
                    <input type="file" id="img_upload" name="img_upload" required></input>
                </fieldset>
                <input class="form-button" name="submit" type="submit" value="Upload" >
            </form>
        </div>
    </div>

    <div class="popup" id="change_information">
        <div class="overlay"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup_changeinfo()">&times;</div>
            <h1>Change Information</h1>
            <form action="#" method="POST" >
                <fieldset>
                    <title>User Information</title>
                    <label for="user">Username:</label><br>
                    <input type="text" id="user" name="user"></input>
                    <label for="user">Password:</label><br>
                    <input type="text" id="user" name="user"></input>
                </fieldset>
                <button class="form-button" type="submit">Submit</button>
            </form>
        </div>
    </div>

    <div class="popup" id="delete_acct">
        <div class="overlay"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup_deleteacct()">&times;</div>
            <h1>Delete Account</h1>
            <div>
                <h3>Delete User Account ?</h3>
                <button>Yes</button > 
                <button>No</button > 

            </div>
        </div>
    </div>

    <div>
        <div>
        <button class="ui_box" id="upload_image"onclick="togglePopup()">Change Image</button>
        </div>
        <div>
        <button class="ui_box" id="change_info"onclick="togglePopup_changeinfo()">Change Password/Username</button>
        </div>
        <div>
        <button class="ui_box" id="delete_acc"onclick="togglePopup_deleteacct()">Delete Account</button>
        </div>
    </div>

    </body>
</html>