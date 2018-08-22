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
	
	$q = $db->prepare("UPDATE friends_relationships set status='1'
	 WHERE (user_id1 = :user_id1 AND user_id2 = :user_id2)
		OR (user_id1 = :user_id2 AND user_id2 = :user_id1)");
	$q->execute(array(

		'user_id1' => get_session('user_id'),
		'user_id2' => $id['id'],

		));

	$q = $db->prepare('INSERT INTO notifications(subject_id, name, user_id) VALUES(:subject_id, :name, :user_id)');
	$q->execute(array(

	'subject_id' => $id['id'],
	'name' => 'friend_request_accepted',
	'user_id' => get_session('user_id'),

	));

	set_flash("Vous êtes à présent ami avec cet utilisateur!");
	redirect("profile.php?pseudo=".$_GET['pseudo']);
}else{

	redirect("profile.php?pseudo=".get_session('pseudo'));
}