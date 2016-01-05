<?php

function connect_user($pseudo) {
	$_SESSION['pseudo']=$pseudo;
	
	include_once('model/user/update_last_activity.php');
	update_last_activity($pseudo);
	include_once('model/user/update_last_ip.php');
	update_last_ip($pseudo);
}