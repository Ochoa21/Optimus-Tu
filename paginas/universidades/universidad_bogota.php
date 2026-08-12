<?php
define('BASE_URL', '/Optimus-TU');

require_once __DIR__ . '/../../config/sesion.php';
if(!isset($_SESSION['correo'])){
    header("Location: " . BASE_URL . "/auth/login.php");
    exit;
}

// Universidades de Bogotá (archivo independiente, generado desde datos_universidades.php)
$universidades = [
    [
        'id' => 'unal-bogota',
        'nombre' => 'Universidad Nacional de Colombia (Sede Bogotá)',
        'ciudad' => 'Bogotá',
        'tipo' => 'Pública',
        'fundacion' => '1867',
        'web' => 'https://www.unal.edu.co',
        'descripcion' => 'La universidad pública más importante del país, con la mayor oferta académica e investigativa a nivel nacional.',
        'carreras' => [
            [
                'nombre' => 'Ingeniería de Sistemas',
                'duracion' => '10 semestres',
                'titulo' => 'Ingeniero(a) de Sistemas',
                'trata' => 'Desarrollo de software, inteligencia artificial y sistemas tecnológicos.',
                'campo' => 'Empresas tecnológicas, desarrollo web y ciberseguridad.',
            ],
            [
                'nombre' => 'Psicología',
                'duracion' => '10 semestres',
                'titulo' => 'Psicólogo(a)',
                'trata' => 'Comportamiento humano, emociones y salud mental.',
                'campo' => 'Hospitales, colegios, empresas y consultorios.',
            ],
        ],
    ],
    [
        'id' => 'andes',
        'nombre' => 'Universidad de los Andes',
        'ciudad' => 'Bogotá',
        'tipo' => 'Privada',
        'fundacion' => '1948',
        'web' => 'https://uniandes.edu.co',
        'descripcion' => 'Una de las universidades privadas más prestigiosas y costosas de Colombia, reconocida a nivel internacional en negocios, ingeniería y derecho.',
        'carreras' => [
            [
                'nombre' => 'Administración de Empresas',
                'duracion' => '9 semestres',
                'titulo' => 'Administrador(a)',
                'trata' => 'Liderazgo, finanzas y gestión empresarial.',
                'campo' => 'Empresas, marketing y emprendimiento.',
            ],
            [
                'nombre' => 'Derecho',
                'duracion' => '10 semestres',
                'titulo' => 'Abogado(a)',
                'trata' => 'Estudio de leyes, justicia y normas sociales.',
                'campo' => 'Firmas de abogados, litigio y sector público.',
            ],
        ],
    ],
    [
        'id' => 'javeriana',
        'nombre' => 'Pontificia Universidad Javeriana',
        'ciudad' => 'Bogotá',
        'tipo' => 'Privada',
        'fundacion' => '1623',
        'web' => 'https://www.javeriana.edu.co',
        'descripcion' => 'Universidad privada de tradición jesuita, una de las más antiguas de América, con fuerte oferta en salud, comunicación y humanidades.',
        'carreras' => [
            [
                'nombre' => 'Comunicación Social',
                'duracion' => '8 semestres',
                'titulo' => 'Comunicador(a) Social',
                'trata' => 'Medios de comunicación, periodismo y producción audiovisual.',
                'campo' => 'Televisión, radio y medios digitales.',
            ],
            [
                'nombre' => 'Medicina',
                'duracion' => '12 semestres',
                'titulo' => 'Médico(a)',
                'trata' => 'Diagnóstico y tratamiento de enfermedades.',
                'campo' => 'Hospitales, clínicas y salud pública.',
            ],
        ],
    ],
    [
        'id' => 'rosario',
        'nombre' => 'Universidad del Rosario',
        'ciudad' => 'Bogotá',
        'tipo' => 'Privada',
        'fundacion' => '1653',
        'web' => 'https://www.urosario.edu.co',
        'descripcion' => 'Una de las universidades más antiguas de Colombia, con gran prestigio en derecho, medicina y ciencias políticas.',
        'carreras' => [
            [
                'nombre' => 'Derecho',
                'duracion' => '10 semestres',
                'titulo' => 'Abogado(a)',
                'trata' => 'Estudio de leyes, justicia y normatividad.',
                'campo' => 'Juzgados, empresas y sector público.',
            ],
        ],
    ],
    [
        'id' => 'externado',
        'nombre' => 'Universidad Externado de Colombia',
        'ciudad' => 'Bogotá',
        'tipo' => 'Privada',
        'fundacion' => '1886',
        'web' => 'https://www.uexternado.edu.co',
        'descripcion' => 'Reconocida especialmente por sus programas de derecho, ciencias políticas y economía.',
        'carreras' => [
            [
                'nombre' => 'Ciencia Política',
                'duracion' => '8 semestres',
                'titulo' => 'Politólogo(a)',
                'trata' => 'Análisis de sistemas políticos, gobierno y políticas públicas.',
                'campo' => 'Entidades públicas, ONG y organismos internacionales.',
            ],
        ],
    ],
    [
        'id' => 'unimilitar',
        'nombre' => 'Universidad Militar Nueva Granada',
        'ciudad' => 'Bogotá',
        'tipo' => 'Pública',
        'fundacion' => '1938',
        'web' => 'https://www.umng.edu.co',
        'descripcion' => 'Universidad pública adscrita al Ministerio de Defensa, con oferta académica abierta al público civil además de personal militar.',
        'carreras' => [
            [
                'nombre' => 'Relaciones Internacionales y Estudios Políticos',
                'duracion' => '9 semestres',
                'titulo' => 'Profesional en Relaciones Internacionales',
                'trata' => 'Análisis de política exterior, diplomacia y seguridad internacional.',
                'campo' => 'Cancillería, organismos internacionales y sector diplomático.',
            ],
        ],
    ],
    [
        'id' => 'distrital',
        'nombre' => 'Universidad Distrital Francisco José de Caldas',
        'ciudad' => 'Bogotá',
        'tipo' => 'Pública',
        'fundacion' => '1948',
        'web' => 'https://www.udistrital.edu.co',
        'descripcion' => 'Universidad pública de Bogotá reconocida por su fuerte oferta en ingenierías, educación y artes, con matrícula muy accesible.',
        'carreras' => [
            [
                'nombre' => 'Ingeniería Electrónica',
                'duracion' => '10 semestres',
                'titulo' => 'Ingeniero(a) Electrónico(a)',
                'trata' => 'Diseño de sistemas electrónicos, telecomunicaciones y automatización.',
                'campo' => 'Empresas de tecnología, telecomunicaciones e industria.',
            ],
        ],
    ],
    [
        'id' => 'santotomas',
        'nombre' => 'Universidad Santo Tomás',
        'ciudad' => 'Bogotá',
        'tipo' => 'Privada',
        'fundacion' => '1580',
        'web' => 'https://www.usta.edu.co',
        'descripcion' => 'Una de las universidades más antiguas de Colombia, de tradición dominica, con amplia oferta en derecho, ingeniería y ciencias sociales.',
        'carreras' => [
            [
                'nombre' => 'Derecho',
                'duracion' => '10 semestres',
                'titulo' => 'Abogado(a)',
                'trata' => 'Formación jurídica integral con enfoque humanista.',
                'campo' => 'Juzgados, litigio, sector público y privado.',
            ],
        ],
    ],
    [
        'id' => 'sergioarboleda',
        'nombre' => 'Universidad Sergio Arboleda',
        'ciudad' => 'Bogotá',
        'tipo' => 'Privada',
        'fundacion' => '1965',
        'web' => 'https://www.usergioarboleda.edu.co',
        'descripcion' => 'Universidad privada reconocida por sus programas de derecho, comunicación, negocios y relaciones internacionales.',
        'carreras' => [
            [
                'nombre' => 'Periodismo',
                'duracion' => '8 semestres',
                'titulo' => 'Periodista',
                'trata' => 'Investigación, redacción y producción de contenido informativo.',
                'campo' => 'Medios de comunicación, prensa y medios digitales.',
            ],
        ],
    ],
    [
        'id' => 'sabana',
        'nombre' => 'Universidad de La Sabana',
        'ciudad' => 'Bogotá (Chía)',
        'tipo' => 'Privada',
        'fundacion' => '1979',
        'web' => 'https://www.unisabana.edu.co',
        'descripcion' => 'Universidad privada de alta calidad ubicada en las afueras de Bogotá, reconocida por su enfoque en formación integral.',
        'carreras' => [
            [
                'nombre' => 'Enfermería',
                'duracion' => '9 semestres',
                'titulo' => 'Enfermero(a) Profesional',
                'trata' => 'Cuidado integral de la salud de pacientes en distintos contextos.',
                'campo' => 'Hospitales, clínicas y salud comunitaria.',
            ],
        ],
    ],
    [
        'id' => 'piloto',
        'nombre' => 'Universidad Piloto de Colombia',
        'ciudad' => 'Bogotá',
        'tipo' => 'Privada',
        'fundacion' => '1962',
        'web' => 'https://www.unipiloto.edu.co',
        'descripcion' => 'Universidad privada reconocida especialmente por sus programas de arquitectura, diseño e ingeniería.',
        'carreras' => [
            [
                'nombre' => 'Arquitectura',
                'duracion' => '10 semestres',
                'titulo' => 'Arquitecto(a)',
                'trata' => 'Diseño y planeación de espacios urbanos y edificaciones.',
                'campo' => 'Firmas de arquitectura, construcción y entidades públicas.',
            ],
        ],
    ],
];
$ciudadSeleccionada = 'Bogotá';
?>

<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Universidades en Bogotá | Optimus-Tu</title>

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
<h1>Universidades en Bogotá</h1>
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
