<?php 
session_start();
if(!isset($_SESSION['user'])) {
	header("Location: index.php");
	exit;
} else {
	require_once 'db_connect.php';
//insernt i DB with ajax request
	if (isset($_POST["info_sent_to_php"])) {
		$id = mysqli_real_escape_string($connect, $_POST["info_sent_to_php"]);
		$sql_add_friend = "INSERT INTO friendships (`fk_userID_from`,`fk_userID_to`) VALUES ('".$_SESSION['user']."','$id')";
		$result_add_friend = $connect->query($sql_add_friend);
		echo $result_add_friend;
	}

	//insernt in DB with as PHP request
	//in this case button should have link as href='add_friend.php?id=".$row['userID']."'
	// if ($_GET['id']) {
	// 	$id = $_GET['id'];
	// 	$sql_add_friend = "INSERT INTO friendships (`fk_userID_from`,`fk_userID_to`) VALUES ('".$_SESSION['user']."','$id')";
	// 	$check = $connect->query($sql_add_friend);
	// 	if($check  === TRUE) {
	// 		header("Location: home.php");
	// 		exit;
	// 	} else {
	// 		echo "Error while sending friend request: ". $connect->error;
	// 	}
	// }
}			
$connect->close();
?>