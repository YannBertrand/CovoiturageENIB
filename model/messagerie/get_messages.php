<?php

function get_messages($pseudo, $page = 1, $max = 5) {
	global $DB;
	
	$offset = ($page - 1)*$max;
	$req = $DB->prepare("SELECT sender, receiver, title, message, DATE_FORMAT(sending_date, '%d/%m/%Y') AS date, DATE_FORMAT(sending_date, '%H:%i:%s') AS hour FROM messagerie WHERE sender=:pseudo OR receiver=:pseudo ORDER BY sending_date DESC LIMIT :offset, :max");
	$req->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
	$req->bindParam(':offset', $offset, PDO::PARAM_INT);
	$req->bindParam(':max', $max, PDO::PARAM_INT);
    $req->execute() or die(print_r($req->errorInfo()));
	$messages=$req->fetchAll();
	
	return $messages;
}
