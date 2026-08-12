
<?php
session_start();

if(!isset($_SESSION['correo'])){
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Universidades | Optimus-Tu</title>

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

/* TITULO */

.header{

text-align:center;

margin-bottom:50px;
}

.header h1{

font-size:60px;

background:linear-gradient(to right,#00e5ff,#ff00cc);

-webkit-background-clip:text;
-webkit-text-fill-color:transparent;

margin-bottom:15px;
}

.header p{

font-size:18px;

color:#d8d8d8;
}

/* BOTONES */

.botones{

display:flex;

flex-wrap:wrap;

gap:15px;

justify-content:center;

margin-bottom:40px;
}

.boton{

padding:15px 25px;

border:none;

border-radius:50px;

background:rgba(255,255,255,.08);

color:white;

font-size:16px;

cursor:pointer;

transition:.3s;

backdrop-filter:blur(10px);
}

.boton:hover{

background:linear-gradient(90deg,#00bfff,#ff00cc);

transform:scale(1.05);
}

/* TARJETAS */

.card{

display:none;

background:rgba(255,255,255,.05);

border:1px solid rgba(255,255,255,.08);

border-radius:30px;

padding:35px;

margin-bottom:35px;

backdrop-filter:blur(12px);

animation:fade .5s ease;
}

.uni{

font-size:38px;

margin-bottom:25px;

color:#00e5ff;
}

/* CARRERAS */

.career{

background:rgba(255,255,255,.04);

padding:25px;

border-radius:20px;

margin-bottom:20px;
}

.career h3{

font-size:28px;

margin-bottom:15px;

color:#ff00cc;
}

.info{

margin-bottom:10px;

font-size:17px;

line-height:1.8;
}

.info strong{
color:#00e5ff;
}

/* ANIMACION */

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

/* RESPONSIVE */

@media(max-width:768px){

.header h1{
font-size:40px;
}

.uni{
font-size:28px;
}

.career h3{
font-size:22px;
}

.boton{
width:100%;
}

}

</style>

</head>

<body>

<div class="header">

<h1>Universidades de Colombia</h1>

<p>
Selecciona una universidad y descubre
sus carreras y oportunidades.
</p>

</div>

<!-- BOTONES -->

<div class="botones">

<button class="boton"
onclick="mostrar('nacional')">

Universidad Nacional

</button>

<button class="boton"
onclick="mostrar('antioquia')">

Universidad de Antioquia

</button>

<button class="boton"
onclick="mostrar('andes')">

Universidad de los Andes

</button>

<button class="boton"
onclick="mostrar('javeriana')">

Pontificia Javeriana

</button>

<button class="boton"
onclick="mostrar('sena')">

SENA

</button>

</div>

<!-- UNIVERSIDAD NACIONAL -->

<div class="card" id="nacional">

<h2 class="uni">
Universidad Nacional de Colombia
</h2>

<div class="career">

<h3>Ingeniería de Sistemas</h3>

<p class="info">
<strong>Duración:</strong> 10 semestres
</p>

<p class="info">
<strong>Título:</strong> Ingeniero(a) de Sistemas
</p>

<p class="info">
<strong>¿De qué trata?</strong>
Desarrollo de software,
inteligencia artificial y sistemas tecnológicos.
</p>

<p class="info">
<strong>Campo laboral:</strong>
Empresas tecnológicas,
desarrollo web y ciberseguridad.
</p>

</div>

<div class="career">

<h3>Psicología</h3>

<p class="info">
<strong>Duración:</strong> 10 semestres
</p>

<p class="info">
<strong>Título:</strong> Psicólogo(a)
</p>

<p class="info">
<strong>¿De qué trata?</strong>
Comportamiento humano,
emociones y salud mental.
</p>

<p class="info">
<strong>Campo laboral:</strong>
Hospitales, colegios,
empresas y consultorios.
</p>

</div>

</div>

<!-- UNIVERSIDAD DE ANTIOQUIA -->

<div class="card" id="antioquia">

<h2 class="uni">
Universidad de Antioquia
</h2>

<div class="career">

<h3>Medicina</h3>

<p class="info">
<strong>Duración:</strong> 12 semestres
</p>

<p class="info">
<strong>Título:</strong> Médico(a)
</p>

<p class="info">
<strong>¿De qué trata?</strong>
Diagnóstico y tratamiento
de enfermedades.
</p>

<p class="info">
<strong>Campo laboral:</strong>
Hospitales, clínicas
y salud pública.
</p>

</div>

<div class="career">

<h3>Derecho</h3>

<p class="info">
<strong>Duración:</strong> 10 semestres
</p>

<p class="info">
<strong>Título:</strong> Abogado(a)
</p>

<p class="info">
<strong>¿De qué trata?</strong>
Leyes, justicia
y normas sociales.
</p>

<p class="info">
<strong>Campo laboral:</strong>
Juzgados,
empresas y litigios.
</p>

</div>

</div>

<!-- UNIVERSIDAD DE LOS ANDES -->

<div class="card" id="andes">

<h2 class="uni">
Universidad de los Andes
</h2>

<div class="career">

<h3>Administración de Empresas</h3>

<p class="info">
<strong>Duración:</strong> 9 semestres
</p>

<p class="info">
<strong>Título:</strong> Administrador(a)
</p>

<p class="info">
<strong>¿De qué trata?</strong>
Liderazgo,
finanzas y gestión empresarial.
</p>

<p class="info">
<strong>Campo laboral:</strong>
Empresas,
marketing y emprendimiento.
</p>

</div>

</div>

<!-- JAVERIANA -->

<div class="card" id="javeriana">

<h2 class="uni">
Pontificia Universidad Javeriana
</h2>

<div class="career">

<h3>Comunicación Social</h3>

<p class="info">
<strong>Duración:</strong> 8 semestres
</p>

<p class="info">
<strong>Título:</strong> Comunicador(a) Social
</p>

<p class="info">
<strong>¿De qué trata?</strong>
Medios de comunicación,
periodismo y producción audiovisual.
</p>

<p class="info">
<strong>Campo laboral:</strong>
Televisión,
radio y medios digitales.
</p>

</div>

</div>

<!-- SENA -->

<div class="card" id="sena">

<h2 class="uni">
SENA
</h2>

<div class="career">

<h3>Análisis y Desarrollo de Software</h3>

<p class="info">
<strong>Duración:</strong> 2 años
</p>

<p class="info">
<strong>Título:</strong> Tecnólogo ADSO
</p>

<p class="info">
<strong>¿De qué trata?</strong>
Programación,
bases de datos y software.
</p>

<p class="info">
<strong>Campo laboral:</strong>
Empresas de tecnología,
desarrollo web y soporte.
</p>

</div>

</div>

<script>

function mostrar(id){

let cards = document.querySelectorAll(".card");

cards.forEach((card)=>{

card.style.display = "none";

});

document.getElementById(id).style.display = "block";

}

</script>

</body>
</html>
