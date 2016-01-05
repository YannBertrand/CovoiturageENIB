<?php

function update_last_activity($pseudo) {
	global $DB;
	
	$req = $DB->prepare("UPDATE users 
								SET last_activity=NOW()
								WHERE pseudo=:pseudo");
	$req->execute(array('pseudo' => $pseudo)) or die(print_r($req->errorInfo()));
}