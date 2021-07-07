<?php
/*
 * Copyright 2019 - Redzpot Impulso en Imagen S.A. de C.V. 
 * cerda@redzpot.com
 *  */
$_SITE_PATH = $_SERVER["DOCUMENT_ROOT"] . "/" . explode("/", $_SERVER["PHP_SELF"])[1] . "/";
require_once($_SITE_PATH . "app/model/agencias.class.php");

$oAgencias = new Agencias();
$sesion = $_SESSION[$oAgencias->NombreSesion];
$oAgencias->ValidaSession($sesion->usr_id);
$oAgencias->ValidaNivelUsuario("agencias");

?>
<?php require_once('app/views/default/script_h.html'); ?>
<script type="text/javascript">
$(document).ready(function(e) {
    $("#btnGuardar").button().click(function(e) {
        if ($("#age_nom_empresa").val() === "" || $("#age_rfc").val() === "" || $("#age_direccion").val() === "" || $(
                "#age_correo_empresa").val() === "" || $("#age_tel_empresa").val() === "" ){
            Alert("", "Llene todos los campos porfavor", "warning");
        } else {
            $("#frmFormulario").submit();
        }
    });

    $("#btnBuscar").button().click(function(e) {
        Listado();
    });
    Listado();
});

function Editar(id) {
    var jsonDatos = {
        "age_id": id
    };

    $.ajax({
        data: jsonDatos,
        type: "post",
        url: "app/views/default/modules/catalogos/agencias/m.agencias.form.php",
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
    if (confirm("Esta seguro de borrar la información del cliente? Esta acción no se podra deshacer") === false)
        return;

    var jsonDatos = {
        "age_id": id,
        "accion": "BORRAR"
    };

    $.ajax({
        data: jsonDatos,
        type: "post",
        url: "app/views/default/modules/catalogos/agencias/m.agencias.procesa.php",
        beforeSend: function() {},
        success: function(data) {
            Listado();
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
        }
    });
}

function Listado() {
    var jsonDatos = {
        "age_activo": $("#age_activo_1 option:selected").val()
    };
    $.ajax({
        data: jsonDatos,
        type: "post",
        url: "app/views/default/modules/catalogos/agencias/m.agencias.listado.php",
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
    <title>Agencias</title>
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
                    <div class="container">
                        <form id="frmOpciones" name="frmOpciones" method="post" class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-sm-2">Estado de agencia:</label>
                                <div class="col-sm-10">
                                    <select id="age_activo_1" name="age_activo" class="form-control"
                                        onchange="Listado()">
                                        <option value="1">ACTIVO</option>
                                        <option value="0">INACTIVO</option>
                                        <option value="T">-- TODOS --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" style="float:rigth;">
                                <input type="button" class="btn btn-primary" id="btnBuscar" name="btnBuscar"
                                    value="Buscar">
                            </div>
                        </form>
                        <hr>
                    </div>
                    <!-- cerrar contenido pagina-->
                    <div id="divListado"></div>
                </div>
            </div>
            <!-- Logout Modal-->
            <div class="modal fade" id="myModal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><strong>Informacion de agencias</strong>
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