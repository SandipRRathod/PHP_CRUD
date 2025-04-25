<?php

require_once "init.php";

// Continue with product creation if the token is valids

    $data = json_decode(file_get_contents("php://input")); //return PHP object (or array).
    $name = $data->name ?? '';
    $description = $data->description ?? '';
    $category_id = $data->category_id ?? '';
    $price = $data->price ?? '';

    if (empty($name) || empty($description) || empty($category_id) || empty($price)) {
        http_response_code(400); //bad request
        echo json_encode(["message" => "All fields are required"]);
        exit();
    }

    $sql = "INSERT INTO products (name, description, category_id, price) VALUES (:name, :description, :category_id, :price)";
    $stmt = $conn->prepare($sql);

    try {
        $stmt->execute([
            ":name" => $name,
            ":description" => $description,
            ":category_id" => $category_id,
            ":price" => $price
        ]);
        echo json_encode(["message" => "Product created successfully"]);
    } catch (PDOException $e) {
        http_response_code(500); //Internal Server Error
        echo json_encode(["message" => "Error creating product", "error" => $e->getMessage()]);
    }


?>
