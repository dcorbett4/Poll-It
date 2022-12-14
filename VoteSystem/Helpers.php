<?php

//Create a root path to access include/require php files 
$ROOT_PATH = dirname(__DIR__);


//display profile picture
function profile_pic()
{

    $server = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "VOTEDB";
    $conn = new mysqli($server, $user, $pass, $dbname);

    $id = $_SESSION['id'];

    $sql = "SELECT * FROM images WHERE user_id = $id";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        if (mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_array($query);
            $img_name = $row[2];

            $img = "/VoteSystem/User_Imgs/$img_name";
        } else {
            $img = "/VoteSystem/User_Imgs/defaultimg.jpg";
        }
    }

    echo '<div>';
    echo '<img width="15%"id="profile_picture" src ="' . $img . '" alt="Profile_Picture">';
    echo '</div';
}

function voterinfo()
{

    $server = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "VOTEDB";
    $conn = new mysqli($server, $user, $pass, $dbname);

    $id = $_SESSION['id'];

    $sql = "SELECT * FROM logins WHERE user_id != 1";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        if (mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_array($query);
        } else {
        }
    }
}
/*
* This function checks if the poll has expired yet, and returns a value.
* 
* Returning 0 means the poll is still available
* Returning 1 means the poll has expired
* Returning 2 means there is no poll created
*/
function checkexpiration()
{
    $server = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "VOTEDB";
    $conn = new mysqli($server, $user, $pass, $dbname);

    $sql = mysqli_query($conn, "SELECT End FROM poll");

    if (mysqli_num_rows($sql) > 0) {
        $query = mysqli_fetch_array($sql);

        $today = date("Y-m-d H:i:s");
        $end = $query['End'];
        if ($today < $end) {
            return 0; //the poll is still available
        } else {
            return 1; //the poll has expired
        }
    } else {
        return 2; //there is no poll created
    }
}

function checkvoterstatus()
{
    $server = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "VOTEDB";
    $conn = new mysqli($server, $user, $pass, $dbname);

    $id = $_SESSION['id'];

    $sql = "SELECT * FROM voterstatus WHERE ID = '$id'";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_array($query);
        if ($row['Status'] == 0) {
            return true;
        } else {
            return false;
        }
    } else {
        $sql = "INSERT INTO voterstatus VALUES ('$id', 1, 'none')";
        if (mysqli_query($conn, $sql)) {
            return false;
        }
    }
}

function checkpoll()
{
    $server = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "VOTEDB";
    $conn = new mysqli($server, $user, $pass, $dbname);

    $sql = mysqli_query($conn, "SELECT * FROM poll");

    if (mysqli_num_rows($sql) > 0) {
        $title = mysqli_fetch_array($sql);
        $_SESSION['Polltitle'] = $title['Title'];
        return true;
    } else
        return false;
}

function topchoice()
{
    $server = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "VOTEDB";
    $conn = new mysqli($server, $user, $pass, $dbname);

    $sql = mysqli_query($conn, "SELECT * FROM choices ORDER BY SELECTIONS DESC LIMIT 1");
    if (mysqli_num_rows($sql) > 0) {
        $topchoice  = mysqli_fetch_array($sql);
        $num = $topchoice['TEXT'];
        $images = $topchoice['IMAGE'];
        echo "<h2>$num </h2> <br>";
        echo "<img width=\"10%\"id=\"profile_picture\" src =\"/VoteSystem/Choice_Imgs/$images\" alt=\"Profile_Picture\">";
    } else

        echo "NO CHOICE AVAILABLE";
}



function err_display_cand()
{

    if (isset($_SESSION['cand_err'])) {
        echo $_SESSION['cand_err'][0];
        unset($_SESSION['cand_err']);
    }
    
}


function err_display_vote()
{

    if (isset($_SESSION['vote_info'])) {
        echo $_SESSION['vote_info'][0];
        unset($_SESSION['vote_info']);
    }
}

function endtime()
{
    $server = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "VOTEDB";
    $conn = new mysqli($server, $user, $pass, $dbname);

    $sql = mysqli_query($conn, "SELECT * FROM poll");
    $time = ' N/A';
    if (mysqli_num_rows($sql) > 0) {
        $title = mysqli_fetch_array($sql);
        $time = $title['End'];
    }
        echo $time;

}

function checktotalvotes()
{
    $server = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "VOTEDB";
    $conn = new mysqli($server, $user, $pass, $dbname);

    $totalvotes = 0;
    $sql = mysqli_query($conn, "SELECT SELECTIONS FROM choices");
    while ($row = mysqli_fetch_array($sql)) {
        $totalvotes += $row['SELECTIONS'];
    }

    return $totalvotes;
}
