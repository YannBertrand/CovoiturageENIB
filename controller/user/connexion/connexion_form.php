<?php

if(isset($_SESSION['pseudo'])) { include_once('view/user/connexion/user_connected.php'); }
else { include_once('view/user/connexion/user_not_connected.php'); }