<?php
session_start();

require("includes/functions.php");
include('filters/auth_filter.php');
require("config/db.php");
require("bootstrap/locale.php");

if (isset($_POST['change_password'])) {

	$errors = array();

	extract($_POST);

	if (not_empty(array('current_password', 'new_password', 'new_password_confirmation'))) {

		if (strlen($new_password) < 6) {
			
			$errors[] = "Mot de passe trop court! (Minimum 6 caractères)";
		}else{

			if ($new_password != $new_password_confirmation) {
				
				$errors[] = "Les deux mots de passe ne concordent pas!";
			}
		}


		if (count($errors) == 0) {

			$q = $db->prepare("SELECT password FROM users WHERE id = :id");

			$q->execute(array(

			'id' => get_session('user_id')

			));

			$user = $q->fetch(PDO::FETCH_OBJ);

			if ($user && sha1($current_password) === $user->password) {
				
				$q = $db->prepare("UPDATE users SET password = :password WHERE id = :id ");

		$q->execute(array(

		'password' => sha1($new_password),
		'id' => get_session('user_id')
		
		));

				set_flash("Félicitations, votre Mot de passe a été mis à jour!");
				redirect("profile.php?pseudo=".get_session('pseudo'));
			}else{

				$errors[] = "Le mot de passe actuel indiqué est incorrect.";
				save_input_data();
			}
				
			}else{

				save_input_data();
			}

	}else{

		$errors[] = "Veillez remplir tous les champs marqués d'un (*)";
		save_input_data();
	}



}else{

	clear_input_data();
}



require("views/change_password.view.php");


?>