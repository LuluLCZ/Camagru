<html>
<head>
	<meta charset="utf-8">
	<title>Photo</title>
	<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800" rel="stylesheet">
	<link rel="stylesheet" href="../index.css">
</head>
<body>
<div class="big_contain">
	<div class="screen-taken">
		<video class="image1" id="screenshot-video" autoplay></video>
		<img class="image2" src="/data/0.png" id='filter'>
	</div>
	<div class="screen-taken">
		<img class="image1" src="" id="screenshot-img" style="width: 600px;">
		<img class="image2" src="" id='filter_fix'>
	</div>
	<div>
		<button id="screenshot-button">Capturer ce moment génial</button>
	</div>
	<script type="text/javascript">
		function changeImage(a) {
			document.getElementById("filter").src=a;
		}
	</script>

	<div><a href="/index.php?pages=uploading">Je n'ai pas de webcam !</a></div>
	
	<div id="buttons">
	</div>
	<canvas style="display:none;"></canvas>
	<script type="text/javascript" src="/scripts/usrCam.js"></script>
	<?php
	
	$dir = 'data/*.{jpg,jpeg,gif,png}';
	$files = glob($dir,GLOB_BRACE);
	
	?>
	<div class="filterss" style="height:350px;width:350px;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">
		<?php foreach($files as $image)
		{ 
		$f= str_replace($repertoire,'',$image);
		echo 
		'<img src='.$f.'  onclick=\'changeImage("'.$f.'");\'>';
		}?>
	</div>
</div>
</body>

</html>