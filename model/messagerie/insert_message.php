<?php

function insert_message($sender, $receiver, $title, $message) {
	global $DB;
	
	$req = $DB->prepare("INSERT INTO messagerie(id,sender,receiver,title,message,sending_date) 
									VALUES('',:sender,:receiver,:title,:message, NOW()     )");
	$req->execute(array('sender' => $sender,
						'receiver' => $receiver,
						'title'	 => $title,
						'message' => $message)) or die(print_r($req->errorInfo()));
	
}