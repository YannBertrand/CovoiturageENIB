<?php include_once('header.php'); ?>

<div id="content">
	<?php include_once('menu_not_connected.php'); ?>
	<?php include_once('view/includes/menu.php'); ?>
	
	<div id="middle">
		<div class="post">
			<div class="postheader"><h1>Liste des trajets à venir</h1></div>
			<div class="postcontent">
				<div id="map" style="width: 90%; height: 250px; border: 1px solid grey; margin: auto;"></div>
				<script>
					var markers = [];
					
					var enib_position = new google.maps.LatLng(48.3603502, -4.5656347);
					var map = createMap("map", enib_position, 9, true, true, true, false);
					
					var enib_marker = createMarker(enib_position, map, "ENIB", true, "/covoiturage-yann/view/includes/images/university.png");
					markers.push(enib_marker);
					
					
					<?php foreach($trips as $trip) { ?>
						createRoute(map, 
									new google.maps.LatLng(<?php echo $trip['origin']; ?>), 
									new google.maps.LatLng(<?php echo $trip['destination']; ?>),
									[<?php foreach($trip['waypoints'] as $waypoint) { 
										if($waypoint == $trip['waypoints'][0]) 
											echo '{location:new google.maps.LatLng('.$waypoint.'), stopover:false}';
										else 
											echo ', {location:new google.maps.LatLng('.$waypoint.'), stopover:false}';
									} ?>],
									<?php echo $trip['departure']; ?>,
									'<?php echo $trip['color']; ?>');
					<?php } ?>
					
					updateBounds(map, markers);
				</script>
			</div>
			<div class="postfooter"></div>
		</div>
	</div>
</div>

<?php include_once('view/includes/footer.php'); ?>