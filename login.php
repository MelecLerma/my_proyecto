<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar']) && $_POST['enviar'] === 'si') {
    $correo = filter_var($_POST['usu_correo'], FILTER_SANITIZE_EMAIL);
    $pass = htmlspecialchars($_POST['usu_pass']);

    // Validación básica
    if (filter_var($correo, FILTER_VALIDATE_EMAIL) && strlen($pass) >= 4) {
        // Aquí conectarías con tu base de datos (ejemplo)
        $usuarioValido = ($correo === "admin@tecnogamer.com" && $pass === "1234");

        if ($usuarioValido) {
            $_SESSION['usuario'] = $correo;
            header('Location: index.html');
            exit();
        } else {
            echo "<script>alert('Credenciales incorrectas'); window.location='index.html';</script>";
        }
    } else {
        echo "<script>alert('Correo o contraseña inválidos'); window.location='index.html';</script>";
    }
} else {
    header('Location: index.html');
    exit();
}
?>