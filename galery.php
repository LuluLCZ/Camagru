<?php
session_start();
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8','root', 'llacaze');
}
catch (Exception $e)
{
	die('Erreur : ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href='index.css'>
	</head>
	<style>
	</style>
	<body>
		<div class="header-gallery">
			<div>Gallerie</div>
		</div>
	</body>
</html>