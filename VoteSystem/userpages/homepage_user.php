<?php

session_start();
$user = $_SESSION['user'];
$id = $_SESSION['id'];

include(dirname(__DIR__) . '/Helpers.php');

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
            <a href="/VoteSystem/contact.html" name="Contact" class="logout_btn">Contact Us</a>
        </div>


    </header>

    <div class="navbar">
        <center>
            <?php
            profile_pic();
            ?>
            <h4 id="username"> Welcome,<?php echo $_SESSION['user']; ?></h4>
        </center>

        <a href="/VoteSystem/userpages/homepage_user.php"><i class="fa fa-home" aria-hidden="true"></i><span>DASHBOARD</span></a>
        <a href="/VoteSystem/userpages/results_user.php"><i class="fa fa-bar-chart" aria-hidden="true"></i><span>RESULTS</span></a>

        <a href="/VoteSystem/userpages/vote_user.php"><i class="fa fa-check-to-slot" aria-hidden="true"></i><span>VOTE</span></a>
        <a href="/VoteSystem/userpages/settings_user.php"><i class="fa fa-cogs" aria-hidden="true"></i><span>SETTINGS</span></a>
    </div>


    <div class="content">
        <div id="con">
            <div class="Status">
                <h2>POLL TITLE:
                    <?php
                    if (checkpoll()) {
                        echo $_SESSION['Polltitle'];
                    } else
                        echo "NO POLL  CREATED"
                    ?>

                </h2>
                <h2> POLL STATUS: 
                        <?php
                        $check = checkexpiration();

                        if ($check == 2) {
                            echo "NO POLL CREATED";
                        } else if ($check == 1) {
                            echo "EXPIRED";
                        } else if ($check == 0) {
                            echo "AVAILABLE";
                        }
                        ?>
                    </h2>
            </div>

        </div>
        <div id="stats">
            <div id="totvotes">
                <h3> TOTAL VOTES </h3>
                <div id="tots">
                <?php echo checktotalvotes(); ?>
                </div>
            </div>
            <div id="topchoice">
                <h3> TOP CHOICE</h3>
                <?php
                topchoice();
                ?>
            </div>

        </div>
        <div id="end">
            <h3>EXPIRATION: <?php endtime(); ?></h3>
        </div>
    </div>


</body>

</html>
