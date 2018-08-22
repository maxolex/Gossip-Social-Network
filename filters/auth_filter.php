<?php


if(!isset($_SESSION['user_id']) && !isset($_SESSION['pseudo'])){

	$_SESSION['forwarding_url'] = $_SERVER['REQUEST_URI'];
	set_flash('Vous devez être connecter pour acceder à cette page!','danger');
	header('Location: login.php');
	exit();
}

?>