<?php

function getUser($id)
{
	$db = dbConnect();
	
	$query = $db->prepare("SELECT * FROM users WHERE id = ?");
	$query->execute([
		$id
	]);
	
	$result = $query->fetch();
	
	return $result;
}

function getUserByEmail($email)
{
	$db = dbConnect();
	
	$query = $db->prepare("SELECT * FROM users WHERE email = ?");
	$query->execute([
		$email
	]);
	
	$result = $query->fetch();
	
	return $result;
}

function createUser($informations)
{
	$db = dbConnect();

	$query = $db->prepare("INSERT INTO users (email, firstname, lastname, password, address, city, country) VALUES( :email, :firstname, :lastname, :password, :address, :city, :country )");

	$result = $query->execute([
		'email' => $informations['email'],
		'firstname' => $informations['firstname'],
		'lastname' => $informations['lastname'],
		'password' => encryptSecret($informations['password']),
		'address' => $informations['address'],
		'city' => $informations['city'],
		'country' => strtoupper($informations['country']),
	]);
	
	return $result;
}

function updateUser($id, $informations)
{
	$db = dbConnect();

		$db = dbConnect();

	$queryString = 'UPDATE users SET firstname = :firstname, lastname = :lastname,' . (!empty($informations['password'])? 'password = :password,': '') . 'address = :address, email = :email, city = :city, country = :country WHERE id = :id';

    $queryArray = [
        'firstname' => $informations['firstname'],
        'lastname' => $informations['lastname'],
        'address' => $informations['address'],
        'email' => $informations['email'],
        'city' => $informations['city'],
        'country' => strtoupper($informations['country']),
		'id' => $id
    ];

    if(!empty($informations['password'])){
        $queryArray['password'] = encryptSecret($informations['password']);
    }

    $query = $db->prepare($queryString);
	$result = $query->execute($queryArray);

	return $result;	
}

function checkValidAddress($user) {
	if ($user['country'] == "" || $user['city'] == "" || $user['address'] == "" || ($user['address'] == trim($user['address']) && strpos($user['address'], ' ') == false)) {
		return true;
	} else {
		return false;
	}
}