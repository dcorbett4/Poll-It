<?php

session_start();

include(dirname(__DIR__) . '/Helpers.php');
require(dirname(__DIR__) . '/Connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $conn = new mysqli($server, $user, $pass, $dbname);

    $id = substr($_POST['delete'], 14);

    $sql = "SELECT * FROM choices WHERE Choice_ID = '$id'";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {

        $sql = "DELETE FROM choices WHERE Choice_ID='$id'";
        if (mysqli_query($conn, $sql)) {
            echo "Choice Deleted";
            header("Location:/VoteSystem/adminpages/Manage_Choices.php");
        }
    }
    echo "Choice Doesn't Exist Go Back and Try Again!";
}
