<?php
/*
 * Copyright 2019 - Redzpot Impulso en Imagen S.A. de C.V. 
 * cerda@redzpot.com
 *  */
session_start();

$_SITE_PATH = $_SERVER["DOCUMENT_ROOT"] . "/" . explode("/", $_SERVER["PHP_SELF"])[1] . "/";
require_once($_SITE_PATH . "app/model/agencias.class.php");
require_once($_SITE_PATH . "app/model/usuarios.class.php");

$age_id = addslashes(filter_input(INPUT_POST, "age_id"));

$oAgencias = new Agencias();
$oAgencias->age_id = $age_id;
$oAgencias->getInfo();

$oUsuarios = new usuarios ();
$sesion = $_SESSION[$oUsuarios->NombreSesion];
if($sesion->usr_id != 1){
    $oUsuarios->age_id = $sesion->age_id;
}
$lstUsuarios = $oUsuarios->Gerentes();
//$oAgencias->age_fecha_vigencia = empty($oAgencias->age_fecha_vigencia) ? date("Y-m-d") : $oAgencias->age_fecha_vigencia;
?>
<script>
$(document).ready(function(e) {
    if ($("#age_logo").val() == "") {
        $("#btnQuitarFoto").hide();
        $("#age_log").css("display", "none");
        $("#foto").css("display", "inline");
    } else {
        $("#btnQuitarFoto").show();
        $("#age_log").css("display", "inline");
        $("#foto").css("display", "none");
    }

    $("#btnQuitarFoto").button().click(function(e) {
        if (confirm("Esta seguro de quitar la foto?") === false)
            return;

        var jsonDatos = {
            "age_id": $("#age_id").val(),
            "accion": "QUITAR_LOGO"
        };
        $.ajax({
            data: jsonDatos,
            type: "post",
            url: "app/views/default/modules/catalogos/agencias/m.agencias.procesa.php",
            beforeSend: function() {},
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
                Editar($("#age_id").val());
                Listado();
            }
        });
    });

    $("#frmFormulario").ajaxForm({
        beforeSubmit: function(formData, jqForm, options) {},
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
            $("#myModal_1").modal("hide");
        }
    });
});
</script>

<form id="frmFormulario" name="frmFormulario"
    action="app/views/default/modules/catalogos/agencias/m.agencias.procesa.php" method="post"
    enctype="multipart/form-data" class="form-horizontal">
    <div>
        <div class="form-group">
            <strong class="">Gerente:</strong>
            <div class="form-group">
                <select id="usr_id" class="form-control" name="usr_id">
                    <?php
                        if (count($lstUsuarios) > 0) {
                            echo "<option value='0' >-- SELECCIONE --</option>\n";
                            foreach ($lstUsuarios as $idx => $campo) {
                                if ($campo->usr_id == $oAgencias->usr_id){
                                echo "<option value='{$campo->usr_id}' selected>{$campo->usr_nombre}</option>\n";
                                }else{
                            echo "<option value='{$campo->usr_id}' >{$campo->usr_nombre}</option>\n";
                        }
                            }
                        }
                        ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <strong>Nombre de agencia:</strong>
            <div class="form-group">
                <input type="text" id="age_nom_empresa" name="age_nom_empresa"
                    value="<?= $oAgencias->age_nom_empresa ?>" class="form-control" />
            </div>
        </div>
        <div class="form-group">
            <strong>RFC:</strong>
            <div class="form-group">
                <input type="text" id="age_rfc" name="age_rfc" maxlength="13" value="<?= $oAgencias->age_rfc ?>"
                    placeholder="ABCD123456789" class="form-control" />
            </div>
        </div>
        <div class="form-group">
            <strong>Dirección:</strong>
            <div class="form-group">
                <textarea id="age_direccion" name="age_direccion"
                    class="form-control"><?= ($oAgencias->age_direccion) ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <strong>Correo-E (Agencia):</strong>
            <div class="form-group">
                <input type="text" id="age_correo_empresa" name="age_correo_empresa" maxlength="80"
                    value="<?= $oAgencias->age_correo_empresa ?>" placeholder="micorreo@dominio.com"
                    class="form-control" />
            </div>
        </div>
        <div class="form-group">
            <strong>Teléfono (Agencia):</strong>
            <div class="form-group">
                <input type="text" id="age_tel_empresa" name="age_tel_empresa" maxlength="11"
                    value="<?= $oAgencias->age_tel_empresa ?>" placeholder="123-1234567" class="form-control" />
            </div>
        </div>
        <div class="form-group">
            <strong>Estatus:</strong>
            <div class="form-group">
                <select id="age_activo" name="age_activo" class="form-control">
                    <option value="1" <?php if ($oAgencias->age_activo == true) echo "selected"; ?>>ACTIVO</option>
                    <option value="0" <?php if ($oAgencias->age_activo == false) echo "selected"; ?>>INACTIVO</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <strong>Archivo de foto:</strong>
            <div class="form-group">
                <input type="file" id="foto" name="foto" value="" />
                <img id="age_log" name="age_log" src="<?= $oAgencias->age_logo ?>" border="0"
                    class="img-fluid px-3 px-sm-4 mt-3 mb-4" /><br />
                <input type="button" id="btnQuitarFoto" name="btnQuitarFoto" value="Quitar" class="form-control" />
            </div>
        </div>
        <input type="hidden" id="accion" name="accion" value="GUARDAR" />
        <input type="hidden" id="age_id" name="age_id" value="<?= $oAgencias->age_id ?>" />
        <input type="hidden" id="age_logo" name="age_logo" value="<?= $oAgencias->age_logo ?>" />
</form>