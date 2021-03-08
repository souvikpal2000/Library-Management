<?php
	$dbServername = "localhost";
	$dbUsername = "root";
	$dbPassword = "";
	$dbName = "library";

	$connect = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

	if(!$connect)
	{
		die("Connection Failed : ".mysqli_connect_error());
	}
?>