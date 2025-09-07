<?php
	session_start();

	require_once('db/config.php');
	$conn = mysqli_connect($host, $user, $pass, $dbname);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Parasolove</title>

	<link rel="stylesheet" href="style/target/main.min.css">
	<link rel="shortcut icon" href="assets/site-images/favicon.ico" type="image/x-icon">
</head>
<body>
	