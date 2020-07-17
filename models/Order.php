
<?php

function getAllOrders()
{
    $db = dbConnect();

    $query = $db->query('SELECT * FROM orders ORDER BY id DESC');
	$orders =  $query->fetchAll();

    return $orders;
}

function getAllOrdersByUser($id)
{
    $db = dbConnect();

    $query = $db->prepare('SELECT * FROM orders WHERE user_id = ? ORDER BY id DESC');
    $query->execute([
		$id
	]);
	$orders = $query->fetchAll();

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
	
	$query = $db->prepare("SELECT * FROM users WHERE id = ?");
	$query->execute([
		$id
	]);
	
	$result = $query->fetch();
	
	return $result;
}

function addOrder($cart, $user_id, $bill)
{	
	$user = getOrderUser($user_id);
    $db = dbConnect();

    $result = array();

    $query = $db->prepare("INSERT INTO orders (order_date, order_bill, user_id, user_firstname, user_lastname, user_email, user_address) VALUES( :order_date, :order_bill, :user_id, :user_firstname, :user_lastname, :user_email, :user_address)");

	$result['answer'] = $query->execute([
		'order_date' => date('Y-m-d H:i:s'),
		'order_bill' => $bill,
		'user_id' => $user['id'],
		'user_firstname' => $user['firstname'],
		'user_lastname' => $user['lastname'],
		'user_email' => $user['email'],
		'user_address' => $user['address'],
	]);

	if ($result['answer']) {

		$result['order_id'] = $db->lastInsertId();

		foreach ($cart as $cart_product) {
			addProductOrder($result['order_id'] , $cart_product);
		}
	}

	return $result;
}

function addProductOrder($order_id, $cart_product)
{
	$product = getProduct($cart_product['id']);

	$db = dbConnect();

	$query = $db->prepare("INSERT INTO order_products (order_id, product_id, name, price, size, amount) VALUES( :order_id, :product_id, :name, :price, :size, :amount)");

	$result = $query->execute([
		'order_id' => $order_id,
		'product_id' => $cart_product['id'],
		'name' => $product['name'],
		'price' => $product['price'],
		'size' => $cart_product['size'],
		'amount' => $cart_product['amount'],
	]);
}
