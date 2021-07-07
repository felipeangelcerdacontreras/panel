<?php
/*
 * Copyright 2019 - Redzpot Impulso en Imagen S.A. de C.V. 
 * cerda@redzpot.com
 */
$_SITE_PATH = $_SERVER["DOCUMENT_ROOT"] . "/" . explode("/", $_SERVER["PHP_SELF"])[1] . "/";
require_once($_SITE_PATH . "/app/model/cabecera.class.php");

$oCabecera = new Cabecera();
$sesion = $_SESSION[$oCabecera->NombreSesion];
$oCabecera->ValidaNivelUsuario("cabecera");
$oCabecera->id_index = $sesion->root;
$oCabecera->getInfo();
//print_r($oCabecera);
//print_r($sesion);
?>
<?php require_once('app/views/default/script_h.html'); ?>
<script type="text/javascript">
$(document).ready(function(e) {

    $("#btnGuardar").button().click(function(e) {
        $("#frmFormulario").submit();
    });

    $("#btnQuitarFoto").button().click(function(e) {
        if (confirm("Esta seguro de quitar la foto?") === false)
            return;

        var jsonDatos = {
            "id_index": 1,
            "val1": "logo",
            "accion": "QUITAR"
        };
        $.ajax({
            data: jsonDatos,
            type: "post",
            url: "app/views/default/modules/formato/cabecera/m.cabecera.procesa.php",
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
                setTimeout(function() {
                    location.reload(); //actualizas el div
                }, 1000);
            }
        });
    });
    $("#btnQuitarFoto1").button().click(function(e) {
        if (confirm("Esta seguro de quitar la foto?") === false)
            return;

        var jsonDatos = {
            "id_index": 1,
            "val1": "imagen_1",
            "accion": "QUITAR"
        };
        $.ajax({
            data: jsonDatos,
            type: "post",
            url: "app/views/default/modules/formato/cabecera/m.cabecera.procesa.php",
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
                setTimeout(function() {
                    location.reload(); //actualizas el div
                }, 1000);
            }
        });
    });
    $("#btnQuitarFoto2").button().click(function(e) {
        if (confirm("Esta seguro de quitar la foto?") === false)
            return;

        var jsonDatos = {
            "id_index": 1,
            "val1": "imagen_lateral_1",
            "accion": "QUITAR"
        };
        $.ajax({
            data: jsonDatos,
            type: "post",
            url: "app/views/default/modules/formato/cabecera/m.cabecera.procesa.php",
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
                setTimeout(function() {
                    location.reload(); //actualizas el div
                }, 1000);
            }
        });
    });
    $("#btnQuitarFoto3").button().click(function(e) {
        if (confirm("Esta seguro de quitar la foto?") === false)
            return;

        var jsonDatos = {
            "id_index": 1,
            "val1": "imagen_lateral_2",
            "accion": "QUITAR"
        };
        $.ajax({
            data: jsonDatos,
            type: "post",
            url: "app/views/default/modules/formato/cabecera/m.cabecera.procesa.php",
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
                setTimeout(function() {
                    location.reload(); //actualizas el div
                }, 1000);
            }
        });
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

    if ($("#logo").val() == "") {
        $("#btnQuitarFoto").hide();
        $("#imgFoto").css("display", "none");
        $("#foto").css("display", "inline");
    } else {
        $("#btnQuitarFoto").show();
        $("#imgFoto").css("display", "inline");
        $("#foto").css("display", "none");
    }

    if ($("#imagen_1").val() == "") {
        $("#btnQuitarFoto1").hide();
        $("#imgFoto1").css("display", "none");
        $("#foto1").css("display", "inline");
    } else {
        $("#btnQuitarFoto1").show();
        $("#imgFoto1").css("display", "inline");
        $("#foto1").css("display", "none");
    }

    if ($("#imagen_lateral_1").val() == "") {
        $("#btnQuitarFoto2").hide();
        $("#imgFoto2").css("display", "none");
        $("#foto2").css("display", "inline");
    } else {
        $("#btnQuitarFoto2").show();
        $("#imgFoto2").css("display", "inline");
        $("#foto2").css("display", "none");
    }

    if ($("#imagen_lateral_2").val() == "") {
        $("#btnQuitarFoto3").hide();
        $("#imgFoto3").css("display", "none");
        $("#foto3").css("display", "inline");
    } else {
        $("#btnQuitarFoto3").show();
        $("#imgFoto3").css("display", "inline");
        $("#foto3").css("display", "none");
    }
});
</script>
<?php require_once('app/views/default/link.html'); ?>

<head>
    <?php require_once('app/views/default/head.html'); ?>
    <title>Cabecera</title>
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

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">CABECERA</h6>
                        </div>
                        <div class="container" id="form">
                            <form id="frmFormulario" name="frmFormulario"
                                action="app/views/default/modules/formato/cabecera/m.cabecera.procesa.php"
                                enctype="multipart/form-data" method="post" target="_self" class="form-horizontal">
                                <div style="margin:auto;">

                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Color de cabecera:</label>
                                        <div class="col-sm-10">
                                            <input type="color" id="color_plantilla" name="color_plantilla"
                                                value="<?= $oCabecera->color_plantilla ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Logo :</label>
                                        <div class="col-sm-2">
                                            <input type="file" id="foto" name="foto" value="" />
                                            <img id="imgFoto" name="imgFoto" src="<?= $oCabecera->logo ?>"
                                                class="img-fluid px-3 px-sm-4 mt-3 mb-4" /><br />
                                            <input type="button" id="btnQuitarFoto" name="btnQuitarFoto" value="Quitar"
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Imagen 1 :</label>
                                        <div class="col-sm-2">
                                            <input type="file" id="foto1" name="foto1" value="" />
                                            <img id="imgFoto1" name="imgFoto1" src="<?= $oCabecera->imagen_1 ?>"
                                                class="img-fluid px-3 px-sm-4 mt-3 mb-4" /><br />
                                            <input type="button" id="btnQuitarFoto1" name="btnQuitarFoto1"
                                                value="Quitar" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Texto 1</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="texto_1_1" required name="texto_1_1"
                                                value="<?= $oCabecera->texto_1_1 ?>" 
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Texto 2</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="texto_2_1" required name="texto_2_1"
                                                value="<?= $oCabecera->texto_2_1 ?>" 
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Texto 3</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="texto_3_1" required name="texto_3_1"
                                                value="<?= $oCabecera->texto_3_1 ?>" 
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Imagen lateral arriba :</label>
                                        <div class="col-sm-2">
                                            <input type="file" id="foto2" name="foto2" value="" />
                                            <img id="imgFoto2" name="imgFoto2" src="<?= $oCabecera->imagen_lateral_1 ?>"
                                                class="img-fluid px-3 px-sm-4 mt-3 mb-4" /><br />
                                            <input type="button" id="btnQuitarFoto2" name="btnQuitarFoto2"
                                                value="Quitar" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Texto 1</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="texto1_lateral_1" required name="texto1_lateral_1"
                                                value="<?= $oCabecera->texto1_lateral_1 ?>" 
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Texto 2</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="texto2_lateral_1" required name="texto2_lateral_1"
                                                value="<?= $oCabecera->texto2_lateral_1 ?>" 
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Texto 3</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="texto3_lateral_1" required name="texto3_lateral_1"
                                                value="<?= $oCabecera->texto3_lateral_1 ?>" 
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Imagen lateral abajo :</label>
                                        <div class="col-sm-2">
                                            <input type="file" id="foto3" name="foto3" value="" />
                                            <img id="imgFoto3" name="imgFoto3" src="<?= $oCabecera->imagen_lateral_2 ?>"
                                                class="img-fluid px-3 px-sm-4 mt-3 mb-4" /><br />
                                            <input type="button" id="btnQuitarFoto3" name="btnQuitarFoto3"
                                                value="Quitar" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Texto 1</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="texto1_lateral_2" required name="texto1_lateral_2"
                                                value="<?= $oCabecera->texto1_lateral_2 ?>" 
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Texto 2</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="texto2_lateral_2" required name="texto2_lateral_2"
                                                value="<?= $oCabecera->texto2_lateral_2 ?>" 
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Texto 3</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="texto3_lateral_2" required name="texto3_lateral_2"
                                                value="<?= $oCabecera->texto3_lateral_2 ?>" 
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">QUIENES SOMOS</h6>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Texto</label>
                                        <div class="col-sm-10">
                                            <textarea name="texto_quienessomos"
                                                class="form-control"><?= $oCabecera->texto_quienessomos ?></textarea>
                                        </div>
                                    </div>
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">¿POR QUÉ ELEGIRNOS?</h6>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Texto superior</label>
                                        <div class="col-sm-10">
                                            <textarea name="texto_superior"
                                                class="form-control"><?= $oCabecera->texto_superior ?></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- post -->
                                        <div class="col-md-4">
                                            <div class="post post-sm">
                                                <label class="control-label col-sm-2">Texto 1</label>
                                                <div class="post-body">
                                                    <textarea name="texto_elegirnos1"
                                                        class="form-control"><?= $oCabecera->texto_elegirnos1 ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /post -->

                                        <!-- post -->
                                        <div class="col-md-4">
                                            <div class="post post-sm">
                                                <label class="control-label col-sm-2">Texto 2</label>
                                                <div class="post-body">
                                                    <textarea name="texto_elegirnos2"
                                                        class="form-control"><?= $oCabecera->texto_elegirnos2 ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /post -->

                                        <!-- post -->
                                        <div class="col-md-4">
                                            <div class="post post-sm">
                                                <label class="control-label col-sm-2">Texto 3</label>
                                                <div class="post-body">
                                                    <textarea name="texto_elegirnos3"
                                                        class="form-control"><?= $oCabecera->texto_elegirnos3 ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /post -->
                                    </div>
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">SERVICIOS</h6>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Texto</label>
                                        <div class="col-sm-10">
                                            <textarea name="texto_servicios"
                                                class="form-control"><?= $oCabecera->texto_servicios ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Publicacion de instagram:</h6>
                                        </div>
                                        <div class="col-sm-10">
                                            <input type="text" id="publicacion_insta" required name="publicacion_insta"
                                                value="<?= $oCabecera->publicacion_insta ?>" 
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="button" class="btn btn-success" id="btnGuardar" value="Guardar">
                                    </div>
                                    <input type="hidden" id="accion" name="accion" value="GUARDAR" />

                                    <input type="hidden" id="logo" name="logo" value="<?= $oCabecera->logo ?>" />
                                    <input type="hidden" id="imagen_1" name="imagen_1"
                                        value="<?= $oCabecera->imagen_1 ?>" />
                                    <input type="hidden" id="imagen_lateral_1" name="imagen_lateral_1"
                                        value="<?= $oCabecera->imagen_lateral_1 ?>" />
                                    <input type="hidden" id="imagen_lateral_2" name="imagen_lateral_2"
                                        value="<?= $oCabecera->imagen_lateral_2 ?>" />
                                </div>
                            </form>
                            <iframe name="pp" style="position:absolute; top:-1500px;"></iframe>
                        </div>
                    </div>
                    <!-- cerrar contenido pagina-->
                    <div id="divListado"></div>
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