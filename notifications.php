<?php

session_start();
require("config/db.php");
require("includes/functions.php");
require("includes/init.php");
include('filters/auth_filter.php');
require("bootstrap/locale.php");


$q = $db->prepare("SELECT notifications.id FROM notifications 
	LEFT JOIN users ON users.id = user_id WHERE subject_id = ?");

$q->execute(array(get_session('user_id')));

$notifications_total = $q->rowCount();

if($notifications_total >= 1){

$nbre_notifications_par_page = 10;
$nbre_pages_max_gauche_et_droite = 4;
$last_page = ceil($notifications_total / $nbre_notifications_par_page);

if(isset($_GET['page']) && is_numeric($_GET['page'])){

$page_num = $_GET['page'];

} else {

$page_num = 1;

}
if($page_num < 1){

$page_num = 1;

} else if($page_num > $last_page) {

$page_num = $last_page;

}

$limit = 'LIMIT '.($page_num - 1) * $nbre_notifications_par_page. ',' . $nbre_notifications_par_page;

$q = $db->prepare("SELECT users.pseudo, users.email,notifications.subject_id, notifications.name,notifications.user_id, notifications.seen,notifications.created_at
FROM notifications
LEFT JOIN users ON users.id = user_id
WHERE subject_id = ?
ORDER BY notifications.created_at DESC $limit");

$q->execute(array(get_session('user_id')));

$notifications = $q->fetchAll(PDO::FETCH_OBJ);

$pagination = '<nav class="text-center"><ul>';

if($last_page != 1){

if($page_num > 1){

$previous = $page_num - 1;
$pagination .= '<li><a href="notifications.php?page='.$previous.'">'.$long_text['pagination_precedent'][get_current_locale()].'</a></li>';
for($i = $page_num - $nbre_pages_max_gauche_et_droite; $i < $page_num; $i++){

	if($i > 0){

	$pagination .= '<li><a href="notifications.php?page='.$i.'">'.$i.'</a></li>';

	}
}
}

$pagination .= '<li class="active"><a href="#">'.$page_num.'</a></li>';

for($i = $page_num+1; $i <= $last_page; $i++){

$pagination .= '<li><a href="notifications.php?page='.$i.'">'.$i.'</a></li>';
if($i >= $page_num + $nbre_pages_max_gauche_et_droite){

break;

}

}
if($page_num != $last_page){

$next = $page_num + 1;

$pagination .= '<li><a href="notifications.php?page='.$next.'">'.$long_text['pagination_suivant'][get_current_locale()].'</a></li>';
}

}
$pagination .= '</ul></nav>';

require("views/notifications.view.php");

} else {

set_flash('Aucune notification disponible pour le moment...');

redirect('profile.php');

}

$q = $db->prepare("UPDATE notifications SET seen = '1' WHERE subject_id = ?");
$q->execute(array(get_session('user_id')));	

?>
