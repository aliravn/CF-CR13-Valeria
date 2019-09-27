<?php 
	if(!isset($_SESSION['user'])) {
		header("Location: index.php");
		exit;
	}
?>

<div class="sidebar-nav bg-white" id="sidebar">
	<p class="text-gray font-weight-bold text-uppercase px-3 mb-0 small">Navigation</p>
	<ul class="nav flex-column bg-white mb-0">
		<li class="nav-item">
			<a href="home.php" class="nav-link text-dark font-italic">
				<i class="fa fa-home sidebar-link sidebar-link-large mr-1"></i>
				Home
			</a>
		</li>
		<li class="nav-item">
			<a href="#" class="nav-link text-dark font-italic">
				<i class="fa fa-user-plus sidebar-link fa-fw"></i>
				Add friends [n/a]
			</a>
		</li>
		<li class="nav-item">
			<a href="#" class="nav-link text-dark font-italic">
				<i class="fa fa-users sidebar-link fa-fw"></i>
				Show friend [n/a]
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