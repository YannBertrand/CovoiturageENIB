<?php

function update_last_ip($pseudo) {
	global $DB;
	
	if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])){ $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; }
    elseif(isset($_SERVER['HTTP_CLIENT_IP'])) { $ip  = $_SERVER['HTTP_CLIENT_IP']; }
    else { $ip = $_SERVER['REMOTE_ADDR']; }
	
	$req = $DB->prepare("UPDATE users 
								SET last_ip=:last_ip
								WHERE pseudo=:pseudo");
	$req->execute(array('last_ip' => $ip, 'pseudo' => $pseudo)) or die(print_r($req->errorInfo()));
}