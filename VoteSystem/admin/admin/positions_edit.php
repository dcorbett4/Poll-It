<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$description = $_POST['description'];
		$max_vote = $_POST['max_vote'];

		$sql = "UPDATE poll SET description = '$description', max_vote = '$max_vote' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'poll updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location: poll.php');

?>