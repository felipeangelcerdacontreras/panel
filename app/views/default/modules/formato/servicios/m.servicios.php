<?php
/*
 * Copyright 2019 - Redzpot Impulso en Imagen S.A. de C.V. 
 * cerda@redzpot.com
 */
$_SITE_PATH = $_SERVER["DOCUMENT_ROOT"] . "/" . explode("/", $_SERVER["PHP_SELF"])[1] . "/";
require_once($_SITE_PATH . "/app/model/servicios.class.php");

$oServicios = new Servicios();
$oServicios->ValidaNivelUsuario("tecnologia");

?>
<?php require_once('app/views/default/script_h.html'); ?>
<script type="text/javascript">
$(document).ready(function(e) {
    Listado();
    $("#btnGuardar").button().click(function(e) {
        $("#frmFormulario").submit();
    });

    $("#btnBuscar").button().click(function(e) {
        Listado();
    });
});

function Editar(id) {
    var jsonDatos = {
        "id_servicios": id
    };

    $.ajax({
        data: jsonDatos,
        type: "post",
        url: "app/views/default/modules/formato/servicios/m.servicios.form.php",
        beforeSend: function() {
            $("#divFormulario").html(
                '<div class="container"><center><img src="app/views/default/img/loading.gif" border="0"/><br />Cargando formulario, espere un momento por favor...</center></div>'
            );
        },
        success: function(datos) {
            $("#divFormulario").html(datos);
        }
    });
    $("#myModal_1").modal({
        backdrop: "true"
    });
}

function Borrar(id) {
    if (confirm("¿Estas seguro de borrar el servicio?") == false)
        return;
    var jsonDatos = {
        "id_servicios": id,
        "accion": "BORRAR"
    };

    $.ajax({
        data: jsonDatos,
        type: "POST",
        url: "app/views/default/modules/formato/servicios/m.servicios.procesa.php",
        beforeSend: function() {
            $("#divListado").html(
                '<center><img src="app/views/default/images/loading.gif" border="0"/><br />Leyendo información de la Base de Datos, espere un momento por favor...</center>');
        },
        success: function(data) {
            var str = data;
            var datos0 = str.split("@")[0];
            var datos1 = str.split("@")[1];
            var datos2 = str.split("@")[2];
            if ((datos3 = str.split("@")[3]) === undefined) {
                datos3 = "";
            } else {
                datos3 = str.split("@")[3];
            }
            Alert(datos0, datos1 + "  " + datos3, datos2);
            Listado();
        }
    });
}

function Listado() {
    var jsonDatos = {

    };
    $.ajax({
        data: jsonDatos,
        type: "post",
        url: "app/views/default/modules/formato/servicios/m.servicios.listado.php",
        beforeSend: function() {
            $("#divListado").html(ImagenCargando());
        },
        success: function(datos) {
            $("#divListado").html(datos);
        }
    });
}
</script>
<?php require_once('app/views/default/link.html'); ?>

<head>
    <?php require_once('app/views/default/head.html'); ?>
    <title>Servicios</title>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- archivo menu-->
        <?php require_once('app/views/default/menu.php'); ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!--archivo header-->
                <?php require_once('app/views/default/header.php'); ?>
                <div class="container-fluid">
                    <!-- contenido de la pagina -->

                    <!-- cerrar contenido pagina-->
                    <div id="divListado"></div>
                </div>
            </div>
            <!-- Logout Modal-->
            <div class="modal fade bd-example-modal-lg" id="myModal_1" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                <strong>Servicios</strong>
                            </h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- contenido del modal-->
                            <div style="width:100%;" class="modal-body" id="divFormulario">
                            </div>
                        </div>
                        <div class="modal-footer">

                            <input type="submit" class="btn btn-success" id="btnGuardar" value="Guardar">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->

            <!-- archivo Footer -->
            <?php require_once('app/views/default/footer.php'); ?>
            <!-- End of Footer -->
        </div>
    </div>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <?php require_once('app/views/default/script_f.html'); ?>
</body>

</html>