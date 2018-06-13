<?php
session_start();
require_once('classes_bdd/users.php');
require_once('classes_bdd/picture_manager.php');

	if ((isset($_GET['pages']) && ($_GET['pages'] !== "login" || $_GET['pages'] !== 'signup')) || !(isset($_GET['pages'])))
	{
		include('pages/header.php');
	}
	if (isset($_GET['pages']) && $_GET['pages'] === "login")
		require_once('pages/login.php');
	else if (isset($_GET['pages']) && $_GET['pages'] === "signup")
		require_once('pages/signup.php');
	else if (isset($_GET['pages']) && $_GET['pages'] === "pictures")
		require_once('pages/pictures.php');
	else if (isset($_GET['pages']) && $_GET['pages'] === "profile")
	{
		$req_res = getPics();
		require_once('pages/profile.php');
	}
	else if (isset($_GET['pages']) && $_GET['pages'] === 'passwdfrgt')
	{
		require_once('pages/newpass.php');
	}
	else if (isset($_GET['pages']) && $_GET['pages'] === "info_account")
		require_once('pages/info_account.php');
	else if (isset($_GET['action']) && $_GET['action'] === "signin")
	{
		signin();
		header('Location: /index.php');
		
		if ($_SESSION['confirm'] == 0)
		{
			session_destroy();
			header('Location: /index.php');
		}
	}
	else if (isset($_GET['action']) && $_GET['action'] === "signup")
	{
		print_r($_POST);
		
		signup();
	}
	else if (isset($_GET['action']) && $_GET['action'] == 'supp_pic' && isset($_GET['pic_id']))
	{
		delPic($_GET['pic_id']);
		require_once('index.php?pages=profile');
	}
	else if (isset($_GET['page']) && $_GET['page'] === "activate")
	{
		activation();
	}
	elseif (isset($_GET['action']) && $_GET['action'] === "logout")
	{
		session_destroy(); header('Location: /index.php');
	}
	else if (isset($_GET['action']) && $_GET['action'] === 'postPic')
	{
		sendNewPic();
	}
	else if (isset($_GET['action']) && $_GET['action'] === 'newpw')
	{
		changePw();
	}
	else if (isset($_GET['action']) && $_GET['action'] === 'updsumup')
	{
		updSumup();
	}
	else if (isset($_GET['action']) && $_GET['action'] === 'delacc')
	{
		delAccount();
	}
	else if (isset($_GET['action']) && $_GET['action'] === 'postCom' && isset($_GET['img_id']))
	{
		SayitisBeautifull();
	}
	else if (isset($_GET['action']) && $_GET['action'] == 'img_status' && isset($_GET['pic_id']))
	{
		HelpHimBecomeFamous($_GET['pic_id']);
	}
	else if (isset($_GET['action']) && $_GET['action'] == 'changePseudo')
	{
		changePseudo();
	}
	else if (isset($_GET['action']) && $_GET['action'] == 'changeMail')
	{
		changeMail();
	}
	else if (isset($_GET['action']) && $_GET['action'] == 'sortusr' &&isset($_POST['searchusr']))
	{
		$req_res = getPicsUsr($_POST['searchusr']);
		require_once('pages/main.php');
	}
	else if (isset($_GET['ranked']) && $_GET['ranked'] == 'yes')
	{
		$req_res = getAllPicsRanked();
		require_once('pages/main.php');
	}
	else if (!$_SESSION['logged_on_user'] && isset($_GET['action']) && $_GET['action'] == 'forgotPw' && isset($_POST) && isset($_POST['email_recup']))
	{
		sendRstMail();
	}
	else if (!$_SESSION['logged_on_user'] && isset($_GET['pages']) && $_GET['pages'] == 'resetpasswd' && isset($_GET['key']))
	{
		require_once('pages/new_passwd.php');
	}
	else
	{
		$req_res = getAllPics();
		// var_dump($req_res['0']['coms']);
		require_once('pages/main.php');
	}
?>