<?php  //base /root tag

// Get the request method
$method = $_SERVER['REQUEST_METHOD'];  //$_SERVER is a superglobal array in PHP that holds server and execution environment information

switch ($method) {

    //if there is more than one same methods with diffrent opration then i we can use conditional statements like if else inside switch case with full uri  '

    //require_once is used to include and evaluate a file in PHP even if the file called multiple times 

    case 'GET':
        require_once "category/read.php"; 
        break;

    case 'POST':
        require_once "category/create.php";
        break;

    case 'PUT':
        require_once "category/update.php";
        break;

    case 'DELETE':
        require_once "category/delete.php";
        break;

    default:
        http_response_code(405); // status code for Method Not Allowed  
        echo json_encode(["message" => "Request method not supported"]);
        break;
}

?>
