<?php
require_once "../config/db.php";

$data = json_decode(file_get_contents("php://input"));
$username = $data->username ?? '';
$password = $data->password ?? '';

if (empty($username) || empty($password)) {
    http_response_code(400);
    echo json_encode(["message" => "Username and password are required"]);
    exit();
}

// Check if the username already exists
$sql_check = "SELECT * FROM users WHERE username = :username";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->execute([":username" => $username]);

if ($stmt_check->rowCount() > 0) {
    // Username already exists
    http_response_code(400);
    echo json_encode(["message" => "Username already exists"]);
    exit();
}

// If username doesn't exist, hash the password and insert the user
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

$sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
$stmt = $conn->prepare($sql);

try {
    $stmt->execute([
        ":username" => $username,
        ":password" => $hashedPassword
    ]);
    echo json_encode(["message" => "User registered successfully"]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["message" => "Error registering user", "error" => $e->getMessage()]);
}
?>
