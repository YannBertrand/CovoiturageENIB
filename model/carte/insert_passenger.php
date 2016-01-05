<?php

function insert_passenger($trip_id, $pseudo, $origin, $destination) {
	global $DB;
	
	$req = $DB->prepare("INSERT INTO passengers(id,trip_id,pseudo,origin,destination) 
									VALUES('',:trip_id,:pseudo,:origin,:destination)");
	$req->execute(array('trip_id' => $trip_id,
						'pseudo' => $pseudo,
						'origin' => $origin,
						'destination' => $destination)) or die(print_r($req->errorInfo()));
	
	return $DB->lastInsertId();
}
