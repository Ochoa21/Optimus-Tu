<?php
include('sesion.php');

if (!isset($_SESSION['correo'])) {
    header("Location: login.php");
    exit();
}

$pagina_actual = 'becas';
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Becas | Optimus-Tu</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
*{ margin:0; padding:0; box-sizing:border-box; font-family:'Poppins',sans-serif; }
body{ background:#020617; color:white; min-height:100vh; }
.wrap{ max-width:900px; margin:0 auto; padding:50px 24px 70px; }
.wrap h1{
    font-size:42px;
    margin-bottom:30px;
    background:linear-gradient(to right,#00e5ff,#ff00cc);
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}
.beca{
    background:rgba(255,255,255,.05);
    border:1px solid rgba(255,255,255,.08);
    border-radius:20px;
    padding:28px 30px;
    margin-bottom:22px;
}
.beca h2{ font-size:24px; color:#00e5ff; margin-bottom:10px; }
.beca p{ font-size:16px; line-height:1.7; color:#d5d5d5; }
.volver{
    display:inline-block;
    margin-top:20px;
    color:#00e5ff;
    text-decoration:none;
    font-size:16px;
}
</style>
</head>
<body>

<?php include('nav.php'); ?>

<div class="wrap">

<h1>Becas y Cursos</h1>

<div class="beca">
<h2>Sapiencia</h2>
<p>Financia estudios con créditos condonables para jóvenes de Medellín.</p>
</div>

<div class="beca">
<h2>ICETEX</h2>
<p>Créditos educativos a nivel nacional para educación técnica, tecnológica y universitaria.</p>
</div>

<div class="beca">
<h2>Matrícula Cero</h2>
<p>Programa que permite estudiar en universidades públicas de forma gratuita.</p>
</div>

<a href="inicio.php" class="volver">&larr; Volver al inicio</a>

</div>

<?php include('footer.php'); ?>

</body>
</html>
