<?php 
session_start();
if(!isset($_SESSION['user'])) {
	header("Location: index.php");
	exit;
} else {
	require_once 'db_connect.php';

	// $sql_user = "SELECT * FROM users WHERE userID=".$_SESSION['user'];
	// $result = $connect->query($sql_user);
	// $user_details = mysqli_fetch_array($result, MYSQLI_ASSOC);

	if ($_GET['id']) {
	$id = $_GET['id'];
	$sql_add_friend = "INSERT INTO friendships (`fk_userID_from`,`fk_userID_to`) VALUES ('".$_SESSION['user']."','$id')";
	if($connect->query($sql_add_friend) === TRUE) {
		header("Location: home.php");
		exit;
	} else {
			echo "Error while sending friend request: ". $connect->error;
		}
	}
}			
$connect->close();
?>