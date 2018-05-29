<?php

require_once('classes/logs.php');
require_once('classes/account_modif.php');

function signin()
{
	if (isset($_POST) && isset($_POST['email']) && isset($_POST['passwd']))
	{
		$result = new LogManager();
		$res = $result->loginUsr($_POST['email'], $_POST['passwd']);
		header('Location: /index.php');
	}
	else
		echo "An error occurred, check if your inputs are not empty and try again.";
}

function signup()
{
	if (isset($_POST) && isset($_POST['email']) && isset($_POST['passwd']) && isset($_POST['pseudo']) && $_POST['passwd'] === $_POST['passwd_confirm'])
	{
		$admin = 0;
		$result = new LogManager();
		$res = $result->newUsr($_POST['email'], $_POST['passwd'], $_POST['pseudo'], $admin);
		echo $res;
	}
	else
		echo "An error occurred, check if your inputs are not empty and try again.";
}

function activation()
{
	$result = new LogManager();
	$result->confirmAccount($_GET['key'], $_GET['login']);
}

function changePw()
{
	$result = new MyProfile();
	if (isset($_GET['key']) && !isset($_SESSION['logged_on_user']) && $_POST['npasswd'] === $_POST['cnpasswd'])
		$result->changePasswd($_POST['npasswd'], null, $_GET['key']);
	else if(isset($_POST['old_passwd']) && isset($_POST['new_pass']) && $_POST['new_pass'] === $_POST['new_passc'])
	{
		if ($result->truePass($_SESSION['login'], $_POST['old_passwd']))
		{
			$result->changePasswd($_POST['new_pass'], $_SESSION['login'], "ok");
		}
		else
			echo "wrong password";
	}
	else
		echo "error";
}
function delAccount()
{
	$result = new MyProfile();
	if (isset($_POST['passwd']))
		$result->rmAccount($_SESSION['login'], $_POST['passwd']);
}
function sendRstMail()
{
	$result = new MyProfile();
	if (isset($_POST['email']))
		$result->forgotPw($_POST['email']);
}
function updSumup()
{
	$result = new MyProfile();
	$result->updateBio($_POST['updsumup'], $_SESSION['login']);
}

?>