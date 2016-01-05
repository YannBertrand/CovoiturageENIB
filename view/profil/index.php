<?php include_once('view/carte/header.php'); ?>

<div id="content">
	<?php include_once('menu.php'); ?>
	<?php include_once('view/includes/menu.php'); ?>
	
	<div id="middle">
		<div class="post">
			<div class="postheader"><h1>Voir son profil</h1></div>
			<div class="postcontent">
				<p>Pseudo : <?php echo $user['pseudo']; ?></p>
				<p>Prénom : <?php echo $user['firstname']; ?></p>
				<p>Nom : <?php echo $user['lastname']; ?></p>
				<p>Email : <?php echo $user['email']; ?></p>
				<p>
					Adresse de l'appartement : <?php echo $user['enib_home_adress']; ?>
					<?php if($show_enib_home_map) { ?>
						<div id="enib_home_map" style="width: 90%; height: 250px; border: 1px solid grey; margin: auto;"></div>
						<script>
							var enib_home_map = initMap("enib_home_map", "<?php echo $user['enib_home_hidden_adress']; ?>", "Appartement", "<?php echo $LOCAL_DIR; ?>/view/includes/images/apartment.png");
						</script>
					<?php } ?>
				</p>
				<p>
					Adresse des parents : <?php echo $user['home_adress']; ?>
					<?php if($show_home_map) { ?>
						<div id="home_map" style="width: 90%; height: 250px; border: 1px solid grey; margin: auto;"></div>
						<script>
							var home_map = initMap("home_map", "<?php echo $user['home_hidden_adress']; ?>", "Maison", "<?php echo $LOCAL_DIR; ?>/view/includes/images/home.png");
						</script>
					<?php } ?>
				</p>
				<p>Date d'inscription : <?php echo $user['inscription_date']; ?></p>
			</div>
			<div class="postfooter"></div>
		</div>
	</div>
</div>

<?php include_once('view/includes/footer.php'); ?>