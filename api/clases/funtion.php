<?php


require '../clases/dbcon.php';

//error al conectar la bd
function error422($mensaje){

    $data = [
        'estado' => 422,
        'mensaje' => $mensaje,
    ];
    header("HTTP/1.0 422 Error enminente");
    echo json_encode($data);
    exit();
}
//crear usuarios nuevos get
function storeUsuarios($usuariosInput){
     global $conn;

     $nombre = mysqli_real_escape_string($conn, $usuariosInput['nombre']);
     $correo = mysqli_real_escape_string($conn, $usuariosInput['correo']);
     $usuario = mysqli_real_escape_string($conn, $usuariosInput['usuario']);
     $contrasena = mysqli_real_escape_string($conn, $usuariosInput['contrasena']);


     if(empty(trim($nombre))){

        return error422('Ingresa tu nombre');
     }elseif(empty(trim($correo))){

        return error422('Ingresa tu correo electronico');
     }elseif(empty(trim($usuario))){

        return error422('crea un usuario');
     }elseif(empty(trim($contrasena))){

        return error422('Ingresa una contrasena');
     }
     else
     {
        $query = "INSERT INTO usuarios (nombre_completo,correo,usuario,contrasena) VALUES ('$nombre','$correo','$usuario','$contrasena')";
        $result = mysqli_query($conn, $query);

        if($result){

            $data = [
                'estado' => 201,
                'mensaje' => 'Usuario Creado Exitosamente',
        ];
        header("HTTP/1.0 201 Creado Correctamente");
        return json_encode($data);


        }else{
            $data = [
                'estado' => 500,
                'mensaje' => 'Internal Server Error',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);

        }
     }
}
//busqueda de los usuarios registrados post
function getUsuariosList(){
    
    global $conn;

    $query = "SELECT * FROM usuarios";
    $query_run = mysqli_query($conn, $query);

    if($query_run){

        if(mysqli_num_rows($query_run) > 0){

            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
            $data = [
                'estado' => 200 ,
                'mensaje' => 'lISTA DE USUARIOS EXITOSA',
                'data' => $res
        ];
        header("HTTP/1.0 200 OK");
        return json_encode($data);

        }else{
            $data = [
                'estado' => 404,
                'mensaje' => 'No Hay Usuarios',
        ];
        header("HTTP/1.0 404 No Hay Usuarios");
        return json_encode($data);  
        }
    }
    else
    {
        $data = [
            'estado' => 500,
            'mensaje' => 'Internal Server Error',
    ];
    header("HTTP/1.0 500 Internal Server Error");
    return json_encode($data);
        
    }
}

//buscar usuarios por id
function getUsuarios($usuariosParams){

    global $conn;

    if($usuariosParams['id'] == null){

        return error422('Ingresa el ID usuario');
     }

     $usuarioId = mysqli_real_escape_string($conn, $usuariosParams['id']);

     $query = "SELECT * FROM usuarios WHERE id='$usuarioId' LIMIT 1";
     $result = mysqli_query($conn, $query);

     if($result){

        if(mysqli_num_rows($result) == 1)
        {
            $res = mysqli_fetch_assoc($result);

            $data = [
                'estado' => 200,
                'mensaje' => 'Usuario Encontrado Exitosamente',
                'data' => $res
        ];
        header("HTTP/1.0 200 OK");
        return json_encode($data);
        }
        else
        {
            $data = [
                'estado' => 404,
                'mensaje' => 'No Se Encontro Ese Usuario',
        ];
        header("HTTP/1.0 404 No Existe Usuario");
        return json_encode($data);
        }

     }else{

        $data = [
            'estado' => 500,
            'mensaje' => 'Internal Server Error',
    ];
    header("HTTP/1.0 500 Internal Server Error");
    return json_encode($data);


     }


}

//actualizar usuarios
function updateUsuarios($usuariosInput, $usuariosParams){

    global $conn;

    if(!isset($usuariosParams['id'])){

        return error422('No existe usuarios con este id');
    }elseif($usuariosParams['id'] == null){
        return error422('Ingresa el id del usuario');
    }

    $usuarioId = mysqli_real_escape_string($conn, $usuariosParams['id']);

    $nombre = mysqli_real_escape_string($conn, $usuariosInput['nombre']);
    $correo = mysqli_real_escape_string($conn, $usuariosInput['correo']);
    $usuario = mysqli_real_escape_string($conn, $usuariosInput['usuario']);
    $contrasena = mysqli_real_escape_string($conn, $usuariosInput['contrasena']);


    if(empty(trim($nombre))){

       return error422('Ingresa tu nombre');
    }elseif(empty(trim($correo))){

       return error422('Ingresa tu correo electronico');
    }elseif(empty(trim($usuario))){

       return error422('crea un usuario');
    }elseif(empty(trim($contrasena))){

       return error422('Ingresa una contrasena');
    }else
    {
       $query = "UPDATE usuarios SET nombre_completo='$nombre', correo='$correo', usuario='$usuario', contrasena='$contrasena' WHERE id='$usuarioId' LIMIT 1";
       $result = mysqli_query($conn, $query);

       if($result){

           $data = [
               'estado' => 200 ,
               'mensaje' => 'Usuario Actualizado Exitosamente',
       ];
       header("HTTP/1.0 200 Succes");
       return json_encode($data);


       }else{
           $data = [
               'estado' => 500,
               'mensaje' => 'Internal Server Error',
       ];
       header("HTTP/1.0 500 Internal Server Error");
       return json_encode($data);

       }
    }
}

//eliminar registros
function deleteUsuarios($usuariosParams){

    global $conn;

    if(!isset($usuariosParams['id'])){

        return error422('No existe usuarios con este id');
    }elseif($usuariosParams['id'] == null){
        return error422('Ingresa el id del usuario');
    }

    $usuarioId = mysqli_real_escape_string($conn, $usuariosParams['id']);

    $query = "DELETE FROM usuarios WHERE id='$usuarioId' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if($result){

        $data = [
            'estado' => 200,
            'mensaje' => 'Usuario Eliminado Correctamente',
    ];
    header("HTTP/1.0 200 Eliminado");
    return json_encode($data);

    }else{
        $data = [
            'estado' => 404,
            'mensaje' => 'Usuario no existe',
    ];
    header("HTTP/1.0 404 Not Found");
    return json_encode($data);

    }

}




?>