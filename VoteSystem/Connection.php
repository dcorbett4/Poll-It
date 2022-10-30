<?php

$server = "localhost";
$user = "root";
$pass = "";
//database name
$dbname = "VOTEDB"; 

include("/xampp/htdocs/VoteSystem/Helpers.php");

//Initialize connection to mysqli
    $init = new mysqli($server, $user, $pass);

//Verify connection
    if($init -> connect_error){
        die("Connection failed: " . $conn -> connect_error);
    }

?>