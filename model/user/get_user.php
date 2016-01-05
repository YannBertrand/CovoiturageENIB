<?php

function get_user($pseudo) {
	global $DB;
	
	$req = $DB->prepare("SELECT pseudo, firstname, lastname, email, enib_home_adress, enib_home_hidden_adress, home_adress, home_hidden_adress, DATE_FORMAT(inscription_date, 'le %d/%m/%Y à %H:%i:%s') AS inscription_date FROM users WHERE pseudo=:pseudo");
    $req->execute(array('pseudo' => $pseudo)) or die(print_r($req->errorInfo()));
	$user=$req->fetch();
	
	return $user;
}