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
.$_SESSION['user']." OR fk_userID_to = ".$_SESSION['user'].") AND userID !=".$_SESSION['user'];
$result_others = $connect->query($sql_others);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>	
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
			<div class="row">		
				<?php
				if($result_others->num_rows > 0) {
					echo "<h4 class='col-12 text-center'>THESE ARE REGISTERED USERS, WHO ARE NOT YOUR FRIENDS YET</h4>";
					echo "<div class='col-12 text-center' id='update'></div>";
					while($row = $result_others->fetch_assoc()) {
						echo 
						"<div class='col-6 col-md-3 col-lg-2 p-2 friend-card friend-box'>
							<div class='friend-card col-border p-2'>
								<img class='img-fluid img-thumbnail' src=".$row['userpic'].">
								<p class='friend-username'>".$row['username']."</p>
							</div>
							<a class='button-container'>
								<button class='add-friend-button' name='".$row['username']."' id='".$row['userID']."' type='button'>Add Friend</button>
							</a>							
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


<script>
$(document).ready(function() {
	$('.add-friend-button').click(function(e) {
		e.preventDefault();
		$(this).closest('.friend-box').hide();
		var user_id = this.id;
		var name = this.name;
		$.ajax({
			url:'add_friend.php',
			method:"POST",
			data:{info_sent_to_php:user_id},
			success:function(data) {
				if (data == 1) {
					$('#update').html(`<span><?php echo $user_details['username']; ?> is now a friend of ${name}</span>`);
					$('#update').css("background-color","#4bf542");
				} else {
					$('#update').html(`<span class="text-danger">${data}</span>`);
				}	
			}
		})
	});
})

// $(document).ready(function(){
// 	$('input').focus(function(){
// 		$('#update').empty();
// 		$('#update').css("background-color","transparent");		
// 	})
// });
</script>



<footer>
	<p>2019 &copy; AliraVN</p>
</footer>
</body>
</html>