<?php
define('BASE_URL', '/Optimus-TU');

require_once __DIR__ . '/../../config/sesion.php';
if(!isset($_SESSION['correo'])){
    header("Location: " . BASE_URL . "/auth/login.php");
    exit;
}

// Universidades de Tunja (archivo independiente, generado desde datos_universidades.php)
$universidades = [
    [
        'id' => 'uptc',
        'nombre' => 'Universidad Pedagógica y Tecnológica de Colombia (UPTC)',
        'ciudad' => 'Tunja',
        'tipo' => 'Pública',
        'fundacion' => '1953',
        'web' => 'https://www.uptc.edu.co',
        'descripcion' => 'Universidad pública de Boyacá con amplia oferta en educación, ingeniería y ciencias agropecuarias.',
        'carreras' => [
            [
                'nombre' => 'Ingeniería Metalúrgica',
                'duracion' => '10 semestres',
                'titulo' => 'Ingeniero(a) Metalúrgico(a)',
                'trata' => 'Procesamiento y transformación de materiales metálicos.',
                'campo' => 'Industria minera, siderúrgica y manufactura.',
            ],
        ],
    ],
];
$ciudadSeleccionada = 'Tunja';
?>

<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Universidades en Tunja | Optimus-Tu</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{

background:
linear-gradient(rgba(2,6,23,.92),rgba(2,6,23,.95)),
url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2070&auto=format&fit=crop');

background-size:cover;
background-position:center;
background-attachment:fixed;

min-height:100vh;

padding:40px;

color:white;
}

.volver{
display:inline-flex;
align-items:center;
gap:8px;
text-decoration:none;
color:#d8d8d8;
background:rgba(255,255,255,.08);
padding:10px 22px;
border-radius:50px;
font-size:14px;
margin-bottom:30px;
transition:.3s;
}

.volver:hover{
background:linear-gradient(90deg,#00bfff,#ff00cc);
color:white;
}

.header{
text-align:center;
margin-bottom:45px;
}

.header h1{
font-size:52px;
background:linear-gradient(to right,#00e5ff,#ff00cc);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
margin-bottom:15px;
}

.header p{
font-size:17px;
color:#d8d8d8;
}

.card{
background:rgba(255,255,255,.05);
border:1px solid rgba(255,255,255,.08);
border-radius:30px;
padding:35px;
margin-bottom:35px;
backdrop-filter:blur(12px);
animation:fade .5s ease;
max-width:900px;
margin-left:auto;
margin-right:auto;
}

.uni{
font-size:36px;
margin-bottom:10px;
color:#00e5ff;
}

.uni-meta{
display:flex;
flex-wrap:wrap;
gap:12px;
margin-bottom:20px;
}

.tag{
background:rgba(255,255,255,.08);
padding:6px 14px;
border-radius:50px;
font-size:13px;
color:#d8d8d8;
}

.uni-desc{
font-size:16px;
line-height:1.8;
color:#e8e8e8;
margin-bottom:15px;
}

.uni-web a{
color:#ff00cc;
text-decoration:none;
font-size:15px;
}

.uni-web a:hover{
text-decoration:underline;
}

.carreras-title{
font-size:22px;
margin:30px 0 15px 0;
color:#ff00cc;
border-bottom:1px solid rgba(255,255,255,.1);
padding-bottom:10px;
}

.career{
background:rgba(255,255,255,.04);
padding:25px;
border-radius:20px;
margin-bottom:20px;
}

.career h3{
font-size:26px;
margin-bottom:15px;
color:#ff00cc;
}

.info{
margin-bottom:10px;
font-size:16px;
line-height:1.8;
}

.info strong{
color:#00e5ff;
}

@keyframes fade{
from{
opacity:0;
transform:translateY(20px);
}
to{
opacity:1;
transform:translateY(0);
}
}

@media(max-width:768px){

.header h1{
font-size:34px;
}

.uni{
font-size:26px;
}

.career h3{
font-size:20px;
}

}

</style>

</head>

<body>

<?php require_once __DIR__ . '/../../includes/nav.php'; ?>

<a class="volver" href="universidades.php">← Volver a todas las ciudades</a>

<div class="header">
<h1>Universidades en Tunja</h1>
<p><?php echo count($universidades); ?> universidad<?php echo count($universidades) != 1 ? 'es encontradas' : ' encontrada'; ?> con toda su información: carreras, duración, títulos y campo laboral.</p>
</div>

<?php foreach ($universidades as $u): ?>
<div class="card" id="<?php echo htmlspecialchars($u['id']); ?>">

    <h2 class="uni"><?php echo htmlspecialchars($u['nombre']); ?></h2>

    <div class="uni-meta">
        <span class="tag">📍 <?php echo htmlspecialchars($u['ciudad']); ?></span>
        <span class="tag">🏛️ <?php echo htmlspecialchars($u['tipo']); ?></span>
        <span class="tag">📅 Fundada en <?php echo htmlspecialchars($u['fundacion']); ?></span>
    </div>

    <p class="uni-desc"><?php echo htmlspecialchars($u['descripcion']); ?></p>

    <p class="uni-web">
        <a href="<?php echo htmlspecialchars($u['web']); ?>" target="_blank" rel="noopener">
            🔗 Sitio web oficial
        </a>
    </p>

    <h3 class="carreras-title">Carreras destacadas</h3>

    <?php foreach ($u['carreras'] as $c): ?>
    <div class="career">
        <h3><?php echo htmlspecialchars($c['nombre']); ?></h3>
        <p class="info"><strong>Duración:</strong> <?php echo htmlspecialchars($c['duracion']); ?></p>
        <p class="info"><strong>Título:</strong> <?php echo htmlspecialchars($c['titulo']); ?></p>
        <p class="info"><strong>¿De qué trata?</strong> <?php echo htmlspecialchars($c['trata']); ?></p>
        <p class="info"><strong>Campo laboral:</strong> <?php echo htmlspecialchars($c['campo']); ?></p>
    </div>
    <?php endforeach; ?>

</div>
<?php endforeach; ?>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>

</body>
</html>
