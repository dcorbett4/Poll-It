<?php
session_start();
$username = $_SESSION['user'];
$id = $_SESSION['id'];

require('C:/xampp/htdocs/VoteSystem/Helpers.php');
require('C:/xampp/htdocs/VoteSystem/Connection.php');

$conn = new mysqli($server,$user,$pass, $dbname);

$imageDir = $ROOT_PATH."User_Imgs/";
$image_filename = basename($_FILES['img_upload']['name']);
$imagepath = $imageDir.$image_filename;
$fileType = pathinfo($imagepath, PATHINFO_EXTENSION);

echo $imagepath;

if(isset($_POST["submit"]) && !empty($_FILES["img_upload"]["name"])){

    $validextensions = array('jpg','png','jpeg','gif');
    if(in_array($fileType,$validextensions)) {
        //upload to User_img folder
        if(move_uploaded_file($_FILES["img_upload"]["tmp_name"],$imagepath)){
            

            $sql = "SELECT * FROM images WHERE user_id = $id";
            $query = mysqli_query($conn,$sql);
            //make sure query successful
            if ($query) {
            //check if user already has an image
            if (mysqli_num_rows($query) > 0) {
                $sql = "UPDATE images SET img_name = '$image_filename' WHERE user_id = $id";
            } else {
                $sql = "INSERT into images (user_id, img_name) VALUES ($id,'".$fileName."')";
            }
            $query = mysqli_query($conn,$sql);
            
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
}
}
