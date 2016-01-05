<?php

function get_news($page = 1, $max = 5) {
	global $DB;

	$offset = ($page - 1)*$max;
	$req = $DB->prepare("SELECT title, message, DATE_FORMAT(date, '%d/%m/%Y') AS day, DATE_FORMAT(date, '%H:%i:%s') AS hour FROM news ORDER BY date DESC LIMIT :offset, :max");
	$req->bindParam(':offset', $offset, PDO::PARAM_INT);
	$req->bindParam(':max', $max, PDO::PARAM_INT);
    $req->execute() or die(print_r($req->errorInfo()));
	$news=$req->fetchAll();
	
	return $news;
}
