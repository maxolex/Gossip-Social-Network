<?php

require '../config/db.php';
require '../Faker-master/src/autoload.php';

$faker = Faker\Factory::create();

for ($i=1; $i <=150 ; $i++) { 
	
	$q = $db->prepare('INSERT INTO users (name,pseudo,email,password,active,created_at,first_name,city,country,sex,facebook,available_for_hiring,bio)
			VALUES(:name,:pseudo,:email,:password,:active,:created_at,:first_name,:city,:country,:sex,:facebook,:available_for_hiring,:bio)');
	$q->execute(array(
			'name' => $faker->unique()->name,
			'pseudo' => $faker->unique()->userName,
			'email' => $faker->unique()->email,
			'password' => sha1('123456'),
			'active' => 1,
			'created_at' => $faker->date().' '.$faker->time(),
			'first_name' => $faker->unique()->firstName(),
			'city' => $faker->city,
			'country' => $faker->country,
			'sex' => $faker->randomElement(array('H','F')),
			'facebook' => $faker->unique()->userName,
			'available_for_hiring' => $faker->randomElement(array('0','1')),
			'bio' => $faker->paragraph(),
		));


	$id = $db->lastInsertId();
	$q = $db->prepare("INSERT INTO friends_relationships(user_id1, user_id2, status) VALUES(?, ?, ?)");
	$q->execute(array($id, $id, '2'));


}

echo "Users Added!!";