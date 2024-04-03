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
        input[type="password"],
        input[type="text"] {
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
        // Redirigir a la página de registro
        header("Location: registro.php");
        exit(); // Asegurarse de que el script se detenga después de redirigir
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
        /* Aquí van tus estilos adicionales */
    </style>
</head>
<body>
    <!-- Contenido HTML del formulario de registro -->
    <div class="container">
        <h2>Registro de Usuario</h2>
        <form action="" method="post">
            <input type="text" name="nombre" placeholder="Nombre">
            <input type="email" name="correo" placeholder="Correo Electrónico">
            <input type="password" name="contrasena" placeholder="Contraseña">
            <input type="submit" name="registro" value="Registrarse">
        </form>
    </div>
</body>
</html>