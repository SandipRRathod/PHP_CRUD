<?php

require_once "init.php";

    $data = json_decode(file_get_contents("php://input"));
    $id = $data->id ?? '';
    $name = $data->name ?? '';
    $description = $data->description ?? '';
    $category_id = $data->category_id ?? '';
    $price = $data->price ?? '';

    if (empty($id) || empty($name) || empty($description) || empty($category_id) || empty($price)) {
        http_response_code(400);
        echo json_encode(["message" => "All fields are required"]);
        exit();
    }

    // Update query
    $sql = "UPDATE products SET name = :name, description = :description, category_id = :category_id, price = :price WHERE id = :id";
    $stmt = $conn->prepare($sql);

    try {
        $stmt->execute([
            ":name" => $name,
            ":description" => $description,
            ":category_id" => $category_id,
            ":price" => $price,
            ":id" => $id
        ]);
        echo json_encode(["message" => "Product updated successfully"]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["message" => "Error updating product", "error" => $e->getMessage()]);
    }

?>