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
			$request = $db->prepare('UPDATE users SET passwd = :new WHERE pseudo = :login');
			$request->execute(array(
									'new' => hash('whirlpool', $newpw),
									'login' => $login));
									// 'confirm_key' => $key));
			return (true);
		}
		catch (Exception $e)
		{
			return false;
		}
	}

	

	public function deleteAccount($login, $passwd)
	{
		$db = $this->dbconnect();
		try
		{
			$req = $db->prepare('DELETE FROM users WHERE pseudo =:pseudo AND passwd =:passwd');
			$req->execute(array('pseudo' => $login, 'passwd' => $passwd));
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