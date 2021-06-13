<?php

function getAllProducts()
{
    $db = dbConnect();

    $query = $db->query("SELECT * FROM products WHERE is_hidden = 0");
    $products =  $query->fetchAll();

    $products = addProductsImages($products);

    return $products;
}

function getAllBuyableProducts()
{
    $db = dbConnect();

    $query = $db->query("SELECT id FROM categories WHERE is_buyable = 1");
    $categories_id = $query->fetchAll();

    $query = $db->query("SELECT * FROM products INNER JOIN product_categories ON product_categories.category_id WHERE products.is_hidden = 0 AND product_categories.category_id IN ($categories_id)");
    $products = $query->fetchAll();

    $products = addProductsImages($products);

    return $products;
}

function getAllArchived()
{
    $db = dbConnect();

    $query = $db->query("SELECT * FROM products WHERE is_archived = 1 ORDER BY id DESC");
    $products =  $query->fetchAll();

    $products = addProductsImages($products);

    return $products;
}

function getProductSizes($id)
{
    $db = dbConnect();

    $query = $db->prepare("SELECT * FROM product_sizes WHERE product_id = ?");
    $query->execute([
        $id
    ]);

    $product_sizes = $query->fetchAll();

    $sizes = array();
    foreach ($product_sizes as $product_size) {
        $query = $db->prepare("SELECT * FROM sizes WHERE id = ?");
        $query->execute([
            $product_size['size_id']
        ]);

        $size = $query->fetch();
        array_push($sizes, $size);
    }
    
    return $sizes;
}


function getAllProductsByCategory($id)
{
    $db = dbConnect();
    
    $query = $db->prepare("SELECT * FROM product_categories WHERE category_id = ?");
    $query->execute([
        $id
    ]);

    $product_categories = $query->fetchAll();
    $products_by_category = array();

    foreach ($product_categories as $product_category) {
        $product = getProduct($product_category['product_id']);
        if ($product != null) array_push($products_by_category, $product);
    }

    $products_by_category = addProductsImages($products_by_category);
    return $products_by_category;
}

function getProduct($id)
{
    $db = dbConnect();

    $query = $db->prepare("SELECT * FROM products WHERE id = ? AND is_hidden = 0");
    $query->execute([
        $id
    ]);

    $result = $query->fetch();

    if ($result) array_push($result, getProductImages($id));
    return $result;
}

function updateProductAmount($id, $minus)
{
    $db = dbConnect();

    $query = $db->prepare('SELECT * FROM products WHERE id = ?');
    $query->execute([
        $id
    ]);
    
    $product = $query->fetch();

    $product['amount'] -= $minus;

    $query = $db->prepare('UPDATE products SET amount = ? WHERE id = ?');
    $result = $query->execute([
        $product['amount'],
        $id
    ]);

}

function addProductsImages($products)
{
    $count = 0;
    foreach ($products as $product) {
        array_push($products[$count], getProductImages($product['id']));
        $count++;
    }

    return $products;
}

function getProductImages($id)
{
    $images = array();
    foreach (glob('assets/images/products/' . $id . '-' . '*.*') as $image) array_push($images, $image);

    return $images;
}
