<?php

session_start();
$user = $_SESSION['user'];
$id = $_SESSION['id'];


include("/xampp/htdocs/VoteSystem/Helpers.php");
require('C:/xampp/htdocs/VoteSystem/Connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $conn = new mysqli($server, $user, $pass, $dbname);

    $id = substr($_POST['vote'], 9);

    $sql = "SELECT * FROM choices WHERE Choice_ID = '$id'";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {

        $queryArr = $query->fetch_array(MYSQLI_ASSOC);
        $newSelections = $queryArr['SELECTIONS'] + 1;

        if ($newSelections > 0) {
            $sql = "UPDATE choices SET SELECTIONS = '$newSelections' WHERE Choice_ID = '$id'";
            if (mysqli_query($conn, $sql)) {
                echo "Poll Created";
                header("Location:/VoteSystem/userpages/vote_user.php");
            }
        } else {
            echo "Bad Math";
        }
    }
    echo "Choice Doesn't Exist Go Back and Try Again!";
}
