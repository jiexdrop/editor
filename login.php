<?php
require_once "config.php";

$username = "";
$password = "";
$username_error = "";
$password_error = "";
$welcome_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST['username'])) {
		$username_error = "Please type username";
		exit;
	}

	if (empty($_POST['password'])) {
		$password_error = "Please type password";
		exit;
	}

	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = "SELECT id, username, password FROM users WHERE username='" . $username  ."'";
	$result = $mysqli->query($sql);

	// username is unique
	$row = $result->fetch_row();

	// row 0 = id, row 1 = username, row 2 = password
	if(password_verify($password, $row[2]))
	{
		session_start();
		
		$_SESSION["loggedin"] = true;
		$_SESSION["username"] = $username;  

		header("location: templates.php");
		die();
	} else 
	{
		$password_error = "Password error";
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<title>editor</title>
</head>

<body>
	<div class="container">
		<h2><?php echo ($welcome_message) ?></h2>
		<form action="login.php" method="POST">
			<div class="form-group">
				<label>Username</label>
				<input type="text" class="form-control" placeholder="Enter username" name="username" required>
				<small><?php echo ($username_error) ?></small>
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" class="form-control" name="password" placeholder="Password" required>
				<small><?php echo ($password_error) ?></small>
			</div>
			<button type="submit" class="btn btn-primary">Login</button>
		</form>
	</div>


</body>

</html>