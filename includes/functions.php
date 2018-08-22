<?php


if (!function_exists('e')) {
	

	function e($string){

		if ($string) {
			
			return htmlspecialchars($string);
		}
	}

}


if (!function_exists('check_if_the_current_user_has_liked_the_micropost')) {
	

	function check_if_the_current_user_has_liked_the_micropost($micropost_id){

		global $db;
		$q = $db->prepare("SELECT id FROM micropost_like WHERE user_id = ? AND micropost_id = ?");
		$q->execute(array(get_session('user_id'),$micropost_id));

		$count = $q->rowCount();
		$q->closeCursor();
		return (bool) $count;
		
	}

}


if (!function_exists('get_like_count')) {
	

	function get_like_count($micropost_id){

		global $db;
		$q = $db->prepare("SELECT like_count FROM microposts WHERE id = :id");
		$q->execute(array(

				'id' => $micropost_id

		));

		$data = $q->fetch(PDO::FETCH_OBJ);

		return intval($data->like_count);
	}

}


if (!function_exists('get_likers')) {
	

	function get_likers($micropost_id){

		global $db;
		$q = $db->prepare("SELECT users.id, users.pseudo FROM users 
							LEFT JOIN micropost_like ON users.id = micropost_like.user_id
							WHERE micropost_like.micropost_id = ?
							ORDER BY micropost_like.id DESC
							LIMIT 3");
		$q->execute(array($micropost_id));

		return $q->fetchAll(PDO::FETCH_OBJ);
	}

}

if (!function_exists('get_likers_text')) {
	

	function get_likers_text($micropost_id){

		$like_count = get_like_count($micropost_id);
		$likers = get_likers($micropost_id);


		$output = '';

		if($like_count > 0){

			$remaining_like_count = $like_count - 3;
			$it_self_like =  check_if_the_current_user_has_liked_the_micropost($micropost_id); 
			foreach ($likers as $liker) {
				if(get_session('user_id') != $liker->id){

					$output .= '<a href="profile.php?pseudo='.$liker->pseudo.'">'.$liker->pseudo.'<a/>, ';
				}
				
			}

			$output .= $it_self_like ? 'Vous, '.$output : $output;

			//$output .= 'et '. $remaining_like_count . ' autres personnes aiment';
		}
		

		return $output;
	}

}

if (!function_exists('user_has_already_liked_the_micropost')) {
	

	function user_has_already_liked_the_micropost($micropost_id){

		global $db;

		$q = $db->prepare("SELECT id FROM micropost_like 
	 					WHERE user_id = :user_id AND micropost_id = :micropost_id");
		 $q->execute(array(

		 'user_id' => get_session('user_id'),
		 'micropost_id' => $micropost_id

		 ));

		 return (bool) $q->rowCount();
	}

}

if (!function_exists('if_a_friend_request_has_already_been_sent')) {
	

	function if_a_friend_request_has_already_been_sent($id1,$id2){

		global $db;

		$q = $db->prepare("SELECT status FROM friends_relationships 
			WHERE (user_id1 = :user_id1 AND user_id2 = :user_id2)
			OR (user_id1 = :user_id2 AND user_id2 = :user_id1)");

		$q->execute(array(

				'user_id1' => $id1,
				'user_id2' => $id2 			
			));

		$count = $q->rowCount();

		$q->closeCursor();

		return (bool) $count;
	}

}


if (!function_exists('friends_count')) {
	

	function friends_count(){

		global $db;

		$q = $db->query("SELECT id FROM users WHERE pseudo = '{$_GET['pseudo']}' ");
		$q->execute();
		$id = $q->fetch();

		$q = $db->prepare("SELECT status FROM friends_relationships
			WHERE (user_id1 = :user OR user_id2 = :user)
			AND status = '1' ");
		$q->execute(array(

				'user' => $id['id']			
			));

		$count = $q->rowCount();

		$q->closeCursor();

		return $count;
	}

}


if (!function_exists('relation_link_to_display')) {
	

	function relation_link_to_display($pseudo){

		global $db;

		$q = $db->query("SELECT id FROM users WHERE pseudo = '{$pseudo}' ");
		$q->execute();
		$id = $q->fetch();

		$q = $db->prepare("SELECT user_id1,user_id2,status FROM friends_relationships 
			WHERE (user_id1 = :user_id1 AND user_id2 = :user_id2)
			OR (user_id1 = :user_id2 AND user_id2 = :user_id1)");
		$q->execute(array(

			'user_id1' => get_session('user_id'),
			'user_id2' => $id['id']

			));

		$data = $q->fetch(PDO::FETCH_OBJ);
		$q->closeCursor();
		if($data){

			if($data->user_id1 == $id['id'] AND $data->status == '0'){

				//echo '<a href="" class="btn btn-success"><i class="icon-ok"></i> Accepter</a> <a href="" class="btn btn-danger"><i class="icon-ban-circle"></i> Refuser</a>';
				return "accept_reject_relation_link";		

			}else if($data->user_id1 == get_session('user_id') AND $data->status == '0'){

				//echo '<a href="delete_friend.php?pseudo='.$pseudo.'" class="btn btn-info"><i class="icon-ban-circle"></i> Annuler la demande</a>';
				return "cancel_relation_link";

			}else if($data->status == '1'){

				//echo '<a href="delete_friend.php?pseudo='.$pseudo.'" class="btn btn-danger"><i class="icon-ban-circle"></i> Retirer de ma liste d\'amis</a>';
				return "delete_relation_link";

			}

		}else{

			//echo '<a href="add_friend.php?pseudo='.$pseudo.'" class="btn btn-primary"><i class="icon-plus-sign"></i> Ajouter comme ami</a>';
			return "add_relation_link";
		}
	}

}

if (!function_exists('redirect_intent_or')) {
	

	function redirect_intent_or($default_url){

		if ($_SESSION['forwarding_url']) {
			
			$url = $_SESSION['forwarding_url'] ;
		}else{

			$url = $default_url;
		}
		$_SESSION['forwarding_url'] = null;
		redirect($url);
	}

}


if (!function_exists('get_current_locale')) {
	

	function get_current_locale(){

		return $_SESSION['locale'];
	}

}

if (!function_exists('is_logged_in')) {
	

	function is_logged_in(){

		return isset($_SESSION['user_id']) || isset($_SESSION['pseudo']);
	}

}

if (!function_exists('get_avatar')) {
	

	function get_avatar($email){

		//return "http://gravatar.com/avatar/".md5(strtolower(trim(e($email))));
		global $db;
		$q = $db->prepare('SELECT pseudo,email,change_picture FROM users WHERE email= ?');
		$q->execute(array($email));

		$users = $q->fetchAll(PDO::FETCH_OBJ);

		$q->closeCursor();
		foreach ($users as $user) {

			if ($user->change_picture) {
				
				return "imgs/".e($user->pseudo).".jpg";

			}else{

				return "imgs/default.jpg";
			}

			}
		}
		
	}

if (!function_exists('find_user_by_pseudo')) {
	

	function find_user_by_pseudo($pseudo){

		global $db;
		$q = $db->prepare('SELECT id,first_name, pseudo, email, city, country, facebook, twitter,sex,available_for_hiring, bio FROM users WHERE pseudo= ?');
		$q->execute(array($pseudo));

		$data = $q->fetch(PDO::FETCH_OBJ);

		$q->closeCursor();

		return $data;
	}

}

if (!function_exists('find_pseudo_id')) {
	

	function find_pseudo_id($pseudo){

		global $db;
		$q = $db->prepare('SELECT id  FROM users WHERE pseudo= ?');
		$q->execute(array($pseudo));

		$data = $q->fetch(PDO::FETCH_OBJ);

		$q->closeCursor();

		return $data->id;
	}

}

if (!function_exists('get_session')) {
	

	function get_session($key){

		if (!empty($_SESSION[$key])) {
			
			return e($_SESSION[$key]);

		}else{

			return null;
		}
	}

}

if (!function_exists('not_empty')) {
	

	function not_empty($fields = array()){


		if (count($fields) != 0) {
			
			foreach ($fields as $field) {
				if (empty($_POST[$field]) || trim($_POST[$field]) == FALSE) {
					
					return false;
				}
			}
			return true;
		}
	}
}

if (!function_exists('is_already_in_use')) {
	

	function is_already_in_use($field, $value, $table){

		global $db;


		$q = $db->prepare("SELECT id FROM $table WHERE $field = ?");
		$q->execute(array($value));

		$count = $q->rowCount();

		$q->closeCursor();

		return $count;

	}

}

if (!function_exists('set_flash')) {
	
	function set_flash($message, $type = 'info'){

		$_SESSION['notification']['message'] = $message;
		$_SESSION['notification']['type'] = $type;


	}
}

if (!function_exists('redirect')) {
	
	function redirect($page){

		header('Location: '. $page);
		exit();
	}
}


if (!function_exists('save_input_data')) {
	
	function save_input_data(){

		foreach ($_POST as $key => $value) {
			
			if (stripos($key, 'password') == false) {
				
				$_SESSION['input'][$key] = $value;
			}
		}
	}
}


if (!function_exists('get_input')) {
	
	function get_input($key){

			if (!empty($_SESSION['input'][$key])) {
				
				return e($_SESSION['input'][$key]);

			}else{

				return null;
			}

				
	}
}


if (!function_exists('clear_input_data')) {
	
	function clear_input_data(){

		if (isset($_SESSION['input'])) {
			

			$_SESSION['input'] = "";
		}
	}
}

if (!function_exists('set_active')) {
	

	function set_active($file, $class = 'active'){

			$explode = explode('/', $_SERVER['SCRIPT_NAME']);
			$page = array_pop($explode);
			if ($page == $file.'.php') {
				
				return $class;
			}else{

				return "";
			}

	}

}

?>