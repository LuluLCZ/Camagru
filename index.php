<?php
session_start();
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8','root', 'llacaze');
}
catch (Exception $e)
{
	die('Erreur : ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Camagru</title>
		<link rel="stylesheet" type="text/css" href='index.css'>
	</head>
	<style>
	</style>
	<body>
	<nav class="nav" role="navigation">
		<ul class="menu">
			<li><a>Camagru</a></li>
			<?php
			if (!isset($_SESSION['user']))
			{
				echo "
				<li class=\"has-children\"><a>Pas encore membre ?</a>
					<!-- sous menu signup -->
					<ul class=\"sous-menu\">
						<li><a>
							<form action=\"./signup.php\" method=\"post\">
								<div>
									<label for=\"user\">Pseudo</label> : <input type=\"text\" name=\"user\" id=\"user\" />
								</div>
								<div>
									<label for=\"password\">Password</label> :  <input type=\"password\" name=\"password\" id=\"password\" />
								</div>
								<div>
									<label for=\"email\">Email</label> : <input type=\"text\" name=\"email\" id=\"email\" />
								</div>
								<div>
									<label for=\"nom\">Nom</label> : <input type=\"text\" name=\"nom\" id=\"nom\" />
								</div>
								<div>
									<label for=\"prenom\">Prenom</label> : <input type=\"text\" name=\"prenom\" id=\"prenom\" />
								</div>
								<div>
									<input type=\"submit\" value=\"Envoyer\" />
								</div>
							</form>
						</a></li>
					</ul>
				</li>
			<li class=\"has-children\"><a>Je suis membre !</a>
				<!-- sous menu signup -->
				<ul class=\"sous-menu\">
					<li><a>
					<form action=\"login.php\" method=\"post\">
						<div>
							<label for=\"user\">Pseudo</label> : <input type=\"text\" name=\"user\" id=\"user\" />
						</div>
						<div>
							<label for=\"password\">Password</label> :  <input type=\"text\" name=\"password\" id=\"password\" />
						</div>
						<div>
							<input type=\"submit\" value=\"Envoyer\" />
						</div>
					</a></li>
				</ul>
			</li>";
			}
			else
			{
				echo "<li><a href=\"logout.php\">Deconnexion</a></li>";
			}
			?>
	</body>
</html>
