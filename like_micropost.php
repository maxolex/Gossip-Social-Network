<?php
session_start();
require("config/db.php");
require("includes/functions.php");
require("includes/init.php");
include('filters/auth_filter.php');

if(!empty($_GET['id'])){


	 if(!user_has_already_liked_the_micropost($_GET['id'])){

		 $q = $db->prepare("INSERT INTO micropost_like(user_id,micropost_id) VALUES(:user_id,:micropost_id)");
		 $q->execute(array(

		 'user_id' => get_session('user_id'),
		 'micropost_id' => $_GET['id']

		 ));

		 $q = $db->prepare("UPDATE microposts SET like_count = like_count + 1 WHERE id = :micropost_id");
		 $q->execute(array(

		 'micropost_id' => $_GET['id']

		 ));

	 }

 }
 	redirect('profile.php?id='.get_session('pseudo').'#micropost'.$_GET['id']);
?>