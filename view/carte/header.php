<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="<?php echo $LOCAL_DIR; ?>/view/includes/css/global.css" rel="stylesheet" type="text/css" />
	<link href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet" />
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBobI40tpOrX8BeY1HtGMvVRbq1Rjty58Y&sensor=false&libraries=places"></script>
	<script src="<?php echo $LOCAL_DIR; ?>/view/includes/map.js"></script>
	<style>
		/* css for timepicker */
		.ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
		.ui-timepicker-div dl { text-align: left; }
		.ui-timepicker-div dl dt { height: 25px; margin-bottom: -25px; }
		.ui-timepicker-div dl dd { margin: 0 10px 10px 65px; }
		.ui-timepicker-div td { font-size: 90%; }
		.ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }

		.ui-timepicker-rtl{ direction: rtl; }
		.ui-timepicker-rtl dl { text-align: right; }
		.ui-timepicker-rtl dl dd { margin: 0 65px 10px 10px; }
	</style>
	<title>EN'Route</title>
</head>

<body>
<div id="container">
	<div id="header">
		<ul>
			<li><a href="<?php echo $LOCAL_DIR; ?>/">Accueil</a></li>
			<?php if(isset($_SESSION['pseudo'])) { ?>
				<li><a href="<?php echo $LOCAL_DIR; ?>/profil/">Profil</a></li>
				<li><a href="<?php echo $LOCAL_DIR; ?>/messagerie/">Messagerie</a></li>
			<?php }
			else { ?>
				<li><a href="<?php echo $LOCAL_DIR; ?>/informations/">Informations</a></li>
				<li><a href="<?php echo $LOCAL_DIR; ?>/inscription/">Inscription</a></li>
			<?php } ?>
			<li class="last"><a href="<?php echo $LOCAL_DIR; ?>/carte/">Carte</a></li>
		</ul>
	</div>
