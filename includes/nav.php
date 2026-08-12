<?php
// nav.php
// Requiere que sesion.php ya haya sido incluido y que exista $_SESSION['correo'].
// Variable opcional $pagina_actual = 'inicio' | 'test' | 'universidades' | 'becas' | 'perfil'
// para resaltar el enlace activo.

$nombre_mostrar = $_SESSION['nombre'] ?? 'Usuario';
$inicial = mb_strtoupper(mb_substr($nombre_mostrar, 0, 1));
$pagina_actual = $pagina_actual ?? '';
?>
<style>
.ot-navbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:18px 60px;
    background:rgba(2,6,23,.75);
    backdrop-filter:blur(10px);
    border-bottom:1px solid rgba(255,255,255,.06);
    flex-wrap:wrap;
    gap:16px;
    position:relative;
    z-index:30;
    font-family:'Poppins',sans-serif;
}
.ot-navbar .ot-logo h1{
    font-size:28px;
    margin:0;
    background:linear-gradient(to right,#00e5ff,#ff00cc);
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}
.ot-navbar .ot-logo p{
    font-size:10px;
    letter-spacing:2px;
    color:#00e5ff;
    margin:0;
}
.ot-navbar a{ text-decoration:none; }
.ot-links{
    display:flex;
    gap:28px;
    align-items:center;
    flex-wrap:wrap;
}
.ot-links a{
    color:#e8e8ea;
    font-size:15px;
    opacity:.85;
    transition:.2s;
}
.ot-links a:hover{ opacity:1; color:#00e5ff; }
.ot-links a.ot-activo{ color:#00e5ff; opacity:1; font-weight:600; }
.ot-user{ position:relative; }
.ot-user-btn{
    display:flex;
    align-items:center;
    gap:10px;
    background:rgba(255,255,255,.06);
    border:1px solid rgba(255,255,255,.12);
    padding:6px 16px 6px 6px;
    border-radius:50px;
    cursor:pointer;
    color:white;
    font-family:inherit;
    font-size:14px;
}
.ot-avatar{
    width:32px;
    height:32px;
    border-radius:50%;
    background:linear-gradient(135deg,#00e5ff,#ff00cc);
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:700;
    font-size:14px;
    color:#020617;
    flex-shrink:0;
}
.ot-caret{ font-size:11px; opacity:.7; }
.ot-dropdown{
    display:none;
    position:absolute;
    right:0;
    top:calc(100% + 10px);
    background:#0e1526;
    border:1px solid rgba(255,255,255,.1);
    border-radius:14px;
    min-width:190px;
    padding:8px;
    box-shadow:0 20px 50px rgba(0,0,0,.5);
}
.ot-dropdown.show{ display:block; }
.ot-dropdown a, .ot-dropdown .ot-dropdown-item{
    display:block;
    width:100%;
    text-align:left;
    background:none;
    border:none;
    color:#e8e8ea;
    padding:10px 12px;
    border-radius:8px;
    font-size:14px;
    cursor:pointer;
    font-family:inherit;
}
.ot-dropdown a:hover{ background:rgba(255,255,255,.07); color:white; }
.ot-dropdown hr{ border:none; border-top:1px solid rgba(255,255,255,.08); margin:6px 4px; }
.ot-dropdown-nombre{
    padding:8px 12px 4px;
    font-size:13px;
    color:#8a8a95;
}
@media(max-width:900px){
    .ot-navbar{ padding:16px 20px; }
    .ot-links{ gap:16px; }
}
</style>

<nav class="ot-navbar">

    <div class="ot-logo">
        <h1>Optimus-Tu</h1>
        <p>DESCUBRE TU FUTURO</p>
    </div>

    <div class="ot-links">
        <a href="<?php echo BASE_URL; ?>/paginas/inicio.php" class="<?php echo $pagina_actual === 'inicio' ? 'ot-activo' : ''; ?>">Inicio</a>
        <a href="<?php echo BASE_URL; ?>/paginas/test.php" class="<?php echo $pagina_actual === 'test' ? 'ot-activo' : ''; ?>">Test Vocacional</a>
        <a href="<?php echo BASE_URL; ?>/paginas/universidades/universidades.php" class="<?php echo $pagina_actual === 'universidades' ? 'ot-activo' : ''; ?>">Universidades</a>
        <a href="<?php echo BASE_URL; ?>/paginas/becas.php" class="<?php echo $pagina_actual === 'becas' ? 'ot-activo' : ''; ?>">Becas</a>
    </div>

    <div class="ot-user">
        <button type="button" class="ot-user-btn" onclick="document.getElementById('otDropdown').classList.toggle('show')">
            <span class="ot-avatar"><?php echo htmlspecialchars($inicial); ?></span>
            <span><?php echo htmlspecialchars($nombre_mostrar); ?></span>
            <span class="ot-caret">&#9662;</span>
        </button>
        <div class="ot-dropdown" id="otDropdown">
            <div class="ot-dropdown-nombre"><?php echo htmlspecialchars($nombre_mostrar); ?></div>
            <hr>
            <a href="<?php echo BASE_URL; ?>/cuenta/perfil.php">Mi perfil</a>
            <a href="<?php echo BASE_URL; ?>/auth/logout.php">Cerrar sesión</a>
        </div>
    </div>

</nav>

<script>
document.addEventListener('click', function(e){
    var dd = document.getElementById('otDropdown');
    var btn = document.querySelector('.ot-user-btn');
    if(dd && btn && !dd.contains(e.target) && !btn.contains(e.target)){
        dd.classList.remove('show');
    }
});
</script>
