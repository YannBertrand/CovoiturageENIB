<?php

function connect_to_db() {
	global $SQL_HOST, $SQL_DBNAME, $SQL_USER, $SQL_PASSWORD;
	try {
		return new PDO('mysql:host='.$SQL_HOST.';dbname='.$SQL_DBNAME.';charset=utf8', $SQL_USER, $SQL_PASSWORD);
	}
	catch (Exception $e){
		die('Erreur : ' . $e->getMessage());
	}
}
