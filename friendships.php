<?php
session_start();
if(!isset($_SESSION['user'])) {
	header("Location: index.php");
	exit;
}

require_once 'db_connect.php';
//display username and userpic in navigation panel
$sql_user = "SELECT * FROM users WHERE userID=".$_SESSION['user'];
$result = $connect->query($sql_user);
$user_details = mysqli_fetch_array($result, MYSQLI_ASSOC);

// display all friends of the current user, who confirmed request
$sql_friends = "SELECT userID, username, userpic FROM friendships JOIN users ON fk_userID_from = userID OR fk_userID_to = userID WHERE friend_status='confirmed' AND fk_userID_from =" .$_SESSION['user']. " AND userID !=" .$_SESSION['user']. " OR friend_status='confirmed' AND fk_userID_to =" .$_SESSION['user']. " AND userID !=".$_SESSION['user'];
$result_friends = $connect->query($sql_friends);


// display all friends of the current user, whom user has sent request to
$sql_request_sent = "SELECT userID, username, userpic FROM users JOIN friendships ON fk_userID_to = userID AND friend_status = 'request' WHERE fk_userID_from =" .$_SESSION['user'];
$result_request_sent = $connect->query($sql_request_sent);

// display friend requests, waiting for confirmation from current user
$sql_friend_request = "SELECT userID, username, userpic, friendshipID FROM users JOIN friendships ON fk_userID_from = userID AND friend_status='request' WHERE fk_userID_to =" .$_SESSION['user'];
$result_friend_request = $connect->query($sql_friend_request);

?>

<!DOCTYPE html>
<html>
<head>
	<title>PEOPLE|Friends</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Blinker|Saira+Stencil+One&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/dashboard.css">
</head>

<body>

<!-- HEADER section -->
	<header>
		<h2>PEOPLE = finding friends made easy</h2>
	</header>

<!-- PAGE CONTENT section -->
	<div class="page-content page-content-friendship">
		<div class="container-fluid">
			<div class="row">
				<?php
				if($result_friends->num_rows > 0) {
					$name_of_user = strtoupper($user_details['username']);
					echo "<h4 class='col-12 text-center'><span>CONFIRMED</span> FRIENDS OF <span>$name_of_user</span></h4>";
					echo "<div class='col-12 text-center' id='update'></div>";
					while($row = $result_friends->fetch_assoc()) {
						echo
						"<div class='col-6 col-md-3 col-lg-2 p-2  friend-card'>
							<div class='friend-card col-border col-border-friends p-2'>
								<img class='img-fluid img-thumbnail' src=".$row['userpic'].">
								<p class='friend-username'>".$row['username']."</p>
							</div>
						</div>";
					}
				} else {	
					echo "<h4 class='col-12 text-center'>YOU HAVE NO FRIENDS</h4>";
					echo "<h4 class='col-12 text-center'>=^.^=</h4>";
				}
				?>
			</div>
			<div class="row">
				<?php
				if($result_request_sent->num_rows > 0) {
					echo "<h4 class='col-12 text-center'>SENT REQUESTS TO:</h4>";
					while($row = $result_request_sent->fetch_assoc()) {
						echo
						"<div class='col-6 col-md-3 col-lg-2 p-2  friend-card'>
							<div class='friend-card col-border col-border-pending p-2'>
								<img class='img-fluid img-thumbnail' src=".$row['userpic'].">
								<p class='friend-username'>".$row['username']."</p>
							</div>
						</div>";
					}
				}
				?>
			</div>
			<div class="row">
				<?php
				if($result_friend_request->num_rows > 0) {
					echo "<h4 class='col-12 text-center'>WAITING FOR YOUR CONFIRMATION:</h4>";
					while($row = $result_friend_request->fetch_assoc()) {
						echo
						"<div class='col-6 col-md-3 col-lg-2 p-2  friend-card'>
							<div class='friend-card col-border col-border-pending p-2'>
								<img class='img-fluid img-thumbnail' src=".$row['userpic'].">
								<p class='friend-username'>".$row['username']."</p>
							</div>
							<a class='button-container' href='confirm_friend_request.php?id=".$row['friendshipID']."'>	
								<button class='add-friend-button' id='".$row['friendshipID']."' type='button'>Confirm</button>
							</a>
						</div>";
					}
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