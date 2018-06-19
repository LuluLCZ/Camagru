<html>
<head>
	  <script type='text/javascript' src='//code.jquery.com/jquery-1.9.1.js'></script>
	  <meta http-equiv="content-type" content="text/html; charset=UTF-8">

	<title>Photo</title>
	<link rel="stylesheet" href="/index.css">
	<script defer src="https:
	//use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800" rel="stylesheet">
</head>

<body>
<div class="big_contain">
	<script type="text/javascript">
		function changeImage(a) {
			document.getElementById("filter_fix").src=a;
		}
	</script>
	<script type='text/javascript'>//<![CDATA[
		$(window).load(function(){
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				
				reader.onload = function (e) {
					$('#uploading').attr('src', e.target.result);
				}
				
				reader.readAsDataURL(input.files[0]);
			}
		}
		
		$("#imgInp").change(function(){
			readURL(this);
		});
	});//]]> 
	</script>

	<div class="screen-taken">
		<form id="form1" runat="server">
			<input type="file" id="imgInp" accept="image/*"/>
			<img class="image1" id="uploading" src="#" alt="ton image" />
			<img class="image2" src="/data/0.png" id="filter_fix" />
		</form>
	</div>
	<div>
		<button id="screenshot-button">Capturer ce moment génial</button>
	</div>
	<canvas style="display:none;"></canvas>
	<div id="buttons">
	</div>
	<script type="text/javascript" src="/scripts/getImg.js"></script>
	<?php
	
	$dir = 'data/*.{jpg,jpeg,gif,png}';
	$files = glob($dir,GLOB_BRACE);
	
	?>
	<div class="filterss" style="height:350px;width:350px;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">
		<?php foreach($files as $image)
		{ 
		$f= str_replace($repertoire,'',$image);
		echo 
		'<img src='.$f.'  onclick=\'changeImage("'.$f.'");\'>';
		}?>
	</div>
</div>
</body>


</html>