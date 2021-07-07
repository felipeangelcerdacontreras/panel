<?php
/*
 * Copyright 2019 - Redzpot Impulso en Imagen S.A. de C.V. 
 * cerda@redzpot.com
 */
$_SITE_PATH = $_SERVER["DOCUMENT_ROOT"] . "/" . explode("/", $_SERVER["PHP_SELF"])[1] . "/";
require_once($_SITE_PATH . "/app/model/usuarios.class.php");

$oUsuarios = new Usuarios();
$sesion = $_SESSION[$oUsuarios->NombreSesion];
$oUsuarios->ValidaNivelUsuario("usuarios");


$lstUsuarios = $oUsuarios->Listado();


?>
<?php require_once('app/views/default/script_h.html'); ?>
<script type="text/javascript">
$(document).ready(function(e) {
    Listado();
    $("#btnGuardar").button().click(function(e) {
        if ($("#cli_id").val() === "0" || $("#usr_alias").val() === "" || $("#usr_nombre").val() ===
            "" || $("#usr_nivel").val() === "0" || $("#usr_correoe").val() === "") {
            Alert("", "Llene todos los campos porfavor", "warning");
        } else {
            $("#frmFormulario").submit();
        }
    });
    $("#btnBuscar").button().click(function(e) {
        Listado();
    });

});

function Listado() {
    var jsonDatos = {
        "accion": "BUSCAR"
    };
    $.ajax({
        data: jsonDatos,
        type: "POST",
        url: "app/views/default/modules/catalogos/usuarios/m.usuarios.listado.php",
        beforeSend: function() {
            $("#divListado").html(
                '<div class="container"><center><img src="app/views/default/img/loading.gif" border="0"/><br />Leyendo información de la Base de Datos, espere un momento por favor...</center></div>'
            );
        },
        success: function(datos) {
            $("#divListado").html(datos);
        }
    });
}

function Editar(usr_id) {
    $.ajax({
        data: "usr_id=" + usr_id,
        type: "POST",
        url: "app/views/default/modules/catalogos/usuarios/m.usuarios.formulario.php",
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

function Borrar(usr_id) {
    if (confirm("¿Está seguro de borrar el registro seleccionado?") == false)
        return;

    $.ajax({
        data: "usr_id=" + usr_id + "&accion=BORRAR",
        type: "POST",
        url: "app/views/default/modules/catalogos/usuarios/m.usuarios.procesa.php",
        beforeSend: function() {
            $("#divListado").html(
                '<div class="container"><center><img src="app/views/default/img/loading.gif" border="0"/><br />Leyendo información de la Base de Datos, espere un momento por favor...</center></div>'
            );
        },
        success: function(data) {
            var str = data;
            var datos0 = str.split("@")[0];
            var datos1 = str.split("@")[1];
            var datos2 = str.split("@")[2];
            var datos3 = str.split("@")[3];
            if (datos3 === undefined) {
                Alert(datos0, datos1, datos2);
            } else {
                Alert(datos0, datos1 + "  " + datos3, datos2);
            }
            Listado();
        }
    });
}
</script>

<?php require_once('app/views/default/link.html'); ?>

<head>
    <?php require_once('app/views/default/head.html'); ?>
    <title>Usuarios</title>
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
            <div class="modal fade" id="myModal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><strong>Usuarios</strong>
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