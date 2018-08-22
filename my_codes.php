<?php
session_start();
require("config/db.php");
require("includes/functions.php");
include('filters/auth_filter.php');
require("bootstrap/locale.php");


$q = $db->prepare("SELECT id,code FROM codes WHERE user_id = :id ORDER BY id ");
$q->execute(array(

	'id' => get_session('user_id')

	));
$codes = $q->fetchAll(PDO::FETCH_OBJ);



require("views/my_codes.view.php");


?>