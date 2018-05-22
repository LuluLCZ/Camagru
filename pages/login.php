<?php
session_start();
?>

<html>
<head>
	<meta charset="utf-8">
	<title>Se connecter</title>
	<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800" rel="stylesheet">
	<link rel="stylesheet" href="../sign.css">
</head>

<body>
	<div class="bloc_one">
		<div class="icone"><i class="fab fa-angellist"></i></div>
		<div class="logs">
			<form action="index.php/action=signin" method="POST">
				<label for="email">Adresse mail</label>
				<input type="email" name="email" id="email" required /><br />
				<label for="passwd">Mot de passe</label>
				<input type="password" name="passwd" id="passwd" required/><br />
				<input class="button" type="submit" name="submit" value="Sign in" />
			</form>
		</div>
	</div>
</body>
</html>