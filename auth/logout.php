<?php
define('BASE_URL', '/Optimus-TU');

require_once __DIR__ . '/../config/sesion.php';

// Vaciar todas las variables de sesión
$_SESSION = [];

// Borrar la cookie de sesión del navegador
if (ini_get("session.use_cookies")) {
    $parametros = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $parametros["path"],
        $parametros["domain"],
        $parametros["secure"],
        $parametros["httponly"]
    );
}

session_destroy();

// REDIRECCIONAR AL LOGIN
header("Location: login.php");
exit();

?>
