<?php

// Get the request method
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        require_once "product/read.php";
        break;

    case 'POST':
        require_once "product/create.php";
        break;

    case 'PUT':
        require_once "product/update.php";
        break;

    case 'DELETE':
        require_once "product/delete.php";
        break;

    default:
        http_response_code(405); // Method Not Allowed
        echo json_encode(["message" => "Request method not supported"]);
        break;
}

?>
