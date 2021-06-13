<?php

function getAllProducts()
{
    $db = dbConnect();

    $query = $db->query('SELECT * FROM products ORDER BY id DESC');
	$products =  $query->fetchAll();

    return $products;
}

function getAllProductsCategories()
{
	$db = dbConnect();
	
	$query = $db->query("SELECT * FROM product_categories");
	$products_categories = $query->fetchAll();
	
	return $products_categories;
}

function getAllProductCategories($id)
{
	$db = dbConnect();
	
	$query = $db->prepare("SELECT * FROM product_categories WHERE product_id = ?");
	$query->execute([
		$id
	]);

	$product_categories = $query->fetchAll();
	
	return $product_categories;
}

function getAllProductsSizes()
{
	$db = dbConnect();
	
	$query = $db->query("SELECT * FROM product_sizes");
	$products_sizes = $query->fetchAll();
	
	return $products_sizes;
}

function getAllProductSizes($id)
{
	$db = dbConnect();
	
	$query = $db->prepare("SELECT * FROM product_sizes WHERE product_id = ?");
	$query->execute([
		$id
	]);

	$product_sizes = $query->fetchAll();
	
	return $product_sizes;
}


function getProduct($id)
{
	$db = dbConnect();
	
	$query = $db->prepare("SELECT * FROM products WHERE id = ?");
	$query->execute([
		$id
	]);
	
	$result = $query->fetch();
	
	return $result;
}

function updateProduct($id, $informations)
{
	$db = dbConnect();
	
	$query = $db->prepare('UPDATE products SET name = ?, description = ?, price = ?, amount = ?, is_hidden = ?, is_archived = ? WHERE id = ?');
	
	$result = $query->execute([
		$informations['name'],
		$informations['description'],
		$informations['price'],
		$informations['amount'],
		$informations['is_hidden'],
		$informations['is_archived'],
		$id,
	]);

	if ($result) {

		$query = $db->prepare('DELETE FROM product_categories WHERE product_id = ?');
		$result = $query->execute([$id]);

		foreach ($informations['categories_id'] as $category_id) {
			$query = $db->prepare('INSERT INTO product_categories (product_id, category_id) VALUES(:product_id, :category_id)');
	
			$result = $query->execute([
				'product_id' => $id,
				'category_id' => $category_id,
			]);
		}

		$query = $db->prepare('DELETE FROM product_sizes WHERE product_id = ?');
		$result = $query->execute([$id]);

		foreach ($informations['sizes_id'] as $size_id) {
			$query = $db->prepare('INSERT INTO product_sizes (product_id, size_id) VALUES(:product_id, :size_id)');
	
			$result = $query->execute([
				'product_id' => $id,
				'size_id' => $size_id,
			]);
		}

		if (!empty($_FILES['images'])) {
			$path = '../assets/images/products/';
			foreach (glob($path . $id . '-' . '*.*') as $file) unlink($file);

			for ( $i=0 ; $i < count($_FILES['images']['name']) ; $i++ ) {

				if (isset($_FILES['images']['tmp_name'][$i])) {

					$allowed_extensions = array( 'jpg' , 'jpeg' , 'gif', 'png' );
					$file_extension = pathinfo( $_FILES['images']['name'][$i] , PATHINFO_EXTENSION);

					if (in_array($file_extension , $allowed_extensions)) {

						$imageId = count(glob($path . $id . '-' . '*.*')) + 1;
						$file_name = $id . '-' . $imageId . '.' . $file_extension;
						
						$result = move_uploaded_file($_FILES['images']['tmp_name'][$i], $path . $file_name);

					}
				}
			}
		}

	}
	
	return $result;
}

function addProduct($informations)
{
	$db = dbConnect();
	
	$query = $db->prepare("INSERT INTO products (name, description, price, amount, is_hidden, is_archived) VALUES( :name, :description, :price, :amount, :is_hidden, :is_archived)");

	$result = $query->execute([
		'name' => $informations['name'],
		'description' => $informations['description'],
		'price' => $informations['price'],
		'amount' => $informations['amount'],
		'is_hidden' => $informations['is_hidden'],
		'is_archived' => $informations['is_archived'],
	]);

	if ($result) {

		$id = $db->lastInsertId();

		foreach ($informations['categories_id'] as $category_id) {

			$query = $db->prepare('INSERT INTO product_categories (product_id, category_id) VALUES(:product_id, :category_id)');
	
			$result = $query->execute([
				'product_id' => $id,
				'category_id' => $category_id,
			]);
		}

		foreach ($informations['sizes_id'] as $size_id) {
			$query = $db->prepare('INSERT INTO product_sizes (product_id, size_id) VALUES(:product_id, :size_id)');
	
			$result = $query->execute([
				'product_id' => $id,
				'size_id' => $size_id,
			]);
		}

		for( $i=0 ; $i < count($_FILES['images']['name']) ; $i++ ) {

			if (isset($_FILES['images']['tmp_name'][$i])) {

				$allowed_extensions = array( 'jpg' , 'jpeg' , 'gif', 'png' );
				$file_extension = pathinfo( $_FILES['images']['name'][$i] , PATHINFO_EXTENSION);

				if (in_array($file_extension , $allowed_extensions)) {
					$path = '../assets/images/products/';
					$imageId = count(glob($path . $id . '-' . '*.*')) + 1;
					$file_name = $id . '-' . $imageId . '.' . $file_extension;
					
					$result = move_uploaded_file($_FILES['images']['tmp_name'][$i], $path . $file_name);
				}
			}
		}
	}
	
	return $result;
}

function deleteProduct($id)
{
	$db = dbConnect();
	
	$query = $db->prepare('DELETE FROM products WHERE id = ?');
	$result = $query->execute([$id]);

	if ($result) {
		$path = '../assets/images/products/';
		foreach (glob($path . $id . '-' . '*.*') as $file) unlink($file);
	} 

	return $result;
}