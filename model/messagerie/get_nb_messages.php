<?php

function get_nb_messages($pseudo)
{
	global $DB;
	$req = $DB->prepare('SELECT id FROM messagerie WHERE receiver = :receiver OR sender = :sender');
	$donnees = $req->execute(array('receiver' => $pseudo, 'sender' => $pseudo));
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
