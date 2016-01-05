<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="<?php echo $LOCAL_DIR; ?>/view/includes/css/global.css" rel="stylesheet" type="text/css" />
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
