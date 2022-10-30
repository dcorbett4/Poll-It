<?php

$error = NULL;


require('C:/xampp/htdocs/VoteSystem/Connection.php');

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $conn = new mysqli($server, $user, $pass, $dbname);

    $id = $_POST['user'];
    $password = $_POST['pass'];

    $sql = "SELECT * FROM Logins WHERE user = '$id' ";
    $query = mysqli_query($conn,$sql);

    //Check that username exists
if(mysqli_num_rows($query) == 0){
    $_SESSION['log_err'][] = "User Does Not Exists<br>";
    $error = $_SESSION['log_err'];
    //     echo"<pre>";
    // print_r($_SESSION['log_err']);
    // echo"<pre><br>";


}else {

//Compare passwords
$row = $query -> fetch_row();

// echo"<pre>";
// print_r($row);
// echo"<pre><br>";

$pass2 = $row[2];

// echo $password;
// echo $pass2;

if($password != $pass2){
    $_SESSION['log_err'][] = "Password Is Not Correct<br>";
    $error = $_SESSION['log_err'];
    // echo"<pre>";
    // print_r($_SESSION['log_err']);
    // echo"<pre><br>";

 }

 if( $error == null) {
    // echo "login succesful";

    $_SESSION['id'] = $row[0];
    $_SESSION['user'] = $row[1];
    $_SESSION['Admin'] = $row[3];
    if($_SESSION['Admin'] == 1){
    header("Location:/VoteSystem/adminpages/homepage.php");
    }else{
    header("Location:/VoteSystem/userpages/homepage_user.php");   
    }
}


}


}
function err_display_log(){

    if(isset($_SESSION['log_err'])){
        $error = $_SESSION['log_err'];
        echo"<h3>Login Failed</h1>";
        echo "<ul>";
        foreach($error as $err){
            echo "<li> $err </li>";
        }
        echo "</ul>";
        unset($_SESSION['log_err']);
    }    
}
?>