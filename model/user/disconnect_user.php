<?php

function disconnect_user() {
	//On s'en fout qu'il soit connecté ou pas, la destruction de session ne génère pas d'erreur.
	$_SESSION = array();
	session_destroy();
}