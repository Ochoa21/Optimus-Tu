<?php
define('BASE_URL', '/Optimus-TU');

require_once __DIR__ . '/../../config/sesion.php';
if(!isset($_SESSION['correo'])){
    header("Location: " . BASE_URL . "/auth/login.php");
    exit;
}

// Cargamos la base de datos central de universidades
$universidades = require __DIR__ . '/datos_universidades.php';

// Función para generar el mismo slug usado en los nombres de archivo (universidad_<slug>.php)
function slugCiudad($ciudad) {
    $ciudad = trim(explode('(', $ciudad)[0]);
    $ciudad = strtr($ciudad, [
        'á'=>'a','é'=>'e','í'=>'i','ó'=>'o','ú'=>'u','ñ'=>'n',
        'Á'=>'a','É'=>'e','Í'=>'i','Ó'=>'o','Ú'=>'u','Ñ'=>'n'
    ]);
    $ciudad = strtolower($ciudad);
    $ciudad = preg_replace('/[^a-z0-9]+/', '_', $ciudad);
    return trim($ciudad, '_');
}

// Agrupamos por ciudad (usamos la ciudad "limpia", sin aclaraciones entre paréntesis)
$ciudades = [];
foreach ($universidades as $u) {
    $ciudadLimpia = trim(explode('(', $u['ciudad'])[0]);
    if (!isset($ciudades[$ciudadLimpia])) {
        $ciudades[$ciudadLimpia] = 0;
    }
    $ciudades[$ciudadLimpia]++;
}
ksort($ciudades, SORT_LOCALE_STRING);
?>

<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Universidades por Ciudad | Optimus-Tu</title>

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

.header{
text-align:center;
margin-bottom:40px;
}

.header h1{
font-size:56px;
background:linear-gradient(to right,#00e5ff,#ff00cc);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
margin-bottom:15px;
}

.header p{
font-size:18px;
color:#d8d8d8;
max-width:700px;
margin:0 auto;
}

/* BUSCADOR */

.buscador{
max-width:500px;
margin:0 auto 40px auto;
}

.buscador input{
width:100%;
padding:15px 20px;
border-radius:50px;
border:1px solid rgba(255,255,255,.15);
background:rgba(255,255,255,.06);
color:white;
font-size:16px;
outline:none;
}

.buscador input::placeholder{
color:#a8a8a8;
}

/* GRID DE CIUDADES */

.ciudades-grid{
display:grid;
grid-template-columns:repeat(auto-fill,minmax(240px,1fr));
gap:20px;
max-width:1100px;
margin:0 auto;
}

.ciudad-card{
background:rgba(255,255,255,.06);
border:1px solid rgba(255,255,255,.1);
border-radius:24px;
padding:30px 25px;
text-align:center;
text-decoration:none;
color:white;
transition:.3s;
backdrop-filter:blur(10px);
cursor:pointer;
display:block;
}

.ciudad-card:hover{
background:linear-gradient(135deg,#00bfff,#ff00cc);
transform:translateY(-6px) scale(1.03);
}

.ciudad-card .icono{
font-size:36px;
margin-bottom:12px;
}

.ciudad-card h3{
font-size:24px;
margin-bottom:8px;
}

.ciudad-card p{
font-size:14px;
color:#d8d8d8;
}

.ciudad-card:hover p{
color:#fff;
}

.sin-resultados{
text-align:center;
color:#a8a8a8;
font-size:16px;
margin-top:20px;
}

.oculto{
display:none !important;
}

@media(max-width:768px){

.header h1{
font-size:36px;
}

}

</style>

</head>

<body>

<?php require_once __DIR__ . '/../../includes/nav.php'; ?>

<div class="header">
<h1>Universidades por Ciudad</h1>
<p>Selecciona una ciudad de Colombia y descubre todas sus universidades con información completa: carreras, duración, títulos y campo laboral.</p>
</div>

<div class="buscador">
<input type="text" id="buscarCiudad" placeholder="Buscar ciudad..." oninput="filtrarCiudades()">
</div>

<div class="ciudades-grid" id="ciudadesGrid">
<?php foreach ($ciudades as $ciudad => $cantidad): ?>
    <a
      class="ciudad-card"
      data-nombre="<?php echo strtolower($ciudad); ?>"
      href="universidad_<?php echo slugCiudad($ciudad); ?>.php"
    >
      <div class="icono">📍</div>
      <h3><?php echo htmlspecialchars($ciudad); ?></h3>
      <p><?php echo $cantidad; ?> universidad<?php echo $cantidad != 1 ? 'es' : ''; ?></p>
    </a>
<?php endforeach; ?>
</div>

<p class="sin-resultados oculto" id="sinResultados">No se encontró ninguna ciudad con ese nombre.</p>

<script>

function filtrarCiudades(){
    const texto = document.getElementById("buscarCiudad").value.toLowerCase();
    const tarjetas = document.querySelectorAll(".ciudad-card");
    let visibles = 0;

    tarjetas.forEach(t=>{
        const coincide = t.dataset.nombre.includes(texto);
        t.classList.toggle("oculto", !coincide);
        if(coincide) visibles++;
    });

    document.getElementById("sinResultados").classList.toggle("oculto", visibles > 0);
}

</script>

<div style="text-align:center;margin:10px 0 40px;"><a href="<?php echo BASE_URL; ?>/paginas/inicio.php" style="color:#00e5ff;text-decoration:none;font-size:16px;">&larr; Volver al inicio</a></div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>

</body>
</html>
