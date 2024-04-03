<?php
// Conexión a la base de datos
$servidor = "localhost";
$usuario = "root";
$clave = "";
$baseDeDatos = "veterinaria";

$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);

if (!$enlace) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Procesamiento del formulario de registro
if (isset($_POST['registro'])) {
    // Captura de datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Escapar caracteres especiales para prevenir inyección SQL
    $nombre = mysqli_real_escape_string($enlace, $nombre);
    $correo = mysqli_real_escape_string($enlace, $correo);
    $contrasena = mysqli_real_escape_string($enlace, $contrasena);

    // Consulta SQL para insertar los datos del usuario en la base de datos
    $insertarUsuario = "INSERT INTO cuenta (nombre, correo, contrasena) VALUES ('$nombre', '$correo', '$contrasena')";
    $resultado = mysqli_query($enlace, $insertarUsuario);

    // Verificación de éxito o error en la inserción de datos
    if ($resultado) {
        echo "<p>Registro exitoso. Ahora puedes iniciar sesión.</p>";
    } else {
        echo "<p>Error al registrar el usuario: " . mysqli_error($enlace) . "</p>";
    }
}

// Cierre de la conexión a la base de datos
mysqli_close($enlace);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <!-- Estilos CSS -->
</head>
<body>
    <!-- Contenido HTML del formulario de registro -->
    <h2>Registro de Usuario</h2>
    <form action="" method="post">
        <input type="text" name="nombre" placeholder="Nombre">
        <input type="email" name="correo" placeholder="Correo Electrónico">
        <input type="password" name="contrasena" placeholder="Contraseña">
        <input type="submit" name="registro" value="Registrarse">
    </form>
</body>
</html>
