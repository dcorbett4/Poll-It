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

                <li><a href="/VoteSystem/userpages/homepage_user.php"> DASHBOARD</a></li>
                <li><a href="/VoteSystem/userpages/results_user.php"> RESULTS</a></li>

            </ul>

        </nav>

        <h3>MANAGE</h3>
        <nav>
            <ul>
                <li><a href="/VoteSystem/userpages/vote_user.php"> VOTE </a></li>
            </ul>
        </nav>

        <h3>SETTINGS</h3>
        <nav>
            <ul>
                <li><a href="/VoteSystem/userpages/settings_user.php"> USER </a></li>
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