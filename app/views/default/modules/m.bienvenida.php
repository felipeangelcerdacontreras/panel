<?php
/*
 * Copyright 2019 - Redzpot Impulso en Imagen S.A. de C.V. 
 * cerda@redzpot.com
 *  */
$_SITE_PATH = $_SERVER["DOCUMENT_ROOT"] . "/" . explode("/", $_SERVER["PHP_SELF"])[1] . "/";
require_once($_SITE_PATH . "/Configuracion.class.php");


$oConfig = new Configuracion();
$sesion = $_SESSION[$oConfig->NombreSesion];


$horasaludo = date("H:i");

if ($horasaludo >= "00:00" && $horasaludo < "12:00"){
    $horasaludoF = "Buen día";
}

if ($horasaludo >= "12:00" && $horasaludo < "19:00"){
    $horasaludoF = "Buenas tardes";
}

if ($horasaludo >= "19:00" && $horasaludo < "24:00"){
    $horasaludoF = "Buenas noches";
}
setlocale(LC_ALL,"es_ES");
$texto = strftime("%A %d de %B del %Y");
?>
<?php require_once('app/views/default/script_h.html'); ?>
<!DOCTYPE html PUBLIC>
<html>
<title>Bienvenid@</title>
<?php require_once('app/views/default/link.html'); ?>
<?php require_once('app/views/default/head.html'); ?>
<!-- aqui empieza plantilla-->
<script type="text/javascript">
$(document).ready(function(e) {

});
</script>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php require_once('app/views/default/menu.php'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php require_once('app/views/default/header.php'); ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!--contenido pagg-->
                    <!-- Content Row -->
                    <div class="container">
                        <!-- Illustrations -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    <?php print"<h1>$horasaludoF, $sesion->usr_nombre</h1>";?></h6>
                            </div>
                            <strong style="text-align: right"><?=$texto;?>&nbsp&nbsp</strong>
                            <div class="card-body">
                                <div class="text-center">
                                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 22rem;" src="app/views/default/images/redzpot.jfif" alt="">
                                </div>
                                <p>Redzpot Impulso en Imagen S.A. de C.V. es una empresa lagunera que inicia operaciones
                                    en el 2005 como resultado de la necesidad de ofrecer a las empresas de nuestra
                                    región publicidad digital de alto impacto y con un respaldo tecnológico de
                                    vanguardia. Nuestro innovador concepto nos ha permitido marcar la pauta hasta llegar
                                    a ser líderes en nuestra región para el ramo de la publicidad digital en interiores;
                                    como: cafeterías, restaurantes, gimnasios, plazas comerciales, tiendas de
                                    conveniencia, tiendas de autoservicio, etc. Hemos desarrollado nuestra propia
                                    infraestructura tecnológica lo cual nos permite ir un paso adelante en un medio tan
                                    competitivo como lo es la publicidad. Contamos con el equipo humano necesario para
                                    ofrecer a nuestros clientes la más alta calidad en producción, atención y servicio.
                                </p>
                            </div>
                        </div>
                        <?php $lstValuadores;?>

                        <!-- Approach -->
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php require_once('app/views/default/footer.php'); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
</body>
<!-- aqui termina plantilla-->
<?php require_once('app/views/default/script_f.html'); ?>
</body>

</html>