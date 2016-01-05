<?php

if(!isset($_SESSION['pseudo'])) { header('location: ../../'); }
else {
	//Quelque chose a été envoyé ?
	if(isset($_POST['sent'])) {
		//initialisations
		$receiver = htmlspecialchars($_POST['receiver']); $title = htmlspecialchars($_POST['title']); $message = htmlspecialchars($_POST['message']);
		
		$everything_entered = verify_everything_entered($receiver, $title, $message);
		
		//Si tout a bien été entré, on commence les vérifications
		if($everything_entered) {
			$everything_verified = verify($receiver, $title, $message);
			
			//Si tout est vérifié
			if($everything_verified) {
				//On peut rajouter le message
				include_once('model/messagerie/insert_message.php');
				insert_message($_SESSION['pseudo'], $receiver, $title, $message);
				
				header('Location: ../');
			}
		}
		else {
			$_SESSION['sending_errors'][]='Il manque des informations.';
		}
	}
	
	//Si ça ne s'est pas bien passé ou que l'utilisateur n'a rien fait
	//On affiche le formulaire
	include_once('model/user/get_users.php');
	$users = get_users();
	
	include('view/messagerie/envoyer/index.php'); 
}

//Vérification que les infos sont bien entrées
function verify_everything_entered($receiver, $title, $message) {
	$receiver_entered=false; $title_entered=false; $message_entered=false;
	
	if(isset($receiver) and $receiver != '') { $receiver_entered=true; }
	if(isset($title) and $title != '') { $title_entered=true; }
	if(isset($message) and $message != '') { $message_entered=true; }
	
	return ($receiver_entered and $title_entered and $message_entered);
}

//Vérification des informations
function verify($receiver, $title, $message) {
	//verification receveur
	$receiver_verification = verify_receiver($receiver);
	//verification titre
	$title_verification = verify_title($title);
	//verification du corps du message
	$message_verification = verify_message($message);
	
	return ($receiver_verification and $title_verification and $message_verification);
}

//Vérification receveur
function verify_receiver($receiver) {
	global $PSEUDO_MIN_LENGTH, $PSEUDO_MAX_LENGTH;
	$error=false;
	include_once('model/user/user_exists.php');
	
	//Receveur = soi-même
	if($receiver==$_SESSION['pseudo']) { $_SESSION['sending_errors'][]='Vous ne pouvez pas envoyer de message à vous-même.'; $error=true; }
	else {
		//Pseudo innexistant
		if(!user_exists(array('pseudo' => $receiver))) { $_SESSION['sending_errors'][]='Le pseudo entré n\'existe pas.'; $error=true; }
	}
	
	if(!$error) { return true; }
	return false;
}

//Verification titre
function verify_title($title) {
	global $TITLE_MIN_LENGTH, $TITLE_MAX_LENGTH;
	$error=false;
	
	//Longueur
	if(strlen($title) < $TITLE_MIN_LENGTH) { $_SESSION['sending_errors'][]='Le titre est trop court (minimum '.$TITLE_MIN_LENGTH.' caractères).'; $error=true; }
	elseif(strlen($title) > $TITLE_MAX_LENGTH) { $_SESSION['sending_errors'][]='Le titre est trop long (maximum '.$TITLE_MAX_LENGTH.' caractères).'; $error=true; }
	
	if(!$error) { return true; }
	return false;
}

//Verification message
function verify_message($message) {
	global $MESSAGE_MIN_LENGTH, $MESSAGE_MAX_LENGTH;
	$error=false;
	
	//Longueur
	if(strlen($message) < $MESSAGE_MIN_LENGTH) { $_SESSION['sending_errors'][]='Le message est trop court (minimum '.$MESSAGE_MIN_LENGTH.' caractères).'; $error=true; }
	elseif(strlen($message) > $MESSAGE_MAX_LENGTH) { $_SESSION['sending_errors'][]='Le message est trop long (maximum '.$MESSAGE_MAX_LENGTH.' caractères).'; $error=true; }
	
	if(!$error) { return true; }
	return false;
}