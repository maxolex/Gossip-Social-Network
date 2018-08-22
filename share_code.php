<?php

session_start();
require('includes/functions.php');
include('filters/auth_filter.php');
require('config/db.php');
require("bootstrap/locale.php");


if (!empty($_GET['id'])) {
	$q = $db->prepare('SELECT code FROM codes WHERE id=? ');
	$success = $q->execute(array( $_GET['id']));


		$data = $q->fetch(PDO::FETCH_OBJ);

		if (!$data) {
			
			$code = "";

		}else{

			$code = $data->code;
		}
		
}else{

	$code = "";
}



if (isset($_POST['save'])) {

	if (not_empty(array('code'))) {

		extract($_POST);
		$q = $db->prepare('INSERT INTO codes(code,user_id)  VALUES(?,?)');
		$success = $q->execute(array($code,get_session('user_id')));

		if ($success) {

			$id = $db->lastInsertId();

			redirect('show_code.php?id='.$id);
			

		}else{

			set_flash("Erreur lors de la sauvegarde du code source, Veuillez Reésayez SVP.");
			redirect('share_code.php');
		}

		

	}else{

		redirect('share_code.php');
	}


}


?>


<?php require("views/share_code.view.php"); ?>