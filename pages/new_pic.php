<?php ob_start(); ?>
<div id="contain_cam">
	<video id="screenshot-video" autoplay></video>
	<canvas style="display:none;"></canvas>
	<button id="screenshot-button">take a picture</button>
	<div id="buttons">
		<form method="post" action="index.php?action=add_own_pic">
			<input type="file" name="image" accept="image/*"/> 
		</form>
	</div>
	<img src="" id="screenshot-img">
</div>

<script type="text/javascript" src="scripts/usrCam.js"></script>