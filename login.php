<?php
session_start();
require_once('credentials.php');

if (isset($_GET['logout'])) {
	session_destroy();
	//unset($_SESSION['user']);
	header('Location: index.php', TRUE, 302);
	exit;
}

if(isset($_SESSION['user']))
{
    header("Location: index.php", TRUE, 302);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Shorten Request Variables if they are set
	$username = isset($_POST['username']) ? trim($_POST['username']) : '';
	$password = isset($_POST['password']) ? trim($_POST['password']) : '';

	// $valid_user = 'Brian';
	// $valid_hash = '$2y$10$tvKXv57wFWSeECg2ALkh3uQE.F6z7cSjQT/A.3CzfHIVYQtp2/YFe';

	// if (strtolower($username) == strtolower($valid_user) && password_verify($password, $valid_hash)) {
	// 	$_SESSION['user'] = $valid_user;
	// 	header("Location: private.php", TRUE, 302);
	//  exit;
	// }

	if (array_key_exists(strtolower($username), $valid_users)) {
		if (password_verify($password, $valid_users[strtolower($username)]['hash'])) {
			$_SESSION['user'] = $valid_users[strtolower($username)]['name'];
			header("Location: index.php", TRUE, 302);
    		exit;
		}
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Auth Demo Login Page</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<style >
	.aligntmn{
		margin-top: 214px;
        margin-left: 35%;
	

	}
	</style>
</head>
<body>
<div class="aligntmn">
	<h1 style="color: #1884BB;">Note Taking Application</h1>
	<form action="login.php" method="POST">
	<div class="form-group">
		<label style="color: #3F5D9A;">Username: <input type="text" class="form-control" name="username"></label><br></div>
		<div class="form-group">
		<label style="color: #3F5D9A;">Password: <input type="password" class="form-control" name="password"></label><br>
		</div>
		<input class="btn btn-success" type="submit" value="Login">
	</form>
</div>
</body>
</html>