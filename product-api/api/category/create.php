<?php

require_once "init.php";

// Continue with category creation if the token is valid


    $data = json_decode(file_get_contents("php://input")); //array or object
    $name = $data->name ?? '';
    $description = $data->description ?? '';

    if (empty($name) || empty($description)) {
        http_response_code(400);//bad req
        echo json_encode(["message" => "All fields are required"]);
        exit();
    }

    $sql = "INSERT INTO categories (name, description) VALUES (:name, :description)";
    $stmt = $conn->prepare($sql);

    try {
        $stmt->execute([
            ":name" => $name,
            ":description" => $description
        ]);
        echo json_encode(["message" => "Category created successfully"]);
    } catch (PDOException $e) {
        http_response_code(500); //Internal Server Error
        echo json_encode(["message" => "Error creating category", "error" => $e->getMessage()]);
    }


?>