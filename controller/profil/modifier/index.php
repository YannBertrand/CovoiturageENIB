<?php

if(!isset($_SESSION['pseudo'])) { header('location: ../../'); }
else {
	include_once('model/user/get_user.php');
	$user=get_user($_SESSION['pseudo']);
	
	//Quelque chose a été envoyé ?
	if(isset($_POST['sent'])) {
		//initialisations
		$firstname = htmlspecialchars($_POST['firstname']); $lastname = htmlspecialchars($_POST['lastname']); 
		$enib_home_adress = htmlspecialchars($_POST['enib_home_adress']); $enib_home_hidden_adress = htmlspecialchars($_POST['enib_home_hidden_adress']); 
		$home_adress = htmlspecialchars($_POST['home_adress']); $home_hidden_adress = htmlspecialchars($_POST['home_hidden_adress']); 
		
		
		//Vérification du prénom
		if(verify_firstname($user, $firstname)) {
			//Modification du prénom
			include_once('model/user/update_firstname.php');
			update_firstname($_SESSION['pseudo'], $firstname);
		}
		//Vérification du nom
		if(verify_lastname($user, $lastname)) {
			//Modification du nom
			include_once('model/user/update_lastname.php');
			update_lastname($_SESSION['pseudo'], $lastname);
		}
		//Vérification de l'adresse de l'appart
		if(verify_enib_home_adresses($user, $enib_home_adress, $enib_home_hidden_adress)) {
			//Modification de l'adresse de l'appart
			include_once('model/user/update_enib_home_adresses.php');
			update_enib_home_adresses($_SESSION['pseudo'], $enib_home_adress, $enib_home_hidden_adress);
		}
		//Vérification du nom
		if(verify_home_adresses($user, $home_adress, $home_hidden_adress)) {
			//Modification de l'adresse de la maison
			include_once('model/user/update_home_adresses.php');
			update_home_adresses($_SESSION['pseudo'], $home_adress, $home_hidden_adress);
		}
		
		include_once('model/user/update_modification_date.php');
		update_modification_date($_SESSION['pseudo']);
		
		$user=get_user($_SESSION['pseudo']); //On remet à jour les infos qui ont put être modifiées
	}
	include_once('view/profil/modifier/index.php'); 
}

function verify_firstname($user, $firstname) {
	global $FIRSTNAME_MIN_LENGTH, $FIRSTNAME_MAX_LENGTH;
	$error=false;
	
	//Rien n'a changé
	if($user['firstname'] == $firstname) { $error=true; } 
	else {
		//Longueur
		if(strlen($firstname) < $FIRSTNAME_MIN_LENGTH) { $_SESSION['update_errors'][]='Le prénom est trop court (minimum '.$FIRSTNAME_MIN_LENGTH.' caractères).'; $error=true; }
		elseif(strlen($firstname) > $FIRSTNAME_MAX_LENGTH) { $_SESSION['update_errors'][]='Le prénom est trop long (maximum '.$FIRSTNAME_MAX_LENGTH.' caractères).'; $error=true; }
	}
	
	if(!$error) { return true; }
	else { return false; }
}

function verify_lastname($user, $lastname) {
	global $LASTNAME_MIN_LENGTH, $LASTNAME_MAX_LENGTH;
	$error=false;
	
	//Rien n'a changé
	if($user['lastname'] == $lastname) { $error=true; } 
	else {
		//Longueur
		if(strlen($lastname) < $LASTNAME_MIN_LENGTH) { $_SESSION['update_errors'][]='Le nom est trop court (minimum '.$LASTNAME_MIN_LENGTH.' caractères).'; $error=true; }
		elseif(strlen($lastname) > $LASTNAME_MAX_LENGTH) { $_SESSION['update_errors'][]='Le nom est trop long (maximum '.$LASTNAME_MAX_LENGTH.' caractères).'; $error=true; }
	}
	
	if(!$error) { return true; }
	else { return false; }
}

function verify_enib_home_adresses($user, $enib_home_adress, $enib_home_hidden_adress) {
	$error=false;
	
	//Rien n'a changé
	if($user['enib_home_adress'] == $enib_home_adress OR $user['enib_home_hidden_adress'] == $enib_home_hidden_adress) { $error=true; }
	
	if(!$error) { return true; }
	else { return false; }
}

function verify_home_adresses($user, $home_adress, $home_hidden_adress) {
	$error=false;
	
	//Rien n'a changé
	if($user['home_adress'] == $home_adress OR $user['home_hidden_adress'] == $home_hidden_adress) { $error=true; } 
	
	if(!$error) { return true; }
	else { return false; }
}