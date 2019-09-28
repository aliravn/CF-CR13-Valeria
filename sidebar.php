<?php 
	if(!isset($_SESSION['user'])) {
		header("Location: index.php");
		exit;
	}

	$sql_counter = "SELECT userID FROM users WHERE userID !=" .$_SESSION['user'];
	$result_counter = $connect->query($sql_counter);
	$counter = $result_counter->num_rows;

	$sql_friends = "SELECT userID, username, userpic FROM friendships JOIN users ON fk_userID_from = userID OR fk_userID_to = userID WHERE fk_userID_from =" .$_SESSION['user']. " AND userID !=" .$_SESSION['user']. " OR fk_userID_to =" .$_SESSION['user']. " AND userID !=".$_SESSION['user'];
	$result_friends = $connect->query($sql_friends);
?>

<div class="sidebar-nav bg-white" id="sidebar">
	<div class="media d-flex align-items-center mx-2 mb-4">
		<img src="<?php echo $user_details['userpic']; ?>" alt="..." class="mr-3 rounded img-thumbnail nav-thumbnail-color" id="avatar">
		<div class="media-body">
			<h4 class="m-0"><?php echo $user_details['username']; ?></h4>
			<p class="font-weight-light mb-0">Friends[<?php echo $result_friends->num_rows; ?>/<?php echo $counter; ?>]</p>
		</div>
	</div>
	<p class="text-gray font-weight-bold text-uppercase px-3 mb-0 small">Navigation</p>
	<ul class="nav flex-column bg-white mb-0">
		<li class="nav-item">
			<a href="home.php" class="nav-link text-dark font-italic">
				<i class="fa fa-home sidebar-link sidebar-link-large mr-1"></i>
				Home / Non-friends
			</a>
		</li>
		<li class="nav-item">
			<a href="friendships.php" class="nav-link text-dark font-italic">
				<i class="fa fa-users sidebar-link fa-fw"></i>
				Show friends
			</a>
		</li>
		<li class="nav-item">
			<a href="friendships.php" class="nav-link text-dark font-italic">
				<i class="fa fa-address-book sidebar-link fa-fw"></i>
				Show requests [n/a]
			</a>
		</li>		

		<p class="text-gray font-weight-bold text-uppercase px-3 mt-3 mb-0 small">User settings [n/a]</p>
		<li class="nav-item">
			<a href="#" class="nav-link text-dark font-italic">
				<i class="fa fa-user-circle-o sidebar-link fa-fw"></i>
				Avatar [n/a]
			</a>
		</li>
		<li class="nav-item">
			<a href="#" class="nav-link text-dark font-italic">
				<i class="fa fa-unlock-alt sidebar-link fa-fw"></i>
				Password [n/a]
			</a>
		</li>
		<li class="nav-item">
			<a href="logout.php?logout" class="nav-link text-dark font-italic nav-logout-color" />
				<i class="fa fa-sign-out nav-logout-color fa-fw"></i>
				Logout
			</a>
		</li>		
	</ul>
</div>

