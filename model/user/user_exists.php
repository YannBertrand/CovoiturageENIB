<?php

function user_exists($params) {
	global $DB;
	
	$where=''; $i=0; //construction de where
	foreach($params as $key => $param) {
		$where .= $key.'=:'.$key; $i++;
		if($i < count($params)) { $where.=' AND '; }
	}
	
	$req = $DB->prepare('SELECT pseudo FROM users WHERE '.$where);
    $req->execute($params) or die(print_r($req->errorInfo()));
	$user=$req->fetch();
	
	if(!empty($user)) { return true; }
	else { return false; }
}