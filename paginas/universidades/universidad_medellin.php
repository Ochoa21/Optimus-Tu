<?php
define('BASE_URL', '/Optimus-TU');
require_once __DIR__ . '/../../config/sesion.php';
if(!isset($_SESSION['correo'])){
    header("Location: " . BASE_URL . "/auth/login.php");
    exit;
}

// Universidades de Medellín (archivo independiente, generado desde datos_universidades.php)
$universidades = [
    [
        'id' => 'udea',
        'nombre' => 'Universidad de Antioquia',
        'ciudad' => 'Medellín',
        'tipo' => 'Pública',
        'fundacion' => '1803',
        'web' => 'https://www.udea.edu.co',
        'descripcion' => 'La Universidad de Antioquia (UdeA) es una de las universidades públicas más importantes y antiguas de Colombia, reconocida por su investigación en salud, ciencias y humanidades.',
        'carreras' => [
            [
                'nombre' => 'Medicina',
                'duracion' => '12 semestres',
                'titulo' => 'Médico(a)',
                'trata' => 'Diagnóstico, tratamiento y prevención de enfermedades en el cuerpo humano.',
                'campo' => 'Hospitales, clínicas, salud pública e investigación médica.',
            ],
            [
                'nombre' => 'Ingeniería de Sistemas',
                'duracion' => '10 semestres',
                'titulo' => 'Ingeniero(a) de Sistemas',
                'trata' => 'Desarrollo de software, redes, bases de datos e inteligencia artificial.',
                'campo' => 'Empresas de tecnología, desarrollo de software y ciberseguridad.',
            ],
            [
                'nombre' => 'Derecho',
                'duracion' => '10 semestres',
                'titulo' => 'Abogado(a)',
                'trata' => 'Estudio de las leyes, la justicia y las normas que rigen la sociedad.',
                'campo' => 'Juzgados, notarías, empresas y litigio independiente.',
            ],
        ],
    ],
    [
        'id' => 'eafit',
        'nombre' => 'Universidad EAFIT',
        'ciudad' => 'Medellín',
        'tipo' => 'Privada',
        'fundacion' => '1960',
        'web' => 'https://www.eafit.edu.co',
        'descripcion' => 'EAFIT es una universidad privada de Medellín reconocida por sus programas de negocios, ingeniería y su fuerte enfoque en innovación y emprendimiento.',
        'carreras' => [
            [
                'nombre' => 'Ingeniería de Sistemas',
                'duracion' => '9 semestres',
                'titulo' => 'Ingeniero(a) de Sistemas',
                'trata' => 'Programación, ciencia de datos, inteligencia artificial y desarrollo de software.',
                'campo' => 'Empresas tecnológicas, startups y consultoría en TI.',
            ],
            [
                'nombre' => 'Negocios Internacionales',
                'duracion' => '9 semestres',
                'titulo' => 'Profesional en Negocios Internacionales',
                'trata' => 'Comercio exterior, finanzas globales y estrategia empresarial.',
                'campo' => 'Multinacionales, comercio exterior y consultoría.',
            ],
            [
                'nombre' => 'Diseño',
                'duracion' => '9 semestres',
                'titulo' => 'Diseñador(a)',
                'trata' => 'Diseño gráfico, industrial y de experiencia de usuario.',
                'campo' => 'Agencias creativas, empresas de producto y marcas.',
            ],
        ],
    ],
    [
        'id' => 'upb',
        'nombre' => 'Universidad Pontificia Bolivariana',
        'ciudad' => 'Medellín',
        'tipo' => 'Privada',
        'fundacion' => '1936',
        'web' => 'https://www.upb.edu.co',
        'descripcion' => 'La UPB es una universidad privada de tradición católica, con gran oferta en ingenierías, comunicación y ciencias de la salud.',
        'carreras' => [
            [
                'nombre' => 'Comunicación Social',
                'duracion' => '9 semestres',
                'titulo' => 'Comunicador(a) Social',
                'trata' => 'Periodismo, producción audiovisual y medios digitales.',
                'campo' => 'Televisión, radio, agencias de contenido y medios digitales.',
            ],
            [
                'nombre' => 'Ingeniería Industrial',
                'duracion' => '10 semestres',
                'titulo' => 'Ingeniero(a) Industrial',
                'trata' => 'Optimización de procesos productivos y gestión de calidad.',
                'campo' => 'Manufactura, logística y consultoría de procesos.',
            ],
        ],
    ],
    [
        'id' => 'udem',
        'nombre' => 'Universidad de Medellín',
        'ciudad' => 'Medellín',
        'tipo' => 'Privada',
        'fundacion' => '1950',
        'web' => 'https://www.udem.edu.co',
        'descripcion' => 'Universidad privada con amplia oferta en ingenierías, derecho, economía y ciencias sociales, con fuerte presencia regional.',
        'carreras' => [
            [
                'nombre' => 'Ingeniería Civil',
                'duracion' => '10 semestres',
                'titulo' => 'Ingeniero(a) Civil',
                'trata' => 'Diseño y construcción de infraestructura como puentes, edificios y vías.',
                'campo' => 'Constructoras, entidades públicas y consultoría estructural.',
            ],
            [
                'nombre' => 'Economía',
                'duracion' => '9 semestres',
                'titulo' => 'Economista',
                'trata' => 'Análisis de mercados, políticas públicas y finanzas.',
                'campo' => 'Bancos, entidades gubernamentales y consultoría económica.',
            ],
        ],
    ],
    [
        'id' => 'unal-medellin',
        'nombre' => 'Universidad Nacional (Sede Medellín)',
        'ciudad' => 'Medellín',
        'tipo' => 'Pública',
        'fundacion' => '1936',
        'web' => 'https://medellin.unal.edu.co',
        'descripcion' => 'Sede de la Universidad Nacional de Colombia en Medellín, reconocida por sus programas de ingeniería, arquitectura y ciencias agropecuarias.',
        'carreras' => [
            [
                'nombre' => 'Ingeniería de Minas',
                'duracion' => '10 semestres',
                'titulo' => 'Ingeniero(a) de Minas',
                'trata' => 'Exploración, extracción y aprovechamiento de recursos minerales.',
                'campo' => 'Empresas mineras, energéticas y de consultoría ambiental.',
            ],
            [
                'nombre' => 'Arquitectura',
                'duracion' => '10 semestres',
                'titulo' => 'Arquitecto(a)',
                'trata' => 'Diseño de espacios, edificaciones y planeación urbana.',
                'campo' => 'Firmas de arquitectura, entidades públicas y construcción.',
            ],
        ],
    ],
    [
        'id' => 'itm',
        'nombre' => 'Instituto Tecnológico Metropolitano (ITM)',
        'ciudad' => 'Medellín',
        'tipo' => 'Pública',
        'fundacion' => '1993',
        'web' => 'https://www.itm.edu.co',
        'descripcion' => 'Institución universitaria pública de Medellín con enfoque técnico y tecnológico, accesible y orientada a las necesidades del sector productivo.',
        'carreras' => [
            [
                'nombre' => 'Tecnología en Análisis y Desarrollo de Software',
                'duracion' => '6 semestres',
                'titulo' => 'Tecnólogo(a) en Software',
                'trata' => 'Programación, bases de datos y desarrollo de aplicaciones.',
                'campo' => 'Empresas de software, soporte técnico y desarrollo web.',
            ],
        ],
    ],
    [
        'id' => 'sena',
        'nombre' => 'SENA',
        'ciudad' => 'Medellín (nacional)',
        'tipo' => 'Pública (gratuita)',
        'fundacion' => '1957',
        'web' => 'https://www.sena.edu.co',
        'descripcion' => 'El SENA ofrece formación técnica y tecnológica gratuita en todo el país, con alta empleabilidad y convenios con empresas.',
        'carreras' => [
            [
                'nombre' => 'Análisis y Desarrollo de Software',
                'duracion' => '2 años',
                'titulo' => 'Tecnólogo(a) ADSO',
                'trata' => 'Programación, bases de datos y desarrollo de software.',
                'campo' => 'Empresas de tecnología, desarrollo web y soporte.',
            ],
            [
                'nombre' => 'Gestión Empresarial',
                'duracion' => '2 años',
                'titulo' => 'Tecnólogo(a) en Gestión Empresarial',
                'trata' => 'Administración, contabilidad básica y procesos empresariales.',
                'campo' => 'Pymes, áreas administrativas y emprendimiento.',
            ],
        ],
    ],
    [
        'id' => 'ces',
        'nombre' => 'Universidad CES',
        'ciudad' => 'Medellín',
        'tipo' => 'Privada',
        'fundacion' => '1977',
        'web' => 'https://www.ces.edu.co',
        'descripcion' => 'Universidad privada de Medellín reconocida a nivel nacional por sus programas del área de la salud y su enfoque investigativo.',
        'carreras' => [
            [
                'nombre' => 'Medicina',
                'duracion' => '12 semestres',
                'titulo' => 'Médico(a)',
                'trata' => 'Formación clínica integral con énfasis en investigación biomédica.',
                'campo' => 'Hospitales, clínicas, investigación y salud pública.',
            ],
            [
                'nombre' => 'Odontología',
                'duracion' => '10 semestres',
                'titulo' => 'Odontólogo(a)',
                'trata' => 'Prevención, diagnóstico y tratamiento de enfermedades bucales.',
                'campo' => 'Clínicas odontológicas, consultorios privados y salud pública.',
            ],
        ],
    ],
    [
        'id' => 'eia',
        'nombre' => 'Escuela de Ingeniería de Antioquia (EIA)',
        'ciudad' => 'Medellín',
        'tipo' => 'Privada',
        'fundacion' => '1970',
        'web' => 'https://www.eia.edu.co',
        'descripcion' => 'Institución privada especializada exclusivamente en ingenierías, reconocida por su alta exigencia académica y vínculo con el sector productivo.',
        'carreras' => [
            [
                'nombre' => 'Ingeniería Biomédica',
                'duracion' => '10 semestres',
                'titulo' => 'Ingeniero(a) Biomédico(a)',
                'trata' => 'Diseño de tecnología y dispositivos aplicados a la salud.',
                'campo' => 'Hospitales, empresas de dispositivos médicos e investigación.',
            ],
            [
                'nombre' => 'Ingeniería Administrativa',
                'duracion' => '10 semestres',
                'titulo' => 'Ingeniero(a) Administrador(a)',
                'trata' => 'Gestión de procesos, proyectos y organizaciones con enfoque técnico.',
                'campo' => 'Empresas industriales, consultoría y gerencia de proyectos.',
            ],
        ],
    ],
    [
        'id' => 'lasallista',
        'nombre' => 'Corporación Universitaria Lasallista',
        'ciudad' => 'Medellín (Caldas)',
        'tipo' => 'Privada',
        'fundacion' => '1983',
        'web' => 'https://www.lasallista.edu.co',
        'descripcion' => 'Universidad privada del área metropolitana de Medellín, reconocida por sus programas de ingeniería de alimentos, administración y ciencias agropecuarias.',
        'carreras' => [
            [
                'nombre' => 'Ingeniería de Alimentos',
                'duracion' => '9 semestres',
                'titulo' => 'Ingeniero(a) de Alimentos',
                'trata' => 'Procesamiento, conservación y control de calidad de alimentos.',
                'campo' => 'Industria alimentaria, control de calidad e investigación.',
            ],
        ],
    ],
    [
        'id' => 'sanbuenaventura',
        'nombre' => 'Universidad de San Buenaventura (Medellín)',
        'ciudad' => 'Medellín',
        'tipo' => 'Privada',
        'fundacion' => '1968',
        'web' => 'https://www.usbmed.edu.co',
        'descripcion' => 'Universidad privada de tradición franciscana con oferta en ingenierías, educación, comunicación y ciencias sociales.',
        'carreras' => [
            [
                'nombre' => 'Psicología',
                'duracion' => '10 semestres',
                'titulo' => 'Psicólogo(a)',
                'trata' => 'Estudio del comportamiento humano y procesos mentales.',
                'campo' => 'Clínicas, colegios, empresas y consultorios particulares.',
            ],
        ],
    ],
    [
        'id' => 'funlam',
        'nombre' => 'Universidad Católica Luis Amigó (FUNLAM)',
        'ciudad' => 'Medellín',
        'tipo' => 'Privada',
        'fundacion' => '1986',
        'web' => 'https://www.funlam.edu.co',
        'descripcion' => 'Universidad privada con enfoque social, reconocida por sus programas en ciencias sociales, comunicación y criminología.',
        'carreras' => [
            [
                'nombre' => 'Criminología',
                'duracion' => '9 semestres',
                'titulo' => 'Criminólogo(a)',
                'trata' => 'Estudio del delito, la criminalidad y la seguridad ciudadana.',
                'campo' => 'Policía, fiscalía, entidades de seguridad e investigación.',
            ],
        ],
    ],
    [
        'id' => 'unaula',
        'nombre' => 'Universidad Autónoma Latinoamericana (UNAULA)',
        'ciudad' => 'Medellín',
        'tipo' => 'Privada',
        'fundacion' => '1966',
        'web' => 'https://www.unaula.edu.co',
        'descripcion' => 'Universidad privada de Medellín con tradición en programas sociales, jurídicos y humanísticos, orientada a la accesibilidad.',
        'carreras' => [
            [
                'nombre' => 'Derecho',
                'duracion' => '10 semestres',
                'titulo' => 'Abogado(a)',
                'trata' => 'Formación jurídica con enfoque en derechos humanos y justicia social.',
                'campo' => 'Juzgados, defensoría pública, litigio y sector social.',
            ],
        ],
    ],
    [
        'id' => 'colmayor',
        'nombre' => 'Colegio Mayor de Antioquia',
        'ciudad' => 'Medellín',
        'tipo' => 'Pública',
        'fundacion' => '1945',
        'web' => 'https://www.colmayor.edu.co',
        'descripcion' => 'Institución universitaria pública de Medellín, con programas técnicos, tecnológicos y profesionales accesibles.',
        'carreras' => [
            [
                'nombre' => 'Gastronomía',
                'duracion' => '8 semestres',
                'titulo' => 'Profesional en Gastronomía',
                'trata' => 'Preparación de alimentos, gestión de cocina y cultura culinaria.',
                'campo' => 'Restaurantes, hotelería y emprendimiento gastronómico.',
            ],
        ],
    ],
    [
        'id' => 'politecnico-jic',
        'nombre' => 'Politécnico Colombiano Jaime Isaza Cadavid',
        'ciudad' => 'Medellín',
        'tipo' => 'Pública',
        'fundacion' => '1964',
        'web' => 'https://www.elpoli.edu.co',
        'descripcion' => 'Institución universitaria pública de Medellín con amplia oferta técnica, tecnológica y profesional a precios accesibles.',
        'carreras' => [
            [
                'nombre' => 'Tecnología en Sistemas',
                'duracion' => '6 semestres',
                'titulo' => 'Tecnólogo(a) en Sistemas',
                'trata' => 'Desarrollo, soporte y mantenimiento de sistemas informáticos.',
                'campo' => 'Empresas de tecnología, soporte técnico y desarrollo de software.',
            ],
        ],
    ],
];
$ciudadSeleccionada = 'Medellín';
?>

<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Universidades en Medellín | Optimus-Tu</title>

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
<h1>Universidades en Medellín</h1>
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
