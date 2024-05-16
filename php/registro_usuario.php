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

// Obtener los datos del formulario
$nombre_completo = $_POST['nombre_completo'];
$correo = $_POST['correo'];
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];
// encript clave
$contrasena = hash('sha512', $contrasena);

// Crear la consulta SQL para insertar los datos
$query = "INSERT INTO usuarios (nombre_completo, correo, usuario, contrasena) 
          VALUES ('$nombre_completo', '$correo', '$usuario', '$contrasena')";

// verificar que no se repita el correo en la base de datos
$verificar_correo = mysqli_query($conn, "SELECT * FROM usuarios WHERE correo = '$correo'");

if (mysqli_num_rows($verificar_correo) > 0) {
    echo "<script>alert('Este correo ya está registrado. Inténtelo nuevamente.'); window.location = '../sesion.php';</script>";
    exit();
}

// verificar que no se repita el usuario en la base de datos
$verificar_usuario = mysqli_query($conn, "SELECT * FROM usuarios WHERE usuario = '$usuario'");

if (mysqli_num_rows($verificar_usuario) > 0) {
    echo "<script>alert('Este usuario ya existe. Por favor, elige otro.'); window.location = '../sesion.php';</script>";
    exit();
}
$ejecutar = mysqli_query($conn, $query);

if($ejecutar){
    echo "<script>alert('Registro exitoso!!'); window.location = '../sesion.php';</script>";
}else{
    echo "<script>alert('Error al registrar, porfavor verifica tus datos.'); window.location = '../sesion.php';</script>";
}

// ejecutar la consulta para insertar el nuevo usuario en la base de datos
//$query = "INSERT INTO usuarios (correo, usuario, contraseña) 
            //VALUES ('$correo', '$usuario', '$contraseña')";
// Cerrar la conexión
mysqli_close($conn);
?>
<?php