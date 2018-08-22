<?php

session_start();
include('filters/guest_filter.php');
require('config/db.php');
require('includes/functions.php');
require("bootstrap/locale.php");


if (isset($_POST['login'])) {

	if (not_empty(array('identifiant', 'password'))) {
		
		extract($_POST);

		$q = $db->prepare("SELECT id,pseudo FROM users 
							WHERE (pseudo = :identifiant OR email = :identifiant) 
							AND password = :password  
							AND  active = '1' ");

		$q->execute(array(

		'identifiant' => $identifiant,
		'password' => sha1($password)

		));

		$userHasBeenFound = $q->rowcount();

		if ($userHasBeenFound) {

			$user = $q->fetch(PDO::FETCH_OBJ);

			$_SESSION['user_id'] = $user->id;
			$_SESSION['pseudo'] = $user->pseudo;


			redirect_intent_or('profile.php');
		}else{


				set_flash('Identifiant ou Mot de passe Incorrect!','danger');

			save_input_data();
		}
	}

}else{

	clear_input_data();
}


?>


<?php require("views/login.view.php"); ?>