<?php
/*
 * Copyright 2019 - Redzpot Impulso en Imagen S.A. de C.V. 
 * cerda@redzpot.com
 *  */

$_SITE_PATH = $_SERVER["DOCUMENT_ROOT"] . "/" . explode("/", $_SERVER["PHP_SELF"])[1] . "/";
require_once($_SITE_PATH . "/app/model/usuariosCuenta.class.php");

$oUsuario = new usuarioscuenta();
$sesion = $_SESSION[$oUsuario->NombreSesion];
$oUsuario->ValidaNivelUsuario("micuenta");

$oUsuario->usr_id = $_SESSION[$oUsuario->NombreSesion]->usr_id;

$oUsuario->Informacion();

?>
<?php require_once('app/views/default/script_h.html'); ?>
<script type="text/javascript">
$(document).ready(function(e) {
    $("#btnQuitarFoto").button().click(function(e) {
        if (confirm(
                "¿Esta seguro que desea quitar la foto del usuario? Esta acción no se podrá revertir"
            ) === false)
            return;

        $.ajax({
            data: "usr_id=" + $("#usr_id").val() + "&accion=QUITAR_FOTO",
            type: "POST",
            url: "app/views/default/modules/micuenta/m.micuenta.procesa.php",
            beforeSend: function() {

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
                setTimeout(function() {
                    location.reload(); //actualizas el div
                }, 1000);
            }
        });
    });

    $("#cbxPass").change(function(e) {

        if ($("#cbxPass").is(":checked")) {
            $("#usr_pass").prop("disabled", false);
        } else
            $("#usr_pass").prop("disabled", true);
    });
    $("#btnGuardar").click(function(e) {
        if ($("#usr_alias").val() == "" || $("#usr_nombre").val() == "" || $("#usr_nivel").val() ==
            "0" || $("#usr_correoe").val() == "") {
            Alert("", "Llene todos los campos porfavor", "warning");
        } else {
            $("#frmFormulario").submit();
        }
    });
    $("#frmFormulario").ajaxForm({
        beforeSubmit: function(formData, jqForm, options) {},
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
            setTimeout(function() {
                location.reload(); //actualizas el div
            }, 1000);
        }
    });

    if ($("#usr_foto").val() == "") {
        $("#btnQuitarFoto").hide();
        $("#imgFoto").css("display", "none");
        $("#foto").css("display", "inline");
    } else {
        $("#btnQuitarFoto").show();
        $("#imgFoto").css("display", "inline");
        $("#foto").css("display", "none");
    }
});
</script>

<?php require_once('app/views/default/link.html'); ?>

<head>
    <?php require_once('app/views/default/head.html'); ?>
    <title>Perfil</title>
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
                    <div class="container" id="form">
                        <form id="frmFormulario" name="frmFormulario"
                            action="app/views/default/modules/micuenta/m.micuenta.procesa.php"
                            enctype="multipart/form-data" method="post" target="_self" class="form-horizontal">
                            <div style="margin:auto;">
                                <center>

                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Nombre</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="usr_nombre" required name="usr_nombre"
                                                value="<?= $oUsuario->usr_nombre ?>" maxlength="100"
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Contraseña:</label>
                                        <div class="col-sm-10">
                                            <input type="password" id="usr_pass" name="usr_pass" value="" maxlength="45"
                                                disabled class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Modificar Contraseña </label>
                                        <div class="col-sm-10">
                                            <input type="checkbox" id="cbxPass" class="form-control" name="cbxPass" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Archivo de foto:</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="foto" name="foto" value="" />
                                            <img id="imgFoto" name="imgFoto" src="<?= $oUsuario->usr_foto ?>"
                                                class="img-fluid px-3 px-sm-4 mt-3 mb-4" /><br />
                                            <input type="button" id="btnQuitarFoto" name="btnQuitarFoto" value="Quitar"
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Correo-E:</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="usr_correoe" required name="usr_correoe"
                                                value="<?= $oUsuario->usr_correoe ?>" maxlength="100"
                                                placeholder="correo@dominio.com" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <strong class="">Celular:</strong>
                                        <div class="col-sm-10">
                                            <input type="text" id="usr_num" required name="usr_num"
                                                value="<?= $oUsuario->usr_num?>" maxlength="10" placeholder="8700000000"
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="button" class="btn btn-success" id="btnGuardar" value="Guardar">
                                    </div>
                                    <input type="hidden" id="usr_id" name="usr_id" value="<?= $oUsuario->usr_id ?>" />
                                    <input type="hidden" id="accion" name="accion" value="GUARDAR" />
                                    <input type="hidden" id="usr_foto" name="usr_foto"
                                        value="<?= $oUsuario->usr_foto ?>" />
                                </center>
                            </div>
                        </form>
                        <iframe name="pp" style="position:absolute; top:-1500px;"></iframe>
                    </div>
                    <!-- cerrar contenido pagina-->
                </div>
            </div>
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