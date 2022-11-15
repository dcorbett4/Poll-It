<?php

session_start();
$id = $_SESSION['id'];


include("/xampp/htdocs/VoteSystem/Helpers.php");
require('C:/xampp/htdocs/VoteSystem/Connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $conn = new mysqli($server, $user, $pass, $dbname);

    $sql = "SELECT * FROM poll";
    $query = mysqli_query($conn, $sql);

    
    if(mysqli_num_rows($query) > 0){
    
    $conn = new mysqli($server, $user, $pass, $dbname);

    $sql = "INSERT INTO choices(Poll_ID, Choice_ID, TEXT, IMAGE , SELECTIONS ) * FROM poll";
    $query = mysqli_query($conn, $sql);


    
    }

}



  
?>