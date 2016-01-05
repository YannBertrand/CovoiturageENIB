<?php include_once('view/includes/header.php'); ?>

<div id="content">
	<?php include_once('view/messagerie/menu.php'); ?>
	<?php include_once('view/includes/menu.php'); ?>
	
	<div id="middle">
		<div class="post">
			<div class="postheader"><h1>Envoyer un message</h1></div>
			<div class="postcontent">
				<form action="" method="post">
					<p>
						<input type="hidden" name="sent" value="1" />
						
						<label for="receiver">Destinataire : </label><input class="formulaire" list="users" type="text" id="receiver" name="receiver" maxlength="<?php echo $PSEUDO_MAX_LENGTH; ?>" size="<?php echo $PSEUDO_MAX_LENGTH; ?>" value="<?php if(isset($_POST['receiver'])) { echo $_POST['receiver']; } ?>" /></br></br>
						<datalist id="users">
							<?php foreach($users as $user) { ?><option value="<?php echo $user['pseudo']; ?>"><?php } ?>
						</datalist>
						<label for="title">Titre : </label><input class="formulaire" type="text" id="title" name="title" maxlength="<?php echo $TITLE_MAX_LENGTH; ?>" size="<?php echo $TITLE_MAX_LENGTH; ?>" value="<?php if(isset($_POST['title'])) { echo $_POST['title']; } ?>" /></br></br>
						<label for="message">Message : </label><textarea class="formulaire" type="text" id="message" name="message" style="max-width: 300px"><?php if(isset($_POST['message'])) { echo $_POST['message']; } ?></textarea></br></br>
						
						<input class="formulaire" type="submit" name="valider" /></br>
					</p>
				</form>
				<?php if(isset($_SESSION['sending_errors']) and $_SESSION['sending_errors'] != null) { ?>
					<div>
						<p style="color: #ff0000">
						<?php foreach($_SESSION['sending_errors'] as $error) { echo $error.'<br />'; } ?>
						</p>
					</div>
				<?php } $_SESSION['sending_errors'] = ''; ?>
			</div>
			<div class="postfooter"></div>
		</div>
	</div>
</div>

<?php include_once('view/includes/footer.php'); ?>