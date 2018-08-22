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

	if(!if_a_friend_request_has_already_been_sent(get_session('user_id'),$id['id'])){

		$q = $db->prepare('INSERT INTO friends_relationships(user_id1,user_id2) VALUES(:user_id1,:user_id2)');
		$q->execute(array(

		'user_id1' => get_session('user_id'),
		'user_id2' => $id['id'],

		));

		$q = $db->prepare('INSERT INTO notifications(subject_id, name, user_id) VALUES(:subject_id, :name, :user_id)');
		$q->execute(array(

		'subject_id' => $id['id'],
		'name' => 'friend_request_sent',
		'user_id' => get_session('user_id'),

		));

	set_flash("Votre demande d'amité a été envoyée avec succès!");
	redirect("profile.php?pseudo=".$_GET['pseudo']);

	}else{

		set_flash("Cet utilisateur vous a déjà envoyé une demande d'amitié!");
		redirect("profile.php?pseudo=".$_GET['pseudo']);
	}
	
	
}else{

	redirect("profile.php?pseudo=".get_session('pseudo'));
}