<?php

function getAllCompleteTrips() {
	global $DB;
	
	$req = $DB->query("SELECT origin, destination 
							FROM trips
							WHERE trip_date > NOW()
							ORDER BY trip_date 
							LIMIT 0,10") or die(print_r($req->errorInfo()));
	$trips=$req->fetchAll();
	
	return $trips;
}