<?php

if(!isset($_SESSION['pseudo'])) { 
	include_once('model/carte/get_all_complete_trips.php');
	$complete_trips = getAllCompleteTrips();
	
	$colors = Array('blue', 
					'fuchsia', 
					'gray', 
					'green', 
					'lime', 
					'maroon', 
					'olive', 
					'purple', 
					'red', 
					'yellow');
	$i=0;
	$trips = Array();
	foreach($complete_trips as $trip) {
		if(!array_key_exists($trip['trip_id'], $trips)) { //trajet pas encore vu
			$trips[$trip['trip_id']]['origin']=$trip['origin'];
			$trips[$trip['trip_id']]['destination']=$trip['destination'];
			$trips[$trip['trip_id']]['waypoints']=Array();
			$trips[$trip['trip_id']]['departure']=$trip['departure'];
			$trips[$trip['trip_id']]['color']=$colors[$i];
			$i++;
		} else { 
			$trips[$trip['trip_id']]['waypoints'][]=$trip['origin'];
			$trips[$trip['trip_id']]['waypoints'][]=$trip['destination'];
		}
	}
	
	include('view/carte/user_not_connected.php'); 
}
else {
	//Quelque chose a été envoyé ?
	if(isset($_POST['sent'])) { 
		//initialisations
		$origin = htmlspecialchars($_POST['hidden_from']); $destination = htmlspecialchars($_POST['hidden_to']);
		$type = htmlspecialchars($_POST['type']);
		$frequency = htmlspecialchars($_POST['frequency']);
		$date = htmlspecialchars($_POST['hidden_date']);
		
		if(verify_everything_entered($origin, $destination, $type, $frequency, $date)) { 
			$everything_verified = verify($origin, $destination, $frequency, $date);
			
			//Si tout est vérifié
			if($everything_verified) {
				include_once('model/carte/get_trips.php');
				
				$trips = get_trips($date);
				
				include('view/carte/user_connected_form_completed.php');
				exit();
			}
		}
		else {
			$_SESSION['sending_errors'][]='Il manque des informations.';
		}
	}
	$show_enib_home_marker = false; $show_home_marker = false;
	$show_map = false;
	
	include_once('model/user/get_user.php');
	$user=get_user($_SESSION['pseudo']);
	
	if(is_adress_defined($user['enib_home_hidden_adress'])) { $show_enib_home_marker=true; $show_map=true; }
	if(is_adress_defined($user['home_hidden_adress'])) { $show_home_marker=true; $show_map=true; }
	
	include('view/carte/user_connected.php');
}

//Vérification que les infos sont bien entrées
function verify_everything_entered($origin, $destination, $type, $frequency, $date) {
	$origin_entered=false; $destination_entered=false; $type_entered=false; $frequency_entered=false; $date_entered=false;
	
	if(isset($origin) and $origin != '') { $origin_entered=true; }
	if(isset($destination) and $destination != '') { $destination_entered=true; }
	if(isset($type) and $type != '') { $type_entered=true; }
	if(isset($frequency)) { $frequency_entered=true; }
	if(isset($date) and $date != '') { $date_entered=true; }
	
	return ($origin_entered and $destination_entered and $type_entered and $frequency_entered and $date_entered);
}

//Vérification des informations
function verify($origin, $destination, $frequency, $date) {
	//verification de l'origine
	$origin_verification = verify_adress($origin);
	//verification de la destination
	$destination_verification = verify_adress($destination);
	//verification de la fréquence
	$frequency_verification = verify_frequency($frequency);
	//verification de la date
	//$date_verification = verify_date($date); //la flemme
	
	return ($origin_verification and $destination_verification and $frequency_verification);
}

function is_adress_defined($adress) {
	$position = explode(', ', $adress);
	
	if(count($position) == 2) { return true; }
	else { return false; }
}
function verify_adress($adress) { 
	if(is_adress_defined($adress)) { return true; } 
	else { $_SESSION['sending_errors'][]='Mauvaise position.'; return false; }
}

function verify_frequency($frequency) {
	global $FREQUENCIES;
	$error=false;
	
	if(!in_array($frequency, $FREQUENCIES)) { $error=true; $_SESSION['sending_errors'][]='Fréquence innexistante.'; } 
	
	if(!$error) { return true; }
	else { return false; }
}