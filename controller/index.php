<?php
include_once('model/news/get_news.php');
include_once('model/news/get_nb_news.php');
$max = 5;

if (array_key_exists('goto', $_GET)) {
	if ($_GET['goto'] < 1) {
		$pageact = 1;
	}
	else { 
		$pageact = $_GET['goto'];
	}
}
else {
	$pageact = 1;
}

$news = get_news($pageact, $max);
$nb_total = get_nb_news();

include('view/index.php'); 

