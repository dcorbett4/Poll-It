<?php

include("/xampp/htdocs/VoteSystem/Helpers.php");
require('C:/xampp/htdocs/VoteSystem/Connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $conn = new mysqli($server, $user, $pass, $dbname);

    $poll_name = $_POST['title'];
    $erro = [];
    $date = date('Y-m-d H:i:s');
    $enddate = date('Y-m-d H:i:s', strtotime(' + 1 days'));

    $sql = "SELECT * FROM poll";
    $query = mysqli_query($conn, $sql);

    if (empty($poll_name)) {
        $_SESSION['reg_err'][] = "Title is Empty<br>";
        array_push($erro, $_SESSION['reg_err']);
    }

    if (count($erro) == 0) {
        $sql = "INSERT INTO poll (title, start, status, end ) VALUES ('$poll_name' , '$date', 0, '$enddate')";
        if (mysqli_query($conn, $sql)) {
            echo "Poll Created";
            header("Location:/VoteSystem/adminpages/Manage_Polls.php");
        }
    }

    echo "Poll Already Created Reset To Create A New Poll";
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
