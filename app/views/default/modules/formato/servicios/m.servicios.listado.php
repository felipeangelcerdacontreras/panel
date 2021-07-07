<?php
/*
 * Copyright 2019 - Redzpot Impulso en Imagen S.A. de C.V. 
 * cerda@redzpot.com
 */
session_start();

$_SITE_PATH = $_SERVER["DOCUMENT_ROOT"] . "/" . explode("/", $_SERVER["PHP_SELF"])[1] . "/";
require_once($_SITE_PATH . "/app/model/servicios.class.php");

$oServicios = new Servicios($_POST);
$lastServicios = $oServicios->Listado();
$sesion = $_SESSION[$oServicios->NombreSesion];

?>
<style>
td:hover {
    cursor: move;
}
</style>
<script>
$(document).ready(function(e) {
    $("#btnOrden").button().click(function(e) {
        $("#frmFormulario1").submit();
    });

    $("#frmFormulario1").ajaxForm({
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
            Listado();
        }
    });

    $("#dataTable").DataTable({
        pageLength : 100,
        lengthMenu: [[100, -1], [100, 'Todos']]
    });

    $('.dataTables_length').addClass('bs-select');

    var fixHelperModified = function(e, tr) {
            var $originals = tr.children();
            var $helper = tr.clone();
            $helper.children().each(function(index) {
                $(this).width($originals.eq(index).width())
            });
            return $helper;
        },
        updateIndex = function(e, ui) {
            $('td.index', ui.item.parent()).each(function(i) {
                $(this).html(i + 1);
            });
            $('input[type=text]', ui.item.parent()).each(function(i) {
                $(this).val(i + 1);
            });
        };
    $("#dataTable tbody").sortable({
        helper: fixHelperModified,
        stop: updateIndex
    }).disableSelection();

    $("tbody").sortable({
        distance: 5,
        delay: 100,
        opacity: 0.6,
        cursor: 'move',
        update: function() {}
    });

    $("#btnAgregar").button().click(function(e) {
        Editar("");
    });
});
</script>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Servicios</h6>
        <div class="form-group" style="text-align:right">
            <input type="button" id="btnAgregar" class="btn btn-success" name="btnAgregar" value="Agregar nuevo" />
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form id="frmFormulario1" name="frmFormulario1"
                action="app/views/default/modules/formato/servicios/m.servicios.procesa.php" method="post"
                class="form-horizontal">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Imagen</th>
                            <th>Eliminar</th>
                            <th hidden>orden</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Imagen</th>
                            <th>Eliminar</th>
                            <th hidden>orden</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
        if (count($lastServicios) > 0) {
            $cont = 1;
            foreach ($lastServicios as $idx => $campo) {
                ?>
                        <tr id="<?=$cont?>">
                            <td>
                                <div>
                                    <input type="number" hidden name="id_servicios_<?=$cont?>"
                                        id="id_servicios_<?=$cont?>" value="<?=  $campo->id_servicios  ?>">
                                    <a href="javascript:Editar('<?= $campo->id_servicios ?>');" ;><?= $cont ?></a>
                                </div>
                            </td>
                            <td><img src='<?php  if ($campo->imagen_servicios != ""){echo $campo->imagen_servicios;}?>'
                                    border="0" width="15%" /></a>
                            </td>
                            <td>
                                <a href="javascript:Borrar('<?= $campo->id_servicios ?>')"><img
                                        src="app/views/default/images/trash_22x22.png" border='0' width="22" /></a>
                            </td>
                            <td class="indexInput" hidden>
                                <input type="text" name="ord_servicios_<?=$cont?>" id="ord_servicios_<?=$cont?>"
                                    value="<?= $cont ?>">
                            </td>
                        </tr>
                        <?php
                    $cont++;
            }
            echo "<input type='number' hidden name='final' id='final' value='$cont'>";
        }
        ?>
                    </tbody>
                </table>
                <div class="modal-footer">
                    <input type="hidden" id="accion" name="accion" value="LISTA" />
                    <input type="button" class="btn btn-success" id="btnOrden" value="Guardar Orden">
                </div>
        </div>
        </form>
    </div>
</div>