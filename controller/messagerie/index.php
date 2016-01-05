<?php
$max =  5;
if(!isset($_SESSION['pseudo'])) { header('location: ../'); }
else {
	include_once('model/messagerie/get_messages.php');
	include_once('model/messagerie/get_nb_messages.php');

	if (array_key_exists('goto', $_GET)) {
		if ($_GET['goto'] < 1) { $pageact = 1; }
		else { $pageact = $_GET['goto']; }
	}
	else { $pageact = 1; }

	$messages=get_messages($_SESSION['pseudo'], $pageact, $max);
	$nb_total = get_nb_messages($_SESSION['pseudo']);
	
	include('view/messagerie/index.php'); 
}
