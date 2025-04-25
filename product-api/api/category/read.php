<?php

require_once "init.php";

// If the token is valid, fetch categories from the database
    $sql = "SELECT * FROM categories";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the list of categories
    echo json_encode($categories);


?>