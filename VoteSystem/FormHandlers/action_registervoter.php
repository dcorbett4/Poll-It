<?php
session_start();
require('C:/xampp/htdocs/VoteSystem/Connection.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

$conn = new mysqli($server, $user, $pass, $dbname);

$username = $_POST['user'];
$pass = $_POST['pass'];


//check if user already exist
$sql = "SELECT user FROM logins WHERE user = '$username' ";
$query = mysqli_query($conn,$sql);

echo mysqli_num_rows($query);

//Check that username is unique

if(mysqli_num_rows($query) != 0 || count_chars($username) == 0 ){
    $_SESSION['reg_err'][] = "User Invalid Username<br>";
    header("Location:/VoteSystem/adminpages/Manage_Voters.php");
    die;
}

//make sure password isnt empty
if(count_chars($pass) == 0){
   $_SESSION['reg_err'][] = "Invalid Password<br>";
   header("Location:/VoteSystem/adminpages/Manage_Voters.php");
   die;
}


$sql = "INSERT INTO Logins (user, pass, permission ) VALUES ('$username' , '$pass', 0)";
    if(mysqli_query($conn, $sql)){
    $_SESSION['registered'] = TRUE;
    header("Location:/VoteSystem/adminpages/Manage_Voters.php");
    }




}

function err_display_reg(){

    if(isset($_SESSION['reg_err'])){
        $erro = $_SESSION['reg_err'];
        echo"<h3>Registration Failed</h3>";
        echo "<ul>";
        foreach($erro as $err){
            echo "<li> $err </li>";
        }
        echo "</ul>";
        unset($_SESSION['reg_err']);
    }    
}


?>
