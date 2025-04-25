<?php
require_once "../config/db.php";
require "../vendor/autoload.php";

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$secret_key = "SECRET_KEY";

$data = json_decode(file_get_contents("php://input"));
$username = $data->username ?? '';
$password = $data->password ?? '';

$sql = "SELECT * FROM users WHERE username = :username";
$stmt = $conn->prepare($sql);
$stmt->execute([":username" => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    $payload = [
        "iss" => "localhost",
        "aud" => "localhost",
        "iat" => time(),
        "nbf" => time(),
        "exp" => time() + (60 * 60), // 1 hour
        "data" => [
            "id" => $user['id'],
            "username" => $user['username']
        ]
    ];

    $jwt = JWT::encode($payload, $secret_key, 'HS256');
    echo json_encode(["token" => $jwt]);
} else {
    http_response_code(401);
    echo json_encode(["message" => "Invalid username or password"]);
}
?>
