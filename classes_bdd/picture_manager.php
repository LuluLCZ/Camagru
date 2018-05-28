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
?>