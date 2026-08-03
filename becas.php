<link rel="stylesheet" href="style.css">

<style>

.becas-wrap *{
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

.becas-wrap{
padding:40px;
color:white;
background:
linear-gradient(rgba(2,6,23,.92),rgba(2,6,23,.95)),
url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2070&auto=format&fit=crop');
background-size:cover;
background-position:center;
background-attachment:fixed;
min-height:100vh;
}

.becas-header{
text-align:center;
margin-bottom:35px;
}

.becas-header h1{
font-size:50px;
background:linear-gradient(to right,#00e5ff,#ff00cc);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
margin-bottom:10px;
}

.becas-header p{
font-size:16px;
color:#d8d8d8;
max-width:700px;
margin:0 auto;
}

.nota-aviso{
max-width:750px;
margin:20px auto 35px auto;
background:rgba(255,204,0,.08);
border:1px solid rgba(255,204,0,.35);
padding:15px 20px;
border-radius:16px;
font-size:14px;
color:#ffe08a;
text-align:center;
}

/* BECAS NACIONALES (fijas) */

.nacionales{
max-width:900px;
margin:0 auto 45px auto;
}

.nacionales h2{
font-size:26px;
color:#00e5ff;
margin-bottom:15px;
text-align:center;
}

.nac-grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:18px;
}

.nac-card{
background:rgba(255,255,255,.05);
border:1px solid rgba(255,255,255,.08);
border-radius:20px;
padding:20px;
}

.nac-card h3{
color:#ff00cc;
font-size:19px;
margin-bottom:8px;
}

.nac-card p{
font-size:14px;
line-height:1.6;
color:#e0e0e0;
}

/* BUSCADOR Y FILTROS */

.becas-buscador{
max-width:500px;
margin:0 auto 25px auto;
}

.becas-buscador input{
width:100%;
padding:15px 20px;
border-radius:50px;
border:1px solid rgba(255,255,255,.15);
background:rgba(255,255,255,.06);
color:white;
font-size:16px;
outline:none;
}

.becas-buscador input::placeholder{
color:#a8a8a8;
}

.becas-filtros{
display:flex;
flex-wrap:wrap;
gap:10px;
justify-content:center;
margin-bottom:30px;
}

.becas-filtro{
padding:8px 18px;
border-radius:50px;
border:1px solid rgba(255,255,255,.15);
background:rgba(255,255,255,.04);
color:#d8d8d8;
font-size:14px;
cursor:pointer;
transition:.3s;
}

.becas-filtro:hover,
.becas-filtro.activo{
background:linear-gradient(90deg,#00bfff,#ff00cc);
color:white;
border-color:transparent;
}

/* BOTONES DE UNIVERSIDADES */

.becas-botones{
display:flex;
flex-wrap:wrap;
gap:15px;
justify-content:center;
margin-bottom:40px;
}

.becas-boton{
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

.becas-boton small{
display:block;
font-size:12px;
color:#00e5ff;
margin-top:3px;
font-weight:300;
}

.becas-boton:hover{
background:linear-gradient(90deg,#00bfff,#ff00cc);
transform:scale(1.05);
}

.becas-oculto{
display:none !important;
}

/* TARJETAS DE UNIVERSIDAD */

.becas-card{
display:none;
background:rgba(255,255,255,.05);
border:1px solid rgba(255,255,255,.08);
border-radius:30px;
padding:35px;
margin:0 auto 35px auto;
backdrop-filter:blur(12px);
animation:fadeBecas .5s ease;
max-width:900px;
}

.becas-uni{
font-size:36px;
margin-bottom:10px;
color:#00e5ff;
}

.becas-meta{
display:flex;
flex-wrap:wrap;
gap:12px;
margin-bottom:25px;
}

.becas-tag{
background:rgba(255,255,255,.08);
padding:6px 14px;
border-radius:50px;
font-size:13px;
color:#d8d8d8;
}

.costo-box{
background:rgba(0,229,255,.08);
border:1px solid rgba(0,229,255,.25);
border-radius:16px;
padding:18px 22px;
margin-bottom:30px;
font-size:15px;
line-height:1.7;
}

.costo-box strong{
color:#00e5ff;
}

.beca-item{
background:rgba(255,255,255,.04);
padding:25px;
border-radius:20px;
margin-bottom:20px;
}

.beca-item h3{
font-size:24px;
margin-bottom:15px;
color:#ff00cc;
}

.beca-info{
margin-bottom:10px;
font-size:15.5px;
line-height:1.8;
}

.beca-info strong{
color:#00e5ff;
}

.beca-lista{
margin:6px 0 10px 22px;
font-size:15px;
line-height:1.8;
color:#e6e6e6;
}

.icfes-badge{
display:inline-block;
padding:5px 14px;
border-radius:50px;
font-size:13px;
font-weight:600;
margin-left:8px;
}

.icfes-si{
background:rgba(255,0,80,.2);
color:#ff7ea8;
border:1px solid rgba(255,0,80,.35);
}

.icfes-no{
background:rgba(0,255,150,.15);
color:#7effc2;
border:1px solid rgba(0,255,150,.3);
}

.becas-cerrar{
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

.becas-cerrar:hover{
background:rgba(255,0,80,.4);
}

.becas-sin-resultados{
text-align:center;
color:#a8a8a8;
font-size:16px;
margin-bottom:20px;
}

@keyframes fadeBecas{
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

.becas-header h1{
font-size:34px;
}

.becas-uni{
font-size:26px;
}

.becas-boton{
width:100%;
}

}

</style>

<div class="becas-wrap">

<div class="becas-header">
<h1>Becas Universitarias</h1>
<p>Consulta requisitos, puntaje ICFES/Saber 11 necesario, costo aproximado de la carrera y los beneficios reales de cada beca, universidad por universidad.</p>
</div>

<div class="nota-aviso">
⚠️ Los valores de costos, puntajes y requisitos son <strong>aproximados y con fines informativos</strong>. Las cifras cambian cada año, así que siempre confirma en la página oficial de la universidad o en ICETEX antes de aplicar.
</div>

<!-- BECAS NACIONALES (aplican en todo el país, no solo una universidad) -->

<div class="nacionales">
<h2>Becas y apoyos que aplican a nivel nacional</h2>
<div class="nac-grid">

<div class="nac-card">
<h3>Sapiencia (Medellín)</h3>
<p>Financia estudios técnicos, tecnológicos y universitarios con créditos condonables para jóvenes de Medellín en instituciones aliadas.</p>
</div>

<div class="nac-card">
<h3>ICETEX</h3>
<p>Créditos educativos a nivel nacional para pregrado y posgrado, con líneas de crédito condonable según el estrato y el desempeño académico.</p>
</div>

<div class="nac-card">
<h3>Matrícula Cero</h3>
<p>Gratuidad en universidades públicas para estudiantes de estratos 1, 2 y 3 admitidos, sujeta a disponibilidad de cupos y presupuesto departamental.</p>
</div>

<div class="nac-card">
<h3>Generación E</h3>
<p>Programa del Gobierno Nacional con dos componentes: Excelencia (mejores puntajes Saber 11 de bajos recursos) y Equidad (apoyo económico según SISBEN).</p>
</div>

</div>
</div>

<div class="becas-buscador">
<input type="text" id="becasBuscarInput" placeholder="Buscar universidad por nombre o ciudad..." oninput="filtrarBecasBotones()">
</div>

<div class="becas-filtros" id="becasFiltrosCiudad"></div>

<div class="becas-botones" id="becasContenedorBotones"></div>

<p class="becas-sin-resultados becas-oculto" id="becasSinResultados">No se encontraron universidades con ese criterio.</p>

<div id="becasContenedorCards"></div>

</div>

<script>

/* =========================================================
   BASE DE DATOS DE BECAS POR UNIVERSIDAD
   ========================================================= */

const becasUniversidades = [

  {
    id:"udea",
    nombre:"Universidad de Antioquia",
    ciudad:"Medellín",
    tipo:"Pública",
    costoCarrera:"Matrícula según estrato socioeconómico: desde $80.000 (estrato 1) hasta aprox. $1.800.000 por semestre (estrato alto).",
    becas:[
      {
        nombre:"Beca Bienestar Universitario UdeA",
        icfes:"No aplica puntaje mínimo específico, pero se prioriza buen rendimiento académico",
        requisitos:[
          "Estar matriculado(a) activamente en la universidad",
          "Pertenecer a estratos 1, 2 o 3",
          "Mantener un promedio académico aceptable (no estar en riesgo académico)",
          "Presentar estudio socioeconómico ante Bienestar Universitario"
        ],
        beneficio:"Exoneración parcial o total de matrícula y apoyo de sostenimiento (alimentación o transporte) durante el semestre."
      },
      {
        nombre:"Fondo EPM - Bienestar (para estudiantes de escasos recursos)",
        icfes:"Se valora el desempeño en Saber 11, sin un mínimo estricto",
        requisitos:[
          "Ser admitido(a) a un programa de pregrado",
          "Demostrar dificultades económicas para sostener sus estudios",
          "Estar al día con requisitos administrativos de la universidad"
        ],
        beneficio:"Auxilio económico mensual para transporte y alimentación durante el semestre académico."
      }
    ]
  },

  {
    id:"eafit",
    nombre:"Universidad EAFIT",
    ciudad:"Medellín",
    tipo:"Privada",
    costoCarrera:"Entre $9.000.000 y $14.500.000 por semestre según el programa (ingenierías y negocios suelen ser los más altos).",
    becas:[
      {
        nombre:"Beca de Excelencia Académica EAFIT",
        icfes:"Puntaje Saber 11 igual o superior a 380/500 (aprox.)",
        requisitos:[
          "Puntaje ICFES alto (top de tu colegio o departamento)",
          "Buen desempeño en el proceso de admisión de la universidad",
          "Mantener un promedio mínimo durante la carrera para conservar la beca"
        ],
        beneficio:"Descuento de hasta el 100% en el valor de la matrícula durante todo el programa, sujeto a mantener el promedio exigido."
      },
      {
        nombre:"Beca Solidaria EAFIT",
        icfes:"No exige puntaje mínimo, se prioriza la condición socioeconómica",
        requisitos:[
          "Ser admitido(a) en un programa de pregrado",
          "Pertenecer a estratos 1 o 2, o demostrar vulnerabilidad económica",
          "Presentar estudio socioeconómico con la oficina de Bienestar"
        ],
        beneficio:"Apoyo económico parcial en la matrícula, combinable con crédito ICETEX para cubrir el resto del costo."
      }
    ]
  },

  {
    id:"upb",
    nombre:"Universidad Pontificia Bolivariana",
    ciudad:"Medellín",
    tipo:"Privada",
    costoCarrera:"Entre $7.000.000 y $12.000.000 por semestre según el programa.",
    becas:[
      {
        nombre:"Beca Mejor Bachiller UPB",
        icfes:"Puntaje Saber 11 igual o superior a 350/500 (aprox.), o ser el mejor bachiller del colegio",
        requisitos:[
          "Certificado de ser el mejor bachiller de su promoción",
          "Puntaje ICFES competitivo",
          "Inscribirse dentro de las fechas establecidas por la universidad"
        ],
        beneficio:"Descuento entre el 20% y 50% en la matrícula del primer semestre, renovable según desempeño."
      }
    ]
  },

  {
    id:"udem",
    nombre:"Universidad de Medellín",
    ciudad:"Medellín",
    tipo:"Privada",
    costoCarrera:"Entre $5.500.000 y $9.000.000 por semestre según el programa.",
    becas:[
      {
        nombre:"Beca Talento UdeM",
        icfes:"Puntaje Saber 11 igual o superior a 330/500 (aprox.)",
        requisitos:[
          "Buen puntaje ICFES",
          "Ser admitido(a) en el programa de interés",
          "Mantener promedio académico durante el programa"
        ],
        beneficio:"Descuento parcial en la matrícula durante los primeros semestres."
      }
    ]
  },

  {
    id:"unal-medellin",
    nombre:"Universidad Nacional (Sede Medellín)",
    ciudad:"Medellín",
    tipo:"Pública",
    costoCarrera:"Matrícula según estrato e ingresos familiares: desde aprox. $50.000 hasta $1.500.000 por semestre.",
    becas:[
      {
        nombre:"Programa de Apoyo a Estudiantes de Bajos Recursos (PAES/PEAMA)",
        icfes:"No exige puntaje mínimo específico, aplica principalmente por condición socioeconómica",
        requisitos:[
          "Estar admitido(a) en la sede Medellín",
          "Pertenecer a estratos 1 o 2",
          "Presentar la encuesta socioeconómica de bienestar universitario"
        ],
        beneficio:"Reducción significativa de la matrícula y posibilidad de auxilio de alimentación y alojamiento en residencias universitarias."
      }
    ]
  },

  {
    id:"itm",
    nombre:"Instituto Tecnológico Metropolitano (ITM)",
    ciudad:"Medellín",
    tipo:"Pública",
    costoCarrera:"Matrícula según estrato: desde aprox. $150.000 hasta $700.000 por semestre.",
    becas:[
      {
        nombre:"Beca Sapiencia - ITM",
        icfes:"No exige puntaje mínimo estricto, se prioriza vulnerabilidad económica",
        requisitos:[
          "Ser residente de Medellín",
          "Estar admitido(a) en un programa técnico o tecnológico del ITM",
          "Cumplir con los requisitos de la convocatoria de Sapiencia"
        ],
        beneficio:"Cobertura total o parcial de la matrícula durante la duración del programa."
      }
    ]
  },

  {
    id:"sena",
    nombre:"SENA",
    ciudad:"Medellín (nacional)",
    tipo:"Pública (gratuita)",
    costoCarrera:"Formación 100% gratuita en todos los programas técnicos y tecnológicos.",
    becas:[
      {
        nombre:"Formación gratuita SENA",
        icfes:"No se exige puntaje ICFES",
        requisitos:[
          "Ser mayor de 14 años (según el programa)",
          "Inscribirse a través de la plataforma Sofia Plus",
          "Cumplir con los requisitos específicos de cada programa (algunos piden entrevista o prueba)"
        ],
        beneficio:"Formación técnica o tecnológica sin costo, con posibilidad de auxilio de sostenimiento si se hacen prácticas o etapa productiva."
      }
    ]
  },

  {
    id:"unal-bogota",
    nombre:"Universidad Nacional de Colombia (Sede Bogotá)",
    ciudad:"Bogotá",
    tipo:"Pública",
    costoCarrera:"Matrícula según estrato e ingresos familiares: desde aprox. $50.000 hasta $1.600.000 por semestre.",
    becas:[
      {
        nombre:"Generación E - Componente Equidad",
        icfes:"No exige un mínimo alto, pero prioriza puntajes moderados combinados con SISBEN bajo",
        requisitos:[
          "Estar registrado(a) en el SISBEN con puntaje bajo",
          "Ser admitido(a) en un programa de pregrado presencial",
          "No haber sido beneficiario(a) previamente de este componente"
        ],
        beneficio:"Matrícula gratuita más un componente de sostenimiento mensual para gastos de manutención."
      }
    ]
  },

  {
    id:"andes",
    nombre:"Universidad de los Andes",
    ciudad:"Bogotá",
    tipo:"Privada",
    costoCarrera:"Entre $15.000.000 y $22.000.000 por semestre, una de las más costosas del país.",
    becas:[
      {
        nombre:"Quiero Estudiar (Los Andes)",
        icfes:"Puntaje Saber 11 competitivo (usualmente entre los mejores del país)",
        requisitos:[
          "Pertenecer a los estratos 1, 2 o 3",
          "Tener un puntaje ICFES sobresaliente",
          "Ser admitido(a) por el proceso regular de la universidad",
          "Mantener buen rendimiento académico para conservar el beneficio"
        ],
        beneficio:"Cobertura de hasta el 100% de la matrícula durante toda la carrera, más apoyo de manutención en algunos casos."
      }
    ]
  },

  {
    id:"javeriana",
    nombre:"Pontificia Universidad Javeriana",
    ciudad:"Bogotá",
    tipo:"Privada",
    costoCarrera:"Entre $9.000.000 y $16.000.000 por semestre según el programa.",
    becas:[
      {
        nombre:"Beca Junior Javeriana",
        icfes:"Puntaje Saber 11 igual o superior a 350/500 (aprox.)",
        requisitos:[
          "Ser bachiller con puntaje ICFES alto",
          "Presentar la solicitud dentro del proceso de admisión",
          "Mantener un promedio académico mínimo durante la carrera"
        ],
        beneficio:"Descuento parcial en la matrícula, renovable semestre a semestre según el promedio."
      }
    ]
  },

  {
    id:"rosario",
    nombre:"Universidad del Rosario",
    ciudad:"Bogotá",
    tipo:"Privada",
    costoCarrera:"Entre $10.000.000 y $17.000.000 por semestre según el programa.",
    becas:[
      {
        nombre:"Beca Talento Rosarista",
        icfes:"Puntaje Saber 11 alto (usualmente top de su colegio)",
        requisitos:[
          "Puntaje ICFES sobresaliente",
          "Ser admitido(a) en el proceso regular",
          "Cumplir con el promedio mínimo para renovación"
        ],
        beneficio:"Descuento en matrícula que puede ir del 20% hasta el 100% según el nivel de la beca otorgada."
      }
    ]
  },

  {
    id:"externado",
    nombre:"Universidad Externado de Colombia",
    ciudad:"Bogotá",
    tipo:"Privada",
    costoCarrera:"Entre $8.000.000 y $13.000.000 por semestre según el programa.",
    becas:[
      {
        nombre:"Beca Mejor Icfes Externado",
        icfes:"Puntaje Saber 11 igual o superior a 360/500 (aprox.)",
        requisitos:[
          "Puntaje ICFES competitivo",
          "Presentar solicitud durante el proceso de inscripción",
          "Mantener promedio académico exigido"
        ],
        beneficio:"Descuento significativo en el valor de la matrícula durante el primer año, renovable según desempeño."
      }
    ]
  },

  {
    id:"icesi",
    nombre:"Universidad Icesi",
    ciudad:"Cali",
    tipo:"Privada",
    costoCarrera:"Entre $8.000.000 y $12.500.000 por semestre según el programa.",
    becas:[
      {
        nombre:"Beca Talento Icesi",
        icfes:"Puntaje Saber 11 competitivo (usualmente sobre 350/500)",
        requisitos:[
          "Buen puntaje ICFES",
          "Ser admitido(a) en el programa de interés",
          "Mantener promedio académico mínimo"
        ],
        beneficio:"Descuento parcial en matrícula, combinable con créditos educativos."
      }
    ]
  },

  {
    id:"univalle",
    nombre:"Universidad del Valle",
    ciudad:"Cali",
    tipo:"Pública",
    costoCarrera:"Matrícula según estrato: desde aprox. $100.000 hasta $1.200.000 por semestre.",
    becas:[
      {
        nombre:"Matrícula Cero - Univalle",
        icfes:"No exige puntaje mínimo específico",
        requisitos:[
          "Ser admitido(a) en un programa de pregrado presencial",
          "Pertenecer a estratos 1, 2 o 3",
          "Estar registrado(a) en el SISBEN"
        ],
        beneficio:"Exoneración total del valor de la matrícula durante la duración del programa, sujeta a disponibilidad presupuestal."
      }
    ]
  },

  {
    id:"unorte",
    nombre:"Universidad del Norte",
    ciudad:"Barranquilla",
    tipo:"Privada",
    costoCarrera:"Entre $9.000.000 y $14.000.000 por semestre según el programa.",
    becas:[
      {
        nombre:"Beca Puntaje Icfes Uninorte",
        icfes:"Puntaje Saber 11 igual o superior a 340/500 (aprox.)",
        requisitos:[
          "Puntaje ICFES competitivo",
          "Ser admitido(a) en el proceso regular",
          "Mantener promedio académico mínimo para renovación"
        ],
        beneficio:"Descuento en la matrícula que varía según el puntaje obtenido, renovable cada semestre."
      }
    ]
  },

  {
    id:"uis",
    nombre:"Universidad Industrial de Santander (UIS)",
    ciudad:"Bucaramanga",
    tipo:"Pública",
    costoCarrera:"Matrícula según estrato: desde aprox. $80.000 hasta $900.000 por semestre.",
    becas:[
      {
        nombre:"Beca Bienestar UIS",
        icfes:"No exige puntaje mínimo específico",
        requisitos:[
          "Pertenecer a estratos 1 o 2",
          "Estar matriculado(a) en un programa de pregrado",
          "Presentar estudio socioeconómico"
        ],
        beneficio:"Exoneración parcial de matrícula y apoyo de alimentación en el comedor universitario."
      }
    ]
  },

  {
    id:"utb",
    nombre:"Universidad Tecnológica de Bolívar",
    ciudad:"Cartagena",
    tipo:"Privada",
    costoCarrera:"Entre $6.500.000 y $10.000.000 por semestre según el programa.",
    becas:[
      {
        nombre:"Beca Excelencia UTB",
        icfes:"Puntaje Saber 11 igual o superior a 330/500 (aprox.)",
        requisitos:[
          "Buen puntaje ICFES",
          "Ser admitido(a) en el programa de interés",
          "Mantener promedio académico mínimo durante la carrera"
        ],
        beneficio:"Descuento parcial en la matrícula, renovable semestre a semestre."
      }
    ]
  }

];

/* =========================================================
   RENDER DINÁMICO
   ========================================================= */

const becasContenedorBotones = document.getElementById("becasContenedorBotones");
const becasContenedorCards = document.getElementById("becasContenedorCards");
const becasFiltrosCiudad = document.getElementById("becasFiltrosCiudad");
const becasSinResultados = document.getElementById("becasSinResultados");

let becasCiudadActiva = "todas";

function becasCiudadesUnicas(){
  const set = new Set(becasUniversidades.map(u => u.ciudad.split(" (")[0]));
  return ["todas", ...Array.from(set).sort()];
}

function renderBecasFiltros(){
  becasFiltrosCiudad.innerHTML = "";
  becasCiudadesUnicas().forEach(ciudad=>{
    const btn = document.createElement("button");
    btn.className = "becas-filtro" + (ciudad === becasCiudadActiva ? " activo" : "");
    btn.textContent = ciudad === "todas" ? "Todas las ciudades" : ciudad;
    btn.onclick = ()=>{
      becasCiudadActiva = ciudad;
      renderBecasFiltros();
      filtrarBecasBotones();
    };
    becasFiltrosCiudad.appendChild(btn);
  });
}

function renderBecasBotones(){
  becasContenedorBotones.innerHTML = "";
  becasUniversidades.forEach(u=>{
    const btn = document.createElement("button");
    btn.className = "becas-boton";
    btn.dataset.nombre = (u.nombre + " " + u.ciudad).toLowerCase();
    btn.dataset.ciudad = u.ciudad.split(" (")[0];
    btn.innerHTML = u.nombre + "<small>" + u.ciudad + " · " + u.tipo + "</small>";
    btn.onclick = ()=> mostrarBecas(u.id);
    becasContenedorBotones.appendChild(btn);
  });
}

function renderBecasCards(){
  becasContenedorCards.innerHTML = "";
  becasUniversidades.forEach(u=>{
    const card = document.createElement("div");
    card.className = "becas-card";
    card.id = "beca-" + u.id;

    let becasHTML = "";
    u.becas.forEach(b=>{
      const requisitosHTML = b.requisitos.map(r => `<li>${r}</li>`).join("");
      becasHTML += `
        <div class="beca-item">
          <h3>${b.nombre}</h3>
          <p class="beca-info">
            <strong>¿Puntaje ICFES / Saber 11 requerido?</strong> ${b.icfes}
          </p>
          <p class="beca-info"><strong>Requisitos:</strong></p>
          <ul class="beca-lista">${requisitosHTML}</ul>
          <p class="beca-info"><strong>Beneficios al obtenerla:</strong> ${b.beneficio}</p>
        </div>
      `;
    });

    card.innerHTML = `
      <button class="becas-cerrar" onclick="cerrarBecasCards()">✕ Cerrar</button>
      <h2 class="becas-uni">${u.nombre}</h2>
      <div class="becas-meta">
        <span class="becas-tag">📍 ${u.ciudad}</span>
        <span class="becas-tag">🏛️ ${u.tipo}</span>
      </div>
      <div class="costo-box">
        <strong>💰 Costo aproximado de la carrera:</strong><br>
        ${u.costoCarrera}
      </div>
      <h3 class="carreras-title" style="font-size:22px;margin:20px 0 15px 0;color:#ff00cc;border-bottom:1px solid rgba(255,255,255,.1);padding-bottom:10px;">
        Becas disponibles
      </h3>
      ${becasHTML}
    `;

    becasContenedorCards.appendChild(card);
  });
}

function mostrarBecas(id){
  document.querySelectorAll(".becas-card").forEach(card=>{
    card.style.display = "none";
  });
  const card = document.getElementById("beca-" + id);
  if(card){
    card.style.display = "block";
    card.scrollIntoView({behavior:"smooth", block:"start"});
  }
}

function cerrarBecasCards(){
  document.querySelectorAll(".becas-card").forEach(card=>{
    card.style.display = "none";
  });
}

function filtrarBecasBotones(){
  const texto = document.getElementById("becasBuscarInput").value.toLowerCase();
  let visibles = 0;

  document.querySelectorAll(".becas-boton").forEach(btn=>{
    const coincideTexto = btn.dataset.nombre.includes(texto);
    const coincideCiudad = becasCiudadActiva === "todas" || btn.dataset.ciudad === becasCiudadActiva;
    const mostrarBtn = coincideTexto && coincideCiudad;
    btn.classList.toggle("becas-oculto", !mostrarBtn);
    if(mostrarBtn) visibles++;
  });

  becasSinResultados.classList.toggle("becas-oculto", visibles > 0);
}

renderBecasFiltros();
renderBecasBotones();
renderBecasCards();

</script>