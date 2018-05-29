<?php

class PostPic
{
	public function uploadImg($content, $author, $uid)
	{
		$db = $this->dbconnect();
		try
		{
			echo "FDO";
			$request = $db->prepare('INSERT INTO imgs(author, uid, date_uplo, content, nrate, ncoms)
					VALUES(:author, :uid, NOW(), :content, :nrate, :ncoms)');
			$request->execute(array('author' => $author,
									'uid' => $uid,
									'content' => $content,
									'nrate' => 0,
									'ncoms' => 0));
		}
		catch(Exception $e)
		{
			die("An error occured during account activation: " . $e->getMessge());
		}
	}

	public function getImg($user)
	{
		$db = $this->dbconnect();
		$req_res = array();
		try
		{
			$request = $db->prepare('SELECT * FROM imgs WHERE author = :user ORDER BY id DESC');
			$request->execute(array(':user' => $user));
			if ($request->rowCount())
			{
				$req_res = $request->fetchAll();
			}
			$req_res['content'] = $req_res;
			return $req_res;
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