<?php

function getAllShipping()
{
    $db = dbConnect();

    $query = $db->query('SELECT * FROM shipping');
	$shipping =  $query->fetchAll();

    return $shipping;
}

function getShipping($id)
{
	$db = dbConnect();
	
	$query = $db->prepare("SELECT * FROM shipping WHERE id = ?");
	$query->execute([
		$id
	]);

	$result = $query->fetch();

	return $result;
}

function updateShipping($id, $informations)
{
	$db = dbConnect();

	$query = $db->prepare('UPDATE shipping SET fees = :fees, description = :description WHERE id = :id');
	$result = $query->execute([
		'fees' => $informations['fees'],
		'description' => $informations['description'],
		'id' => $id
    ]);

	return $result;
}

function addShipping($informations)
{
	$db = dbConnect();

	$query = $db->prepare("INSERT INTO shipping (fees, description) VALUES( :fees, :description )");
	$result = $query->execute([
		'fees' => $informations['fees'],
		'description' => $informations['description']
	]);

	return $result;
}

function deleteShipping($id)
{
	$db = dbConnect();

	$query = $db->prepare('DELETE FROM shipping WHERE id = ?');
	$result = $query->execute([$id]);

	return $result;
}