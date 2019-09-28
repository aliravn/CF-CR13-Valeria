<?php 
session_start();
if(!isset($_SESSION['user'])) {
	header("Location: index.php");
	exit;
} else {
	require_once 'db_connect.php';

	if ($_GET['id']) {
		$id = $_GET['id'];
		$sql_confirm_friendship = "UPDATE friendships SET `friend_status` = 'confirmed' WHERE friendshipID = '$id'" ;
		if($connect->query($sql_confirm_friendship) === TRUE) {
				header("Location: friendships.php");
				exit;
		} else {
				echo "Error while updating record : ". $connect->error;
		}
	}
}			
$connect->close();
?>