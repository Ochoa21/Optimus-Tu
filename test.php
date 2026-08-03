
<?php
include('sesion.php');

if(!isset($_SESSION['correo'])){
    header("Location: login.php");
    exit;
}

$pagina_actual = 'test';
?>

<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Test Vocacional | Optimus-Tu</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{

min-height:100vh;

background:
linear-gradient(rgba(2,6,23,.90),rgba(2,6,23,.94)),
url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=2071&auto=format&fit=crop');

background-size:cover;
background-position:center;
background-attachment:fixed;

padding:40px;

color:white;
}

/* CONTENEDOR */

.container{

max-width:1100px;

margin:auto;

background:rgba(255,255,255,.05);

border:1px solid rgba(255,255,255,.1);

backdrop-filter:blur(14px);

padding:45px;

border-radius:35px;
}

/* LOGO */

.logo{

text-align:center;
margin-bottom:30px;
}

.logo h1{

font-size:55px;

background:linear-gradient(to right,#00e5ff,#ff00cc);

-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
}

.logo p{

color:#d8d8d8;

letter-spacing:3px;

font-size:14px;
}

/* TITULO */

.title{

text-align:center;

margin-bottom:50px;
}

.title h2{

font-size:42px;

margin-bottom:15px;
}

.title span{
color:#00e5ff;
}

.title p{

font-size:18px;

color:#d8d8d8;

line-height:1.8;
}

/* PREGUNTAS */

.question{

background:rgba(255,255,255,.04);

padding:30px;

border-radius:25px;

margin-bottom:30px;

border:1px solid rgba(255,255,255,.08);

transition:.4s;
}

.question:hover{

transform:translateY(-5px);

border:1px solid rgba(0,229,255,.25);

box-shadow:0 0 20px rgba(0,229,255,.15);
}

.question h3{

font-size:25px;

margin-bottom:22px;

color:#00e5ff;

line-height:1.5;
}

/* OPCIONES */

label{

display:block;

padding:15px 18px;

margin-bottom:15px;

background:rgba(255,255,255,.04);

border-radius:15px;

cursor:pointer;

transition:.3s;

font-size:17px;
}

label:hover{

background:rgba(0,229,255,.12);

transform:translateX(8px);
}

input[type="radio"]{

margin-right:12px;

accent-color:#00e5ff;
}

/* BOTON */

.btn{

width:100%;

padding:20px;

border:none;

border-radius:60px;

background:
linear-gradient(
90deg,
#00bfff,
#6a5cff,
#ff00cc
);

color:white;

font-size:22px;
font-weight:700;

cursor:pointer;

margin-top:20px;

transition:.4s;
}

.btn:hover{

transform:scale(1.02);
}

.btn:disabled{

opacity:.6;

cursor:not-allowed;

transform:none;
}

/* RESULTADO */

.resultado{

display:none;

margin-top:40px;

padding:40px;

border-radius:30px;

background:rgba(255,255,255,.07);

border:1px solid rgba(255,255,255,.1);
}

.resultado h2{

font-size:38px;

margin-bottom:20px;

color:#00e5ff;
}

.resultado p{

font-size:20px;

line-height:2;

color:#e5e5e5;
}

.estado-guardado{

margin-top:20px;

font-size:16px;

font-weight:600;
}

.estado-guardado.ok{
color:#00e676;
}

.estado-guardado.error{
color:#ff5252;
}

</style>

</head>

<body>

<?php include('nav.php'); ?>

<div class="container">

<div class="title">

<h2>
TEST <span>VOCACIONAL</span> Y PSICOSOCIAL
</h2>

<p>
Responde honestamente y descubre qué carreras
se adaptan mejor a tu personalidad.
</p>

</div>

<form id="testForm">

<!-- PREGUNTA 1 -->

<div class="question">

<h3>
1. Imagina que tienes un día completamente libre...
¿Qué harías sin pensarlo?
</h3>

<label>
<input type="radio" name="p1" value="tecnologia">
Explorar tecnología o videojuegos
</label>

<label>
<input type="radio" name="p1" value="arte">
Dibujar, editar o crear contenido
</label>

<label>
<input type="radio" name="p1" value="salud">
Ayudar o escuchar personas
</label>

<label>
<input type="radio" name="p1" value="negocios">
Pensar en proyectos o negocios
</label>

<label>
<input type="radio" name="p1" value="educacion">
Leer o aprender cosas nuevas
</label>

</div>

<!-- PREGUNTA 2 -->

<div class="question">

<h3>
2. Cuando alguien tiene un problema, tú...
</h3>

<label>
<input type="radio" name="p2" value="salud">
Escuchas y aconsejas
</label>

<label>
<input type="radio" name="p2" value="tecnologia">
Buscas soluciones lógicas
</label>

<label>
<input type="radio" name="p2" value="arte">
Piensas creativamente
</label>

<label>
<input type="radio" name="p2" value="negocios">
Tomas el control
</label>

<label>
<input type="radio" name="p2" value="educacion">
Explicas cómo resolverlo
</label>

</div>

<!-- PREGUNTA 3 -->

<div class="question">

<h3>
3. ¿Qué contenido consumes más?
</h3>

<label>
<input type="radio" name="p3" value="tecnologia">
Tecnología y ciencia
</label>

<label>
<input type="radio" name="p3" value="arte">
Arte y música
</label>

<label>
<input type="radio" name="p3" value="salud">
Psicología y emociones
</label>

<label>
<input type="radio" name="p3" value="negocios">
Dinero y emprendimiento
</label>

<label>
<input type="radio" name="p3" value="educacion">
Historia y cultura
</label>

</div>

<!-- PREGUNTA 4 -->

<div class="question">

<h3>
4. ¿Qué frase se parece más a ti?
</h3>

<label>
<input type="radio" name="p4" value="tecnologia">
Me gusta entender cómo funcionan las cosas
</label>

<label>
<input type="radio" name="p4" value="arte">
Necesito expresar mi creatividad
</label>

<label>
<input type="radio" name="p4" value="salud">
Me importa mucho ayudar
</label>

<label>
<input type="radio" name="p4" value="negocios">
Me gusta liderar
</label>

<label>
<input type="radio" name="p4" value="educacion">
Disfruto aprender y enseñar
</label>

</div>

<!-- PREGUNTA 5 -->

<div class="question">

<h3>
5. ¿Qué actividad te hace perder la noción del tiempo?
</h3>

<label>
<input type="radio" name="p5" value="tecnologia">
Resolver retos
</label>

<label>
<input type="radio" name="p5" value="arte">
Diseñar o crear
</label>

<label>
<input type="radio" name="p5" value="salud">
Hablar con personas
</label>

<label>
<input type="radio" name="p5" value="negocios">
Planear proyectos
</label>

<label>
<input type="radio" name="p5" value="educacion">
Investigar o leer
</label>

</div>

<button type="button"
id="btnDescubrir"
class="btn"
onclick="resultado()">

Descubrir mi vocación

</button>

</form>

<div class="resultado" id="resultado">

<h2 id="titulo"></h2>

<p id="texto"></p>

<p class="estado-guardado" id="estadoGuardado"></p>

</div>

<a href="inicio.php" class="btn" style="display:inline-block;text-align:center;margin-top:30px;text-decoration:none;">&larr; Volver al inicio</a>

</div>

<script>

function resultado(){

let respuestas = document.querySelectorAll('input[type="radio"]:checked');

if(respuestas.length < 5){

alert("Debes responder todas las preguntas");

return;
}

let puntos = {

tecnologia:0,
arte:0,
salud:0,
negocios:0,
educacion:0

};

respuestas.forEach((r)=>{

puntos[r.value]++;

});

let mayor = "";
let max = 0;

for(let area in puntos){

if(puntos[area] > max){

max = puntos[area];
mayor = area;

}

}

let titulo = "";
let texto = "";

if(mayor == "tecnologia"){

titulo = "💻 PERFIL TECNOLÓGICO";

texto = `
Carreras recomendadas:

• Ingeniería de Sistemas
• Desarrollo de Software
• Ciberseguridad
• Inteligencia Artificial
• Ciencia de Datos
`;

}

else if(mayor == "arte"){

titulo = "🎨 PERFIL CREATIVO";

texto = `
Carreras recomendadas:

• Diseño Gráfico
• Arquitectura
• Producción Audiovisual
• Publicidad
• Fotografía
`;

}

else if(mayor == "salud"){

titulo = "❤️ PERFIL HUMANISTA";

texto = `
Carreras recomendadas:

• Psicología
• Medicina
• Enfermería
• Trabajo Social
• Fisioterapia
`;

}

else if(mayor == "negocios"){

titulo = "📈 PERFIL EMPRESARIAL";

texto = `
Carreras recomendadas:

• Administración de Empresas
• Marketing
• Finanzas
• Negocios Internacionales
• Economía
`;

}

else{

titulo = "📚 PERFIL EDUCATIVO";

texto = `
Carreras recomendadas:

• Pedagogía
• Filosofía
• Historia
• Sociología
• Comunicación Social
`;

}

document.getElementById("resultado").style.display = "block";

document.getElementById("titulo").innerHTML = titulo;

document.getElementById("texto").innerHTML = texto;

window.scrollTo({

top:document.body.scrollHeight,
behavior:'smooth'

});

guardarResultado(mayor);

}

function guardarResultado(perfil){

const boton = document.getElementById("btnDescubrir");
const estado = document.getElementById("estadoGuardado");

boton.disabled = true;
estado.className = "estado-guardado";
estado.textContent = "Guardando tu resultado en tu perfil...";

const datos = new URLSearchParams();
datos.append("resultado", perfil);

fetch("guardar_resultado.php", {
method: "POST",
headers: {
"Content-Type": "application/x-www-form-urlencoded"
},
body: datos
})
.then(respuesta => respuesta.json())
.then(data => {

boton.disabled = false;

if(data.success){
estado.className = "estado-guardado ok";
estado.textContent = "✔ " + data.message;
} else {
estado.className = "estado-guardado error";
estado.textContent = "✖ " + data.message;
}

})
.catch(() => {

boton.disabled = false;
estado.className = "estado-guardado error";
estado.textContent = "✖ No se pudo conectar con el servidor para guardar tu resultado";

});

}

</script>

<?php include('footer.php'); ?>

</body>
</html>
