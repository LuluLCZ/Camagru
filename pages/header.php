<head>
		<meta charset="utf-8">
		<title>Accueil</title>
		<link rel="stylesheet" href="index.css">
		<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800" rel="stylesheet">
	</head>
<body>
</html>
			<?php
			if (isset($_SESSION['logged_on_user']) && $_SESSION['logged_on_user'] === true)
			{?>
				<ul class="navbar" role="navigation">
					<li><a href="/index.php"><i class="fa fa-home"></i>Camagru</a></li>
					<li><a href="/index.php?pages=pictures"><i class="fas fa-camera-retro"></i>Prendre une photo</a></li>
					<li><a href="/index.php?pages=profile"><i class="far fa-user"></i>Mon compte</a></li>
					<li class="tendances"><a href="/index.php?ranked=yes"><i class="fab fa-hotjar"></i>Tendances</a></li>
					<li>
						<form action="/index.php?action=sortusr" method="POST">
							<input type="searchusr" name="searchusr" id="searchusr" placeholder="Rechercher user"/>
							<input class="button" type="submit" name="submit" value="search">
						</form>
					</li>
					<li><a href="/index.php?pages=info_account"><i class="fas fa-wrench"></i></a></li>
					<li><a href="/index.php?action=logout"><i class="fas fa-sign-out-alt"></i>Se déco</button></a></li>
			</ul><?php
			}
			else
			{
				?>
				<ul class="navbar" role="navigation">
					<li><a href="/index.php"><i class="fa fa-home"></i>Camagru</a></li>
					<li><a href="/index.php?pages=login"><i class="fas fa-sign-in-alt"></i>Se connecter</a></li>
					<li><a href="/index.php?pages=signup"><i class="far fa-star"></i>S'inscrire</a></li>
					<li class="tendances"><a href="/index.php?ranked=yes"><i class="fab fa-hotjar"></i>Tendances</a></li>
					<li>
						<form action="/index.php?action=sortusr" method="POST">
							<input type="searchusr" name="searchusr" id="searchusr" placeholder="Rechercher user"/>
							<input class="button" type="submit" name="submit" value="search">
						</form>
					</li>
				<li><button>Guest</button></li>
				</ul><?php
			}?>