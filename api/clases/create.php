<?php
error_reporting(0);

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');

include('funtion.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];

if($requestMethod == 'POST'){

    $inputData = json_decode(file_get_contents("php://input"), true);
    if(empty($inputData)){

        echo $_POST['nombre_completo'];
        $storeUsuarios = storeUsuarios($_POST);
    }else{

        $storeUsuarios = storeUsuarios($inputData);
    }
    echo $inputData['nombre_completo'];
}
else
{
    $data = [
        'estado' => 405,
        'mensaje' => $requestMethod. ' Method Not Allowed',
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}

?>