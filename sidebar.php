<?php 
	if(!isset($_SESSION['user'])) {
		header("Location: index.php");
		exit;
	}
?>

<div class="sidebar-nav bg-white" id="sidebar">
	<div class="media d-flex align-items-center mx-2 mb-4">
		<img src="<?php echo $user_details['userpic']; ?>" alt="..." class="mr-3 rounded img-thumbnail nav-thumbnail-color" id="avatar">
		<div class="media-body">
			<h4 class="m-0"><?php echo $user_details['username']; ?></h4>
			<p class="font-weight-light mb-0">Friends[tba]</p>
		</div>
	</div>
	<p class="text-gray font-weight-bold text-uppercase px-3 mb-0 small">Navigation</p>
	<ul class="nav flex-column bg-white mb-0">
		<li class="nav-item">
			<a href="home.php" class="nav-link text-dark font-italic">
				<i class="fa fa-home sidebar-link sidebar-link-large mr-1"></i>
				Home
			</a>
		</li>
		<li class="nav-item">
			<a href="friendships.php" class="nav-link text-dark font-italic">
				<i class="fa fa-users sidebar-link fa-fw"></i>
				Show friends [ok]
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
	</ul>
</div>