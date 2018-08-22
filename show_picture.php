<?php

session_start();
require('config/db.php');
require('includes/functions.php');
include('filters/auth_filter.php');
require("bootstrap/locale.php");

$q = $db->prepare("SELECT pseudo,email FROM users WHERE id=:user_id");
		$q->execute(array(

				'user_id' => get_session('user_id')

			));

		$users = $q->fetchAll(PDO::FETCH_OBJ);



		if (isset($_POST['img'])) {

			extract($_POST);

		$img = $_FILES['img']['name'];
		$img_tmp = $_FILES['img']['tmp_name'];
		foreach ($users as $user) {
			$pseudo = $user->pseudo;
		}

		if (!empty($img_tmp)) {
			
			$image = explode('.', $img);
			$image_ext = end($image);
			if (in_array(strtolower($image_ext), array('png','jpg','jpeg','bmp','gif'))===false) {

				$errors[] = "Veillez rentrer SVP une image valide ";
				
			}else{

				$image_size = getimagesize($img_tmp);
				if ($image_size['mime'] == 'image/jpeg') {

					$image_src = imagecreatefromjpeg($img_tmp);

				}else if ($image_size['mime'] == 'image/png') {
					
					$image_src = imagecreatefrompng($img_tmp);
				}else if ($image_size['mime'] == 'image/x-ms-bmp') {
					
					$image_src = imagecreatefrombmp($img_tmp);

				}else if ($image_size['mime'] == 'image/gif') {
					
					$image_src = imagecreatefromgif($img_tmp);
				}else{

					$img_src = false;
					$errors[] = "Veillez rentrer SVP une image valide ";
				}
				if ($image_src != false) {
					
					$image_width = $image_size[0];
					if ($image_size[0]== $image_width) {
						
						$image_finale = $image_src;
					}else{

						$new_width[0] = $image_width;
						$new_height[1] = $image_size[1];
						$image_finale = imagecreatetruecolor($new_width[0], $new_height[1]);
						imagecopyresampled($image_finale, $image_src, 0, 0, 0, 0, $new_width[0], $new_height[1], $image_size[0], $image_size[1]);
					}
					imagejpeg($image_finale,'imgs/'.$pseudo.'.jpg');
				}
			}
			
			$q = $db->prepare("UPDATE users SET change_picture = '1' WHERE id = :user_id");
			$q->execute(array(

				'user_id' => get_session('user_id')

			));

			set_flash("Votre profil a été changé avec succes!");
			redirect("show_picture.php");
		}else{

			set_flash("Veillez rentrer SVP une image");
		}
		}

?>


<?php require("views/show_picture.view.php"); ?>