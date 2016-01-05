<?php

function update_firstname($pseudo, $firstname) {
	global $DB;
	
	$req = $DB->prepare("UPDATE users 
								SET firstname=:firstname
								WHERE pseudo=:pseudo");
	$req->execute(array('firstname' => $firstname, 'pseudo' => $pseudo)) or die(print_r($req->errorInfo()));
}