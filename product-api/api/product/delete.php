<?php

require_once "init.php";

    $data = json_decode(file_get_contents("php://input"));
    $id = $data->id ?? '';

    if (empty($id)) {
        http_response_code(400);
        echo json_encode(["message" => "id is required"]);
        exit();
    }

    // Delete query
    $sql = "DELETE FROM products WHERE id = :id";
    $stmt = $conn->prepare($sql);

    try {
        $stmt->execute([":id" => $id]);
        echo json_encode(["message" => "Product deleted successfully"]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["message" => "Error deleting product", "error" => $e->getMessage()]);
    }


?>