<?php
require_once "config.php";

$username = "";
$password = "";
$username_error = "";
$password_error = "";

$welcome_message = "";

//password_hash()

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$sql = "SELECT id, username FROM users";
	$result = $mysqli->query($sql);

	// Display users
	/*if ($result->num_rows > 0) {
		// output data of each row
		while ($row = $result->fetch_assoc()) {
			echo "id: " . $row["id"] . " - Name: " . $row["username"] . "<br>";
		}
	} else {
		echo "0 results";
	}*/

	if (empty($_POST['username'])) {
		$username_error = "Please type username";
		exit;
	}

	if (empty($_POST['password'])) {
		$password_error = "Please type password";
		exit;
	}

	$username = $_POST['username'];
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

	$sql = "INSERT INTO users (username, password) VALUES ('" . $username . "','" . $password . "')";

	if ($mysqli->query($sql) === TRUE) {
		$welcome_message = "Welcome " . $username;
	} else {
		$username_error = $mysqli->error;
	}

	$mysqli->close();
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
		<form action="register.php" method="POST">
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
			<button type="submit" class="btn btn-secondary">Register</button>
		</form>
	</div>


</body>

</html>