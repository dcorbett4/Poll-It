<?php

//Create a root path to access include/require php files 
$ROOT_PATH = "/xampp/htdocs/VoteSystem/";


//display profile picture
function profile_pic() {

    $server = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "VOTEDB"; 
    $conn = new mysqli($server,$user,$pass, $dbname);

    $id = $_SESSION['id'];

    $sql = "SELECT * FROM images WHERE user_id = $id";
    $query = mysqli_query($conn,$sql);

    if ($query) {
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_array($query);
        $img_name= $row[2];
      
       $img = "/VoteSystem/User_Imgs/$img_name";
    } else {
       $img = "/VoteSystem/User_Imgs/defaultimg.jpg";
    }
    }

    echo '<div>';
    echo '<img width="15%"id="profile_picture" src ="'.$img.'" alt="Profile_Picture">';
    echo '</div';

}

function voterinfo(){

    $server = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "VOTEDB"; 
    $conn = new mysqli($server,$user,$pass, $dbname);

    $id = $_SESSION['id'];

    $sql = "SELECT * FROM logins WHERE user_id != 1";
    $query = mysqli_query($conn,$sql);

    if ($query) {
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_array($query);
    
    } else {

    }
    }
}



?>
