<?php
/*
 * Copyright 2019 - Redzpot Impulso en Imagen S.A. de C.V. 
 * cerda@redzpot.com
 */
session_start();

$_SITE_PATH = $_SERVER["DOCUMENT_ROOT"] . "/" . explode("/", $_SERVER["PHP_SELF"])[1] . "/";
require_once($_SITE_PATH . "/app/model/servicios.class.php");

$id = addslashes(filter_input(INPUT_POST, "id_servicios"));
$oServicios = new Servicios();

$oServicios->id_servicios = $id;
$oServicios->getInfo();

//$oServicios->age_fecha_vigencia = empty($oServicios->age_fecha_vigencia) ? date("Y-m-d") : $oServicios->age_fecha_vigencia;
?>
<script>
$(document).ready(function(e) {

    if ($("#imagen_servicios").val() == "") {
        $("#btnQuitarFoto").hide();
        $("#imgFoto").css("display", "none");
        $("#foto").css("display", "inline");
    } else {
        $("#btnQuitarFoto").show();
        $("#imgFoto").css("display", "inline");
        $("#foto").css("display", "none");
    }

    $("#btnQuitarFoto").button().click(function(e) {
        if (confirm("¿Esta seguro de quitar la imagen?") === false)
            return;

        var jsonDatos = {
            "id_servicios": $("#id_servicios").val(),
            "accion": "QUITAR"
        };

        $.ajax({
            data: jsonDatos,
            type: "POST",
            url: "app/views/default/modules/formato/servicios/m.servicios.procesa.php",
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
                Editar($("#id_servicios").val());
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
    action="app/views/default/modules/formato/servicios/m.servicios.procesa.php" method="post"
    enctype="multipart/form-data" class="form-horizontal">
    <div class="form-group">
        <label class="control-label col-sm-2">Imagen Servicios :</label>
        <div class="col-sm-2">
            <input type="file" id="foto" name="foto" value="" />
            <img id="imgFoto" name="imgFoto" src="<?= $oServicios->imagen_servicios ?>"
                class="img-fluid px-3 px-sm-4 mt-3 mb-4" /><br />
            <input type="button" id="btnQuitarFoto" name="btnQuitarFoto" value="Quitar" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <strong class="">Texto 1:</strong>
        <div class="form-group">
            <input type="text" id="texto1_servicios" required name="texto1_servicios" value="<?= $oServicios->texto1_servicios ?>"
             class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <strong class="">Texto 2:</strong>
        <div class="form-group">
            <input type="text" id="texto2_servicios" required name="texto2_servicios"
                value="<?= $oServicios->texto2_servicios ?>" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <strong class="">Texto 3:</strong>
        <div class="form-group">
            <input type="text" id="texto3_servicios" required name="texto3_servicios"
                value="<?= $oServicios->texto3_servicios ?>" class="form-control" />
        </div>
    </div>
    <input type="hidden" id="accion" name="accion" value="GUARDAR" />
    <input type="hidden" id="id_servicios" name="id_servicios" value="<?= $oServicios->id_servicios ?>" />
    <input type="hidden" id="imagen_servicios" name="imagen_servicios" value="<?= $oServicios->imagen_servicios ?>" />
</form>