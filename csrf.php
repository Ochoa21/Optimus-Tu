<?php
// csrf.php
// Helpers para proteger formularios contra CSRF.
// Requiere que la sesión ya esté iniciada (incluir sesion.php antes que este archivo).

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Imprime un campo oculto con el token para incluir dentro de un <form>
function csrf_field() {
    return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($_SESSION['csrf_token']) . '">';
}

// Verifica el token recibido por POST contra el guardado en sesión
function csrf_verify() {
    return isset($_POST['csrf_token'])
        && isset($_SESSION['csrf_token'])
        && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']);
}
?>
