<?php


function get_nb_news()
{
	global $DB;
	$req = $DB->prepare('SELECT id FROM news');
	$donnees = $req->execute();
	$nb =0;
	if ($donnees = $req->fetch()) {
		do
		{
			$nb ++;
		}	
	while ($donnees = $req->fetch());
	}
	else
	{	$nb = 0;
	}
	return $nb;
}
