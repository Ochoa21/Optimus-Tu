<?php
// footer.php
// Requiere que sesion.php ya haya sido incluido antes (para leer $_SESSION si existe).
$logueado = isset($_SESSION['correo']);
?>
<style>
.ot-footer{
    margin-top:60px;
    padding:45px 60px 25px;
    background:rgba(2,6,23,.9);
    border-top:1px solid rgba(255,255,255,.07);
    color:#c9c9d1;
    font-family:'Poppins',sans-serif;
}
.ot-footer-inner{
    display:flex;
    flex-wrap:wrap;
    justify-content:space-between;
    gap:30px;
    max-width:1200px;
    margin:0 auto;
}
.ot-footer-inner > div{ min-width:200px; }
.ot-footer h4{
    color:white;
    font-size:15px;
    margin-bottom:14px;
}
.ot-footer p{
    font-size:14px;
    line-height:1.8;
    margin:0 0 6px;
    color:#b8b8c2;
}
.ot-footer a{
    color:#c9c9d1;
    text-decoration:none;
    font-size:14px;
}
.ot-footer a:hover{ color:#00e5ff; }
.ot-footer-bottom{
    text-align:center;
    margin-top:30px;
    padding-top:20px;
    border-top:1px solid rgba(255,255,255,.06);
    font-size:13px;
    color:#75757e;
}
@media(max-width:900px){
    .ot-footer{ padding:35px 24px 20px; }
}
</style>

<footer class="ot-footer">
    <div class="ot-footer-inner">

        <div>
            <h4>Optimus-Tu</h4>
            <p>Te ayudamos a descubrir tu vocación y a encontrar el camino académico que mejor se ajusta a ti.</p>
        </div>

        <div>
            <h4>Explora</h4>
            <?php if ($logueado): ?>
                <p><a href="<?php echo BASE_URL; ?>/paginas/inicio.php">Inicio</a></p>
                <p><a href="<?php echo BASE_URL; ?>/paginas/test.php">Test Vocacional</a></p>
                <p><a href="<?php echo BASE_URL; ?>/paginas/universidades/universidades.php">Universidades</a></p>
                <p><a href="<?php echo BASE_URL; ?>/paginas/becas.php">Becas</a></p>
            <?php else: ?>
                <p><a href="<?php echo BASE_URL; ?>/inicio.html">Inicio</a></p>
                <p><a href="<?php echo BASE_URL; ?>/inicio.html#quienes-somos">Quiénes somos</a></p>
            <?php endif; ?>
        </div>

        <div>
            <h4><?php echo $logueado ? 'Tu cuenta' : 'Accede'; ?></h4>
            <?php if ($logueado): ?>
                <p><a href="<?php echo BASE_URL; ?>/cuenta/perfil.php">Mi perfil</a></p>
                <p><a href="<?php echo BASE_URL; ?>/auth/logout.php">Cerrar sesión</a></p>
            <?php else: ?>
                <p><a href="<?php echo BASE_URL; ?>/auth/login.php">Iniciar sesión</a></p>
                <p><a href="<?php echo BASE_URL; ?>/auth/registro.php">Regístrate</a></p>
            <?php endif; ?>
        </div>

    </div>

    <div class="ot-footer-bottom">
        &copy; <?php echo date('Y'); ?> Optimus-Tu. Todos los derechos reservados.
    </div>
</footer>
