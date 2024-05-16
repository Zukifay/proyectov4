<?php
// Conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$database = "login_register_db";

$conn = mysqli_connect($host, $user, $password, $database);

// Verificar la conexión
if (!$conn) {
    die("Error en la conexión: " . mysqli_connect_error());
}

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

// encript clave
$contrasena = hash('sha512', $contrasena);

//echo $contrasena;
//die();

$validar_login = mysqli_query($conn, "SELECT * FROM usuarios WHERE correo = '$correo' and contrasena = '$contrasena'");

if(mysqli_num_rows($validar_login) > 0){
    
    header("location: ..//index.html");
    exit();
}else{
    echo "<script>alert('Usuario incorrecto, verifica tus credenciales'); window.location = '../sesion.php';</script>";
    exit();
}
?>
