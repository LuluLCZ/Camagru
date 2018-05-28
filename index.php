<?php
session_start();
require_once('classes_bdd/users.php');
require_once('classes/account_modif.php');
require_once('classes_bdd/picture_manager.php');

require_once('classes/pics.php');

?>
<html>
<head>
	<meta charset="utf-8">
	<title>Accueil</title>
	<link rel="stylesheet" href="index.css">
	<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800" rel="stylesheet">
</head>

<body>
</html>
	<?php include('pages/header.php'); ?>
	<?php include('pages/galery.php');?>

<?php
	if (isset($_GET['action']) && $_GET['action'] === "signin")
		signin();
	else if (isset($_GET['action']) && $_GET['action'] === "signup")
	{
		print_r($_POST);
		
		signup();
	}
	else if (isset($_GET['page']) && $_GET['page'] === "activate")
	{
		echo "OK";
		activation();
	}
	elseif (isset($_GET['action']) && $_GET['action'] === "logout")
	{
		session_destroy(); header('Location: /index.php');
	}
	else if (isset($_GET['action']) && $_GET['action'] === 'postPic')
	{
		// $result = new PostPic();
		// $targetdir = './upload/';
		// print_r($_FILES);
		// if (!file_exists($targetdir))
		// 	mkdir($targetdir);
		// $targetfile = $targetdir.$_FILES['camContent']['name'];
		// if (move_uploaded_file($_FILES['camContent']['tmp_name'], $targetfile))
		// {
		// 	$result->uploadImg($targetfile, 'llacaze', 980);
		// }
		// print_r($_GET);
		// print_r($_POST);
		sendNewPic();
	}
?>