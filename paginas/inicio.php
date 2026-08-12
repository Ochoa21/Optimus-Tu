<!-- inicio.php -->

<?php
define('BASE_URL', '/Optimus-TU');

require_once __DIR__ . '/../config/sesion.php';

if (!isset($_SESSION['correo'])) {
    header("Location: " . BASE_URL . "/auth/login.php");
    exit();
}

$pagina_actual = 'inicio';
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Inicio | Optimus-Tu</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
background:#020617;
color:white;
overflow-x:hidden;
}

.hero{

min-height:calc(100vh - 300px);

background:
linear-gradient(to right,
rgba(0,0,0,.9),
rgba(0,0,0,.45)),
url('https://images.unsplash.com/photo-1498050108023-c5249f4df085?q=80&w=2072&auto=format&fit=crop')
center/cover no-repeat;

padding:30px 70px 70px;
}

.content{

max-width:700px;
margin-top:70px;
}

.content h2{

font-size:90px;
line-height:1;

background:linear-gradient(to right,#00e5ff,#0066ff);

-webkit-background-clip:text;
-webkit-text-fill-color:transparent;

margin-bottom:20px;
}

.content h3{

font-size:70px;
font-style:italic;

margin-bottom:30px;
}

.content p{

font-size:26px;
line-height:1.7;

color:#d5d5d5;

margin-bottom:35px;
}

.content span{
color:#ff00cc;
font-weight:600;
}

.btn{

display:inline-block;

padding:18px 50px;

border-radius:50px;

background:linear-gradient(90deg,#00bfff,#ff00cc);

text-decoration:none;
color:white;

font-size:20px;
font-weight:600;

transition:.3s;
}

.btn:hover{
transform:translateY(-5px);
}

.cards{

margin-top:80px;

display:grid;
grid-template-columns:repeat(3,1fr);

gap:25px;
}

.card{

padding:30px;
border-radius:25px;

background:rgba(255,255,255,.05);

border:1px solid rgba(255,255,255,.1);

backdrop-filter:blur(10px);

transition:.3s;
}

.card:hover{
transform:translateY(-8px);
box-shadow:0 0 25px rgba(0,229,255,.25);
}

.card h4{
font-size:28px;
margin-bottom:10px;
}

.card p{
font-size:18px;
color:#ccc;
}

.card a{
text-decoration:none;
color:white;
}

.cyan{
color:#00e5ff;
}

.pink{
color:#ff00cc;
}

.yellow{
color:#ffd54f;
}

@media(max-width:900px){

.hero{ padding:20px 24px 50px; }

.cards{
grid-template-columns:1fr;
}

.content h2{
font-size:60px;
}

.content h3{
font-size:45px;
}

}

</style>
</head>
<body>

<?php require_once __DIR__ . '/../includes/nav.php'; ?>

<section class="hero">

<div class="content">

<h2>¡TU FUTURO</h2>

<h3>COMIENZA AQUÍ!</h3>

<p>

Explora, <span>Descubre</span> y construye
la carrera perfecta para ti.

</p>

<a href="test.php" class="btn">
Realizar Test
</a>

</div>

<div class="cards">

<div class="card">
<a href="test.php">

<h4 class="yellow">
TEST VOCACIONAL
</h4>

<p>Descubre tu pasión</p>

</a>
</div>

<div class="card">
<a href="<?php echo BASE_URL; ?>/paginas/universidades/universidades.php">

<h4 class="pink">
UNIVERSIDADES
</h4>

<p>Encuentra tu carrera ideal</p>

</a>
</div>

<div class="card">
<a href="becas.php">

<h4 class="cyan">
BECAS Y CURSOS
</h4>

<p>100% online</p>

</a>
</div>

</div>

</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

</body>
</html>
