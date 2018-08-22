<?php 

$q = $db->prepare("SELECT id FROM notifications WHERE subject_id = ? AND seen = '0'");
$q->execute(array(get_session('user_id')));
$notifications_count = $q->rowCount();





 ?>