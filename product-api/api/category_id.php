<?php


//get all product where catgory is same

require_once "init.php";



if (!isset($_GET['category_id'])) { 
    http_response_code(400);
    echo json_encode(["message" => "category_id is required"]);
    exit();
}

$category_id = $_GET['category_id']; //get all product where catgory is same


//db op
$sql = "SELECT * FROM products WHERE category_id = :category_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':category_id', $category_id);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

//return json of products which have the same category
echo json_encode($products);

?>