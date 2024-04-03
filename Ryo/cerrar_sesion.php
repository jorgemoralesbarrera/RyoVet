<?php
session_start();
session_destroy();
header("Location: registro.php"); // Redirige a la página de registro después de cerrar sesión
?>
