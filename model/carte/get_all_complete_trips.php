<?php

function getAllCompleteTrips() {
	global $DB;
	
	$req = $DB->query("SELECT trip_id, driver, pseudo, passengers.origin, passengers.destination, UNIX_TIMESTAMP(departure) AS departure
							FROM trips INNER JOIN passengers
							WHERE departure > NOW() AND trips.id=trip_id
							ORDER BY departure 
							LIMIT 0,10") or die(print_r($req->errorInfo()));
	$trips=$req->fetchAll();
	
	return $trips;
}