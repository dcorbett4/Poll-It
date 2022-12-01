<?php

session_start();
$user = $_SESSION['user'];
$userid = $_SESSION['id'];


include(dirname(__DIR__) . '/Helpers.php');
require(dirname(__DIR__) . '/Connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $conn = new mysqli($server, $user, $pass, $dbname);

    $id = substr($_POST['vote'], 9);

    $sql = "SELECT * FROM choices WHERE Choice_ID = '$id'";
    $query = mysqli_query($conn, $sql);

    if (!checkvoterstatus()) {
        if (mysqli_num_rows($query) > 0) {

            $queryArr = $query->fetch_array(MYSQLI_ASSOC);
            $newSelections = $queryArr['SELECTIONS'] + 1;
            $choice = $queryArr['TEXT'];

            if ($newSelections > 0) {
                $sql = "UPDATE choices SET SELECTIONS = '$newSelections' WHERE Choice_ID = '$id'";
                if (mysqli_query($conn, $sql)) {
                    $sql = "UPDATE voterstatus SET Status = 0, Selected = '$choice' WHERE ID = '$userid'";
                    if (mysqli_query($conn, $sql)) {
                        echo "VOTED!";
                        header("Location:/VoteSystem/userpages/vote_user.php");
                    }
                }
            } else {
                echo "Bad Math";
            }
        }
        echo "Choice Doesn't Exist Go Back and Try Again!";
    } else {
        echo "You have already voted";
    }
}
