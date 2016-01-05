function show(element, display) { if(typeof(display)==="undefined") { display="block"; } element.style.display=display; }
function hide(element) { element.style.display="none"; }

function initMap(map_id, db_marker_position, place_marker_name, place_marker_icon) {
	var enib_position = new google.maps.LatLng(48.3603502, -4.5656347);
	
	//Création de la map
	var map = createMap(map_id, enib_position, 9);
	
	//Création des marqueurs
	var enib_marker = createMarker(enib_position, map, "ENIB", true, "/covoiturage/view/includes/images/university.png");
	
	var db_marker_coords = db_marker_position.split(", ");
	var place_marker = createMarker(new google.maps.LatLng(db_marker_coords[0], db_marker_coords[1]), map, place_marker_name, true, place_marker_icon);
	
	//On recentre et rezoome la carte
	updateBounds(map, [enib_marker, place_marker]);
	
	return map;
}

function initEditMap(map_id, input_id, hidden_input_id, name, place_marker_icon) {
	var enib_position = new google.maps.LatLng(48.3603502, -4.5656347);
		
	//Création de la map
	var map = createMap(map_id, enib_position, 9);
	
	//Création des marqueurs
	var enib_marker = createMarker(enib_position, map, "ENIB", true, "/covoiturage/view/includes/images/university.png");
	
	var hidden_input = document.getElementById(hidden_input_id);
	var hidden_input_coords = hidden_input.value.split(", ");
	if(hidden_input_coords.length==2) {
		var place_marker = createMarker(new google.maps.LatLng(hidden_input_coords[0], hidden_input_coords[1]), map, name, true, place_marker_icon);
	}
	else {
		var place_marker = createMarker(enib_position, map, name, false, place_marker_icon);
	}
	
	//On recentre et rezoome la carte
	updateBounds(map, [enib_marker, place_marker]);
	
	return {"map": map, "enib_marker": enib_marker, "place_marker": place_marker};
}

function createMap(id, center, zoom, draggable, zoomControl, scrollwheel, disableDoubleClickZoom) {
	if(typeof(draggable)==='undefined') draggable = false;
	if(typeof(zoomControl)==='undefined') zoomControl = false;
	if(typeof(scrollwheel)==='undefined') scrollwheel = false;
	if(typeof(disableDoubleClickZoom)==='undefined') disableDoubleClickZoom = false;
	
	var options = {
		center: center,
		zoom: zoom,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		mapTypeControl: false,
		draggable: draggable,
		scaleControl: false,
		zoomControl: zoomControl,
		streetViewControl: false,
		scrollwheel: scrollwheel,
		disableDoubleClickZoom: disableDoubleClickZoom
	};
	return new google.maps.Map(document.getElementById(id), options);
}

function createMarker(position, map, title, visible, icon, zIndex) {
	if(typeof(title)==="undefined") title = google.maps.G_DEFAULT_TITLE;
	if(typeof(visible)==="undefined") visible = google.maps.G_DEFAULT_VISIBLE;
	if(typeof(icon)==="undefined") icon = google.maps.G_DEFAULT_ICON;
	if(typeof(zIndex)==="undefined") zIndex = google.maps.G_DEFAULT_ZINDEX;
	
	return new google.maps.Marker({
		position: position,
		map: map,
		title: title,
		visible: visible,
		icon: icon,
		zIndex: zIndex
	});
}

function updateBounds(map, markers) {
	var map_markers = new google.maps.LatLngBounds();
	var n = markers.length;
	for(var i=0; i < n; i++) {
		map_markers.extend(markers[i].getPosition());
	}
	map.fitBounds(map_markers);
}

function updateMarker(complete_map, element_id, hidden_element_id) {
	var map=complete_map["map"];
	var enib_marker=complete_map["enib_marker"];
	var place_marker=complete_map["place_marker"];
	
	document.getElementById("submit").disabled=true;
	
	place_marker.setVisible(false); //On planque le marqueur tant qu'on a pas trouvé
	document.getElementById("submit").disabled=true; //On bloque l'envoi du formulaire tant qu'on a pas trouvé
	
	var adress = document.getElementById(element_id);
	var hidden_adress = document.getElementsByName(hidden_element_id)[0];
	
	var input = /** @type {HTMLInputElement} */(adress);
	var options = {
		componentRestrictions: {country: 'fr'}
	};
	var autocomplete = new google.maps.places.Autocomplete(input, options);
	adress.className = "formulaire_adress_not_found";
	
	google.maps.event.addListener(autocomplete, 'place_changed', function() {
		var place = autocomplete.getPlace();
		
		var position = place.geometry.location;
		hidden_adress.value=position.lat()+', '+position.lng();
		
		place_marker.setPosition(position);
		place_marker.setVisible(true); //On raffiche le marqueur à la nouvelle position
		
		updateBounds(map, [place_marker, enib_marker]);
		
		if(hidden_adress.value==(position.lat()+', '+position.lng()) && place_marker.getPosition()==position) {
			adress.className = "formulaire";
			document.getElementById("submit").disabled=false; //On remet le formulaire en route
		}
	});
}

//Problème de closure... un peu compliqué
var addComplexListener = function (map, marker, message, event_name, pile, span_from, input_from, span_to, input_to, end_step, next_step) {
	google.maps.event.addListener(marker, event_name, function() {
		//marker.setZIndex(marker.getZIndex()+2); //fais merder plus qu'autre chose
		
		if(!pile[0] && !pile[1]) { //rien n'est entré (départ)
			pile.push(marker); 
			span_from.innerHTML=message;
			input_from.value=marker.getPosition().lat()+', '+marker.getPosition().lng();
		} 
		else if(pile[0] && pile[1]) { //tout est entré (fin)
			pile.pop(); pile.pop(); //on vide la pile
			pile.push(marker);
			span_from.innerHTML=message; span_to.innerHTML="...";
			input_from.value=marker.getPosition().lat()+', '+marker.getPosition().lng(); input_to.value="";
			directionsDisplay.setMap(null);
		}
		else if(pile[0] && !pile[1] && pile[0] != marker) { //point de départ entré
			pile.push(marker);
			span_to.innerHTML=message;
			input_to.value=marker.getPosition().lat()+', '+marker.getPosition().lng();
		}
		
		if(pile.length==2) {
			directionsDisplay = createRoute(map, pile[0].getPosition(), pile[1].getPosition());
			show(end_step, "inline"); show(next_step); 
		}
		else { hide(end_step); hide(next_step); }
	});
}

function updateFromTo(map, complete_markers, event_name) {
	//var from_marker; var to_marker;
	//var from_entered=false; var to_entered=false;
	var pile = [];
	var span_from = document.getElementById("from"); var input_from = document.getElementById("hidden_from");
	var span_to = document.getElementById("to");  var input_to = document.getElementById("hidden_to");
	var directionsDisplay;
	
	var end_step=document.getElementById("end_step_1");
	var step_2=document.getElementById("step_2");
	
	var n = complete_markers.length; var marker=""; var message=""; var listeners=[];
	for(var i=0; i<n; i++) {
		marker = complete_markers[i].marker;
		message = complete_markers[i].message;
		
		addComplexListener(map, marker, message, event_name, pile, span_from, input_from, span_to, input_to, end_step, step_2);
	}
}

function createRoute(map, origin, destination, waypoints, departure, strokeColor) {
	if(typeof(waypoints)==='undefined') waypoints = [];
	if(typeof(departure)==='undefined') departure = '';
	if(typeof(strokeColor)==='undefined') strokeColor = "blue";//google.maps.G_DEFAULT_STROKE_COLOR;
	
	var directionsService = new google.maps.DirectionsService();
	
	var directionsRendererOptions = {
		map: map,
		polylineOptions: {strokeColor: strokeColor, strokeOpacity: 0.5}
	};
    var directionsDisplay = new google.maps.DirectionsRenderer(directionsRendererOptions);
	
	var request = {
		origin: origin, 
		destination: destination,
		waypoints: waypoints,
		optimizeWaypoints: true,
		travelMode: google.maps.DirectionsTravelMode.DRIVING,
		unitSystem: google.maps.UnitSystem.METRIC
    };
	
	var infowindow = new google.maps.InfoWindow({
		position: new google.maps.LatLng((origin.lat()+destination.lat())/2.0, (origin.lng()+destination.lng())/2.0),
		content: 'Trajet de '+origin.toString()+' à '+destination.toString()
	});
	
	
	directionsService.route(request, function(response, status) {
		if (status == google.maps.DirectionsStatus.OK) {
			//alert(response.routes[0].legs[0].distance.text);
			//alert(response.routes[0].legs[0].duration.text);
			directionsDisplay.setDirections(response);
			
			//Events
			var path = response.routes[0].overview_path;
			var eventLine = new google.maps.Polyline({
				path: path,
				visible: true,
				strokeOpacity: 0,
				zIndex: 1000
			}); 
			eventLine.setMap(map);
			
			var polylineOptionsMouseOver = {strokeColor: strokeColor, strokeOpacity: 1};
			google.maps.event.addListener(eventLine, 'click', function(event) {
				directionsDisplay.setOptions({
					'polylineOptions': polylineOptionsMouseOver, 
					'preserveViewport': true
				});
				directionsDisplay.setMap(map);
				infowindow.open(map);
			});
			
			var polylineOptions = {strokeColor: strokeColor, strokeOpacity: 0.5};
			google.maps.event.addListener(infowindow, 'closeclick', function(event) {
				directionsDisplay.setOptions({
					'polylineOptions': polylineOptions,
					'preserveViewport': true
				});
				directionsDisplay.setMap(map);
			});
		} else {
			alert('Erreur');
		}
    });
	
	/*var directionsRendererOptionsHover = {
		map: map,
		polylineOptions: {strokeColor: strokeColor, strokeOpacity: 1}
	};
	google.maps.event.addListener(directionsDisplay, "mouseover", function() { 
		alert("hi");
		directionsDisplay.setOptions(directionsRendererOptionsHover);
	});
	google.maps.event.addListener(directionsDisplay, "mouseout", function() { 
		directionsDisplay.setOptions(directionsRendererOptions);
	});*/
	
	return directionsDisplay;
}