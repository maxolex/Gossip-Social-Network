<?php
session_start();
require("config/db.php");
require("includes/functions.php");
require("includes/init.php");
include('filters/auth_filter.php');

if(!empty($_GET['id'])){

	 $q = $db->prepare('SELECT pseudo FROM microposts WHERE id = :id');
	 $q->execute(array(
	 'id' => $_GET['id']
	 ));

 	$data = $q->fetch(PDO::FETCH_OBJ);
 	$pseudo = $data->pseudo;

 if($pseudo == get_session('pseudo')){

	 $q = $db->prepare('DELETE FROM microposts WHERE id = :id');
	 $q->execute(array(
	 'id' => $_GET['id']
	 ));

 	set_flash("Votre publication a été supprimée avec succès!"); 
 }

 }
 	redirect('profile.php?id='.get_session('pseudo'));
?>