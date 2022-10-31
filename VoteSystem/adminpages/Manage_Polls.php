<?php

session_start();
$username = $_SESSION['user'];
$id = $_SESSION['id'];

include("/xampp/htdocs/VoteSystem/Helpers.php");

?>
<!DOCTYPE html>
<html>

<head>
    <title>Home Page Title</title>
    <link rel="stylesheet" type="text/css" href="/VoteSystem/StyleS/Homepage.css" />
    <link rel="stylesheet" type="text/css" href="/VoteSystem/StyleS/popup_admin_poll.css" />
    <script src="/VoteSystem/Javascript/pop_handler.js"></script>
</head>

<body>
    <h2><?php echo $username; ?></h2>

    <?php
    profile_pic();
    ?>

    <div>
        <h3>HOME</h3>
        <nav>
            <ul>

                <li><a href="/VoteSystem/adminpages/homepage.php"> DASHBOARD</a></li>
                <li><a href="/VoteSystem/adminpages/homepage.php"> RESULTS</a></li>

            </ul>

        </nav>

        <h3>MANAGE</h3>
        <nav>
            <ul>

                <li><a href="/VoteSystem/adminpages/Manage_Polls.php"> POLL </a></li>
                <li><a href="/VoteSystem/adminpages/Manage_Choices.php"> CHOICES</a></li>
                <li><a href="/VoteSystem/adminpages/Manage_Voters.php"> VOTERS</a></li>


            </ul>
        </nav>

        <h3>SETTINGS</h3>
        <nav>
            <ul>
                <li><a href="/VoteSystem/adminpages/settings.php"> USER</a></li>
            </ul>
        </nav>

        <form action="/VoteSystem/logout.php" method="POST">
            <button type="submit" name="logout" class="btn btn-primary">Logout</button>
        </form>
    </div>

    <div class="popup" id="create_poll">
        <div class="overlay"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup_poll()">&times;</div>
            <h1>Create Poll</h1>
            <form action="#" method="POST">
                <fieldset>
                    <legend>Poll </legend>
                    <label for="title">Enter Title:</label><br>
                    <input type="text" id="title" name="title" required></input>
                </fieldset>
                <button class="form-button" type="submit">Submit</button>
            </form>
        </div>
    </div>

    <div class="popup" id="change_title">
        <div class="overlay"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup_title()">&times;</div>
            <h1>Create Poll</h1>
            <form action="#" method="POST">
                <fieldset>
                    <legend>Change Title</legend>
                    <label for="title">Enter New Title:</label><br>
                    <input type="text" id="title" name="title" required></input>
                </fieldset>
                <button class="form-button" type="submit">Submit</button>
            </form>
        </div>
    </div>


    <div class="popup" id="change_end">
        <div class="overlay"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup_end()">&times;</div>
            <h1>Change End Time</h1>
            <form action="#" method="POST">
                <fieldset>
                    <legend>Select New Endtime </legend>
                </fieldset>
                <button class="form-button" type="submit">Submit</button>
            </form>
        </div>
    </div>


    <div class="popup" id="reset">
        <div class="overlay"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup_reset()">&times;</div>
            <h1>Reset</h1>
            <div>
                <h3>Clear All Poll Information ?</h3>
                <button>Yes</button>
                <button>No</button>

            </div>
        </div>
    </div>


    <div>
        <div>
            <button class="ui_box" id="create_poll" onclick="togglePopup_poll()">Create Poll</button>
        </div>
        <div>
            <button class="ui_box" id="change_title" onclick="togglePopup_title()">Change Title</button>
        </div>
        <div>
            <button class="ui_box" id="change_end" onclick="togglePopup_end()">Change End Time</button>
        </div>
        <div>
            <button class="ui_box" id="reset" onclick="togglePopup_reset()">Reset</button>
        </div>
    </div>

</body>

</html>