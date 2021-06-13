<?php

function getAllShipping()
{
    $db = dbConnect();

    $query = $db->query('SELECT * FROM shipping');
	$shipping = $query->fetchAll();

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
