<?php

class MyProfile
{
	public function newPassword($newpw, $login, $key)
	{
		$res = $this->changePasswd($newpw, $login, $key);
		if (!$res)
		{
			echo "Probleme lors du changement de mot de passe.";
		}
	}



	private function sendMail($to, $subject, $content)
	{
		mail($to, $subject, $content);
	}

	public function changePasswd($newpw, $login, $key)
	{
		$db = $this->dbConnect();
		try
		{
			$request = $db->prepare('UPDATE users SET passwd = :new WHERE pseudo = :login OR confirm_key = :key');
			$request->execute(array(
									'new' => hash('whirlpool', $newpw),
									'login' => $login,
									'key' => $key));
			return (true);
		}
		catch (Exception $e)
		{
			return false;
		}
	}

	public function forgotPasswd($email)
	{
		$db = $this->dbConnect();
		try
		{
			$request = $db->prepare('SELECT confirm_key FROM users WHERE email = :email');
			$request->execute(array('email' => $email));
			$answer = $request->fetch();
			if ($answer)
			{
				$url = 'http://localhost:8081/index.php?pages=resetpasswd&key='.urlencode($answer['confirm_key']);
				$content = 'Pour réinitialiser ton mot de passe clique sur le lien suivant :'.$url.' si tu n\'as pas demander une réinitialisation
				de ton mot de passe tu peux ignorer ce message et te connecter comme bon te semble.';
				$subject = 'Réinitialisation de ton mot de passe de Camagru !';
				$content = wordwrap($content, 70, "\r\n");
				mail($email, $subject, $content);
			}
		}
		catch (Exception $e)
		{
			die('Erreur : ' . $e->getMessage());
		}
	}

	public function deleteAccount($login)
	{
		$db = $this->dbconnect();
		try
		{
			$req = $db->prepare('DELETE FROM users WHERE pseudo = :login');
			$req->execute(array('login' => $login));
			$req = $db->prepare('DELETE FROM imgs WHERE author =:pseudo');
			$req->execute(array('pseudo' => $login));
			$req = $db->prepare('DELETE FROM img_com WHERE auth =:pseudo');
			$req->execute(array('pseudo' => $login));
			if ($req->rowCount() > 0)
			{
				session_destroy();
				header('Location: index.php');
			}
		}
		catch (Exception $e)
		{
			die('Wrong passwd');
		}
	}

	public function truePass($login, $passwd)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id FROM users WHERE pseudo = :log AND passwd = :pawd');
		$req->execute(array(
			'log' => $login,
			'pawd' => hash('whirlpool', $passwd) 
		));
		if ($req->fetch())
			return true;
		else
			return false;
	}

	public function updateBio($newBio, $login)
	{
		$db = $this->dbConnect();
		try
		{
			$request = $db->prepare('UPDATE users SET sumup = :bio WHERE pseudo = :log');
			$request->execute(array(
				'bio' => $newBio,
				'log' => $login
			));
			$_SESSION['sumup'] = ($request->rowCount()) ? $newBio : $_SESSION['sumup'];
			header('Location: index.php');
		}
		catch(Exception $e)
		{
			echo "cannot update your bio.";
		}
	}

	public function updateNotif($login, $choice)
	{
		$db = $this->dbConnect();
		try
		{
			$request = $db->prepare('UPDATE users SET autonotif = :choice WHERE pseudo = :log');
			$request->execute(array(
				'choice' => $choice,
				'log' => $login
			));
			$_SESSION['autonotif'] = ($request->rowCount()) ? $choice : $_SESSION['autonotif'];
			header('Location: index.php');
		}
		catch(Exception $e)
		{
			echo "cannot update your bio.";
		}
	}

	public function updatePseudo($oldpseudo, $npseudo)
	{
		$db = $this->dbConnect();
		$exist = $db->prepare('SELECT * FROM users WHERE pseudo = :npseudo');
		$exist->execute(array($npseudo));
		if (!($exist->fetch()))
		{
			try
			{
				$request = $db->prepare('UPDATE users SET pseudo = :npseudo WHERE pseudo = :oldpseudo');
				$request->execute(array('npseudo' => $npseudo, 'oldpseudo' => $oldpseudo));
				$request = $db->prepare('UPDATE imgs SET author = :npseudo WHERE author = :oldpseudo');
				$request->execute(array('npseudo' => $npseudo, 'oldpseudo' => $oldpseudo));
				$request = $db->prepare('UPDATE img_com SET auth = :npseudo WHERE auth = :oldpseudo');
				$request->execute(array('npseudo' => $npseudo, 'oldpseudo' => $oldpseudo));
				$_SESSION['login'] = $npseudo;
			}
			catch(Exception $e)
			{
				echo "Probleme lors du changement de pseudo.<br />Veuillez réessayer ou contactez l'administrateur du site";
			}
		}
		else
			echo "Le pseudo que vous voulez utiliser est deja utilisé. Veuillez choisir un autre pseudo.";
	}

	public function updateMail($npseudo, $nmail)
	{
		$db = $this->dbConnect();
		$exist = $db->prepare('SELECT pseudo FROM users WHERE email = :nmail');
		$exist->execute(array('nmail' => $nmail));
		if (!($exist->fetch()))
		{
			try
			{
				$request = $db->prepare('UPDATE users SET email = :nmail WHERE pseudo = :npseudo');
				$request->execute(array('nmail' => $nmail, 'npseudo' => $npseudo));
				$_SESSION['email'] = $nmail;
			}
			catch(Exception $e)
			{
				echo "Probleme lors du changement de mail.<br />Veuillez réessayer ou contactez l'administrateur du site";
			}
		}
		else
			echo "Le mail que vous voulez utiliser est deja utilisé. Veuillez choisir un autre mail.";
	}

	private function dbConnect()
	{
		try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8','root', 'llacaze');
			return $bdd;
		}
		catch (Exception $e)
		{
			die('Erreur : ' . $e->getMessage());
		}
	}
}

?>