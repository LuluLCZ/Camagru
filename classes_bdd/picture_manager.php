<?php
require_once('classes/pics.php');

function sendNewPic()
{
	
	$result = new PostPic();
	$auth = $_SESSION['login'];
	print_r($_POST);
	if (isset($_POST['camContent']) && isset($_POST['filterPath']))
	{
		$data = explode( ',', $_POST['camContent']);
		$data = base64_decode($data[1]);
		$datawebcam = imagecreatefromstring($data);
		$path_filter = $_POST['filterPath'];
		$filter = imagecreatefrompng($path_filter);
		$transparent = imagecreatetruecolor(320, 240);
		imagecopy( $transparent , $datawebcam, 0, 0, 0, 0,320, 240);
		imagecopy( $transparent , $filter, 0, 0, 0, 0, 320, 240);
		imagecopymerge($datawebcam,  $transparent , 0, 0, 0, 0, 320, 240, 100);
		ob_start();
		imagepng($datawebcam);
		$imgData = ob_get_contents();
		ob_end_clean();
		$base64 = "data:image/png;base64," . base64_encode($datawebcam);
		$_SESSION['saveCollage'] = $base64;
		// echo $base64;
		if (!file_exists($path))
			mkdir($path);
		$collage =  md5(microtime(TRUE)*100000);
		$data = explode( ',', $_SESSION['saveCollage']);
		$collage_path = $path.$collage.".png";
		file_put_contents($path.$collage.".png",  base64_decode($data[1]));
		$result->uploadImg(base64_decode($collage), $auth, $_SESSION['uid']);
		0649932890
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