<?php
// common config files at one place , just have to load this php file 

require_once "../config/db.php";  // Database connection
require "../vendor/autoload.php"; // Include Composer autoload

require_once "../auth/jwt_validation.php";

verifyJWT(); // Verify JWT token before proceeding next

?>