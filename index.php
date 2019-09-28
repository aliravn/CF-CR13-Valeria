<?php
ob_start();
session_start();
require_once 'db_connect.php';

if (isset($_SESSION['user'])!="") {
	header("Location: home.php");
	exit;
}

$error = false;

if(isset($_POST['btn-login'])) {

	$email = trim($_POST['email']);
	$email = strip_tags($email);
	$email = htmlspecialchars($email);

	$pass = trim($_POST[ 'pass']);
	$pass = strip_tags($pass);
	$pass = htmlspecialchars($pass);

	if(empty($email)) {
		$error = true;
		$emailError = "Please enter your email address.";
	} else if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		$error = true;
		$emailError = "Please enter valid email address.";
	}

	if (empty($pass)) {
		$error = true;
		$passError = "Please enter your password." ;
	}

	if (!$error) {
		$password = hash('sha256', $pass); 
		$sql_query = mysqli_query($connect, "SELECT userID, username, userpass FROM users WHERE useremail='$email'" );
		$result = mysqli_fetch_array($sql_query, MYSQLI_ASSOC);
		$count = mysqli_num_rows($sql_query); 

		if ($count == 1 && $result['userpass']==$password) {
			$_SESSION['user'] = $result['userID'];
			header("Location: home.php");
		} else {
			$errMSG = "Email and Password don't match. Please try again..." ;
		}
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>PEOPLE|Login</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href ="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"  crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Blinker|Saira+Stencil+One&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/index_style.css">
	</head>

	<body>
	<!-- HEADER section -->
		<header>
			<h1>Welcome to PEOPLE Network</h1>
		</header>

		<form class="login-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete= "off">
			<h3>ACCOUNT LOGIN</h3>
			<br>
			<!-- outputs message from error line 46 -->
			<?php
			if (isset($errMSG)) {
				echo $errMSG;
			}
			?>
			<input type="email" name="email" class="login-input" placeholder="email" value="<?php echo $email; ?>"  maxlength="40"/>
			<span class="text-danger"><?php echo $emailError; ?></span>
			<input type="password" name="pass" class="login-input" placeholder="password" maxlength="15" />
			<span class="text-danger"><?php  echo $passError; ?></span>
			<button type="submit" name="btn-login" class="login-button">LOGIN</button>	
			<p>Not registered yet?  <a href="register.php">Create an account</a></p>
		</form>
	</body>
</html>
<?php ob_end_flush(); ?>