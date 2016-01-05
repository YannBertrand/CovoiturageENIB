<?php

include_once("model/user/disconnect_user.php");
disconnect_user();
header('Location: '.$_SERVER['HTTP_REFERER']);