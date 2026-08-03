<?php
session_start();

if(!isset($_SESSION['correo'])){
    header("Location: login.php");
    exit;
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
margin-bottom:40px;
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

/* BUSCADOR */

.buscador{
max-width:500px;
margin:0 auto 35px auto;
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

/* FILTROS DE CIUDAD */

.filtros{
display:flex;
flex-wrap:wrap;
gap:10px;
justify-content:center;
margin-bottom:30px;
}

.filtro{
padding:8px 18px;
border-radius:50px;
border:1px solid rgba(255,255,255,.15);
background:rgba(255,255,255,.04);
color:#d8d8d8;
font-size:14px;
cursor:pointer;
transition:.3s;
}

.filtro:hover,
.filtro.activo{
background:linear-gradient(90deg,#00bfff,#ff00cc);
color:white;
border-color:transparent;
}

/* BOTONES DE UNIVERSIDADES */

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
text-align:left;
}

.boton small{
display:block;
font-size:12px;
color:#00e5ff;
margin-top:3px;
font-weight:300;
}

.boton:hover{
background:linear-gradient(90deg,#00bfff,#ff00cc);
transform:scale(1.05);
}

.oculto{
display:none !important;
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
max-width:900px;
margin-left:auto;
margin-right:auto;
}

.uni{
font-size:38px;
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

/* CARRERAS */

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

.cerrar{
display:block;
margin:0 auto 25px auto;
padding:10px 30px;
border-radius:50px;
border:none;
background:rgba(255,255,255,.1);
color:white;
cursor:pointer;
font-size:14px;
}

.cerrar:hover{
background:rgba(255,0,80,.4);
}

.sin-resultados{
text-align:center;
color:#a8a8a8;
font-size:16px;
margin-bottom:20px;
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
font-size:36px;
}

.uni{
font-size:26px;
}

.career h3{
font-size:20px;
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
<p>Selecciona una universidad y descubre toda su información: carreras, duración, títulos y campo laboral.</p>
</div>

<div class="buscador">
<input type="text" id="buscarInput" placeholder="Buscar universidad por nombre o ciudad..." oninput="filtrarBotones()">
</div>

<div class="filtros" id="filtrosCiudad"></div>

<div class="botones" id="contenedorBotones"></div>

<p class="sin-resultados oculto" id="sinResultados">No se encontraron universidades con ese criterio.</p>

<div id="contenedorCards"></div>

<script>

/* =========================================================
   BASE DE DATOS DE UNIVERSIDADES DE COLOMBIA
   (Con énfasis especial en Medellín / Antioquia)
   ========================================================= */

const universidades = [

  {
    id:"udea",
    nombre:"Universidad de Antioquia",
    ciudad:"Medellín",
    tipo:"Pública",
    fundacion:"1803",
    web:"https://www.udea.edu.co",
    descripcion:"La Universidad de Antioquia (UdeA) es una de las universidades públicas más importantes y antiguas de Colombia, reconocida por su investigación en salud, ciencias y humanidades.",
    carreras:[
      {nombre:"Medicina", duracion:"12 semestres", titulo:"Médico(a)", trata:"Diagnóstico, tratamiento y prevención de enfermedades en el cuerpo humano.", campo:"Hospitales, clínicas, salud pública e investigación médica."},
      {nombre:"Ingeniería de Sistemas", duracion:"10 semestres", titulo:"Ingeniero(a) de Sistemas", trata:"Desarrollo de software, redes, bases de datos e inteligencia artificial.", campo:"Empresas de tecnología, desarrollo de software y ciberseguridad."},
      {nombre:"Derecho", duracion:"10 semestres", titulo:"Abogado(a)", trata:"Estudio de las leyes, la justicia y las normas que rigen la sociedad.", campo:"Juzgados, notarías, empresas y litigio independiente."}
    ]
  },

  {
    id:"eafit",
    nombre:"Universidad EAFIT",
    ciudad:"Medellín",
    tipo:"Privada",
    fundacion:"1960",
    web:"https://www.eafit.edu.co",
    descripcion:"EAFIT es una universidad privada de Medellín reconocida por sus programas de negocios, ingeniería y su fuerte enfoque en innovación y emprendimiento.",
    carreras:[
      {nombre:"Ingeniería de Sistemas", duracion:"9 semestres", titulo:"Ingeniero(a) de Sistemas", trata:"Programación, ciencia de datos, inteligencia artificial y desarrollo de software.", campo:"Empresas tecnológicas, startups y consultoría en TI."},
      {nombre:"Negocios Internacionales", duracion:"9 semestres", titulo:"Profesional en Negocios Internacionales", trata:"Comercio exterior, finanzas globales y estrategia empresarial.", campo:"Multinacionales, comercio exterior y consultoría."},
      {nombre:"Diseño", duracion:"9 semestres", titulo:"Diseñador(a)", trata:"Diseño gráfico, industrial y de experiencia de usuario.", campo:"Agencias creativas, empresas de producto y marcas."}
    ]
  },

  {
    id:"upb",
    nombre:"Universidad Pontificia Bolivariana",
    ciudad:"Medellín",
    tipo:"Privada",
    fundacion:"1936",
    web:"https://www.upb.edu.co",
    descripcion:"La UPB es una universidad privada de tradición católica, con gran oferta en ingenierías, comunicación y ciencias de la salud.",
    carreras:[
      {nombre:"Comunicación Social", duracion:"9 semestres", titulo:"Comunicador(a) Social", trata:"Periodismo, producción audiovisual y medios digitales.", campo:"Televisión, radio, agencias de contenido y medios digitales."},
      {nombre:"Ingeniería Industrial", duracion:"10 semestres", titulo:"Ingeniero(a) Industrial", trata:"Optimización de procesos productivos y gestión de calidad.", campo:"Manufactura, logística y consultoría de procesos."}
    ]
  },

  {
    id:"udem",
    nombre:"Universidad de Medellín",
    ciudad:"Medellín",
    tipo:"Privada",
    fundacion:"1950",
    web:"https://www.udem.edu.co",
    descripcion:"Universidad privada con amplia oferta en ingenierías, derecho, economía y ciencias sociales, con fuerte presencia regional.",
    carreras:[
      {nombre:"Ingeniería Civil", duracion:"10 semestres", titulo:"Ingeniero(a) Civil", trata:"Diseño y construcción de infraestructura como puentes, edificios y vías.", campo:"Constructoras, entidades públicas y consultoría estructural."},
      {nombre:"Economía", duracion:"9 semestres", titulo:"Economista", trata:"Análisis de mercados, políticas públicas y finanzas.", campo:"Bancos, entidades gubernamentales y consultoría económica."}
    ]
  },

  {
    id:"unal-medellin",
    nombre:"Universidad Nacional (Sede Medellín)",
    ciudad:"Medellín",
    tipo:"Pública",
    fundacion:"1936",
    web:"https://medellin.unal.edu.co",
    descripcion:"Sede de la Universidad Nacional de Colombia en Medellín, reconocida por sus programas de ingeniería, arquitectura y ciencias agropecuarias.",
    carreras:[
      {nombre:"Ingeniería de Minas", duracion:"10 semestres", titulo:"Ingeniero(a) de Minas", trata:"Exploración, extracción y aprovechamiento de recursos minerales.", campo:"Empresas mineras, energéticas y de consultoría ambiental."},
      {nombre:"Arquitectura", duracion:"10 semestres", titulo:"Arquitecto(a)", trata:"Diseño de espacios, edificaciones y planeación urbana.", campo:"Firmas de arquitectura, entidades públicas y construcción."}
    ]
  },

  {
    id:"itm",
    nombre:"Instituto Tecnológico Metropolitano (ITM)",
    ciudad:"Medellín",
    tipo:"Pública",
    fundacion:"1993",
    web:"https://www.itm.edu.co",
    descripcion:"Institución universitaria pública de Medellín con enfoque técnico y tecnológico, accesible y orientada a las necesidades del sector productivo.",
    carreras:[
      {nombre:"Tecnología en Análisis y Desarrollo de Software", duracion:"6 semestres", titulo:"Tecnólogo(a) en Software", trata:"Programación, bases de datos y desarrollo de aplicaciones.", campo:"Empresas de software, soporte técnico y desarrollo web."}
    ]
  },

  {
    id:"sena",
    nombre:"SENA",
    ciudad:"Medellín (nacional)",
    tipo:"Pública (gratuita)",
    fundacion:"1957",
    web:"https://www.sena.edu.co",
    descripcion:"El SENA ofrece formación técnica y tecnológica gratuita en todo el país, con alta empleabilidad y convenios con empresas.",
    carreras:[
      {nombre:"Análisis y Desarrollo de Software", duracion:"2 años", titulo:"Tecnólogo(a) ADSO", trata:"Programación, bases de datos y desarrollo de software.", campo:"Empresas de tecnología, desarrollo web y soporte."},
      {nombre:"Gestión Empresarial", duracion:"2 años", titulo:"Tecnólogo(a) en Gestión Empresarial", trata:"Administración, contabilidad básica y procesos empresariales.", campo:"Pymes, áreas administrativas y emprendimiento."}
    ]
  },

  {
    id:"unal-bogota",
    nombre:"Universidad Nacional de Colombia (Sede Bogotá)",
    ciudad:"Bogotá",
    tipo:"Pública",
    fundacion:"1867",
    web:"https://www.unal.edu.co",
    descripcion:"La universidad pública más importante del país, con la mayor oferta académica e investigativa a nivel nacional.",
    carreras:[
      {nombre:"Ingeniería de Sistemas", duracion:"10 semestres", titulo:"Ingeniero(a) de Sistemas", trata:"Desarrollo de software, inteligencia artificial y sistemas tecnológicos.", campo:"Empresas tecnológicas, desarrollo web y ciberseguridad."},
      {nombre:"Psicología", duracion:"10 semestres", titulo:"Psicólogo(a)", trata:"Comportamiento humano, emociones y salud mental.", campo:"Hospitales, colegios, empresas y consultorios."}
    ]
  },

  {
    id:"andes",
    nombre:"Universidad de los Andes",
    ciudad:"Bogotá",
    tipo:"Privada",
    fundacion:"1948",
    web:"https://uniandes.edu.co",
    descripcion:"Una de las universidades privadas más prestigiosas y costosas de Colombia, reconocida a nivel internacional en negocios, ingeniería y derecho.",
    carreras:[
      {nombre:"Administración de Empresas", duracion:"9 semestres", titulo:"Administrador(a)", trata:"Liderazgo, finanzas y gestión empresarial.", campo:"Empresas, marketing y emprendimiento."},
      {nombre:"Derecho", duracion:"10 semestres", titulo:"Abogado(a)", trata:"Estudio de leyes, justicia y normas sociales.", campo:"Firmas de abogados, litigio y sector público."}
    ]
  },

  {
    id:"javeriana",
    nombre:"Pontificia Universidad Javeriana",
    ciudad:"Bogotá",
    tipo:"Privada",
    fundacion:"1623",
    web:"https://www.javeriana.edu.co",
    descripcion:"Universidad privada de tradición jesuita, una de las más antiguas de América, con fuerte oferta en salud, comunicación y humanidades.",
    carreras:[
      {nombre:"Comunicación Social", duracion:"8 semestres", titulo:"Comunicador(a) Social", trata:"Medios de comunicación, periodismo y producción audiovisual.", campo:"Televisión, radio y medios digitales."},
      {nombre:"Medicina", duracion:"12 semestres", titulo:"Médico(a)", trata:"Diagnóstico y tratamiento de enfermedades.", campo:"Hospitales, clínicas y salud pública."}
    ]
  },

  {
    id:"rosario",
    nombre:"Universidad del Rosario",
    ciudad:"Bogotá",
    tipo:"Privada",
    fundacion:"1653",
    web:"https://www.urosario.edu.co",
    descripcion:"Una de las universidades más antiguas de Colombia, con gran prestigio en derecho, medicina y ciencias políticas.",
    carreras:[
      {nombre:"Derecho", duracion:"10 semestres", titulo:"Abogado(a)", trata:"Estudio de leyes, justicia y normatividad.", campo:"Juzgados, empresas y sector público."}
    ]
  },

  {
    id:"externado",
    nombre:"Universidad Externado de Colombia",
    ciudad:"Bogotá",
    tipo:"Privada",
    fundacion:"1886",
    web:"https://www.uexternado.edu.co",
    descripcion:"Reconocida especialmente por sus programas de derecho, ciencias políticas y economía.",
    carreras:[
      {nombre:"Ciencia Política", duracion:"8 semestres", titulo:"Politólogo(a)", trata:"Análisis de sistemas políticos, gobierno y políticas públicas.", campo:"Entidades públicas, ONG y organismos internacionales."}
    ]
  },

  {
    id:"icesi",
    nombre:"Universidad Icesi",
    ciudad:"Cali",
    tipo:"Privada",
    fundacion:"1979",
    web:"https://www.icesi.edu.co",
    descripcion:"Universidad privada del suroccidente colombiano, reconocida por su enfoque innovador en negocios e ingeniería.",
    carreras:[
      {nombre:"Ingeniería Industrial", duracion:"9 semestres", titulo:"Ingeniero(a) Industrial", trata:"Optimización de procesos y gestión de recursos.", campo:"Manufactura, logística y consultoría."}
    ]
  },

  {
    id:"univalle",
    nombre:"Universidad del Valle",
    ciudad:"Cali",
    tipo:"Pública",
    fundacion:"1945",
    web:"https://www.univalle.edu.co",
    descripcion:"Principal universidad pública del suroccidente colombiano, con fuerte tradición en salud e ingeniería.",
    carreras:[
      {nombre:"Medicina", duracion:"12 semestres", titulo:"Médico(a)", trata:"Diagnóstico y tratamiento de enfermedades.", campo:"Hospitales y salud pública."}
    ]
  },

  {
    id:"unorte",
    nombre:"Universidad del Norte",
    ciudad:"Barranquilla",
    tipo:"Privada",
    fundacion:"1966",
    web:"https://www.uninorte.edu.co",
    descripcion:"La universidad privada más importante de la región Caribe, con fuerte oferta en ingenierías y negocios.",
    carreras:[
      {nombre:"Ingeniería Industrial", duracion:"10 semestres", titulo:"Ingeniero(a) Industrial", trata:"Gestión de procesos productivos y calidad.", campo:"Industria, logística y consultoría."}
    ]
  },

  {
    id:"uis",
    nombre:"Universidad Industrial de Santander (UIS)",
    ciudad:"Bucaramanga",
    tipo:"Pública",
    fundacion:"1948",
    web:"https://www.uis.edu.co",
    descripcion:"Universidad pública líder en Santander, reconocida por sus programas de ingeniería y ciencias.",
    carreras:[
      {nombre:"Ingeniería de Petróleos", duracion:"10 semestres", titulo:"Ingeniero(a) de Petróleos", trata:"Exploración y explotación de hidrocarburos.", campo:"Empresas petroleras y energéticas."}
    ]
  },

  {
    id:"utb",
    nombre:"Universidad Tecnológica de Bolívar",
    ciudad:"Cartagena",
    tipo:"Privada",
    fundacion:"1970",
    web:"https://www.utb.edu.co",
    descripcion:"Universidad privada de la costa Caribe con fuerte enfoque en ingeniería y negocios marítimos.",
    carreras:[
      {nombre:"Ingeniería Naval", duracion:"9 semestres", titulo:"Ingeniero(a) Naval", trata:"Diseño y mantenimiento de embarcaciones y estructuras marítimas.", campo:"Industria naval y portuaria."}
    ]
  }

];

/* =========================================================
   RENDER DINÁMICO
   ========================================================= */

const contenedorBotones = document.getElementById("contenedorBotones");
const contenedorCards = document.getElementById("contenedorCards");
const filtrosCiudad = document.getElementById("filtrosCiudad");
const sinResultados = document.getElementById("sinResultados");

let ciudadActiva = "todas";

function ciudadesUnicas(){
  const set = new Set(universidades.map(u => u.ciudad.split(" (")[0]));
  return ["todas", ...Array.from(set).sort()];
}

function renderFiltros(){
  filtrosCiudad.innerHTML = "";
  ciudadesUnicas().forEach(ciudad=>{
    const btn = document.createElement("button");
    btn.className = "filtro" + (ciudad === ciudadActiva ? " activo" : "");
    btn.textContent = ciudad === "todas" ? "Todas las ciudades" : ciudad;
    btn.onclick = ()=>{
      ciudadActiva = ciudad;
      renderFiltros();
      filtrarBotones();
    };
    filtrosCiudad.appendChild(btn);
  });
}

function renderBotones(){
  contenedorBotones.innerHTML = "";
  universidades.forEach(u=>{
    const btn = document.createElement("button");
    btn.className = "boton";
    btn.dataset.nombre = (u.nombre + " " + u.ciudad).toLowerCase();
    btn.dataset.ciudad = u.ciudad.split(" (")[0];
    btn.innerHTML = u.nombre + "<small>" + u.ciudad + " · " + u.tipo + "</small>";
    btn.onclick = ()=> mostrar(u.id);
    contenedorBotones.appendChild(btn);
  });
}

function renderCards(){
  contenedorCards.innerHTML = "";
  universidades.forEach(u=>{
    const card = document.createElement("div");
    card.className = "card";
    card.id = u.id;

    let carrerasHTML = "";
    u.carreras.forEach(c=>{
      carrerasHTML += `
        <div class="career">
          <h3>${c.nombre}</h3>
          <p class="info"><strong>Duración:</strong> ${c.duracion}</p>
          <p class="info"><strong>Título:</strong> ${c.titulo}</p>
          <p class="info"><strong>¿De qué trata?</strong> ${c.trata}</p>
          <p class="info"><strong>Campo laboral:</strong> ${c.campo}</p>
        </div>
      `;
    });

    card.innerHTML = `
      <button class="cerrar" onclick="cerrarCards()">✕ Cerrar</button>
      <h2 class="uni">${u.nombre}</h2>
      <div class="uni-meta">
        <span class="tag">📍 ${u.ciudad}</span>
        <span class="tag">🏛️ ${u.tipo}</span>
        <span class="tag">📅 Fundada en ${u.fundacion}</span>
      </div>
      <p class="uni-desc">${u.descripcion}</p>
      <p class="uni-web"><a href="${u.web}" target="_blank" rel="noopener">🔗 Sitio web oficial</a></p>
      <h3 class="carreras-title">Carreras destacadas</h3>
      ${carrerasHTML}
    `;

    contenedorCards.appendChild(card);
  });
}

function mostrar(id){
  document.querySelectorAll(".card").forEach(card=>{
    card.style.display = "none";
  });
  const card = document.getElementById(id);
  if(card){
    card.style.display = "block";
    card.scrollIntoView({behavior:"smooth", block:"start"});
  }
}

function cerrarCards(){
  document.querySelectorAll(".card").forEach(card=>{
    card.style.display = "none";
  });
}

function filtrarBotones(){
  const texto = document.getElementById("buscarInput").value.toLowerCase();
  let visibles = 0;

  document.querySelectorAll(".boton").forEach(btn=>{
    const coincideTexto = btn.dataset.nombre.includes(texto);
    const coincideCiudad = ciudadActiva === "todas" || btn.dataset.ciudad === ciudadActiva;
    const mostrarBtn = coincideTexto && coincideCiudad;
    btn.classList.toggle("oculto", !mostrarBtn);
    if(mostrarBtn) visibles++;
  });

  sinResultados.classList.toggle("oculto", visibles > 0);
}

renderFiltros();
renderBotones();
renderCards();

</script>

</body>
</html>