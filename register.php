<?php
session_start();
include('filters/guest_filter.php');
require('config/db.php');
require('includes/functions.php');
require("bootstrap/locale.php");


if (isset($_POST['register'])) {

	if (not_empty(array('name', 'pseudo', 'email', 'password', 'password_confirm'))) {
		


		$errors = array();

		extract($_POST);


		if (strlen($pseudo) < 3) {
			
			$errors[] = "Pseudo trop court! (Minimum 3 caractères)";
		}

		if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
			$errors[] = "Adresse E-mail Invalide";
		}

		if (strlen($password) < 6) {
			
			$errors[] = "Mot de passe trop court! (Minimum 6 caractères)";
		}else{

			if ($password != $password_confirm) {
				
				$errors[] = "Les deux mots de passe ne concordent pas!";
			}
		}


		if (is_already_in_use('pseudo', $pseudo, 'users')) {
			
			$errors[] = "Pseudo déjà utilisé!";
		}

		if (is_already_in_use('email', $email, 'users')) {
			
			$errors[] = "Adresse E-mail déjà utilisé!";
		}



		if (count($errors) == 0) {

			$to = $email;
			$subject = WEBSITE_NAME. " - ACTIVATION DE COMPTE";	
			$password = sha1($password);
			$token = sha1($pseudo.$email.$password);

			ob_start();

			require('template/emails/activation.tmpl.php');
			$content = ob_get_clean();

			$headers = 'MIME-Version: 1.0' . "\r\n";
			$headers = 'Content-type: text/html; charset=iso-8859-1'. "\r\n";

			mail($to, $subject, $content, $headers);


			set_flash("Mail d'activation envoyé!", 'success');

				$q = $db->prepare('INSERT INTO users (name,pseudo,email,password,active,created_at)
									     VALUES(:name,:pseudo,:email,:password,DEFAULT,now())');
				$q->execute(array(

						'name' => $name,
						'pseudo' => $pseudo,
						'email' => $email,
						'password' => $password


					));
				$id = $db->lastInsertId();
				$q = $db->prepare("INSERT INTO friends_relationships(user_id1, user_id2, status) VALUES(?, ?, ?)");
				$q->execute(array($id, $id, '2'));

			redirect('index.php');
		}else{

			save_input_data();
		}

	}else{
		$errors[] = "Veillez remplir SVP tous les champs";
		save_input_data();

	}
}else{

	clear_input_data();
}

?>


<?php

require("views/register.view.php");

?>