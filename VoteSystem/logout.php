<?php

session_start();

if (isset($_POST['logout'])){
    session_destroy();
    session_unset();
    header("Location: /VoteSystem/login.php");
}
  
  

?>