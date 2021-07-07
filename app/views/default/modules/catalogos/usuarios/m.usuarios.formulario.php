<?php
/*
 * Copyright 2019 - Redzpot Impulso en Imagen S.A. de C.V. 
 * cerda@redzpot.com
 */
session_start();

$_SITE_PATH = $_SERVER["DOCUMENT_ROOT"] . "/" . explode("/", $_SERVER["PHP_SELF"])[1] . "/";
require_once($_SITE_PATH . "/app/model/usuarios.class.php");

$oUsuario = new usuarios ();
$oUsuario->usr_id = addslashes(filter_input(INPUT_POST, "usr_id"));
$sesion = $_SESSION[$oUsuario->NombreSesion];
$oUsuario->Informacion();

$aPermisos = empty($oUsuario->usr_permisos) ? array() : explode("@", $oUsuario->usr_permisos);

?>
<script type="text/javascript">
$(document).ready(function(e) {

    $("#btnQuitarFoto").button().click(function(e) {
        if (confirm(
                "¿Esta seguro que desea quitar la foto del usuario?. Esta acción no se podrá revertir"
            ) === false)
            return;


        $.ajax({
            data: "usr_id=" + $("#usr_id").val() + "&accion=QUITAR_FOTO",
            type: "POST",
            url: "app/views/default/modules/catalogos/usuarios/m.usuarios.procesa.php",
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
                Editar($("#usr_id").val());
                Listado();
            }
        });
    });

    $("#cbxPass").change(function(e) {

        if ($("#cbxPass").is(":checked")) {
            $("#usr_pass").prop("disabled", false);
        } else
            $("#usr_pass").prop("disabled", true);
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
            Alert(datos0, datos1 + "" + datos3, datos2);
            Listado();
            $("#myModal_1").modal("hide");
        }
    });


    // oculto o muestro los botones y elementos para subir el archivo de Foto
    if ($("#usr_foto").val() === "") {
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
<form id="frmFormulario" name="frmFormulario"
    action="app/views/default/modules/catalogos/usuarios/m.usuarios.procesa.php" enctype="multipart/form-data"
    method="post" target="_self" class="form-horizontal">
    <div>

        <div class="form-group">
            <strong class="">Nombre:</strong>
            <div class="form-group">
                <input type="text" class="form-control form-control-user" aria-describedby="emailHelp" id="usr_nombre"
                    required name="usr_nombre" value="<?= $oUsuario->usr_nombre ?>" class="form-control" />
            </div>
        </div>
        <div class="form-group">
            <strong class="">Contraseña:</strong>
            <div class="form-group">
                <input type="text" class="form-control form-control-user" aria-describedby="emailHelp" id="usr_pass"
                    required name="usr_pass" value="" disabled maxlength="15" class="form-control" />
            </div>
        </div>
        <div class="form-group">
            <strong class="">Modificar Contraseña: </strong>
            <div class="col-sm-10">
                <input type="checkbox" id="cbxPass" class="form-control" name="cbxPass" />
            </div>
        </div>
        <div class="form-group">
            <strong class="">Archivo de foto:</strong>
            <div class="form-group">
                <input type="file" id="foto" name="foto" value="" />
                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" id="imgFoto" name="imgFoto"
                    src="/public_html/<?= $oUsuario->usr_foto ?>" width="" /><br />
                <input type="button" i/ind="btnQuitarFoto" name="btnQuitarFoto" value="Quitar" class="form-control" />
            </div>
        </div>
        <div class="form-group">
            <strong class="">Correo-E:</strong>
            <div class="col-sm-10">
                <input type="email" id="usr_correoe" required name="usr_correoe" value="<?= $oUsuario->usr_correoe ?>"
                    maxlength="100" placeholder="correo@dominio.com" class="form-control" />
            </div>
        </div>
        <div class="form-group">
            <strong class="">Celular:</strong>
            <div class="col-sm-10">
                <input type="text" id="usr_num" required name="usr_num" value="<?= $oUsuario->usr_num?>" maxlength="10"
                    placeholder="8700000000" class="form-control" />
            </div>
        </div>
        <div class="form-group">
            <strong class="">Permisos: </strong>
            <div class="col-sm-10">
                <table id="dtBasicExample" class="table table-bordered-curved table-hover" cellspacing="0" width="100%">
                    <tr>
                        <td style="vertical-align: top;">
                            <strong>Usuarios</strong><br />
                            <input type="checkbox" name="usr_permisos[]" value="usuarios"
                                <?php if ($oUsuario->ExistePermiso("usuarios", $aPermisos) === true) echo "checked" ?>><br>
                            <strong>Perfil</strong><br />
                            <input type="checkbox" name="usr_permisos[]" value="micuenta"
                                <?php if ($oUsuario->ExistePermiso("micuenta", $aPermisos) === true) echo "checked" ?>><br>
                        </td>
                        <td style="vertical-align: top;">
                            <strong>Cabecera</strong><br />
                            <input type="checkbox" name="usr_permisos[]" value="cabecera"
                                <?php if ($oUsuario->ExistePermiso("cabecera", $aPermisos) === true) echo "checked" ?>><br>
                            <strong>Servicios</strong><br />
                            <input type="checkbox" name="usr_permisos[]" value="servicios"
                                <?php if ($oUsuario->ExistePermiso("servicios", $aPermisos) === true) echo "checked" ?>><br>
                            <strong>Multimedia</strong><br />
                            <input type="checkbox" name="usr_permisos[]" value="tecnologia"
                                <?php if ($oUsuario->ExistePermiso("tecnologia", $aPermisos) === true) echo "checked" ?>><br>
                        </td>

                    </tr>
                </table>
            </div>
        </div>
        <input type="hidden" id="usr_id" name="usr_id" value="<?= $oUsuario->usr_id ?>" />
        <input type="hidden" id="accion" name="accion" value="GUARDAR" />
        <input type="hidden" id="usr_foto" name="usr_foto" value="<?= $oUsuario->usr_foto ?>" />

    </div>
</form>