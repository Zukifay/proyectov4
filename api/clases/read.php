<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');

include('funtion.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];

if($requestMethod == "GET"){

    if(isset($_GET['id'])){
        
        $usuarios = getUsuarios($_GET);
        echo $usuarios;
    }else{
        $usuariosList = getUsuariosList();
        echo $usuariosList;
    }
}
else
{
    $data = [
        'estado' => 405,
        'mensaje' => $requestMethod. 'Method Not Allowed',
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}

?>