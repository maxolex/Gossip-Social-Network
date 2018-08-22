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
			redirect('share_code.php');

		}
		
}else{

	redirect('share_code.php');
}



?>


<?php require("views/show_code.view.php"); ?>