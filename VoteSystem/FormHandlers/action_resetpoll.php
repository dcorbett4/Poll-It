<?php

session_start();
$id = $_SESSION['id'];
include(dirname(__DIR__) . '/Helpers.php');
require(dirname(__DIR__) . '/Connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $conn = new mysqli($server, $user, $pass, $dbname);
    $erro = [];

    $sql = "SELECT * FROM poll";
    $query = mysqli_query($conn, $sql);


    if (mysqli_num_rows($query) > 0) {
        if (count($erro) == 0) {
            $sql = "DELETE FROM poll";
            if (mysqli_query($conn, $sql)) {
                echo "Poll Reset";

                $sql = "DELETE FROM choices";
                if (mysqli_query($conn, $sql)) {
                    echo "Choices Reset";

                    $sql = "DELETE FROM voterstatus";
                    if (mysqli_query($conn, $sql)) {
                        echo "Voter Status Reset";
                        header("Location:/VoteSystem/adminpages/Manage_Polls.php");
                    }
                }
            }
        }
    } else {
        $_SESSION['reg_err'][] = "No Poll Exist<br>";
        array_push($erro, $_SESSION['reg_err']);
    }
    echo "No Poll exist. One needs to be created before it can be deleted.";
}

function err_display_deleteuser()
{
    if (isset($_SESSION['log_err'])) {
        $error = $_SESSION['log_err'];
        echo "<h3>Poll Reset Failed</h1>";
        echo "<ul>";
        foreach ($error as $err) {
            echo "<li> $err </li>";
        }
        echo "</ul>";
        unset($_SESSION['log_err']);
    }
}
