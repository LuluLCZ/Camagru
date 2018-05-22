<?php

class MyProfile
{
	public function newPassword($newpw, $login)
	{
		$res = $this->changePasswd($newpw, $login);
		if (!$res)
		{
			echo "Probleme lors du changement de mot de passe.";
		}
	}

	private function changePasswd($newpw, $login)
	{
		$db = $this->dbConnect();
		try
		{
			$request = $db->prepare('UPDATE users SET passwd =:new WHERE pseudo = :login');
			$request->execute(array('new' => hash('whirlpool', $newpw), 'pseudo' => $login));
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

	private function dbConnect()
	{
		include('config/database.php');
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