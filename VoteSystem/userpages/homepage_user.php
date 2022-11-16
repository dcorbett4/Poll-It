<?php

session_start();
$user = $_SESSION['user'];
$id = $_SESSION['id'];

?>
<!DOCTYPE html>
<html>

<head>
    <title>Home Page Title</title>
    <link rel="stylesheet" type="text/css" href="/VoteSystem/StyleS/Homepage.css" />
</head>

<body>
    <h2>Welcome, <?php echo $user ?></h2>

    <div>
        <img id="profile_pic" src="/VoteSystem/User_Imgs/defaultimg.jpg" alt="Default_User Image">
    </div>

    <div>
        <h3>HOME</h3>
        <nav>
            <ul>

                <li><a href="/VoteSystem/homepage_user.php"> DASHBOARD</a></li>
                <li><a href="#"> RESULTS</a></li>

            </ul>

        </nav>

        <h3>MANAGE</h3>
        <nav>
            <ul>
                <li><a href="#"> POLL </a></li>
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

</body>

</html>