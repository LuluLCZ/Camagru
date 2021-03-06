<html>
<head>
	<meta charset="utf-8">
	<title>Mon profil</title>
	<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href='/profile.css'>
</head>

<body>
<?php 
if(!$_SESSION['logged_on_user'])
{
	header('Location: /index.php');
	echo "Vous n'etes pas connecté vous ne pouvez pas acceder a cette page.";
}?>
	<div class="header-gallery">
		<div class="title-1">Changer mon mot de passe</div>
		<div class="user-post">
			<form action="/index.php?action=newpw" method="POST">
				<label for="pseudo">Pseudo</label>
				<input type="pseudo" name="pseudo" id="pseudo" required />
				<label for="passwd">Mot de passe actuel</label>
				<input type="password" name="old_passwd" id="oldpasswd" required/>
				<label for="passwd_confirm">Nouveau mot de passe</label>
				<input type="password" name="new_pass" id="newpasswd" required/>
				<label for="passwd_confirm">Confirmer</label>
				<input type="password" name="new_passc" id="cnewpasswd" required/><br />
				<input class="button" type="submit" name="submit" value="Envoyer" />
			</form>
		</div>
		<div class="title-1" style="margin-top: 10px;">Description de mon profil</div>
		<div class="user-post">
			<form action="/index.php?action=updsumup" method="POST">
				<label for="updsumup">Légende de votre profil</label>
				<input type="text" name="updsumup" id="updsumup" required /><br />
				<input class="button" type="submit" name="submit" value="Mettre a jour" />
			</form>
		</div>
		<div class="title-1" style="margin-top: 10px;">Photo de profil</div>
		<div class="user-post">
			<form method="post" action="index.php?action=add_own_pic">
				<input type="file" name="image" accept="image/*"/> 
			</form>
		</div>
		<div class="title-1" style="margin-top: 10px;">Supprimer mon compte</div>
		<div class="user-post">
			<form action="/index.php?action=delacc" method="POST">
				<label for="Deletemyaccount">Ecrire si dessous "JE VEUX SUPPRIMER MON COMPTE"</label>
				<input type="text" name="Deletemyaccount" id="Deletemyaccount" required /><br />
				<input class="button" type="submit" name="submit" value="Envoyer" />
			</form>
		</div>
		<div class="title-1" style="margin-top: 10px;">Changer mon pseudo !</div>
		<div class="user-post">
			<form action="/index.php?action=changePseudo" method="POST">
				<label for="Nouveau pseudo">Nouveau pseudo</label>
				<input type="text" name="newPseudo" id="newPseudo" required /><br />
				<input class="button" type="submit" name="submit" value="Changer mon pseudo !" />
			</form>
		</div>
		<div class="title-1" style="margin-top: 10px;">Changer mon addresse mail !</div>
		<div class="user-post">
			<form action="/index.php?action=changeMail" method="POST">
				<label for="Nouvel email">Nouvel email</label>
				<input type="text" name="newMail" id="newMail" required /><br />
				<input class="button" type="submit" name="submit" value="Changer mon email !" />
			</form>
		</div>
		<div class="title-1">Notifications</div>
		<div class="user-post">
			<form action="/index.php?action=notif" method="POST">
				<input class="button" type="submit" name="notif" id="notif" value=<?= ($_SESSION['autonotif'] == 1) ? Désactiver : Activer?>>
			</form>
		</div>
	</div>
	</body>
</html>