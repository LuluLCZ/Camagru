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
			$_SESSION['confirm'] = $user_info['confirm'];
			$_SESSION['uid'] = $user_info['id'];
			$_SESSION['login'] = $user_info['pseudo'];
			$_SESSION['email'] = $user_info['email'];
			$_SESSION['sumup'] = $user_info['sumup'];
			$_SESSION['autonotif'] = $user_info['autonotif'];
			$_SESSION['logged_on_user'] = true;
			$_SESSION['logged_on_admin'] = ($user_info['admin'] = '0') ? false : true; 
		}
		else
			echo "error";
	}

	public function newUsr($email, $password, $pseudo, $admin)
	{
		$db = $this->dbConnect();
		$exist = $db->prepare('SELECT * FROM users WHERE email = ? OR pseudo = ?');
		$exist->execute(array($email, $pseudo));
		if (!($exist->fetch()))
		{
			$confirm_key = hash('md5', rand());
			try {
				$request = $db->prepare('INSERT INTO users(pseudo, passwd, email, admin, confirm, confirm_key, sumup, autonotif)
					VALUES(:pseudo, :password, :email, :admin, :confirm, :confirm_key, :sumup, :autonotif)');
				$request->execute(array('pseudo' => $pseudo,
									'password' => hash('whirlpool', $password),
									'email' => $email,
									'admin' => $admin,
									'confirm' => 0,
									'confirm_key' => $confirm_key,
									'sumup' => 'bonjour',
									'autonotif' => 1
								)); ///////////////////////// -------------------------------- rand -> conf key
				}
				catch(Exception $e) {die("An error occured" . $e->getMessage());}
				$url = 'http://localhost:8080/index.php?page=activate&login=' . urlencode($pseudo) . '&key=' . urlencode($confirm_key); ///////////////////////////// ----------------------------------------
				$content = 'Thanks for your subscription ' . $pseudo . ' and welcome on board.
				Please click on the following link to activate your account: ' . $url;
				$content = wordwrap($content, 70, "\r\n");
				$subject = 'Activation of your account';
				mail($email, $subject, $content);
				return "Vous allez recevoir un mail d'activation sur votre adresse mail.";
			}
			else
			echo "Le pseudo que vous avez rentrer est deja utilisé.";
		
	}

	public function sendMail($to, $subject, $content)
	{
		mail($to, $subject, $content);
	}

	public function confirmAccount($key, $login)
	{
		$db = $this->dbConnect();
		try
		{
			///////////////// already activated
			$request = $db->prepare('UPDATE users SET confirm = 1 WHERE pseudo = :pseudo AND confirm_key = :key');
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