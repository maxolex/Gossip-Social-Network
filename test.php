<?php
			include("includes/constants.php");

			$email = "";
			$password = "";
			$pseudo = "";


			$to = $email;
			$subject = WEBSITE_NAME. " - ACTIVATION DE COMPTE";	
			$password = sha1($password);
			$token = sha1($pseudo.$email.$password);

			ob_start();

			require('template/emails/activation.tmpl.php');
			$content = ob_get_clean();

			$headers = 'MIME-Version: 1.0' . "\r\n";
			$headers = 'Content-type: text/html; charset=iso-8859-1'. "\r\n";


			echo $to .'<br>';
			echo $subject.'<br>';
			echo $content;
		




		/*$img = $_FILES['img']['name'];
		$img_tmp = $_FILES['img']['tmp_name'];

		if (!empty($img_tmp)) {
			
			$image = explode('.', $img);
			$image_ext = end($image);
			if (in_array(strtolower($image_ext), array('png','jpg','jpeg','gif'))===false) {

				$errors[] = "Veillez rentrer SVP une image valide ";
				
			}else{

				$image_size = getimagesize($img_tmp);
				if ($image_size['mime'] == 'image/jpeg') {

					$image_src = imagecreatefromjpeg($img_tmp);

				}else if ($image_size['mime'] == 'image/png') {
					
					$image_src = imagecreatefrompng($img_tmp);
				}else if ($image_size['mime'] == 'image/gif') {
					
					$image_src = imagecreatefromgif($img_tmp);
				}else{

					$img_src = false;
					$errors[] = "Veillez rentrer SVP une image valide ";
				}
				if ($image_src != false) {
					
					$image_width = 100;
					if ($image_size[0]== $image_width) {
						
						$image_finale = $image_src;
					}else{

						$new_width[0] = $image_width;
						$new_height[1] = 100;
						$image_finale = imagecreatetruecolor($new_width[0], $new_height[1]);
						imagecopyresampled($image_finale, $image_src, 0, 0, 0, 0, $new_width[0], $new_height[1], $image_size[0], $image_size[1]);
					}
					imagejpeg($image_finale,'imgs/'.$nom.'.jpg');
				}
			}
		}*/