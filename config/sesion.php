<?php
// sesion.php
// Configuración centralizada y segura de la sesión.
// Incluir este archivo en vez de llamar session_start() directamente.

if (session_status() === PHP_SESSION_NONE) {

    $parametros_cookie = session_get_cookie_params();

    session_set_cookie_params([
        'lifetime' => $parametros_cookie['lifetime'],
        'path'     => '/',
        'domain'   => $parametros_cookie['domain'],
        'secure'   => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'httponly' => true,   // JS no puede leer la cookie de sesión (mitiga robo por XSS)
        'samesite' => 'Lax'   // Mitiga CSRF básico
    ]);

    session_start();
}
?>
