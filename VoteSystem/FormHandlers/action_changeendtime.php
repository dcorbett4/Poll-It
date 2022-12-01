<?php

session_start();
$id = $_SESSION['id'];


include(dirname(__DIR__) . '/Helpers.php');
require(dirname(__DIR__) . '/Connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $date = $_POST['End_Datetime'];
    $conn = new mysqli($server, $user, $pass, $dbname);

    $erro = [];

    $sql = "SELECT * FROM poll";
    $query = mysqli_query($conn, $sql);

    $today = date("Y-m-d H:i:s");

    if (mysqli_num_rows($query) > 0) {

        if ($today > $date) {
            $_SESSION['reg_err'][] = "Time has already passed<br>";
            array_push($erro, $_SESSION['reg_err']);
        }

        if (count($erro) == 0) {
            $sql = "UPDATE poll SET End = '$date'";
            if (mysqli_query($conn, $sql)) {
                echo "End Time Updated";
                header("Location:/VoteSystem/adminpages/Manage_Polls.php");
            }
        }

        echo "New End Date already passed, go back and submitted a new date.";
    }
}

function err_display_changeenddate()
{
    if (isset($_SESSION['log_err'])) {
        $error = $_SESSION['log_err'];
        echo "<h3>End Date Update Failed</h1>";
        echo "<ul>";
        foreach ($error as $err) {
            echo "<li> $err </li>";
        }
        echo "</ul>";
        unset($_SESSION['log_err']);
    }
}
