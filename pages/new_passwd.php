<html>
<head>
	<meta charset="utf-8">
	<title>Changer mon mot de passe</title>
	<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800" rel="stylesheet">
	<link rel="stylesheet" href="/sign.css">
</head>

<body>
	<div class="bloc_one">
		<div class="icone"><a href="/index.php"><i class="fab fa-angellist"></i></a></div>
		<div class="Head-title">Changer mon mot de passe</div>
		<div class="logs">
			<form action="/index.php?action=newpw&key=".<?php $_GET['key']?> method="POST">
				<input type="password" name="npasswd" placeholder="Nouveau mot de passe..." required/>
				<input type="password" name="cnpasswd" placeholder="Confirmez..." required/>
				<input class="button" type="submit" name="submit" value="Changer mon mot de passe" />
			</form>
		</div>
	</div>
</body>
</html>