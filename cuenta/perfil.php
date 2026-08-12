<?php
define('BASE_URL', '/Optimus-TU');

require_once __DIR__ . '/../config/sesion.php';
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../config/csrf.php';

// Proteger la página: si no hay sesión iniciada, redirige al login
if (!isset($_SESSION['id'])) {
    header("Location: " . BASE_URL . "/auth/login.php");
    exit();
}

$es_admin = (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin');
$pagina_actual = 'perfil';

// ================================
// PROCESAR ACTUALIZACIÓN DE PERFIL (usuarios normales)
// ================================
$mensaje = "";
$tipo_mensaje = ""; // "ok" o "error"

if (!$es_admin && isset($_POST['actualizar'])) {

    if (!csrf_verify()) {

        $mensaje = "Solicitud inválida, por favor recarga la página e intenta de nuevo.";
        $tipo_mensaje = "error";

    } else {

        $primer_nombre    = trim($_POST['primer_nombre'] ?? '');
        $segundo_nombre   = trim($_POST['segundo_nombre'] ?? '');
        $primer_apellido  = trim($_POST['primer_apellido'] ?? '');
        $segundo_apellido = trim($_POST['segundo_apellido'] ?? '');
        $id_usuario = $_SESSION['id'];

        if ($primer_nombre === '' || $primer_apellido === '') {

            $mensaje = "El primer nombre y el primer apellido son obligatorios.";
            $tipo_mensaje = "error";

        } else {

            // Solo se actualiza el nombre. Correo y teléfono no se pueden modificar.
            $sql_update = "UPDATE usuarios SET primer_nombre=?, segundo_nombre=?, primer_apellido=?, segundo_apellido=? WHERE id=?";
            $stmt = mysqli_prepare($conexion, $sql_update);
            mysqli_stmt_bind_param($stmt, "ssssi", $primer_nombre, $segundo_nombre, $primer_apellido, $segundo_apellido, $id_usuario);

            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['nombre'] = trim(implode(' ', array_filter([
                    $primer_nombre, $segundo_nombre, $primer_apellido, $segundo_apellido
                ])));
                $mensaje = "Perfil actualizado correctamente.";
                $tipo_mensaje = "ok";
            } else {
                $mensaje = "Ocurrió un error al actualizar el perfil.";
                $tipo_mensaje = "error";
            }
            mysqli_stmt_close($stmt);

            // Si el usuario quiere cambiar la contraseña
            $clave_actual = trim($_POST['clave_actual'] ?? '');
            $clave_nueva  = trim($_POST['clave_nueva'] ?? '');

            if (!empty($clave_nueva) || !empty($clave_actual)) {

                if (empty($clave_actual) || empty($clave_nueva)) {
                    $mensaje .= " Debes escribir tu contraseña actual y la nueva contraseña.";
                    $tipo_mensaje = "error";
                } else {
                    // Traer el hash actual del usuario
                    $sql_check = "SELECT password FROM usuarios WHERE id=?";
                    $stmt_check = mysqli_prepare($conexion, $sql_check);
                    mysqli_stmt_bind_param($stmt_check, "i", $id_usuario);
                    mysqli_stmt_execute($stmt_check);
                    $res_check = mysqli_stmt_get_result($stmt_check);
                    $fila = mysqli_fetch_assoc($res_check);
                    mysqli_stmt_close($stmt_check);

                    if (!$fila || !password_verify($clave_actual, $fila['password'])) {
                        $mensaje .= " La contraseña actual no es correcta.";
                        $tipo_mensaje = "error";
                    } elseif (!preg_match('/^(?=.*\d)(?=.*[\W]).{8,}$/', $clave_nueva)) {
                        $mensaje .= " La nueva contraseña debe tener mínimo 8 caracteres, un número y un carácter especial.";
                        $tipo_mensaje = "error";
                    } else {
                        $passwordHash = password_hash($clave_nueva, PASSWORD_DEFAULT);
                        $sql_pass = "UPDATE usuarios SET password=? WHERE id=?";
                        $stmt_pass = mysqli_prepare($conexion, $sql_pass);
                        mysqli_stmt_bind_param($stmt_pass, "si", $passwordHash, $id_usuario);
                        mysqli_stmt_execute($stmt_pass);
                        mysqli_stmt_close($stmt_pass);
                        $mensaje .= " Contraseña actualizada.";
                        $tipo_mensaje = "ok";
                    }
                }
            }
        }
    }
}

// Traer los datos actuales del usuario (para mostrarlos, incluso tras el POST)
$usuario = null;
if (!$es_admin) {
    $id_usuario = $_SESSION['id'];
    $sql = "SELECT * FROM usuarios WHERE id=?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_usuario);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $usuario = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($stmt);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mi Perfil | Optimus-Tu</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/password-check.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
min-height:100vh;
background:#020617;
color:white;
}

.wrap{
display:flex;
justify-content:center;
padding:60px 20px;
}

.login-box{
width:520px;
max-width:100%;
padding:45px;
border-radius:25px;

background:rgba(255,255,255,.06);
border:1px solid rgba(255,255,255,.1);

backdrop-filter:blur(12px);

box-shadow:0 0 40px rgba(0,229,255,.2);
}

.logo{
text-align:center;
margin-bottom:20px;
}

.logo h1{
font-size:42px;
font-weight:700;
background:linear-gradient(to right,#00e5ff,#ff00d4);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
}

.logo p{
color:#d8d8d8;
font-size:14px;
letter-spacing:2px;
}

.login-box h2{
text-align:center;
margin-bottom:25px;
font-size:28px;
}

.volver{
display:block;
text-align:center;
margin-bottom:20px;
color:#00e5ff;
text-decoration:none;
font-size:14px;
}

label{
display:block;
font-size:14px;
color:#cfcfcf;
margin-bottom:6px;
margin-top:18px;
}

.fila-doble{
display:flex;
gap:16px;
}

.fila-doble .input-box{
flex:1;
}

.input-box input{
width:100%;
padding:16px;
border:none;
outline:none;
border-radius:14px;

background:rgba(255,255,255,.08);
color:white;
font-size:16px;
}

.input-box input::placeholder{
color:#ccc;
}

.input-box input:disabled{
background:rgba(255,255,255,.03);
color:#9a9a9a;
cursor:not-allowed;
}

small.hint{
display:block;
margin-top:6px;
color:#9a9a9a;
font-size:12px;
}

.btn{
width:100%;
padding:16px;
border:none;
border-radius:50px;

background:linear-gradient(90deg,#00bfff,#ff00cc);

color:white;
font-size:18px;
font-weight:600;
cursor:pointer;
margin-top:28px;

transition:.3s;
}

.btn:hover{
transform:scale(1.03);
}

.mensaje{
margin-top:18px;
padding:14px 16px;
border-radius:12px;
font-size:14px;
text-align:center;
}

.mensaje.ok{
background:rgba(0,230,118,.12);
border:1px solid rgba(0,230,118,.4);
color:#00e676;
}

.mensaje.error{
background:rgba(255,82,82,.12);
border:1px solid rgba(255,82,82,.4);
color:#ff5252;
}

.resultado-box{
margin-top:24px;
padding:16px 18px;
border-radius:14px;
background:rgba(255,255,255,.04);
border:1px solid rgba(255,255,255,.08);
font-size:15px;
}

.resultado-box strong{
color:#00e5ff;
}

/* TABLA ADMIN */

.admin-wrap{
width:100%;
max-width:1000px;
margin:0 auto;
padding:0 20px 60px;
}

.admin-wrap h2{
margin-bottom:20px;
background:linear-gradient(to right,#00e5ff,#ff00cc);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
font-size:32px;
}

table{
width:100%;
border-collapse:collapse;
background:rgba(255,255,255,.05);
border-radius:15px;
overflow:hidden;
}

th, td{
padding:14px 16px;
text-align:left;
border-bottom:1px solid rgba(255,255,255,.08);
}

th{
background:rgba(255,255,255,.06);
color:#00e5ff;
}

.btn-eliminar{
background:none;
border:none;
color:#ff5252;
cursor:pointer;
font-size:14px;
text-decoration:underline;
font-family:inherit;
padding:0;
}

@media(max-width:520px){
.fila-doble{ flex-direction:column; gap:0; }
}

</style>
</head>
<body>

<?php require_once __DIR__ . '/../includes/nav.php'; ?>

<?php if ($es_admin): ?>

<div class="admin-wrap" style="padding-top:50px;">
    <h2>Usuarios</h2>

    <table>
    <tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Correo</th>
    <th>Resultado</th>
    <th>Acción</th>
    </tr>

    <?php
    $res = mysqli_query($conexion, "SELECT * FROM usuarios");
    while($row = mysqli_fetch_array($res)){
        $nombre_fila = trim(implode(' ', array_filter([
            $row['primer_nombre'], $row['segundo_nombre'], $row['primer_apellido'], $row['segundo_apellido']
        ])));
    ?>
    <tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo htmlspecialchars($nombre_fila); ?></td>
    <td><?php echo htmlspecialchars($row['correo']); ?></td>
    <td><?php echo htmlspecialchars($row['resultado'] ?? ''); ?></td>
    <td>
        <form method="POST" action="eliminar.php" style="display:inline;" onsubmit="return confirm('¿Eliminar este usuario?');">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <button type="submit" class="btn-eliminar">Eliminar</button>
        </form>
    </td>
    </tr>
    <?php } ?>
    </table>
</div>

<?php else: ?>

<div class="wrap">
<div class="login-box">

    <div class="logo">
        <h1>Optimus-Tu</h1>
        <p>DESCUBRE TU FUTURO</p>
    </div>

    <h2>Mi Perfil</h2>

    <?php if ($mensaje): ?>
        <div class="mensaje <?php echo $tipo_mensaje === 'error' ? 'error' : 'ok'; ?>">
            <?php echo htmlspecialchars(trim($mensaje)); ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <?php echo csrf_field(); ?>

        <div class="fila-doble">
            <div class="input-box">
                <label>Primer nombre *</label>
                <input type="text" name="primer_nombre" value="<?php echo htmlspecialchars($usuario['primer_nombre']); ?>" required>
            </div>
            <div class="input-box">
                <label>Segundo nombre</label>
                <input type="text" name="segundo_nombre" value="<?php echo htmlspecialchars($usuario['segundo_nombre'] ?? ''); ?>">
            </div>
        </div>

        <div class="fila-doble">
            <div class="input-box">
                <label>Primer apellido *</label>
                <input type="text" name="primer_apellido" value="<?php echo htmlspecialchars($usuario['primer_apellido']); ?>" required>
            </div>
            <div class="input-box">
                <label>Segundo apellido</label>
                <input type="text" name="segundo_apellido" value="<?php echo htmlspecialchars($usuario['segundo_apellido'] ?? ''); ?>">
            </div>
        </div>

        <label>Teléfono</label>
        <div class="input-box">
            <input type="text" value="<?php echo htmlspecialchars($usuario['telefono']); ?>" disabled>
        </div>

        <label>Correo electrónico</label>
        <div class="input-box">
            <input type="email" value="<?php echo htmlspecialchars($usuario['correo']); ?>" disabled>
        </div>

        <label>Contraseña actual</label>
        <div class="input-box">
            <input type="password" name="clave_actual" placeholder="Solo si vas a cambiar la contraseña">
        </div>

        <label>Nueva contraseña</label>
        <div class="input-box">
            <input type="password" name="clave_nueva" id="claveNuevaPerfil" placeholder="Nueva contraseña">
            <small class="hint">Deja ambos campos de contraseña vacíos si no quieres cambiarla.</small>

            <div class="pw-check" id="pwCheckPerfil">
                <div class="pw-check-item bad" data-rule="len">
                    <span class="pw-label">Mínimo 8 caracteres</span>
                    <span class="pw-status">✗</span>
                </div>
                <div class="pw-check-item bad" data-rule="num">
                    <span class="pw-label">Algún número</span>
                    <span class="pw-status">✗</span>
                </div>
                <div class="pw-check-item bad" data-rule="esp">
                    <span class="pw-label">Algún carácter especial</span>
                    <span class="pw-status">✗</span>
                </div>
            </div>
        </div>

        <div class="resultado-box">
            <strong>Resultado del test:</strong>
            <?php echo htmlspecialchars($usuario['resultado'] ?? 'Sin resultado aún'); ?>
        </div>

        <button type="submit" name="actualizar" class="btn">Guardar cambios</button>

    </form>

</div>
</div>

<?php endif; ?>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

<script src="<?php echo BASE_URL; ?>/assets/js/password-check.js"></script>
<script>
    initPasswordChecklist('claveNuevaPerfil', 'pwCheckPerfil');
</script>

</body>
</html>
