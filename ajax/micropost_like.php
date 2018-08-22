<?php 
	session_start();
	require '../config/db.php';
	require '../includes/functions.php';
	extract($_POST);
	if($action == "like"){

		if(!user_has_already_liked_the_micropost($micropost_id))
		{

		 $q = $db->prepare("INSERT INTO micropost_like(user_id,micropost_id) VALUES(:user_id,:micropost_id)");
		 $q->execute(array(

		 'user_id' => get_session('user_id'),
		 'micropost_id' => $micropost_id

		 ));

		 $q = $db->prepare("UPDATE microposts SET like_count = like_count + 1 WHERE id = :micropost_id");
		 $q->execute(array(

		 'micropost_id' => $micropost_id

		 ));

	 }

	}else{

		if(user_has_already_liked_the_micropost($micropost_id))
		{

		 $q = $db->prepare("DELETE FROM micropost_like WHERE user_id = :user_id AND micropost_id = :micropost_id");
		 $q->execute(array(

		 'user_id' => get_session('user_id'),
		 'micropost_id' => $micropost_id

		 ));

		 $q = $db->prepare("UPDATE microposts SET like_count = like_count - 1 WHERE id = :micropost_id");
		 $q->execute(array(

		 'micropost_id' => $micropost_id

		 ));

	 }

	}

		echo get_likers_text($micropost_id);
 ?>