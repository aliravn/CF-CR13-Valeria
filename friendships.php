<?php
session_start();
if(!isset($_SESSION['user'])) {
	header("Location: index.php");
	exit;
}

require_once 'db_connect.php';

$sql_user = "SELECT * FROM users WHERE userID=".$_SESSION['user'];
$result = $connect->query($sql_user);
$user_details = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Blinker&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/dashboard.css">
</head>

<body>

<!-- NAVBAR section -->
	<nav class="navbar">
		<div class="media d-flex align-items-center">
			<img src="<?php echo $user_details['userpic']; ?>" alt="..." width="80" class="mr-3 rounded img-thumbnail nav-thumbnail-color">
			<div class="media-body">
				<h4 class="m-0"><?php echo $user_details['username']; ?></h4>
				<p class="font-weight-light mb-0">Friends[tba]</p>
			</div>
		</div>	
		<a href="logout.php?logout" class="nav-logout-color" />Logout<i class="fa fa-sign-out nav-logout-color fa-fw"></i></a>
	</nav>

<!-- PAGE CONTENT section -->
	<div class="page-content page-content-friendship">
		<div class="container-fluid">
			<div class="row">
			HERE ALL THE EXISTING FRIENDS OF THE CURRENT USER WILL BE DISPLAYED
			</div>
		</div>
	</div>

<!-- SIDEBAR-NAVIGATION section -->	
<?php include "sidebar.php"; ?>


<footer>
	2019 &copy; AliraVN
</footer>
<!-- ********************** JavaScript starts here **********************-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>