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
    <h2>Welcome, <?php echo $user ?></h2>

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

    <h2><a href="/VoteSystem/userpages/vote_user.php">
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

</body>

</html>