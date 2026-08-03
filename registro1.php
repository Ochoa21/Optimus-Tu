<?php
include("sesion.php");
include("conexion.php");
include("csrf.php");

$error = "";

if (isset($_POST['registrar'])) {

    if (!csrf_verify()) {
        $error = "Solicitud inválida, por favor intenta de nuevo.";
    } else {

        $nombre_completo = trim($_POST['nombre']);
        $telefono = trim($_POST['celular']);
        $correo = trim($_POST['correo']);
        $password = trim($_POST['clave']);

        // VALIDAR CONTRASEÑA
        if (!preg_match('/^(?=.*[\W]).{8,}$/', $password)) {

            $error = "La contraseña debe tener mínimo 8 caracteres y al menos un carácter especial.";

        } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {

            $error = "El correo electrónico no es válido.";

        } else {

            // VERIFICAR SI EL CORREO YA EXISTE (consulta preparada)
            $sql_verificar = "SELECT id FROM usuarios WHERE correo = ?";
            $stmt_verificar = mysqli_prepare($conexion, $sql_verificar);
            mysqli_stmt_bind_param($stmt_verificar, "s", $correo);
            mysqli_stmt_execute($stmt_verificar);
            mysqli_stmt_store_result($stmt_verificar);

            if (mysqli_stmt_num_rows($stmt_verificar) > 0) {

                $error = "Este correo ya está registrado.";
                mysqli_stmt_close($stmt_verificar);

            } else {

                mysqli_stmt_close($stmt_verificar);

                // ENCRIPTAR CONTRASEÑA
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                // INSERTAR USUARIO (consulta preparada, rol por defecto "usuario")
                $sql_insertar = "INSERT INTO usuarios (nombre_completo, telefono, correo, password, rol) VALUES (?, ?, ?, ?, 'usuario')";
                $stmt_insertar = mysqli_prepare($conexion, $sql_insertar);
                mysqli_stmt_bind_param($stmt_insertar, "ssss", $nombre_completo, $telefono, $correo, $passwordHash);
                $guardar = mysqli_stmt_execute($stmt_insertar);
                mysqli_stmt_close($stmt_insertar);

                if ($guardar) {
                    header("Location: login.php?registrado=1");
                    exit();
                } else {
                    $error = "Error al registrar. Intenta de nuevo.";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Registro | Optimus-Tu</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{

height:100vh;

display:flex;
justify-content:center;
align-items:center;

background:
linear-gradient(rgba(0,0,0,.82),rgba(0,0,0,.82)),
url('https://images.unsplash.com/photo-1498050108023-c5249f4df085?q=80&w=2072&auto=format&fit=crop')
center/cover no-repeat;

overflow:hidden;
}

.container{

width:460px;

padding:45px;

border-radius:30px;

background:rgba(255,255,255,.06);

border:1px solid rgba(255,255,255,.1);

backdrop-filter:blur(12px);

box-shadow:0 0 40px rgba(0,229,255,.18);

color:white;
}

.logo{

text-align:center;
margin-bottom:25px;
}

.logo h1{

font-size:42px;

background:linear-gradient(to right,#00e5ff,#ff00cc);

-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
}

.logo p{

font-size:13px;
letter-spacing:2px;
color:#00e5ff;
}

.container h2{

text-align:center;
margin-bottom:30px;
font-size:30px;
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

small{
color:#cfcfcf;
font-size:13px;
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
margin-top:18px;
transition:.3s;
}

.btn:hover{
transform:scale(1.03);
}

.login{
text-align:center;
margin-top:22px;
}

.login a{
color:#00e5ff;
text-decoration:none;
}

</style>

</head>

<body>

<div class="container">

<div class="logo">

<h1>Optimus-Tu</h1>
<p>DESCUBRE TU FUTURO</p>

</div>

<h2>Crear Cuenta</h2>

<?php if ($error): ?>
    <div class="error-box"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

<form method="POST">

<?php echo csrf_field(); ?>

<div class="input-box">
<input
type="text"
name="nombre"
placeholder="Nombre completo"
value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>"
required>
</div>

<div class="input-box">
<input
type="tel"
name="celular"
placeholder="Número de teléfono"
value="<?php echo isset($_POST['celular']) ? htmlspecialchars($_POST['celular']) : ''; ?>"
required>
</div>

<div class="input-box">
<input
type="email"
name="correo"
placeholder="Correo electrónico"
value="<?php echo isset($_POST['correo']) ? htmlspecialchars($_POST['correo']) : ''; ?>"
required>
</div>

<div class="input-box">
<input
type="password"
name="clave"
placeholder="Contraseña"
required>

<small>
Mínimo 8 caracteres y un carácter especial.
</small>

</div>

<button
type="submit"
name="registrar"
class="btn">
Registrarse
</button>

</form>

<div class="login">
¿Ya tienes cuenta?
<a href="login.php">Inicia sesión</a>
</div>

</div>

</body>
</html>
