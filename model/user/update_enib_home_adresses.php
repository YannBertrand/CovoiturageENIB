<?php

function update_enib_home_adresses($pseudo, $enib_home_adress, $enib_home_hidden_adress) {
	global $DB;
	
	$req = $DB->prepare("UPDATE users 
								SET enib_home_adress=:enib_home_adress, enib_home_hidden_adress=:enib_home_hidden_adress
								WHERE pseudo=:pseudo");
	$req->execute(array('enib_home_adress' => $enib_home_adress, 
						'enib_home_hidden_adress' => $enib_home_hidden_adress, 
						'pseudo' => $pseudo)) or die(print_r($req->errorInfo()));
}