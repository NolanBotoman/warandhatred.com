<?php

function getSize($id)
{
    $db = dbConnect();

    $query = $db->prepare("SELECT * FROM sizes WHERE id = ?");
    $query->execute([
        $id
    ]);

    $size = $query->fetch();
    
    return $size;
}