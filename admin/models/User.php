	<?php

function getAllUsers()
{
    $db = dbConnect();

    $query = $db->query('SELECT * FROM users');
	$users =  $query->fetchAll();

    return $users;
}

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

function updateUser($id, $informations)
{
	$db = dbConnect();

	$queryString = 'UPDATE users SET firstname = :firstname, lastname = :lastname,' . (!empty($informations['password'])? 'password = :password,': '') . 'address = :address, email = :email, is_admin = :is_admin WHERE id = :id';

    $queryArray = [
        'firstname' => $informations['firstname'],
        'lastname' => $informations['lastname'],
        'address' => $informations['address'],
        'email' => $informations['email'],
        'is_admin' => $informations['is_admin'],
		'id' => $id
    ];

    if(!empty($informations['password'])){
        $queryArray['password'] = encryptSecret($informations['password']);
    }

    $query = $db->prepare($queryString);
	$result = $query->execute($queryArray);
	
	return $result;
}

function addUser($informations)
{
	$db = dbConnect();

	$query = $db->prepare("INSERT INTO users (firstname, lastname, email, password, address, is_admin) VALUES( :firstname, :lastname :email, :password, :address, :is_admin)");

	$result = $query->execute([
		'firstname' => $informations['firstname'],
		'lastname' => $informations['lastname'],
		'email' => $informations['email'],
		'password' => encryptSecret($informations['password']),
		'address' => $informations['address'],
		'is_admin' => $informations['is_admin'],
	]);
	
	return $result;
}

function deleteUser($id)
{
	$db = dbConnect();
	
	$query = $db->prepare('DELETE FROM users WHERE id = ?');
	$result = $query->execute([$id]);

	return $result;
}