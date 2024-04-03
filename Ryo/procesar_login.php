<?php
// Iniciar la sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si se ha enviado el formulario de inicio de sesión
if (isset($_POST['login'])) {
    // Conexión a la base de datos
    $servidor = "localhost";
    $usuario = "root";
    $clave = "";
    $baseDeDatos = "veterinaria";

    $enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);

    if (!$enlace) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Capturar los datos del formulario
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Escapar caracteres especiales para prevenir inyección SQL
    $correo = mysqli_real_escape_string($enlace, $correo);
    $contrasena = mysqli_real_escape_string($enlace, $contrasena);

    // Consulta SQL para verificar las credenciales del usuario
    $consultaUsuario = "SELECT * FROM cuenta WHERE correo='$correo' AND contrasena='$contrasena'";
    $resultado = mysqli_query($enlace, $consultaUsuario);

    // Verificar si el usuario existe en la base de datos
    if (mysqli_num_rows($resultado) == 1) {
        // Iniciar sesión
        $_SESSION['correo'] = $correo;

        // Redirigir al usuario a la página principal
        header("Location: index.html");
        exit();
    } else {
        // Si las credenciales son incorrectas, mostrar un mensaje de error
        $error_message = "Correo electrónico o contraseña incorrectos. Intenta nuevamente.";
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($enlace);
} else {
    // Si se intenta acceder a este archivo directamente sin enviar el formulario, redirigir al inicio de sesión
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error de inicio de sesión</title>
    <style>
        body {
            background-color: #FFA500; /* Color naranja */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #FF6347; /* Color rojo */
        }
        .container {
            max-width: 400px;
            padding: 30px;
            text-align: center;
        }
        .logo img {
            max-width: 200px;
            margin-bottom: 20px;
        }
        .error-message {
            font-size: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="logo">
        <img src="RYO2.png" alt="Logo de RYO">
    </div>
    <div class="error-message">
        <?php echo isset($error_message) ? $error_message : ""; ?>
    </div>
    <div class="registro-link">
        ¿No tienes una cuenta? <a href="cuenta.php">Regístrate</a>
    </div>
</div>
</body>
</html>
