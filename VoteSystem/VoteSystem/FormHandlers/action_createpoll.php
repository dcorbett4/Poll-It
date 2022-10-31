<?php

include("/xampp/htdocs/VoteSystem/Helpers.php");
require('C:/xampp/htdocs/VoteSystem/Connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $conn = new mysqli($server, $user, $pass, $dbname);

    $poll_name = $_POST['title'];
    $erro = [];
    $date = date('Y-m-d H:i:s');

    if (empty($poll_name)) {
        $_SESSION['reg_err'][] = "Title is Empty<br>";
        array_push($erro, $_SESSION['reg_err']);
    }

    if (count($erro) == 0) {
        $sql = "INSERT INTO poll (title, start, status ) VALUES ('$poll_name' , '$date', 0)";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['registered_user'] = TRUE;
            echo "Poll Created";
            header("Location:/VoteSystem/adminpages/Manage_Polls.php");
        }
    }
}

function err_display_createpoll()
{
    if (isset($_SESSION['log_err'])) {
        $error = $_SESSION['log_err'];
        echo "<h3>Poll Creation Failed</h1>";
        echo "<ul>";
        foreach ($error as $err) {
            echo "<li> $err </li>";
        }
        echo "</ul>";
        unset($_SESSION['log_err']);
    }
}
