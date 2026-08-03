<?php
$conexion = mysqli_connect("localhost", "root", "", "sistema_sena");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Charset seguro (evita problemas de inyección relacionados con codificación)
mysqli_set_charset($conexion, "utf8mb4");

// A partir de aquí, cualquier error de mysqli lanza una excepción en vez de
// fallar en silencio (más fácil de detectar problemas durante el desarrollo).
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
?>
