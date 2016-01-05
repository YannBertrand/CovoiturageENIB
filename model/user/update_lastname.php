<?php

function update_lastname($pseudo, $lastname) {
	global $DB;
	
	$req = $DB->prepare("UPDATE users 
								SET lastname=:lastname
								WHERE pseudo=:pseudo");
	$req->execute(array('lastname' => $lastname, 'pseudo' => $pseudo)) or die(print_r($req->errorInfo()));
}