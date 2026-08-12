<?php
define('BASE_URL', '/Optimus-TU');

require_once __DIR__ . '/../config/sesion.php';
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../config/csrf.php';

// Solo el administrador puede eliminar usuarios
if (!isset($_SESSION['id']) || !isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: " . BASE_URL . "/auth/login.php");
    exit();
}

// Solo se acepta por POST (evita borrados vía enlace/GET, más resistente a CSRF)
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id'])) {
    header("Location: perfil.php");
    exit();
}

if (!csrf_verify()) {
    header("Location: perfil.php");
    exit();
}

$id = intval($_POST['id']);

// Un admin no puede eliminarse a sí mismo por error
if ($id !== intval($_SESSION['id'])) {

    $sql = "DELETE FROM usuarios WHERE id=?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

header("Location: perfil.php");
exit();
?>
