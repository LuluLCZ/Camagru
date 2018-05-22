<?php

class LogManager
{
	public function loginUsr($email, $password)
	{
		$db = $this->dbConnect();
		$request = $db->prepare('SELECT * FROM users WHERE email = :email AND passwd = :password');
		$request->execute(array('email' => $email, 'password' => hash('whirlpool', $password)));
		if ($user_info = $request->fetch())
		{
			$_SESSION['uid'] = $user_info['id']; 
			$_SESSION['login'] = $user_info['pseudo']; 
			$_SESSION['email'] = $user_info['email']; 
			$_SESSION['logged_on_user'] = true;
			$_SESSION['logged_on_admin'] = ($user_info['admin'] = '0') ? false : true; 
		}
		else
			return "error";
	}

	public function newUsr($email, $password, $pseudo, $admin)
	{
		$db = $this->dbConnect();
		$exist = $db->prepare('SELECT * FROM users WHERE email = ? OR pseudo = ?');
		$exist->execute(array($email, $pseudo));
		if (!($exists->fetch()))
		{
			$confirm_key = hash('md5', rand());
			try {
				$request = $db->prepare('INSERT INTO users(pseudo, passwd, email, admin, confirm, confirm_key)
					VALUES(:pseudo, :password, :email, :admin, :confirm, :confirm_key)');
				$request->execute(array('email' => $email,
									'password' => hash('whirlpool', $password),
									'user' => $pseudo,
									'admin' => $admin,
									'confirm' => 0,
								)); ///////////////////////// -------------------------------- rand -> conf key
			}
			catch(Exception $e) {echo "An error occured" . $e->getMessage();}
			$url = 'http://localhost:8080/camagru/index.php?page=activate&login=' . urlencode($pseudo) . '&key=' . urlencode($confirm_key); ///////////////////////////// ----------------------------------------
			$content = 'Thanks for your subscription ' . $pseudo . ' and welcome on board.
			 Please click on the following link to activate your account: ' . $url;
			$content = wordwrap($content, 70, "\r\n");
			$this->sendMail('lacaze.lulupote@gmail.com', $email, 'Activation of your account', $content);
			return "ok";
		}
		else
			return "User already exists";
	}

	public function sendMail($from, $to, $subject, $content)
	{
		$email_header = 'From: ' . $from;
		mail($to, $subject, $content);
	}

	public function confirmAccount($key, $login)
	{
		$db = $this->dbConnect();
		try
		{
			///////////////// already activated
			$request = $db->prepare('UPDATE passwd SET confirm = 1 WHERE pseudo = :pseudo AND confirm_key = :key');
			$request->execute(array('pseudo' => $login, 'key' => $key));
			echo "Your account is now activated ! Welcome on board !";
		}
		catch(Exception $e)
		{
			die("An error occured during account activation: " . $e->getMessge());
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