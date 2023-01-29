<?php

$db_host = 'localhost';
$db_name = 'astoncv';
$username = 'root';
$password = '';
$dsn="mysql:dbname=$db_name;host=$db_host";

try {
	$db = new PDO($dsn, $username, $password); 
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $ex) {
	echo("Failed to connect to the database.<br>");
	echo($ex->getMessage());
	exit;
}
?>