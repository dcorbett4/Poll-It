<?php

session_start();
$id = $_SESSION['id'];


include("/xampp/htdocs/VoteSystem/Helpers.php");
require('C:/xampp/htdocs/VoteSystem/Connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $conn = new mysqli($server, $user, $pass, $dbname);
    if(isset($_POST['new_username'])){
        $newname = $_POST['new_username'];          
        $sql = "UPDATE logins SET user = '$newname' WHERE id = $id";
        $query = mysqli_query($conn,$sql);
        $_SESSION['user'] = $newname; 
        header("Location:/VoteSystem/adminpages/settings.php");
    }

    if(isset($_POST['pass1'])  && isset($_POST['pass2'])){
        $newpass = $_POST['pass1'];       
        $sql = "UPDATE logins SET pass = '$newpass' WHERE id = $id";
        $query = mysqli_query($conn,$sql);
        header("Location:/VoteSystem/adminpages/settings.php"); 
    }
}
  
?>