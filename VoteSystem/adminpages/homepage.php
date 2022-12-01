<?php

session_start();
$user = $_SESSION['user'];
$id = $_SESSION['id'];
include(dirname(__DIR__) . '/Helpers.php');
require(dirname(__DIR__) . '/Connection.php');


checkvoterstatus();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Home Page Title</title>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="/VoteSystem/StyleS/Homepage.css" />
</head>

<body>
    <header>
        <div class="left_side">
            <h2>POLL <span>IT</span></h2>
        </div>

        <div id="center">

        </div>

        <div class="right_side">
            <a href="/VoteSystem/logout.php" name="logout" class="logout_btn">Logout</a>
        </div>


    </header>

    <div class="navbar">
        <center>
            <?php
            profile_pic();
            ?>
            <h4 id="username"> Welcome,<?php echo $_SESSION['user']; ?></h4>
        </center>

        <a href="/VoteSystem/adminpages/homepage.php"><i class="fa fa-home" aria-hidden="true"></i><span>DASHBOARD</span></a>
        <a href="/VoteSystem/adminpages/Results.php"><i class="fa fa-bar-chart" aria-hidden="true"></i><span>RESULTS</span></a>

        <a href="/VoteSystem/adminpages/Manage_Polls.php"><i class="fa fa-question" aria-hidden="true"></i><span>POLL</span></a>
        <a href="/VoteSystem/adminpages/Manage_Choices.php"><i class="fa fa-th" aria-hidden="true"></i><span>CHOICES</span></a>
        <a href="/VoteSystem/adminpages/Manage_Voters.php"><i class="fa fa-user" aria-hidden="true"></i><span>VOTERS</span></a>
        <a href="/VoteSystem/adminpages/settings.php"><i class="fa fa-cogs" aria-hidden="true"></i><span>SETTINGS</span></a>
    </div>



    <div class="content">

        <h2><a href="/VoteSystem/adminpages/Manage_Polls.php">
                <?php
                $check = checkexpiration();

                if ($check == 2) {
                    echo "No Poll Created";
                } else if ($check == 1) {
                    echo "Poll has Expired";
                } else if ($check == 0) {
                    echo "Poll is Still Available";
                }
                ?>
            </a></h2>
    </div>


</body>

</html>