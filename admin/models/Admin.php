<?php

function getMaintenanceMode()
{
    $db = dbConnect();

    $query = $db->query('SELECT status FROM admin_values WHERE name = "maintenance"');
	$result = $query->fetchColumn();

    return $result;
}

function switchMaintenance()
{
	$currentMode = getMaintenanceMode();

	$db = dbConnect();

	$state = true;
	if ($currentMode) $state = false;

	$query = $db->prepare('UPDATE admin_values SET status = ? WHERE name = "maintenance"');
	
	$result = $query->execute([
		$state,
	]);
	
	return $result;
}

function getAllAdmin()
{
	$db = dbConnect();

    $query = $db->query('SELECT * FROM admin_values');
	$result = $query->fetchAll();

    return $result;
}