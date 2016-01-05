<?php include_once('view/carte/header.php'); ?>
<?php date_default_timezone_set('Europe/Paris'); ?>

<div id="content">
	<?php include_once('view/carte/menu.php'); ?>
	<?php include_once('view/includes/menu.php'); ?>
	
	<div id="middle">
		<div class="post">
			<div class="postheader"><h1>Ajouter un trajet</h1></div>
			<div class="postcontent">
				<?php if($show_map) { ?>
					<form action="" method="post">
						<?php if(isset($_SESSION['sending_errors']) and $_SESSION['sending_errors'] != null) { ?>
							<div>
								<p style="color: #ff0000">
								<?php foreach($_SESSION['sending_errors'] as $error) { echo $error.'<br />'; } ?>
								</p>
							</div>
						<?php } $_SESSION['sending_errors']=''; ?>
					
						<input type="hidden" name="sent" value="1" />
						
						<p id="step_1">Je fais le trajet de <span id="from">...</span> à <span id="to">...</span><span id="end_step_1" style="display: none;">...<span></p>
							<div id="map" style="width: 90%; height: 250px; border: 1px solid grey; margin: auto;"></div>
							<input type="hidden" id="hidden_from" name="hidden_from" value="" /><input type="hidden" id="hidden_to" name="hidden_to" value="" />
						</p>
						
						<p id="step_2" style="display: none;">
							...<label for="common" onClick="showHide('step_3', 'end_step_2', 'step_4');"><input type="radio" name="type" value="common" id="common" /> fréquent</label>, 
							<label for="occasional" onClick="showHide('step_4', 'end_step_2', 'step_3');"><input type="radio" name="type" value="occasional" id="occasional" /> occasionnel</label><span id="end_step_2" style="display: none;">...<span>
						</p>
						
						<p id="step_3" style="display: none;">
							...tou(te)s les 
							<select name="frequency" id="frequency" onChange="showHide('step_4', 'end_step_3')">
								<option value="" selected></option>
								<option value="daily">jours</option>
								<option value="weekly">semaines</option>
								<option value="bimonthly">deux semaines</option>
								<option value="monthly">mois</option>
							</select>
							<span id="end_step_3" style="display: none;">...<span>
						</p>
						
						<div id="step_4" style="display: none;">
							<p>...le ou à partir du : </p>
							<div id="step_4_date" style="margin-top: -30px; margin-left: 140px;"></div>
							<input type="hidden" id="hidden_date" name="hidden_date" value="<?php echo date('Y-m-d 00:00:00'); ?>"  />
							
							<p>J'ai
								<select name="places_nb" id="places_nb">
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5" selected>5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option>
								</select>
							places dans ma voiture. (moi y-compris)</p>
							
							<p><input type="submit" value="Valider" onclick="valider()" /></p>
						</div>
						
					</form>
					<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
					<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
					<script src="<?php echo $LOCAL_DIR; ?>/view/includes/datetimepicker.js"></script>

					<script>
						//Variable
						var choiceFrequency = null;
						
						/* PREMIERE ETAPE */
						var markers = []; var complete_markers = [];
						
						var enib_position = new google.maps.LatLng(48.3603502, -4.5656347);
						var map = createMap("map", enib_position, 9, true, true, true, false);
						
						var enib_marker = createMarker(enib_position, map, "ENIB", true, "<?php echo $LOCAL_DIR; ?>/view/includes/images/university.png");
						markers.push(enib_marker);
						complete_markers.push({"marker": enib_marker, "message": "l'ENIB"});
						
						<?php if($show_enib_home_marker) { ?>
							var enib_home_position = new google.maps.LatLng(<?php echo $user['enib_home_hidden_adress']; ?>);
							var enib_home_marker = createMarker(enib_home_position, map, "Appartement", true, "<?php echo $LOCAL_DIR; ?>/view/includes/images/apartment.png", 1);
							markers.push(enib_home_marker);
							complete_markers.push({"marker": enib_home_marker, "message": "mon appart'"});
						<?php } ?>
						<?php if($show_home_marker) {  ?>
							var home_position = new google.maps.LatLng(<?php echo $user['home_hidden_adress']; ?>);
							var home_marker = createMarker(home_position, map, "ma maison", true, "<?php echo $LOCAL_DIR; ?>/view/includes/images/home.png", 1);
							markers.push(home_marker);
							complete_markers.push({"marker": home_marker, "message": "la maison"});
						<?php } ?>
						
						updateBounds(map, markers);
						updateFromTo(map, complete_markers, "click");
						
						/* SECONDE ETAPE */
						function showHide(id_to_show, id_to_show_inline, id_to_hide) {
							if(id_to_show instanceof Array) {
								for(var i=0; i<id_to_show.length; i++) show(document.getElementById(id_to_show[i])); 
							}
							else { show(document.getElementById(id_to_show)); }
							
							if(id_to_show_inline instanceof Array) {
								for(var i=0; i<id_to_show_inline.length; i++) show(document.getElementById(id_to_show_inline[i]), 'inline'); 
							}
							else { show(document.getElementById(id_to_show_inline), 'inline'); }
							
							if(id_to_hide instanceof Array) {
								for(var i=0; i<id_to_hide.length; i++) hide(document.getElementById(id_to_hide[i])); 
							}
							else hide(document.getElementById(id_to_hide));
						}
						
						/* QUATRIEME ETAPE */
						$(function() {
							$.datepicker.regional['fr'] = {clearText: 'Effacer', clearStatus: '', closeText: '', closeStatus: 'Fermer sans modifier', prevText: '<Préc', prevStatus: 'Voir le mois précédent',nextText: 'Suiv>', nextStatus: 'Voir le mois suivant',currentText: 'Courant', currentStatus: 'Voir le mois courant',monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'],monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun','Jul','Aoû','Sep','Oct','Nov','Déc'],monthStatus: 'Voir un autre mois', yearStatus: 'Voir un autre année',weekHeader: 'Sm', weekStatus: '',dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],dayStatus: 'Utiliser DD comme premier jour de la semaine', dateStatus: 'Choisir le DD, MM d',dateFormat: 'yyyy-MM-dd', firstDay: 0, initStatus: 'Choisir la date', isRTL: false};
							$.datepicker.setDefaults($.datepicker.regional['fr']);
							//$.timepicker.regional['fr'] = {clearText: 'Effacer', timeFormat: 'HH:mm:00', showTimezone: false, clearStatus: '', closeText: '', closeStatus: 'Fermer sans modifier', prevText: '<Préc', prevStatus: 'Voir le mois précédent',nextText: 'Suiv>', nextStatus: 'Voir le mois suivant',currentText: 'Mtn', currentStatus: 'Voir le mois courant',monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'],monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun','Jul','Aoû','Sep','Oct','Nov','Déc'],monthStatus: 'Voir un autre mois', yearStatus: 'Voir un autre année',weekHeader: 'Sm', weekStatus: '',dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],dayStatus: 'Utiliser DD comme premier jour de la semaine', dateStatus: 'Choisir le DD, MM d',dateFormat: 'yy-mm-dd', firstDay: 0, initStatus: 'Choisir la date', isRTL: false};
							//$.timepicker.setDefaults($.timepicker.regional['fr']);
							$('#step_4_date').datetimepicker({
								showButtonPanel: false,
								timeText: "à",
								hourText: "Heure",
								hourMin: 0,
								hourMax: 23,
								minDate: 0, 
								showWeek: true,
								firstDay: 1,
								showTimezone: false,
								altField: '#hidden_date',
								altFieldTimeOnly: false,
								altFormat: 'yy-mm-dd',
								altTimeFormat: "HH:mm:00",
								altSeparator: " "
							});
						});
						
						function showID(id_to_show, id_to_show_inline){
							if(id_to_show instanceof Array) {
								for(var i=0; i<id_to_show.length; i++) show(document.getElementById(id_to_show[i])); 
							}
							else { show(document.getElementById(id_to_show)); }
							
							if(id_to_show_inline instanceof Array) {
								for(var i=0; i<id_to_show_inline.length; i++) show(document.getElementById(id_to_show_inline[i]), 'inline'); 
							}
							else { show(document.getElementById(id_to_show_inline), 'inline'); }
						}		
						
						// Validation
						function valider() {
							document.getElementById('hidden_from').value=(complete_markers[0]).getPosition();
							document.getElementById('hidden_to').value=(complete_markers[1]).getPosition();
						}
					</script>
				<?php } else { ?><p>Veuillez entrez vos adresses dans le profil.</p><?php } ?>
			</div>
			<div class="postfooter"></div>
		</div>
	</div>
</div>

<?php include_once('view/includes/footer.php'); ?>