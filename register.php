<?php
ob_start();
session_start();

if(isset($_SESSION['user'])!="") { //if the user is logged in (user not empty)
	header("Location: home.php"); // it redirects to home.php
}

include_once 'db_connect.php';

$error = false;

if (isset($_POST['btn-signup'])) {
	$name = trim($_POST['name']);
	$name = strip_tags($name);
	$name = htmlspecialchars($name);

	$email = trim($_POST['email']);
	$email = strip_tags($email);
	$email = htmlspecialchars($email);

	$pass = trim($_POST['pass']);
	$pass = strip_tags($pass);
	$pass = htmlspecialchars($pass);

	if (empty($name)) {
		$error = true ;
		$nameError = "Please enter your full name";
	} else if  (strlen($name) < 3) {
		$error = true;
		$nameError = "Username must have at least 3 characters";
	} else if (!preg_match("/^[a-zA-Z0-9]+$/",$name)) {
		$error = true ;
		$nameError = "Username must contain only alphabets and/or numbers";
	}

	if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		$error = true;
		$emailError = "Please enter valid email address." ;
	} else {
		$query = "SELECT useremail FROM users WHERE useremail='$email'";
		$result = mysqli_query($connect, $query);
		$count = mysqli_num_rows($result);
		if($count!=0){
			$error = true;
			$emailError = "Provided Email is already in use.";
		}
	}

	$uppercase = preg_match('@[A-Z]@', $pass);
	$lowercase = preg_match('@[a-z]@', $pass);
	$number = preg_match('@[0-9]@', $pass);

	if (empty($pass)){
		$error = true;
		$passError = "Please enter password.";
	} else if(!$uppercase || !$lowercase || !$number || strlen($pass) < 10) {
		$error = true;
		$passError = "Password should be at least 10 characters long and has at least 1 number, 1 capital letter";
	}

	$password = hash('sha256', $pass);

	if(!$error) {
		$query = "INSERT INTO users(username, userpass, useremail) VALUES ('$name', '$password', '$email')";
		$result = mysqli_query($connect, $query); 

		if ($result) {
			$errTyp = "success";
			$errMSG = "Successfully registered, you may login now";
			unset($name);
			unset($email);
			unset($pass);
		} else {
			$errTyp = "danger";
			$errMSG = "Smth went wrong, we are trying to fix the problem, try again later..." ;
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet"  href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"  integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/index_style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
<body>
	<form class="login-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" >
		<h3>CREATE NEW ACCOUNT</h3>
		<br>
		<?php if (isset($errMSG)) { ?>
		<div  class="alert alert-<?php echo $errTyp ?> ">
		<?php echo $errMSG; ?>
		</div>
		<?php } ?>

		<input type="text" name="name" class="login-input regi-pass-input" id="username" placeholder ="your name: Anna, Mark, Debby, etc." maxlength ="50" value= "<?php echo $name ?>" />
		<span class="regi-check" id="availability"></span>
		<span class="text-danger regi-check" > <?php echo $nameError; ?> </span>		
		<p class="regi-text">Username: min. 3 characters, only letterst and/or numbers</p>

		<input type="email" name="email" class="login-input" id="email" placeholder="email" maxlength = "40" value="<?php echo $email ?>" />
		<span class="text-danger regi-check"><?php echo $emailError; ?></span>
		
		<input type="password" name="pass" class="login-input regi-pass-input" placeholder="password" maxlength = "15" />
		<p class="regi-text">Password: min. 10 characters, 1 number, 1 capital letter</p>
		<span class="text-danger regi-check"><?php echo $passError; ?></span>
		
		<button id="register" class="login-button" type="submit" name="btn-signup">REGISTER</button >
		<p>Already have an account?  <a href = "index.php">Sign in</a></p>
	</form>
</body>
</html>

<script>
$(document).ready(function(){
	$('#username').keyup(function(){
		var username_to_check = $(this).val();
		$.ajax({
			url:'username_check.php',
			method:"POST",
			data:{username_match:username_to_check},
			success:function(data) {
				if (data != 0) {
					$('#availability').html('<span class="text-danger">User name already in use</span>');
					$('#register').attr("disabled", true);
					$('#register').css("background-color", "grey");
				} else {
					$('#availability').html('<span class="text-success">User name available</span>');
					$('#register').attr("disabled", false);
					$('#register').css("background-color", "lightblue");			
				}
			}
		})

	});
});
</script>
<?php  ob_end_flush(); ?>
