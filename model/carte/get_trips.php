<?php

function get_trips($trip_date) {
	global $DB;
	
	$before_date = date_create($trip_date); $after_date = date_create($trip_date);
	date_modify($before_date, '-1 day'); date_modify($after_date, '+1 day');
	
	echo date_format($before_date, 'Y-m-d'); echo date_format($after_date, 'Y-m-d');
	
	$req = $DB->prepare("SELECT * 
							FROM trips
							WHERE departure BETWEEN :before_date AND :after_date
								AND available_sits > 0
							ORDER BY departure") or die(print_r($req->errorInfo()));
	$req->execute(array('before_date' => date_format($before_date, 'Y-m-d'),
						'after_date' => date_format($after_date, 'Y-m-d')));
	$trips=$req->fetchAll();
	
	return $trips;
}
	/*$offset = ($page - 1)*$max;
	$req = $DB->prepare("SELECT origin, driver FROM trips");
    $req->execute() or die(print_r($req->errorInfo()));
	$trip=$req->fetch();
	while ($donnees = $trip->fetch()){
	    if (<script> getDistancebetween($coordonate, $donnees['origin'], $distanceMax *1000) </script>){
	      $listTrips[] = $donnees;
	      }	
	}
	
	
	return $listTrips;
}








<script>

  var geocoder;

  function getDistanceBetween(coord1, coord2, distance) {
    geocoder = new google.maps.Geocoder();
    var input2 = coord2; //$donnees['origin'];
    var latlngStr2 = input2.split(",",2);
    var lat2 = parseFloat(latlngStr2[0]);
    var lng2 = parseFloat(latlngStr2[1]);
    var gLatLng2 = new google.maps.GLatLng(lat2, lng2, True);
    
    var input1 = coord1 ; //$coordonate;
    var latlngStr1 = input1.split(",",2);
    var lat1 = parseFloat(latlngStr1[0]);
    var lng1 = parseFloat(latlngStr1[1]);
    var gLatLng1 = new google.maps.GLatLng(lat1, lng1, True);
    if (gLatLng1.distanceFrom(gLatLng2) < distance){
      return True;
      }
    else { return False };    
    
    
   // var latlng = new google.maps.LatLng(lat, lng);          
     // if (status == google.maps.GeocoderStatus.OK) {
       // if (results[1]) {
         // infowindow.setContent(results[1].formatted_address);

      //  }
     // } else {
     // }
   }


  
</script>*/