<?php include_once('view/includes/header.php'); ?>

<div id="content">
	<?php include_once('view/menu.php'); ?>
	<?php include_once('view/includes/menu.php'); ?>
	
	<div id="middle">
		<div class="post">
			<div class="postheader"><h1>Inscription</h1></div>
			<div class="postcontent">
				<form action="" method="post">
					<p>
						<input type="hidden" name="sent" value="1" />
						
						<label for="pseudo">Pseudo : </label><input class="formulaire" type="text" id="pseudo" name="pseudo" maxlength="<?php echo $PSEUDO_MAX_LENGTH; ?>" size="<?php echo $PSEUDO_MAX_LENGTH; ?>" value="<?php if(isset($_POST['pseudo'])) { echo $_POST['pseudo']; } ?>" /></br></br>
						<label for="password">Mot de passe : </label><input class="formulaire" type="password" id="password" name="password" maxlength="<?php echo $PASSWORD_MAX_LENGTH; ?>" size="<?php echo $PASSWORD_MAX_LENGTH; ?>" value="<?php if(isset($_POST['password'])) { echo $_POST['password']; } ?>" /></br></br>
						<label for="password_verification">Retapez le mot de passe : </label><input class="formulaire" type="password" id="password_verification" name="password_verification" maxlength="<?php echo $PASSWORD_MAX_LENGTH; ?>" size="<?php echo $PASSWORD_MAX_LENGTH; ?>" value="<?php if(isset($_POST['password_verification'])) { echo $_POST['password_verification']; } ?>" /></br></br>
						<label for="email">Adresse Email : </label><input class="formulaire" type="email" id="email" name="email" value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>" /></br></br>
						
						<input class="formulaire" type="submit" name="valider" /></br>
					</p>
				</form>
				<?php if(isset($_SESSION['inscription_errors']) and $_SESSION['inscription_errors'] != null) { ?>
					<div>
						<p style="color: #ff0000">
						<?php foreach($_SESSION['inscription_errors'] as $error) { echo $error.'<br />'; } $_SESSION['inscription_errors'] = NULL; ?>
						</p>
					</div>
				<?php } ?>
			</div>
			<div class="postfooter"></div>
		</div>
	</div>
</div>

<?php include_once('view/includes/footer.php'); ?>
