<?php

function insert_trip($driver, $origin, $destination, $departure, $frequency, $places_nb) {
	global $DB;
	
	$req = $DB->prepare("INSERT INTO trips(id,origin,destination,driver,departure,frequency,car_capacity,available_sits) 
									VALUES('',:origin,:destination,:driver,:departure,:frequency,:car_capacity,:available_sits)");
	$req->execute(array('origin' => $origin,
						'destination' => $destination,
						'driver'	 => $driver,
						'departure' => $departure,
						'frequency' => $frequency,
						'car_capacity' => $places_nb,
						'available_sits' => $places_nb-1)) or die(print_r($req->errorInfo()));
	
	return $DB->lastInsertId();
}
