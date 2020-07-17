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

	$query = $db->prepare("INSERT INTO users (email, firstname, lastname, password, address) VALUES( :email, :firstname, :lastname, :password, :address)");

	$result = $query->execute([
		'email' => $informations['email'],
		'firstname' => $informations['firstname'],
		'lastname' => $informations['lastname'],
		'password' => encryptSecret($informations['password']),
		'address' => $informations['address'],
	]);
	
	return $result;
}

function updateUser($id, $informations)
{
	$db = dbConnect();

		$db = dbConnect();

	$queryString = 'UPDATE users SET firstname = :firstname, lastname = :lastname,' . (!empty($informations['password'])? 'password = :password,': '') . 'address = :address, email = :email WHERE id = :id';

    $queryArray = [
        'firstname' => $informations['firstname'],
        'lastname' => $informations['lastname'],
        'address' => $informations['address'],
        'email' => $informations['email'],
		'id' => $id
    ];

    if(!empty($informations['password'])){
        $queryArray['password'] = encryptSecret($informations['password']);
    }

    $query = $db->prepare($queryString);
	$result = $query->execute($queryArray);
	
	return $result;
	
	return $result;
}