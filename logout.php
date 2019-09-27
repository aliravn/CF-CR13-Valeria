<!-- logout.php: this page contains only a few lines of php code to unset and destroy the current logged in users session, and after destroying the session the page automatically redirect to the ‘index/login’ page. -->

<?php
session_start();
if (!isset($_SESSION['user'])) {
	header( "Location: index.php"); //is session is not started and user not loged in redirect to index.php
} else if(isset($_SESSION [ 'user'])!="") {
	header("Location: home.php"); // otherwise session is on and user is redirected to home.php
}

if (isset($_GET['logout'])) {
	unset($_SESSION[ 'user' ]);
	session_unset();
	session_destroy();
	header("Location: index.php");
	exit;
}
?>
