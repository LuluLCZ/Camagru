<?php
require_once('classes/pics.php');

function sendNewPic()
{
	
	$result = new PostPic();
	$auth = $_SESSION['login'];
	if (isset($_POST['camContent']) && isset($_POST['filterPath']))
	{
		$result->uploadImg(base64_decode($_POST['camContent']), $auth, $_SESSION['uid'], $_POST['filterPath']);
	}
}

function getPics()
{
	$result = new PostPic();
	$req_res = $result->getImg($_SESSION['login']);
	$res_com = new PostPic();
	foreach ($req_res as $master => $value)
	{
		$req_res[$master]['coms'] = $res_com->getImgCom($req_res[$master]['id'], 0);
	}
	return $req_res;
}

function delPic($pic_id)
{
	$result = new PostPic();
	$result->deletePicture($pic_id);
	
	// require_once('pages/profile.php');
}

function getPicsUsr($usr)
{
	$result = new PostPic();
	$req_res = $result->getImg($usr);
	$res_com = new PostPic();
	foreach ($req_res as $master => $value)
	{
		$req_res[$master]['coms'] = $res_com->getImgCom($req_res[$master]['id'], 0);
	}
	return $req_res;
	// require_once('pages/profile.php');
}

function getAllPics()
{
	$result = new PostPic();
	$req_res = $result->getAllImg();
	$res_com = new PostPic();
	foreach ($req_res as $master => $value)
	{
		$req_res[$master]['coms'] = $res_com->getImgCom($req_res[$master]['id'], 0);
	}
	return $req_res;
}

function getAllPicsRanked()
{
	$result = new PostPic();
	$req_res = $result->getAllImgRanked();
	$res_com = new PostPic();
	foreach ($req_res as $master => $value)
	{
		$req_res[$master]['coms'] = $res_com->getImgCom($req_res[$master]['id'], 0);
	}
	return $req_res;
}

function SayitisBeautifull()
{
	$result = new PostPic();
	$result->addNewComment($_GET['img_id'] ,$_SESSION['login'], $_POST['com']);
}

function HowMuchFamous($pic_id)
{
	$result = new PostPic();
	$res = $result->FamousorNot($_SESSION['uid'], $pic_id);
	return ($res);
}

function HelpHimBecomeFamous()
{
	$result = new PostPic();
	$already = $result->FamousorNot($_SESSION['uid'], $_GET['pic_id']);
	if (!$already)
		$result->BecomingFamous($_SESSION['uid'], $_GET['pic_id']);
	else
		header("Location: index.php");
}

?>