<?php

use Firebase\JWT\JWT;   // Import JWT class for decoding
use Firebase\JWT\Key;   // Import Key class for decoding

// Secret key used to encode and decode the JWT
$secret_key = "SECRET_KEY";  //  Same as used in login secret key

// Middleware to check if JWT is valid
function verifyJWT() {
    global $secret_key; // Accessing the global $secret_key

    $headers = apache_request_headers();  // Get request headers
    $jwt = null;  // Initialize JWT variable

    // Check if the Authorization header is set
    if (isset($headers['Authorization'])) {
        $matches = [];
        preg_match('/Bearer (.+)/', $headers['Authorization'], $matches);  // Extracting the token from the header

        if (isset($matches[1])) {
            // $matches[0]= has 'Bearer' with token
            $jwt = $matches[1];  // Extracting JWT token  this has only token
        }
    }

    // If the token exists, decoding and verifying it
    if ($jwt) {
        try {   
            // Decode the token using the secret key and the expected algorithm
            $decoded = JWT::decode($jwt, new Key($secret_key, 'HS256'));  // Decoding the token

            // Returning the decoded payload (user info)
            return $decoded;  // If the token is valid, returning the payload (user data)
        } catch (Exception $e) {
            // If an error occurs (invalid or expired token), return an error response
            http_response_code(401);  // Unauthorized status code
            echo json_encode(["message" => "Unauthorized", "error" => $e->getMessage()]);
            exit();
        }
    }

    // If no token is found, return Unauthorized
    http_response_code(401);  // Unauthorized status code
    echo json_encode(["message" => "You Are Not Authorized, Please Login.."]);
    
    // echo "You Are Not Authorized, Please Login.."; simple massage 
    exit();
}