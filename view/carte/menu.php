<div id="left">
	<div class="menu">
		<div class="menuheader"><h3>Carte</h3></div>
		<div class="menucontent">
			<ul>
				<li><a href="<?php echo $LOCAL_DIR; ?>/carte/">Chercher un trajet</a></li>
				<?php if(isset($_SESSION['pseudo'])) { ?><li><a href="<?php echo $LOCAL_DIR; ?>/carte/creer/">Ajouter un trajet</a></li><?php } ?>
			</ul>
		</div>
		<div class="menufooter"></div>
	</div>
</div>