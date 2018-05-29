<html>
<head>
	<meta charset="utf-8">
	<title>Photo</title>
	<link rel="stylesheet" href="/index.css">
	<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800" rel="stylesheet">
</head>

<body>

<video id="screenshot-video" autoplay></video>
<button id="screenshot-button">Capturer ce moment génial</button>

<img src="" id="screenshot-img">
<canvas style="display:none;"></canvas>

<div id="buttons">
	<form method="post" action="index.php?action=add_own_pic">
		<input type="file" name="image" accept="image/*"/> 
	</form>
</div>

<script type="text/javascript" src="/scripts/usrCam.js"></script>
</html>