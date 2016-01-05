<?php include_once('header.php'); ?>

<div id="content">
	<?php include_once('view/carte/menu_connected.php'); ?>
	<?php include_once('view/includes/menu.php'); ?>
	
	<div id="middle">
		<div class="post">
			<div class="postheader"><h1>Chercher un trajet</h1></div>
			<div class="postcontent">
				<form action="" method="post">
					<input type="hidden" name="sent" value="1" />
					<p><pre><?php print_r($trips); ?></pre></p>
					
					<p><input type="submit" value="Valider" onclick="valider()" /></p>
				</form>
			</div>
			<div class="postfooter"></div>
		</div>
	</div>
</div>

<?php include_once('view/includes/footer.php'); ?>