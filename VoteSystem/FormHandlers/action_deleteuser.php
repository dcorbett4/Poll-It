<?php

session_start();
$id = $_SESSION['id'];
include("/xampp/htdocs/VoteSystem/Helpers.php");
require('C:/xampp/htdocs/VoteSystem/Connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $conn = new mysqli($server, $user, $pass, $dbname);
    $erro = [];

    $sql = "SELECT * FROM logins WHERE id='$id'";
    $query = mysqli_query($conn, $sql);


    if (mysqli_num_rows($query) > 0) {
        if (count($erro) == 0) {
            $sql = "DELETE FROM logins WHERE id='$id'";
            if (mysqli_query($conn, $sql)) {
                echo "User Deleted";
                header("Location:/VoteSystem/login.php");
            }
        }
    } else {
        $_SESSION['reg_err'][] = "User Doesn't Exist<br>";
        array_push($erro, $_SESSION['reg_err']);
    }
    echo "User Deleted '$id'";
}

function err_display_deleteuser()
{
    if (isset($_SESSION['log_err'])) {
        $error = $_SESSION['log_err'];
        echo "<h3>User Deletion Failed</h1>";
        echo "<ul>";
        foreach ($error as $err) {
            echo "<li> $err </li>";
        }
        echo "</ul>";
        unset($_SESSION['log_err']);
    }
}
