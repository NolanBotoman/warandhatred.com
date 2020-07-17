<?php

function getAllCategories()
{
    $db = dbConnect();

    $query = $db->query('SELECT * FROM categories');
    $products =  $query->fetchAll();

    return $products;
}


function getCategory($id)
{
    $db = dbConnect();
    
    $query = $db->prepare("SELECT * FROM categories WHERE id = ?");
    $query->execute([
        $id
    ]);
    
    $result = $query->fetch();
    
    return $result;
}

