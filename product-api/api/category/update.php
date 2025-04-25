<?php

require_once "init.php";

    $data = json_decode(file_get_contents("php://input"));
    $id = $data->id ?? '';
    $name = $data->name ?? '';
    $description = $data->description ?? '';

    if (empty($id) || empty($name) || empty($description)) {
        http_response_code(400);
        echo json_encode(["message" => "All fields are required"]);
        exit();
    }

    // Update query
    $sql = "UPDATE categories SET name = :name, description = :description WHERE id = :id";
    $stmt = $conn->prepare($sql);

    try {
        $stmt->execute([
            ":name" => $name,
            ":description" => $description,
            ":id" => $id
        ]);
        echo json_encode(["message" => "Category updated successfully"]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["message" => "Error updating category", "error" => $e->getMessage()]);
    }

?>