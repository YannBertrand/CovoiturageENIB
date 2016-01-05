<?php

function get_users() {
	global $DB;
	
	$req = $DB->prepare("SELECT pseudo FROM users WHERE pseudo<>:pseudo ORDER BY pseudo");
	$req->execute(array('pseudo' => $_SESSION['pseudo']));
    $users=$req->fetchAll();
	
	return $users;
}