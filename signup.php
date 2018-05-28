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

$pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
if ($_POST['user'] !== "" && $_POST['password'] !== "" && $_POST["email"] !== "")
{
	$req = $bdd->prepare('INSERT INTO users(user, password, email, nom, prenom) VALUE(?, ?, ?, ?, ?)');
	$req->execute(array($_POST['user'], $pass_hash, $_POST['email'], $_POST['nom'], $_POST['prenom']));
}
header('Location: index.php');
?>