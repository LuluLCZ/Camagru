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

//  Récupération de l'utilisateur et de son pass hashé
$req = $bdd->prepare('SELECT user, password FROM users WHERE user = :user');
$req->execute(array(
	'user' => $_POST['user']));
$resultat = $req->fetch();

// Comparaison du pass envoyé via le formulaire avec la base
$isPasswordCorrect = password_verify($_POST['password'], $resultat['password']);

if (!$resultat)
{
	echo 'Mauvais identifiant ou mot de passe !';
}
else
{
	if ($isPasswordCorrect)
	{
		session_start();
		$_SESSION['user'] = $resultat['user'];
		echo 'Vous êtes connecté !';
	}
	else
	{
		echo 'Mauvais identifiant ou mot de passe !';
	}
}
header('Location: index.php');
?>