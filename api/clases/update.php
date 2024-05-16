<?php
//reporte de errores
error_reporting(0);

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: PUT');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');

include('funtion.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];

if($requestMethod == 'PUT'){

    $inputData = json_decode(file_get_contents("php://input"), true);
    if(empty($inputData)){

        
        $updateUsuarios = updateUsuarios($_POST, $_GET);
    }
    else
    {

        $updateUsuarios = updateUsuarios($inputData, $_GET);
    }

    echo $updateUsuarios;
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