<?php
require_once('classes/pics.php');

function sendNewPic()
{
	$result = new PostPic();
	$auth = $_SESSION['login'];
	print_r($_POST);
	if (isset($_POST['camContent']))
	{
		$result->uploadImg(base64_decode($_POST['camContent']), $auth, $_SESSION['uid']);
	}
}

function getPics()
{
	$result = new PostPic();
	$req_res = $result->getImg($_SESSION['login']);

	require_once('pages/profile.php');
}

function getAllPics()
{
	$result = new PostPic();
	$req_res = $result->getAllImg();
	return $req_res;
}

?>