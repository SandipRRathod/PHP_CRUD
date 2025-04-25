<?php
$host = "localhost";
$db_name = "product_crud";   // your database name
$username = "root";      // default XAMPP MySQL username
$password = "";          // default password is empty

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password); 
     //PDO(php data object) is a PHP class used to interact with databases
    //  PDO supports many different databases
    // PDO supports prepared statements, which help prevent SQL injection attacks


    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // set error mode
    //echo "Connected successfully"; // uncomment to test
} catch (PDOException $exception) {
    echo "Connection failed: " . $exception->getMessage();
}
?>
