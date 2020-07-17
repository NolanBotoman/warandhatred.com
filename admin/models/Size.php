<?php

function getAllSizes()
{
    $db = dbConnect();

    $query = $db->query('SELECT * FROM sizes');
	$sizes =  $query->fetchAll();

    return $sizes;
}

function getSize($id)
{
	$db = dbConnect();
	
	$query = $db->prepare("SELECT * FROM sizes WHERE id = ?");
	$query->execute([
		$id
	]);
	
	$result = $query->fetch();
	
	return $result;
}

function updateSize($id, $informations)
{
	$db = dbConnect();
	
	$query = $db->prepare('UPDATE sizes SET size = ? WHERE id = ?');
	
	$result = $query->execute([
		$informations['size'],
		$id
	]);
	
	return $result;
}

function addSize($informations)
{
	$db = dbConnect();
	
	$query = $db->prepare("INSERT INTO sizes (size) VALUES( :size )");

	$result = $query->execute([
		'size' => $informations['size'],
	]);

	return $result;
}

function deleteSize($id)
{
	$db = dbConnect();
	
	$query = $db->prepare('DELETE FROM sizes WHERE id = ?');
	$result = $query->execute([$id]);
	
	return $result;
}