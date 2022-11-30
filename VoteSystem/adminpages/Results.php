<?php

session_start();
$user = $_SESSION['user'];
$id = $_SESSION['id'];
include(dirname(__DIR__) . '/Helpers.php');

?>
<!DOCTYPE html>
<html>

<head>
    <title>Home Page Title</title>
    <link rel="stylesheet" type="text/css" href="/VoteSystem/StyleS/Homepage.css" />
</head>

<body>
    <h2><?php echo $user ?></h2>

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

    <h2><a href="/VoteSystem/adminpages/homepage.php">No Results To Display</a></h2>


</body>

</html>