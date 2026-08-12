<?php
define('BASE_URL', '/Optimus-TU');

require_once __DIR__ . '/../config/sesion.php';
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../config/conexion.php';

// El login guarda el correo en $_SESSION['correo']
if (!isset($_SESSION['correo'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'No has iniciado sesión']);
    exit;
}

$correo = $_SESSION['correo'];
$resultado = $_POST['resultado'] ?? '';

// Solo se aceptan los perfiles que realmente genera el test
$perfilesValidos = ['tecnologia', 'arte', 'salud', 'negocios', 'educacion'];

if (!in_array($resultado, $perfilesValidos, true)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Resultado no válido']);
    exit;
}

// Consulta preparada: evita inyección SQL
$stmt = mysqli_prepare($conexion, "UPDATE usuarios SET resultado = ? WHERE correo = ?");

if (!$stmt) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta']);
    exit;
}

mysqli_stmt_bind_param($stmt, "ss", $resultado, $correo);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode(['success' => true, 'message' => 'Resultado guardado en tu perfil']);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'No se pudo guardar el resultado']);
}

mysqli_stmt_close($stmt);
mysqli_close($conexion);
?>
