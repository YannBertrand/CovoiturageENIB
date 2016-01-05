<?php

if(!isset($_SESSION['pseudo'])) { header('location: ../'); }
else { 
	$show_enib_home_map=false; $show_home_map=false;
	
	include_once('model/user/get_user.php');
	$user = get_user($_SESSION['pseudo']);
	
	if(is_adress_defined($user['enib_home_hidden_adress'])) { $show_enib_home_map=true; }
	else { $user['enib_home_adress']='Adresse pas encore définie.'; }
	
	if(is_adress_defined($user['home_hidden_adress'])) { $show_home_map=true; }
	else { $user['home_adress']='Adresse pas encore définie.'; }
	
	include('view/profil/index.php');
}

function is_adress_defined($adress) {
	$position = explode(', ', $adress);
	
	if(count($position) == 2) { return true; }
	else { return false; }
}