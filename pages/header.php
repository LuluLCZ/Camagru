			<?php
			if (isset($_SESSION['user']))
			{?>
				<ul class="navbar" role="navigation">
					<li><a href="index.php"><i class="fa fa-home"></i>Camagru</a></li>
					<li><a href="pages/pictures.php"><i class="fas fa-camera-retro"></i>Prendre une photo</a></li>
					<li class="tendances"><a href="index.php/ranked=yes"><i class="fab fa-hotjar"></i>Tendances</a></li>
					<li><form><input placeholder="Rechercher user"/><i class="fa fa-search"></i></form></li>
					<li><a href="pages/info_account.php"><i class="far fa-user"></i></a></li>
					<li><a href="pages/logout.php"><i class="fas fa-sign-out-alt"></i>Se déco</button></a></li>
			</ul><?php
			}
			else
			{
				?>
				<ul class="navbar" role="navigation">
					<li><a href="index.php"><i class="fa fa-home"></i>Camagru</a></li>
					<li><a href="pages/login.php"><i class="fas fa-sign-in-alt"></i>Se connecter</a></li>
					<li><a href="pages/signup.php"><i class="far fa-star"></i>S'inscrire</a></li>
					<li class="tendances"><a href="index.php/ranked=yes"><i class="fab fa-hotjar"></i>Tendances</a></li>
					<li><form><input placeholder="Rechercher user"/><i class="fa fa-search"></i></form></li>
					<li><button>Partager</button></li>
				</ul><?php
			}?>