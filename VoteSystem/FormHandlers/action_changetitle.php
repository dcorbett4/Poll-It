<?php

session_start();
$id = $_SESSION['id'];


include(dirname(__DIR__) . '/Helpers.php');
require(dirname(__DIR__) . '/Connection.php');

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
