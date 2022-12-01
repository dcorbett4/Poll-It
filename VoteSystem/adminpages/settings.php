<?php

session_start();
$username = $_SESSION['user'];
$id = $_SESSION['id'];
include(dirname(__DIR__) . '/Connection.php');
include(dirname(__DIR__) . '/Helpers.php');

?>
<!DOCTYPE html>
<html>
<head>
    <title>Home Page Title</title>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="/VoteSystem/StyleS/Homepage.css" />
    <link rel="stylesheet" type="text/css" href="/VoteSystem/StyleS/popup_admin_settings.css" />
    <script src="/VoteSystem/Javascript/pop_handler.js"></script>
</head>

<body>
    <header>
    <div  class="left_side">
        <h2 >POLL <span>IT</span></h2>
    </div>

    <div id="center">
     
    </div>

    <div class="right_side">
        <a  href="/VoteSystem/logout.php" name="logout"  class="logout_btn">Logout</a>
    </div>


    </header>
    
    <div class="navbar">
        <center>
            <?php
            profile_pic();
            ?>
            <h4 id="username"> <?php echo $_SESSION['user']; ?></h4>
        </center>

        <a href="/VoteSystem/adminpages/homepage.php"><i class="fa fa-home" aria-hidden="true"></i><span>DASHBOARD</span></a>
        <a href="/VoteSystem/adminpages/Results.php"><i class="fa fa-bar-chart" aria-hidden="true"></i><span>RESULTS</span></a>
 
        <a href="/VoteSystem/adminpages/Manage_Polls.php"><i class="fa fa-question" aria-hidden="true"></i><span>POLL</span></a>
        <a href="/VoteSystem/adminpages/Manage_Choices.php"><i class="fa fa-th" aria-hidden="true"></i><span>CHOICES</span></a>
        <a href="/VoteSystem/adminpages/Manage_Voters.php"><i class="fa fa-user" aria-hidden="true"></i><span>VOTERS</span></a>
        <a href="/VoteSystem/adminpages/settings.php"><i class="fa fa-cogs" aria-hidden="true"></i><span>SETTINGS</span></a>
    </div>

  

    <div class="content">
    <div class="popup" id="image_upload">
        <div class="overlay"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup()">&times;</div>
            <h1>Upload New Image</h1>
            <form action="/Votesystem/FormHandlers/action_imageupload.php" method="post" name="image_submit" enctype="multipart/form-data">
                <fieldset>
                    <legend>Upload Image </legend>
                    <label for="img">Choose File:</label><br>
                    <input type="file" id="img_upload" name="img_upload" required></input>
                </fieldset>
                <input class="form-button" name="submit" type="submit" value="Upload">
            </form>
        </div>
    </div>

    <div class="popup" id="change_information">
        <div class="overlay"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup_changeinfo()">&times;</div>
            <h1>Change Information</h1>
            <form action="/Votesystem/FormHandlers/action_updateusername.php" method="POST">
                <fieldset>
                    <label for="new_username">Enter New Username:</label>
                    <input type="text" id="new_username" name="new_username"></input>
                </fieldset>
                <input class="form-button" type="submit" name="submit" value="Submit">
            </form>
            <br>
            <form action="/Votesystem/FormHandlers/action_updateusername.php" method="POST">
                <fieldset>
                    <label for="pass1">New Password:</label>
                    <input type="text" id="pass1" name="pass1" required></input><br>
                    <label for="pass2">Re-Enter Password:</label>
                    <input type="text" id="pass2" name="pass2" required></input>
                </fieldset>
                <input class="form-button" type="submit" name="submit" value="Submit">
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
                <form action="/Votesystem/FormHandlers/action_deleteuser.php" method="POST">
                    <input class="form-button" type="submit" name="submit" value="Yes">
                </form>
            </div>
        </div>
    </div>

    <div>
        <div>
            <button class="ui_box" id="upload_image" onclick="togglePopup()">Change Image</button>
        </div>
        <div>
            <button class="ui_box" id="change_info" onclick="togglePopup_changeinfo()">Change Password/Username</button>
        </div>
        <div>
            <button class="ui_box" id="delete_acc" onclick="togglePopup_deleteacct()">Delete Account</button>
        </div>
    </div>


</body>

</html>