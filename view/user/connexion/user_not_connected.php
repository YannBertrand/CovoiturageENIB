<form action="<?php echo $LOCAL_DIR; ?>/connexion/" method="post">
	<p>
		<input type="hidden" name="sent" value="1" />
		<label for="pseudo">Pseudo : </label><input type="text" id="pseudo" name="pseudo" value="<?php if(isset($_POST['pseudo'])) { echo $_POST['pseudo']; } ?>" />
		<label for="password">Mot de passe : </label><input type="password" id="password" name="password" value="<?php if(isset($_POST['password'])) { echo $_POST['password']; } ?>" />
		<input type="submit" name="valider" />
	</p>
</form>
<span id="link">
	<a href="<?php echo $LOCAL_DIR; ?>/inscription/">Pas encore inscrit ?</a>
	<a href="<?php echo $LOCAL_DIR; ?>/recuperation/">Mot de passe oublié ?</a>
</span>
<?php if(isset($_SESSION['connexion_error']) and $_SESSION['connexion_error'] != null) { ?>
	<div class="formulaire"><p style="color: #ff0000"><?php foreach($_SESSION['connexion_error'] as $error) { echo $error.'<br />'; } ?></p></div>
<?php } $_SESSION['connexion_error']=''; ?>
<div class="clear"></div>