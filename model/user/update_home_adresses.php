<?php

function update_home_adresses($pseudo, $home_adress, $home_hidden_adress) {
	global $DB;
	
	$req = $DB->prepare("UPDATE users 
								SET home_adress=:home_adress, home_hidden_adress=:home_hidden_adress
								WHERE pseudo=:pseudo");
	$req->execute(array('home_adress' => $home_adress, 
						'home_hidden_adress' => $home_hidden_adress, 
						'pseudo' => $pseudo)) or die(print_r($req->errorInfo()));
}