<?php
require_once "db_connect.php";

if (isset($_POST["username_match"])) {
	$username_match = mysqli_real_escape_string($connect, $_POST["username_match"]);
	$query = "SELECT * FROM users WHERE username = '".$username_match."'";
	$result = mysqli_query($connect, $query);
	echo mysqli_num_rows($result);
}
?>
