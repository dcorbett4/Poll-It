<?php

session_start();

include(dirname(__DIR__) . '/Helpers.php');
require(dirname(__DIR__) . '/Connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $conn = new mysqli($server, $user, $pass, $dbname);

    $id = substr($_POST['delete'], 12);

    $sql = "SELECT * FROM logins WHERE id = '$id'";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {

        $sql = "DELETE FROM logins WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            echo "Poll Created";
            header("Location:/VoteSystem/adminpages/Manage_Voters.php");
        }
    }
    echo "User Doesn't Exist Go Back and Try Again!";
}
