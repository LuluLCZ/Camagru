<?php
session_start();
include('config/setup.php');
require_once('classes_bdd/users.php');
require_once('classes_bdd/picture_manager.php');


	$i = ceil(getNumber());
	if ((isset($_GET['pages']) && ($_GET['pages'] !== "login" || $_GET['pages'] !== 'signup')) || !(isset($_GET['pages'])))
	{
		include('pages/header.php');
	}
	if (isset($_GET['pages']) && $_GET['pages'] === "login")
		require_once('pages/login.php');
	else if (isset($_GET['pages']) && $_GET['pages'] === "signup")
		require_once('pages/signup.php');
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
	else if (isset($_GET['page']) && $_GET['page'] === "activate")
	{
		activation();
	}
	else if (isset($_GET['pages']) && $_GET['pages'] === "pictures")
	{
		if ($_SESSION['logged_on_user'])
			require_once('pages/pictures.php');
		else
			header('Location: /index.php');
	}
	else if (isset($_GET['pages']) && $_GET['pages'] === "uploading")
	{
		if ($_SESSION['logged_on_user'])
			require_once('pages/new_pic.php');
		else
			header('Location: /index.php');
	}
	else if (isset($_GET['pages']) && $_GET['pages'] === "profile")
	{
		if ($_SESSION['logged_on_user'])
		{
			$req_res = getPics();
			require_once('pages/profile.php');
		}
		else
			header('Location: /index.php');
	}
	else if (isset($_GET['pages']) && $_GET['pages'] === 'passwdfrgt')
	{
		require_once('pages/newpass.php');
	}
	else if (isset($_GET['pages']) && $_GET['pages'] === "info_account")
	{
		if ($_SESSION['logged_on_user'])
			require_once('pages/info_account.php');
		else
			header('Location: /index.php');
	}
	else if (isset($_GET['action']) && $_GET['action'] === "signup")
	{
		signup();
	}
	else if (isset($_GET['action']) && $_GET['action'] == 'supp_pic' && isset($_GET['pic_id']))
	{
		if ($_SESSION['logged_on_user'])
			delPic($_GET['pic_id'], $_GET['auth']);
		else
			header('Location: /index.php');
	}
	else if (isset($_GET['action']) && $_GET['action'] === "logout")
	{
		if ($_SESSION['logged_on_user'])
		{
			session_destroy();
			header('Location: /index.php');
		}
		else
			header('Location: /index.php');
	}
	else if (isset($_GET['action']) && $_GET['action'] === 'postPic')
	{
		if ($_SESSION['logged_on_user'])
			sendNewPic();
		else
			header('Location: /index.php');
	}
	else if (isset($_GET['action']) && $_GET['action'] === 'newpw')
	{
		if ($_SESSION['logged_on_user'])
			header('Location: /index.php');
		else
			changePw();
	}
	else if (isset($_GET['action']) && $_GET['action'] === 'updsumup')
	{
		if ($_SESSION['logged_on_user'])
			updSumup();
		else
			header('Location: /index.php');
	}
	else if (isset($_GET['action']) && $_GET['action'] === 'delacc')
	{
		if ($_SESSION['logged_on_user'])
			delAccount();
		else
			header('Location: /index.php');
	}
	else if (isset($_GET['action']) && $_GET['action'] === 'postCom' && isset($_GET['img_id']))
	{
		if ($_SESSION['logged_on_user'])
		{
			if ($_POST['com'] !== "")
				SayitisBeautifull();
			else
				header("Location: index.php");
		}
		else
			header('Location: /index.php');
	}
	else if (isset($_GET['action']) && $_GET['action'] == 'img_status' && isset($_GET['pic_id']))
	{
		if ($_SESSION['logged_on_user'])
			HelpHimBecomeFamous($_GET['pic_id']);
		else
			header('Location: /index.php');
	}
	else if (isset($_GET['action']) && $_GET['action'] == 'changePseudo')
	{
		if ($_SESSION['logged_on_user'])
			changePseudo();
		else
			header('Location: /index.php');
	}
	else if (isset($_GET['action']) && $_GET['action'] == 'changeMail')
	{
		if ($_SESSION['logged_on_user'])
			changeMail();
		else
			header('Location: /index.php');
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
	else if (isset($_GET['action']) && $_GET['action'] === 'notif')
	{
		if ($_SESSION['logged_on_user'])
			notif();
		else
			header('Location: /index.php');
	}
	else if (isset($_GET['index']))
	{
		$req_res = getAllPics($_GET['index']);
		require_once('pages/main.php');
		
	}
	else
	{
		$req_res = getAllPics(0);
		require_once('pages/main.php');
	}
	include('pages/footer.php');
?>