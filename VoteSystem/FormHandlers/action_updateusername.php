<?php

session_start();
$id = $_SESSION['id'];


include(dirname(__DIR__) . '/Helpers.php');
require(dirname(__DIR__) . '/Connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $conn = new mysqli($server, $user, $pass, $dbname);
    if (isset($_POST['new_username'])) {
        $newname = $_POST['new_username'];
        $sql = "UPDATE logins SET user = '$newname' WHERE id = $id";
        $query = mysqli_query($conn, $sql);
        $_SESSION['user'] = $newname;

        $sql = "SELECT permission FROM logins WHERE id='$id' ";
        $query = $conn->query($sql);
        $result = $query->fetch_array(MYSQLI_ASSOC);

        if ($result["permission"] == 0) {
            header("Location:/VoteSystem/userpages/settings_user.php");
        } else {
            header("Location:/VoteSystem/adminpages/settings.php");
        }
    }

    if (isset($_POST['pass1'])  && isset($_POST['pass2'])) {
        $newpass = $_POST['pass1'];
        $sql = "UPDATE logins SET pass = '$newpass' WHERE id = $id";
        $query = mysqli_query($conn, $sql);

        $sql = "SELECT permission FROM logins WHERE id='$id' ";
        $query = $conn->query($sql);
        $result = $query->fetch_array(MYSQLI_ASSOC);

        if ($result["permission"] == 0) {
            header("Location:/VoteSystem/userpages/settings_user.php");
        } else {
            header("Location:/VoteSystem/adminpages/settings.php");
        }
    }
}
