<?php
define('BASE_URL', '/Optimus-TU');

require_once __DIR__ . '/../config/sesion.php';
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../config/csrf.php';

$error = "";
$token_valido = false;
$usuario_id = null;

// El token puede venir por GET (al abrir el enlace) o por POST (al enviar el formulario)
$token = trim($_GET['token'] ?? $_POST['token'] ?? '');

if ($token === '') {

    $error = "Enlace de recuperación no válido.";

} else {

    $token_hash = hash('sha256', $token);

    $stmt = mysqli_prepare($conexion, "SELECT usuario_id, expira FROM password_resets WHERE token_hash = ? AND usado = 0");
    mysqli_stmt_bind_param($stmt, "s", $token_hash);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $fila = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($stmt);

    if (!$fila) {
        $error = "Este enlace ya fue usado o no es válido. Solicita uno nuevo.";
    } elseif (strtotime($fila['expira']) < time()) {
        $error = "Este enlace ya expiró. Solicita uno nuevo.";
    } else {
        $token_valido = true;
        $usuario_id = $fila['usuario_id'];
    }
}

$mensaje_exito = "";

if ($token_valido && isset($_POST['restablecer'])) {

    if (!csrf_verify()) {

        $error = "Solicitud inválida, por favor intenta de nuevo.";

    } else {

        $clave_nueva     = trim($_POST['clave_nueva'] ?? '');
        $clave_confirmar = trim($_POST['clave_confirmar'] ?? '');

        if ($clave_nueva !== $clave_confirmar) {

            $error = "Las contraseñas no coinciden.";

        } elseif (!preg_match('/^(?=.*\d)(?=.*[\W]).{8,}$/', $clave_nueva)) {

            $error = "La contraseña debe tener mínimo 8 caracteres, un número y un carácter especial.";

        } else {

            $passwordHash = password_hash($clave_nueva, PASSWORD_DEFAULT);

            $stmt_pass = mysqli_prepare($conexion, "UPDATE usuarios SET password = ? WHERE id = ?");
            mysqli_stmt_bind_param($stmt_pass, "si", $passwordHash, $usuario_id);
            mysqli_stmt_execute($stmt_pass);
            mysqli_stmt_close($stmt_pass);

            // Marcar el token como usado para que no se pueda reutilizar
            $token_hash = hash('sha256', $token);
            $stmt_usado = mysqli_prepare($conexion, "UPDATE password_resets SET usado = 1 WHERE token_hash = ?");
            mysqli_stmt_bind_param($stmt_usado, "s", $token_hash);
            mysqli_stmt_execute($stmt_usado);
            mysqli_stmt_close($stmt_usado);

            $token_valido = false; // ya no debe mostrarse de nuevo el formulario
            $mensaje_exito = "Tu contraseña se actualizó correctamente. Ya puedes iniciar sesión.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Restablecer contraseña | Optimus-Tu</title>

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
display:flex;
flex-direction:column;
background:
linear-gradient(rgba(0,0,0,.75),rgba(0,0,0,.75)),
url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=2070&auto=format&fit=crop')
center/cover;
background-attachment:fixed;
}

.wrap{
flex:1;
display:flex;
justify-content:center;
align-items:center;
padding:50px 20px;
}

.login-box{
width:440px;
max-width:100%;
padding:45px;
border-radius:25px;

background:rgba(255,255,255,.06);
border:1px solid rgba(255,255,255,.1);

backdrop-filter:blur(12px);

box-shadow:0 0 40px rgba(0,229,255,.2);

color:white;
}

.logo{
text-align:center;
margin-bottom:24px;
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
margin-bottom:26px;
font-size:26px;
}

.input-box{
margin-bottom:22px;
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
transition:.3s;
}

.btn:hover{
transform:scale(1.03);
}

.error-box{
background:rgba(255,82,82,.12);
border:1px solid rgba(255,82,82,.4);
color:#ff5252;
padding:14px 16px;
border-radius:12px;
font-size:14px;
text-align:center;
margin-bottom:20px;
}

.mensaje-ok{
background:rgba(0,230,118,.12);
border:1px solid rgba(0,230,118,.4);
color:#00e676;
padding:14px 16px;
border-radius:12px;
font-size:14px;
text-align:center;
margin-bottom:20px;
}

.volver{
display:block;
text-align:center;
margin-top:20px;
color:#00e5ff;
text-decoration:none;
font-size:14px;
}

</style>
</head>
<body>

<div class="wrap">
<div class="login-box">

<div class="logo">
<h1>Optimus-Tu</h1>
<p>DESCUBRE TU FUTURO</p>
</div>

<h2>Restablecer contraseña</h2>

<?php if ($error): ?>
    <div class="error-box"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

<?php if ($mensaje_exito): ?>
    <div class="mensaje-ok"><?php echo htmlspecialchars($mensaje_exito); ?></div>
    <a href="login.php" class="volver">Ir a iniciar sesión</a>
<?php elseif ($token_valido): ?>

    <form method="POST">

        <?php echo csrf_field(); ?>
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

        <div class="input-box">
            <input type="password" name="clave_nueva" id="claveNuevaRestablecer" placeholder="Nueva contraseña" required>

            <div class="pw-check" id="pwCheckRestablecer">
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

        <div class="input-box">
            <input type="password" name="clave_confirmar" placeholder="Confirmar nueva contraseña" required>
        </div>

        <button type="submit" name="restablecer" class="btn">Guardar nueva contraseña</button>

    </form>

<?php else: ?>

    <a href="recuperar.php" class="volver">Solicitar un nuevo enlace</a>

<?php endif; ?>

</div>
</div>

<script src="<?php echo BASE_URL; ?>/assets/js/password-check.js"></script>
<script>
    initPasswordChecklist('claveNuevaRestablecer', 'pwCheckRestablecer');
</script>

</body>
</html>
