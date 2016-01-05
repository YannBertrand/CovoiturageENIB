<?php

//Si l'utilisateur est déjà connecté
if(isset($_SESSION['pseudo'])) { header('location: ../'); }

//Quelque chose a été envoyé ?
if(isset($_POST['sent'])) {
	//initialisations
	$pseudo = htmlspecialchars($_POST['pseudo']); $password = $_POST['password']; $password_verification = $_POST['password_verification']; $email = htmlspecialchars($_POST['email']);
	
	$everything_entered = verify_everything_entered($pseudo, $password, $password_verification, $email);

	//Si tout a bien été entré, on commence les vérifications
	if($everything_entered) {
		include_once('model/user/user_exists.php');
		$everything_verified = verify($pseudo, $password, $password_verification, $email);
		
		//Si tout est vérifié
		if($everything_verified) {
			//On peut rajouter l'utilisateur
			include_once('model/user/insert_user.php');
			insert_user($pseudo, $password, $email);
			
			include_once('model/user/connect_user.php');
			connect_user($pseudo);
			include_once('view/user/inscription/inscription_done.php');
			exit(); //Stop le chargement pour éviter de charger l'autre vue
		}
	}
	else {
		$_SESSION['inscription_errors'][]='Il manque des informations.';
	}
}

//Si ça ne s'est pas bien passé ou que l'utilisateur n'a rien fait
//On affiche le formulaire
include_once('view/user/inscription/inscription_form.php');

//Vérification que les infos sont bien entrées
function verify_everything_entered($pseudo, $password, $password_verification, $email) {
	$pseudo_entered=false; $password_entered=false; $password_verification_entered=false; $email_entered=false;
	
	if(isset($pseudo) and $pseudo != '') { $pseudo_entered=true; }
	if(isset($password) and $password != '') { $password_entered=true; }
	if(isset($password_verification) and $password_verification != '') { $password_verification_entered=true; }
	if(isset($email) and $email != '') { $email_entered=true; }
	
	return ($pseudo_entered and $password_entered and $password_verification_entered and $email_entered);
}

//Vérification des informations
function verify($pseudo, $password, $password_verification, $email) {
	//verification pseudo
	$pseudo_verification = verify_pseudo($pseudo);
	//verification mots de passe
	$passwords_verification = verify_passwords($password, $password_verification);
	//verification email
	$email_verification = verify_email($email);
	
	return ($pseudo_verification and $passwords_verification and $email_verification);
}

//Verification pseudo
function verify_pseudo($pseudo) {
	global $PSEUDO_MIN_LENGTH, $PSEUDO_MAX_LENGTH;
	$error=false;
	
	//Longueur
	if(strlen($pseudo) < $PSEUDO_MIN_LENGTH) { $_SESSION['inscription_errors'][]='Le pseudo est trop court (minimum '.$PSEUDO_MIN_LENGTH.' caractères).'; $error=true; }
	elseif(strlen($pseudo) > $PSEUDO_MAX_LENGTH) { $_SESSION['inscription_errors'][]='Le pseudo est trop long (maximum '.$PSEUDO_MAX_LENGTH.' caractères).'; $error=true; }
	else {
		//Pseudo déjà utilisé
		if(user_exists(array('pseudo' => $pseudo))) { $_SESSION['inscription_errors'][]='Le pseudo entré est déjà utilisé.'; $error=true; }
	}
	
	if(!$error) { return true; }
	return false;
}

//Verification mots de passe
function verify_passwords($password, $password_verification) {
	global $PASSWORD_MIN_LENGTH, $PASSWORD_MAX_LENGTH;
	$error=false;
	
	//Mots de passe pareil
	if($password != $password_verification) { $_SESSION['inscription_errors'][]='Les deux mots de passe ne correspondent pas.'; $error=true; }
	else {
		//Longueur
		if(strlen($password) < $PASSWORD_MIN_LENGTH) { $_SESSION['inscription_errors'][]='Le mot de passe est trop court (minimum '.$PASSWORD_MIN_LENGTH.' caractères).'; $error=true; }
		elseif(strlen($password) > $PASSWORD_MAX_LENGTH) { $_SESSION['inscription_errors'][]='Le mot de passe est trop long (maximum '.$PASSWORD_MAX_LENGTH.' caractères).'; $error=true; }
	}
	
	if(!$error) { return true; }
	return false;
}

//Verification email
function verify_email($email) {
	global $EMAIL_MIN_LENGTH, $EMAIL_MAX_LENGTH;
	$error=false;
	
	//Pseudo déjà utilisé
	if(user_exists(array('email' => $email))) { $_SESSION['inscription_errors'][]='L\'adresse email entrée est déjà utilisée.'; $error=true; }
	else {
		//Vraie adresse email
		if(!preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#', $email)) { $_SESSION['inscription_errors'][]='L\'adresse email entrée n\'est pas une adresse email.'; $error=true; }
		else {
			//Longueur
			if(strlen($email) < $EMAIL_MIN_LENGTH) { $_SESSION['inscription_errors'][]='L\'adresse email est trop courte (minimum '.$EMAIL_MIN_LENGTH.' caractères).'; $error=true; }
			elseif(strlen($email) > $EMAIL_MAX_LENGTH) { $_SESSION['inscription_errors'][]='L\'adresse email est trop longue (maximum '.$EMAIL_MAX_LENGTH.' caractères).'; $error=true; }
		}
	}
	
	if(!$error) { return true; }
	return false;
}