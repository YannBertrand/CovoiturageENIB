<?php

function update_modification_date($pseudo) {
	global $DB;
	
	$req = $DB->prepare("UPDATE users 
								SET modification_date=NOW()
								WHERE pseudo=:pseudo");
	$req->execute(array('pseudo' => $pseudo)) or die(print_r($req->errorInfo()));
}