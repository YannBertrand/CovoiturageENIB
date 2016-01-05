<?php

//Quelque chose a été envoyé ?
if(isset($_POST['sent'])) {
	//initialisations
	$pseudo = htmlspecialchars($_POST['pseudo']); $password = $_POST['password'];
	
	$everything_entered = verify_everything_entered($pseudo, $password);
	
	//Si tout a bien été entré, on commence les vérifications
	if($everything_entered) {
		include_once('model/user/user_exists.php');
		$everything_verified = verify($pseudo, $password);
		
		//Si tout est vérifié
		if($everything_verified) {
			//On peut connecter l'utilisateur
			include_once('model/user/connect_user.php');
			connect_user($pseudo);
		}
	}
	else {
		$_SESSION['connexion_error'][]='Il manque des informations.';
	}
}

header('Location: '.$_SERVER['HTTP_REFERER']);

//Vérification que les infos sont bien entrées
function verify_everything_entered($pseudo, $password) {
	$pseudo_entered=false; $password_entered=false;
	
	if(isset($pseudo) and $pseudo != '') { $pseudo_entered=true; }
	if(isset($password) and $password != '') { $password_entered=true; }
	
	return ($pseudo_entered and $password_entered);
}

function verify($pseudo, $password) {
	//verification pseudo
	$pseudo_verification = verify_pseudo($pseudo);
	//verification mots de passe
	if($pseudo_verification) { $password_verification = verify_password($pseudo, $password); }
	
	return ($pseudo_verification and $password_verification);
}

//Verification pseudo
function verify_pseudo($pseudo) {
	$error=false;
	
	//Pseudo pas existant
	if(!user_exists(array('pseudo' => $pseudo))) { $_SESSION['connexion_error'][]='Le pseudo entré n\'existe pas.'; $error=true; }
	
	if(!$error) { return true; }
	return false;
}

//Verification mot de passe
function verify_password($pseudo, $password) {
	$error=false;
	
	//Pseudo pas existant
	if(!user_exists(array('pseudo' => $pseudo, 'password' => sha1(md5($password))))) { $_SESSION['connexion_error'][]='Le mot de passe entré n\'est pas le bon.'; $error=true; }
	
	if(!$error) { return true; }
	return false;
}