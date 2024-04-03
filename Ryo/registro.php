<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
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
        }
        .container {
            max-width: 400px;
            padding: 30px;
            background-color: #FFF;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 200px;
        }
        form {
            margin: 0 auto;
            max-width: 300px;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 10px;
            background-color: #FF6347; /* Color rojo */
            color: #FFF;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #FF4500; /* Color naranja oscuro */
        }
        .registro-link {
            text-align: center;
            margin-top: 20px;
            color: #555;
        }
        .registro-link a {
            color: #FF6347;
            text-decoration: none;
        }
        .registro-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="logo">
        <img src="RYO2.png" alt="Logo">
    </div>
    <form action="procesar_login.php" method="post">
        <input type="email" name="correo" placeholder="Correo Electrónico">
        <input type="password" name="contrasena" placeholder="Contraseña">
        <input type="submit" name="login" value="Iniciar Sesión">
    </form>
    <div class="registro-link">
    ¿No tienes una cuenta? <a href="cuenta.php">Regístrate</a>
</div>

</div>

</body>
</html>
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

// Procesamiento del inicio de sesión
if (isset($_POST['login'])) {
    // Captura de datos del formulario
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Escapar caracteres especiales para prevenir inyección SQL
    $correo = mysqli_real_escape_string($enlace, $correo);
    $contrasena = mysqli_real_escape_string($enlace, $contrasena);

    // Consulta SQL para verificar las credenciales del usuario
    $consultaUsuario = "SELECT * FROM cuenta WHERE correo='$correo' AND contrasena='$contrasena'";
    $resultado = mysqli_query($enlace, $consultaUsuario);

    // Verificación de si el usuario existe en la base de datos
    if (mysqli_num_rows($resultado) == 1) {
        // Iniciar sesión
        session_start();
        $_SESSION['correo'] = $correo;

        // Redirigir al usuario a la página principal
        header("Location: index.html");
        exit();
    } else {
        echo "<p>Correo electrónico o contraseña incorrectos. Intenta nuevamente.</p>";
    }
}

// Cierre de la conexión a la base de datos
mysqli_close($enlace);
?>
