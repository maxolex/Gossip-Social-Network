<?php
session_start();
require("config/db.php");
require("includes/functions.php");
include('filters/auth_filter.php');
require("bootstrap/locale.php");

if (!empty($_GET['pseudo'])) {

	$user = find_user_by_pseudo($_GET['pseudo']);
	

	if (!$user) {
		
		redirect('index.php');
	}else{

		$q = $db->query("SELECT id FROM users WHERE pseudo = '{$_GET['pseudo']}' ");
		$q->execute();
		$id1 = $q->fetch();

		$q = $db->prepare("SELECT U.pseudo, U.email, M.pseudo, M.like_count, M.id as m_id, M.content, M.created_at
		FROM users as U, microposts as M, friends_relationships as F
		WHERE M.pseudo = U.pseudo
		AND
			CASE
				WHEN F.user_id1 = :user_id
				THEN F.user_id2 = U.id

				WHEN F.user_id2 = :user_id
				THEN F.user_id1 = U.id
			END
		AND F.status > 0
		ORDER BY M.created_at DESC");
		$q->execute(array(

				'user_id' => $id1['id']

			));

		$microposts = $q->fetchAll(PDO::FETCH_OBJ);

	}
	

}else{

	redirect('profile.php?pseudo='.get_session('pseudo'));

}


require("views/profile.view.php");







?>