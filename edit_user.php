<?php
session_start();
require("includes/functions.php");
include('filters/auth_filter.php');
require("config/db.php");
require("bootstrap/locale.php");

if (!empty($_GET['pseudo'])  && $_GET['pseudo'] === get_session('pseudo')) {

	$user = find_user_by_pseudo($_GET['pseudo']);
	

	if (!$user) {
		
		redirect('index.php');
	}
	

}else{

	redirect('edit_user.php?pseudo='.get_session('pseudo'));

}

if (isset($_POST['update'])) {

	$errors = array();

	if (not_empty(array('first_name', 'city', 'country', 'sex', 'facebook', 'bio'))) {
		
		extract($_POST);

		$q = $db->prepare("UPDATE users SET first_name = :first_name, city = :city, country = :country, sex = :sex, facebook = :facebook, twitter = :twitter, available_for_hiring = :available_for_hiring, bio = :bio WHERE id = :id ");

		$q->execute(array(

		'first_name' => $first_name,
		'city' => $city,
		'country' => $country,
		'sex' => $sex,
		'facebook' => $facebook,
		'twitter' => $twitter,
		'available_for_hiring' => !empty($available_for_hiring) ? '1' : '0',
		'bio' => $bio,
		'id' => get_session('user_id'),
		

		));

		set_flash("Félicitations, votre profil a été mis à jour!");
		redirect("profile.php?pseudo=".get_session('pseudo'));

		}else{


			save_input_data();
			$errors[] = "Veuillez remplir tous les champs marqués d'un (*)";
		}

}else{

	clear_input_data();
}

require("views/edit_user.view.php");

?>