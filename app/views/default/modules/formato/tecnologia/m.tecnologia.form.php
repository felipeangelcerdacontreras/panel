<?php
/*
 * Copyright 2019 - Redzpot Impulso en Imagen S.A. de C.V. 
 * cerda@redzpot.com
 */
session_start();

$_SITE_PATH = $_SERVER["DOCUMENT_ROOT"] . "/" . explode("/", $_SERVER["PHP_SELF"])[1] . "/";
require_once($_SITE_PATH . "/app/model/tecnologia.class.php");

$id = addslashes(filter_input(INPUT_POST, "id_tecnologia"));
$oTecnologia = new tecnologia();

$oTecnologia->id_tecnologia = $id;
$oTecnologia->getInfo();

//$oTecnologia->age_fecha_vigencia = empty($oTecnologia->age_fecha_vigencia) ? date("Y-m-d") : $oTecnologia->age_fecha_vigencia;
?>
<script>
$(document).ready(function(e) {

    if ($("#imagen_tecnologia").val() == "") {
        $("#btnQuitarFoto").hide();
        $("#imgFoto").css("display", "none");
        $("#foto").css("display", "inline");
    } else {
        $("#btnQuitarFoto").show();
        $("#imgFoto").css("display", "inline");
        $("#foto").css("display", "none");
    }

    $("#btnQuitarFoto").button().click(function(e) {
        if (confirm("¿Esta seguro de quitar el video/imagen") === false)
            return;

        var jsonDatos = {
            "id_tecnologia": $("#id_tecnologia").val(),
            "accion": "QUITAR"
        };

        $.ajax({
            data: jsonDatos,
            type: "POST",
            url: "app/views/default/modules/formato/tecnologia/m.tecnologia.procesa.php",
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
                Editar($("#id_tecnologia").val());
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
    action="app/views/default/modules/formato/tecnologia/m.tecnologia.procesa.php" method="post"
    enctype="multipart/form-data" class="form-horizontal">
    <div class="form-group">
        <label class="control-label col-sm-2">Multimedia :</label>
        <div class="col-sm-8">
            <input type="file" id="foto" name="foto" value="" />
            <?php if ($oTecnologia->tipod_tecnologia == "MP4") { ?>
            <video preload="none" controls id="imgFoto" name="imgFoto"
                src="<?= $oTecnologia->imagen_tecnologia ?>" width="50%" style="height:38%;" border="0"
                class="form-control"></video>
            <?php } else {?>
            <img id="imgFoto" name="imgFoto" src="<?= $oTecnologia->imagen_tecnologia ?>"
                class="img-fluid px-3 px-sm-4 mt-3 mb-4" />
            <?php }?>
            <br />
            <input type="button" id="btnQuitarFoto" name="btnQuitarFoto" value="Quitar" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <strong class="">Texto 1:</strong>
        <div class="form-group">
            <input type="text" id="texto1_tecnologia" required name="texto1_tecnologia"
                value="<?= $oTecnologia->texto1_tecnologia ?>" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <strong class="">Texto 2:</strong>
        <div class="form-group">
            <input type="text" id="texto2_tecnologia" required name="texto2_tecnologia"
                value="<?= $oTecnologia->texto2_tecnologia ?>" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <strong class="">Texto 3:</strong>
        <div class="form-group">
            <input type="text" id="texto3_tecnologia" required name="texto3_tecnologia"
                value="<?= $oTecnologia->texto3_tecnologia ?>" class="form-control" />
        </div>
    </div>
    <br>
    <input type="hidden" id="accion" name="accion" value="GUARDAR" />
    <input type="hidden" id="id_tecnologia" name="id_tecnologia" value="<?= $oTecnologia->id_tecnologia ?>" />
    <input type="hidden" id="imagen_tecnologia" name="imagen_tecnologia"
        value="<?= $oTecnologia->imagen_tecnologia ?>" />
</form>