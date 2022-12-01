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
