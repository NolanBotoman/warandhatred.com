<?php

function getAllOrders()
{
    $db = dbConnect();

    $query = $db->query('SELECT * FROM orders ORDER BY id DESC');
	$orders =  $query->fetchAll();

    return $orders;
}

function getAllOrdersProducts()
{
    $db = dbConnect();

    $query = $db->query("SELECT * FROM order_products"); 

	$orders_products = $query->fetchAll();

    return $orders_products;
}

function getOrder($id)
{
	$db = dbConnect();
	
	$query = $db->prepare("SELECT * FROM orders WHERE id = ?");
	$query->execute([
		$id
	]);
	
	$result = $query->fetch();
	
	return $result;
}

function getOrderProducts($id)
{
    $db = dbConnect();

    $query = $db->prepare("SELECT * FROM order_products WHERE order_id = ?");
    $query->execute([
		$id
	]);

	$result = $query->fetchAll();

    return $result;
}

function getOrderUser($id)
{
	$db = dbConnect();
	
	$order = getOrder($id);

	$query = $db->prepare("SELECT * FROM users WHERE id = ?");
	$query->execute([
		$order['user_id']
	]);
	
	$result = $query->fetch();
	
	return $result;
}
