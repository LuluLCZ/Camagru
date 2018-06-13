<html>
<head>
	<meta charset="utf-8">
	<title>Mon profil</title>
	<link rel="stylesheet" href="/profile.css">
	<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800" rel="stylesheet">
</head>

<body>
	<div class="header-gallery">
		<div class="title-1">Mes photos</div>
		<?php foreach($req_res as $uimg): ?>
			<div class="user-post">
				<div class="double-pic">
					<img class="image1" style="width: 600px;" src=<?= '"data:image/png;charset:utf-8;base64,' . base64_encode($uimg['content']) . '"'?> />
					<img class="image2" src=<?=$uimg['filter_path']?>>
				</div>
				<div class="supp-button">
					<a href=<?= '"index.php?action=supp_pic&pic_id='.$uimg['id'].'"' ?>><i class="fas fa-trash-alt"></i></a>
				</div>
				<?php if ($_SESSION['logged_on_user'] === true)
				{ ?>
					<div class="form_container" >
						<form method="post" action=<?= '"index.php?action=postCom&img_id=' . $uimg['id'] . '"' ?>>
							<textarea name="com"></textarea>
							<input type="submit" name="submit" value="‣" class="sent" />
						</form>
					</div>
				<?php }?>
				<div class="com" style="height:126px;width:350px;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">
					<?php foreach($uimg['coms'] as $tst): ?>
						<div class="com_head">
							<div class="auth-com">
								<?= $tst['auth'] ?>
							</div>
							<div>
								<?= $tst['content'] ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="icon">
						<a href=<?= '"index.php?action=img_status&pic_id=' . $uimg['id'] . '"' ?>class=<?php echo (!HowMuchfamous($uimg['id'])) ? "heart" : "heart-selected";?>>♥</a>
					<?php echo $uimg['nrate'];?>
				</div>
				</div>
			</div>
			
			<?php endforeach; ?>
		</div>
</html>