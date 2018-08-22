<?php
session_start();
require("includes/functions.php");
include('filters/auth_filter.php');
require("config/db.php");
require("bootstrap/locale.php");


if (!empty($_GET['pseudo']) && $_GET['pseudo'] !== get_session('pseudo')) {

	$q = $db->query("SELECT id FROM users WHERE pseudo = '{$_GET['pseudo']}' ");
	$q->execute();
	$id = $q->fetch();
	
	$q = $db->prepare('DELETE FROM friends_relationships 
		WHERE (user_id1 = :user_id1 AND user_id2 = :user_id2)
		OR (user_id1 = :user_id2 AND user_id2 = :user_id1)');
	$q->execute(array(

		'user_id1' => get_session('user_id'),
		'user_id2' => $id['id'],

		));

	set_flash("Vous n'êtes plus ami avec cet utilisateur!");
	redirect("profile.php?pseudo=".$_GET['pseudo']);
}else{

	redirect("profile.php?pseudo=".get_session('pseudo'));
}