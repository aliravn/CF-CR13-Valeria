<?php
session_start();
if(!isset($_SESSION['user'])) {
	header("Location: index.php");
	exit;
}

require_once 'db_connect.php';

//display username and userpic in navigation panel
$sql_user = "SELECT * FROM users WHERE userID = ".$_SESSION['user'];
$result = $connect->query($sql_user);
$user_details = mysqli_fetch_array($result, MYSQLI_ASSOC);

// display all non-friends for current user
$sql_others = "SELECT userID, username, userpic FROM users WHERE userID NOT IN (SELECT fk_userID_from as userID FROM friendships WHERE fk_userID_from = "
.$_SESSION['user']." OR fk_userID_to = ".$_SESSION['user']." UNION SELECT fk_userID_to as userID FROM friendships WHERE fk_userID_from = "
.$_SESSION['user']." OR fk_userID_to = ".$_SESSION['user'].")";
$result_others = $connect->query($sql_others);

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

<!-- HEADER section -->
	<header></header>

<!-- PAGE CONTENT section -->
	<div class="page-content">
		<div class="container-fluid">
			<p class="col-12 text-center">THESE ARE OTHER REGISTERED USERS, WHO ARE NOT YOUR FRIENDS YET</p>
			<div class="row">
				
				<?php
				if($result_others->num_rows > 0) {
					while($row = $result_others->fetch_assoc()) {
						echo 
						"<div class='col-6 col-md-3 col-lg-2 p-2'>
							<div class='friend-card col-border p-2'>
								<img class='img-fluid img-thumbnail' src=".$row['userpic'].">
								<p class='friend-username'>".$row['username']."</p>
								<a class='' href='add_friend.php?id=".$row['userID']."'>
									<button class='' type='button'>Add Friend</button>
								</a>
							</div>
						</div>";
					} 
				} else {
					echo "You have already become friends with all registered users";
				}	
				?>
			</div>
		</div>
	</div>

<!-- SIDEBAR-NAVIGATION section -->	
<?php include "sidebar.php"; ?>


<footer>
	<p>2019 &copy; AliraVN</p>
</footer>
<!-- ********************** JavaScript starts here **********************-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>