<?php

session_start();
require('includes/constants.php');
require('includes/functions.php');
include('filters/auth_filter.php');
require('config/db.php');
require("bootstrap/locale.php");

if (isset($_POST['publish'])) {
	
	if (!empty($_POST['content'])) {
		
		extract($_POST);
		$q = $db->prepare('INSERT INTO microposts(content,pseudo) VALUES(:content, :pseudo)');
		$q->execute(array(
				'content' => $content,
				'pseudo' => get_session('pseudo')

			));

		set_flash('Votre statut a été mis à jour!');
		redirect('profile.php?pseudo='.get_session('pseudo'));
	}else{

		redirect('profile.php');
		set_flash("Aucun contenu n'a été fourni!","danger");
	}
}

?>

