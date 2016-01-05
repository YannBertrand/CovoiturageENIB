<?php

function insert_user($pseudo, $password, $email) {
	global $DB;
	
	$req = $DB->prepare("INSERT INTO users(id,pseudo,password,firstname,lastname,email,enib_home_adress,enib_home_hidden_adress,home_adress,home_hidden_adress,inscription_date,modification_date,last_activity,last_ip) 
									VALUES('',:pseudo,:password,''     ,''      ,:email,''        ,''                ,''         , ''              , NOW()          , NOW()           , NOW()       ,'')");
	$req->execute(array('pseudo' => $pseudo,
						'password' => sha1(md5($password)),
						'email'	 => $email)) or die(print_r($req->errorInfo()));
	
}