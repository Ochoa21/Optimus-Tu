<?php
include('sesion.php');
include('conexion.php');
include('csrf.php');

$mensaje = "";
$enlace_dev = ""; // Solo para desarrollo local, ver nota más abajo

if (isset($_POST['recuperar'])) {

    if (!csrf_verify()) {

        $mensaje = "Solicitud inválida, por favor intenta de nuevo.";

    } else {

        $correo = trim($_POST['correo']);

        $stmt = mysqli_prepare($conexion, "SELECT id FROM usuarios WHERE correo = ?");
        mysqli_stmt_bind_param($stmt, "s", $correo);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        $usuario = mysqli_fetch_assoc($resultado);
        mysqli_stmt_close($stmt);

        // Mensaje genérico siempre igual, exista o no el correo
        // (evita que alguien use este formulario para adivinar qué correos están registrados)
        $mensaje = "Si el correo está registrado, hemos enviado un enlace para restablecer la contraseña.";

        if ($usuario) {

            $token = bin2hex(random_bytes(32));
            $token_hash = hash('sha256', $token);
            $expira = date('Y-m-d H:i:s', time() + 1800); // 30 minutos

            // Invalidar tokens anteriores del usuario que sigan sin usarse
            $stmt_inv = mysqli_prepare($conexion, "UPDATE password_resets SET usado = 1 WHERE usuario_id = ? AND usado = 0");
            mysqli_stmt_bind_param($stmt_inv, "i", $usuario['id']);
            mysqli_stmt_execute($stmt_inv);
            mysqli_stmt_close($stmt_inv);

            $stmt_ins = mysqli_prepare($conexion, "INSERT INTO password_resets (usuario_id, token_hash, expira) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($stmt_ins, "iss", $usuario['id'], $token_hash, $expira);
            mysqli_stmt_execute($stmt_ins);
            mysqli_stmt_close($stmt_ins);

            $enlace = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/restablecer.php?token=" . $token;

            $asunto = "Recupera tu contraseña - Optimus-Tu";
            $cuerpo = "Hola,\n\nRecibimos una solicitud para restablecer tu contraseña en Optimus-Tu.\n"
                    . "Este enlace es válido por 30 minutos:\n\n" . $enlace . "\n\n"
                    . "Si tú no solicitaste esto, puedes ignorar este mensaje.\n";
            $cabeceras = "From: no-responder@optimus-tu.local";

            // mail() requiere un servidor de correo (SMTP) configurado en el servidor.
            // En XAMPP/local normalmente no está configurado, así que esto puede fallar
            // silenciosamente. Ver la nota debajo del formulario para más detalles.
            @mail($correo, $asunto, $cuerpo, $cabeceras);

            // SOLO PARA DESARROLLO LOCAL: si no tienes un servidor de correo configurado,
            // esto te deja probar el flujo mostrando el enlace en pantalla.
            // Bórralo (o dispara la sección) antes de pasar esto a producción.
            $enlace_dev = $enlace;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Recuperar contraseña | Optimus-Tu</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
margin-bottom:14px;
font-size:26px;
}

.login-box .intro{
text-align:center;
color:#cfcfcf;
font-size:14px;
margin-bottom:26px;
line-height:1.6;
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

.input-box input::placeholder{
color:#ccc;
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

.mensaje{
margin-bottom:20px;
padding:14px 16px;
border-radius:12px;
font-size:14px;
text-align:center;
background:rgba(0,230,118,.12);
border:1px solid rgba(0,230,118,.4);
color:#00e676;
}

.dev-box{
margin-top:18px;
padding:14px 16px;
border-radius:12px;
font-size:13px;
background:rgba(255,213,79,.1);
border:1px solid rgba(255,213,79,.35);
color:#ffd54f;
word-break:break-all;
}

.dev-box a{
color:#ffd54f;
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

<h2>Recuperar contraseña</h2>
<p class="intro">Escribe el correo con el que te registraste y te enviaremos un enlace para crear una nueva contraseña.</p>

<?php if ($mensaje): ?>
    <div class="mensaje"><?php echo htmlspecialchars($mensaje); ?></div>
<?php endif; ?>

<?php if ($enlace_dev): ?>
    <div class="dev-box">
        <strong>Modo desarrollo:</strong> como tu servidor local probablemente no tiene configurado el envío de correos, aquí tienes el enlace para que puedas probar el flujo:<br>
        <a href="<?php echo htmlspecialchars($enlace_dev); ?>"><?php echo htmlspecialchars($enlace_dev); ?></a>
        <br><br>
        Quita este bloque (la variable <code>$enlace_dev</code> en recuperar.php) cuando el envío de correos ya esté funcionando en tu servidor.
    </div>
<?php endif; ?>

<form method="POST">

<?php echo csrf_field(); ?>

<div class="input-box">
<input type="email" name="correo" placeholder="Correo electrónico" required>
</div>

<button type="submit" name="recuperar" class="btn">Enviar enlace de recuperación</button>

</form>

<a href="login.php" class="volver">&larr; Volver a iniciar sesión</a>

</div>
</div>

</body>
</html>
