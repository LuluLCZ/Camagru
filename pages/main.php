<html>
	<head>
		<meta charset="utf-8">
		<title>Accueil</title>
		<link rel="stylesheet" href="/profile.css">
		<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800" rel="stylesheet">
	</head>
	<body>
		<div class="header-gallery">
			<div class="title-1">
				Gallerie
			</div>
			<?php foreach($req_res as $uimg): ?>
			<div class="user-post">
				<div class="author-name">
					<?= $uimg['author'] ?>
				</div>
				<p>le <?=$uimg['date_uplo']?></p>
				<div class="double-pic">
					<img class="image1" style="width: 600px;" src=<?= '"data:image/png;charset:utf-8;base64,' . base64_encode($uimg['content']) . '"'?> />
					<img class="image2" src=<?=$uimg['filter_path']?>>
				</div>
			<?php foreach($uimg['coms'] as $tst): ?>
			<div class="com"><div class="com_head"><p><?= $tst['d_com'] ?></p>
							<p><?= $tst['auth'] ?></p></div>
							<div><p><?= $tst['content'] ?></p></div></div>
			<?php endforeach; ?>
			</div>
			
			<?php endforeach; ?>
		</div>
	</body>
</html>