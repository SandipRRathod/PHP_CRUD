<?php

require_once "init.php";


// If the token is valid, fetch products from the database

    $sql = "SELECT * FROM products";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the list of products
    echo json_encode($products);


?>