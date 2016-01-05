<?php include_once('view/carte/header.php'); ?>

<div id="content">
	<?php include_once('view/profil/menu.php'); ?>
	<?php include_once('view/includes/menu.php'); ?>
	
	<div id="middle">
		<div class="post">
			<div class="postheader"><h1>Modifier son profil</h1></div>
			<div class="postcontent">
				<form id="user_infos_form" action="" method="post">
					<p>
						<input type="hidden" name="sent" value="1" />
						
						<label for="firstname">Prénom : </label><input type="text" id="firstname" class="formulaire" name="firstname" value="<?php echo $user['firstname']; ?>" maxlength="<?php echo $FIRSTNAME_MAX_LENGTH; ?>" size="<?php echo $FIRSTNAME_MAX_LENGTH; ?>" /><br /><br />
						<label for="lastname">Nom : </label><input type="text" id="lastname" class="formulaire" name="lastname" value="<?php echo $user['lastname']; ?>" maxlength="<?php echo $LASTNAME_MAX_LENGTH; ?>" size="<?php echo $LASTNAME_MAX_LENGTH; ?>" />
					</p>
					<p>
						<label for="enib_home_adress">Adresse de l'appartement : </label><input type="text" id="enib_home_adress" name="enib_home_adress" class="formulaire" value="<?php echo $user['enib_home_adress']; ?>" onKeyPress="updateMarker(complete_enib_home_map, 'enib_home_adress', 'enib_home_hidden_adress');" /><br />
						<div id="enib_home_map" style="width: 90%; height: 250px; border: 1px solid grey; margin: auto;"></div>
						<input type="hidden" id="enib_home_hidden_adress" name="enib_home_hidden_adress" value="<?php echo $user['enib_home_hidden_adress']; ?>" />
					</p>
					<p>
						<label for="home_adress">Adresse de la maison : </label><input type="text" id="home_adress" name="home_adress" class="formulaire" value="<?php echo $user['home_adress']; ?>" onKeyPress="updateMarker(complete_home_map, 'home_adress', 'home_hidden_adress');" /><br /> 
						<div id="home_map" style="width: 90%; height: 250px; border: 1px solid grey; margin: auto;"></div>
						<input type="hidden" id="home_hidden_adress" name="home_hidden_adress" value="<?php echo $user['home_hidden_adress']; ?>" />
					</p>
					<p>
						<input id="submit" class="formulaire" type="submit" name="valider" /></br>
					</p>
				</form>
				<?php if(isset($_SESSION['update_errors']) and $_SESSION['update_errors'] != null) { ?>
					<div>
						<p style="color: #ff0000">
						<?php foreach($_SESSION['update_errors'] as $error) { echo $error.'<br />'; } ?>
						</p>
					</div>
				<?php } $_SESSION['update_error']=''; ?>
			</div>
			<div class="postfooter"></div>
		</div>
	</div>
</div>

<?php include_once('view/includes/footer.php'); ?>
<script>
// APPARTEMENT
var complete_enib_home_map = initEditMap("enib_home_map", "enib_home_adress", "enib_home_hidden_adress", "Appartement", "<?php echo $LOCAL_DIR; ?>/view/includes/images/apartment.png");

//MAISON
var complete_home_map = initEditMap("home_map", "home_adress", "home_hidden_adress", "Maison", "<?php echo $LOCAL_DIR; ?>/view/includes/images/home.png");
</script>