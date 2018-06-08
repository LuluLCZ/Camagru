<html>
<head>
	<meta charset="utf-8">
	<title>Photo</title>
	<link rel="stylesheet" href="/index.css">
	<script defer src="https:
	//use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800" rel="stylesheet">
</head>

<body>
<div class="screen-taken">
	<video class="image1" id="screenshot-video" autoplay></video>
	<img class="image2" src="" id='filter'>
</div>
<div class="screen-taken">
	<img class="image1" src="" id="screenshot-img" style="width: 600px;">
	<img class="image2" src="" id='filter_fix'>
</div>
<button id="screenshot-button">Capturer ce moment génial</button>
<script type="text/javascript">
    function changeImage(a) {
		document.getElementById("filter").src=a;
    }
</script>

<canvas style="display:none;"></canvas>

<div id="buttons">
	<form method="post" action="index.php?action=add_own_pic">
		<input type="file" name="image" accept="image/*"/> 
	</form>
</div>
<script type="text/javascript" src="/scripts/usrCam.js"></script>
<?php
 
$dir = 'data/*.{jpg,jpeg,gif,png}';
$files = glob($dir,GLOB_BRACE);
  
echo 'Listing des images du repertoire miniatures <br />';
foreach($files as $image)
{ 
   $f= str_replace($repertoire,'',$image);
   echo 
   '<img src='.$f.'  onclick=\'changeImage("'.$f.'");\'>';
}?>




</html>