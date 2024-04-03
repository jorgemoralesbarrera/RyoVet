// session.js
window.onload = function() {
    fetch('verificar_sesion.php')
        .then(response => response.json())
        .then(data => {
            if (data.autenticado) {
                // Si el usuario está autenticado, mostrar el menú de sesión
                document.getElementById('session-info').style.display = 'block';
                document.getElementById('username').innerText = "Nombre de usuario: " + data.nombreUsuario;
                document.getElementById('email').innerText = "Correo electrónico: " + data.correoUsuario;
            }
        });
};
