<?php
session_start();
include(dirname(__DIR__) . '/Helpers.php');
require(dirname(__DIR__) . '/Connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $conn = new mysqli($server, $user, $pass, $dbname);

    $poll_entry = $_POST['new_choice'];
    $erro = [];

    $sql = "SELECT * FROM poll";
    $query = mysqli_query($conn, $sql);



    if (mysqli_num_rows($query) == 0) {
        echo "Poll Not Created Please Create Poll To Add Choices";
    } else {

        $imageDir = $ROOT_PATH . "Choice_Imgs/";
        $image_filename = basename($_FILES["img_upload"]['name']);
        $imagepath = $imageDir . $image_filename;
        $fileType = pathinfo($imagepath, PATHINFO_EXTENSION);

        echo $imagepath;

        if (isset($_POST["submit"]) && !empty($_FILES["img_upload"]["name"])) {

            $validextensions = array('jpg', 'png', 'jpeg', 'gif');
            if (in_array($fileType, $validextensions)) {
                //upload to Choices_img folder
                if (move_uploaded_file($_FILES["img_upload"]["tmp_name"], $imagepath)) {
                    $sql = "INSERT into Choices (Poll_ID, Text, Image, Selections) VALUES (1,'$poll_entry','" . $image_filename . "',0)";
                    $query = mysqli_query($conn, $sql);
                    header("Location:/VoteSystem/adminpages/Manage_Choices.php");
                }
            }
        }
    }
}






function err_display_createchoice()
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
