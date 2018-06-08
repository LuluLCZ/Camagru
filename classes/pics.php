<?php

class PostPic
{
	public function uploadImg($content, $author, $uid, $filter_path)
	{
		$db = $this->dbconnect();
		try
		{
			$request = $db->prepare('INSERT INTO imgs(author, uid, date_uplo, content, nrate, ncoms, filter_path, commentaires)
					VALUES(:author, :uid, NOW(), :content, :nrate, :ncoms, :filter_path, :commentaires)');
			$request->execute(array('author' => $author,
									'uid' => $uid,
									'content' => $content,
									'nrate' => 0,
									'ncoms' => 0,
									'filter_path' => $filter_path,
									'commentaires' => ''));
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

	public function getAllImg()
	{
		$db = $this->dbconnect();
		$req_res = array();
		try
		{
			$request = $db->prepare('SELECT * FROM imgs ORDER BY id DESC');
			$request->execute(array());
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

	public function getImgCom($img_id, $all)
	{
		$db = $this->dbConnect();
		$com_tab = array();
		try
		{
			if ($all)
				$req = $db->prepare('SELECT id, DATE_FORMAT(date_com, \'%Y/%m/%d at %Hh%i\') AS d_com, auth, content, rate FROM img_com WHERE img_id = ?');
			else
				$req = $db->prepare('SELECT id, DATE_FORMAT(date_com, \'%m/%d at %Hh\') AS d_com, auth, content, rate FROM img_com WHERE img_id = ? ORDER BY id DESC LIMIT 5');
			$req->execute(array($img_id));
			$com_tab = $req->fetchAll();
		}
		catch(Exception $e)
		{
			echo "An error occured : " . $e->getMessage();
		}
		return $com_tab;
	}

	public function addNewComment($img_id, $auth, $content)
	{
		$db = $this->dbConnect();
		try
		{
			$req = $db->prepare('INSERT INTO img_com(img_id, date_com, auth, content, rate) VALUES(:i_id, NOW(), :auth, :content, 0)');
			$req->execute(array(
				'i_id' => $img_id,
				'auth' => $auth,
				'content' => $content
			));
			header("Location: index.php");
		}
		catch(Exception $e)
		{
			echo "An error occured : " . $e->getMessage();
		}
	}

	public function FamousorNot($uid, $img_id)
	{
		$db = $this->dbConnect();
		try
		{
			$req = $db->prepare('SELECT * FROM img_vote WHERE uid = :uid AND img_id = :img_id');
			$req->execute(array(
				'uid' => $uid,
				'img_id' => $img_id
			));
			if ($req->rowCount())
				return True;
			else
				return False;
		}
		catch (Exception $e)
		{
			echo "An error occured" . $e->getMessage();
		}
	}

	public function BecomingFamous($uid, $img_id)
	{
		$db = $this->dbConnect();
		try
		{
			$req = $db->prepare('INSERT INTO img_vote(img_id, uid) VALUES(:img, :uid)');
			$req->execute(array(
				'uid' => $uid,
				'img' => $img_id
			));
			try
			{
				$req2 = $db->prepare('UPDATE imgs SET rate = (rate + 1) WHERE uid = ? AND id = ?');
				$req2->execute(array($uid, $img_id));
				header("Location: index.php");
			}
			catch (Exception $e)
			{
				echo "An error occured : ". $e->getMessage();
			}
		}
		catch (Exception $e)
		{
			echo "An error occured" . $e->getMessage();
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