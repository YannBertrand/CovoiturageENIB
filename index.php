<?php

session_start();

//Initialisations
require_once('controller/global.php');
require_once('controller/sql.php');
$DB = connect_to_db();

$PAGES_LIST=array('profil', 'profil/modifier', 'messagerie', 'messagerie/envoyer', 'carte', 'carte/creer', 'news', 'news/suivant', 'news/precedent');
$PAGES_USER_LIST=array('inscription', 'connexion', 'deconnexion', 'recuperation');
$STATIC_PAGES_LIST=array('informations');

//Mise à jour de la dernière activité
if(isset($_SESSION['pseudo'])) {
	include_once('model/user/update_last_activity.php');
	update_last_activity($_SESSION['pseudo']);
}

//Routeur
if(isset($_GET['page']) AND $_GET['page'] != NULL) {
	if(in_array($_GET['page'], $PAGES_LIST)) {
		include_once('controller/'.$_GET['page'].'/index.php');
	}
	elseif(in_array($_GET['page'], $PAGES_USER_LIST)) {
		include_once('controller/user/'.$_GET['page'].'/index.php');
	}
	elseif(in_array($_GET['page'], $STATIC_PAGES_LIST)) {
		include_once('view/'.$_GET['page'].'/index.php');
	}
	else {
		header('location: /covoiturage-yann/');
	}
}
else {
	include('controller/index.php');
}
