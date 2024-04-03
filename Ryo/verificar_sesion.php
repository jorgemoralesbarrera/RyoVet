<?php
session_start();

if (isset($_SESSION['correo'])) {
    // Si hay una sesión iniciada, devolver los datos de sesión
    $response = array(
        'autenticado' => true,
        'nombreUsuario' => $_SESSION['nombre'],
        'correoUsuario' => $_SESSION['correo']
    );
} else {
    // Si no hay sesión iniciada, devolver que el usuario no está autenticado
    $response = array('autenticado' => false);
}

header('Content-Type: application/json');
echo json_encode($response);
?>
