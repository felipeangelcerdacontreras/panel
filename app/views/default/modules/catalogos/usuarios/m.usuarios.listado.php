<?php
/*
 * Copyright 2019 - Redzpot Impulso en Imagen S.A. de C.V. 
 * cerda@redzpot.com
 */
session_start();

$_SITE_PATH = $_SERVER["DOCUMENT_ROOT"] . "/" . explode("/", $_SERVER["PHP_SELF"])[1] . "/";
require_once($_SITE_PATH . "/app/model/usuarios.class.php");

$oUsuario = new Usuarios();
$oUsuario->age_id = addslashes(filter_input(INPUT_POST, "age_id"));
$oUsuario->usr_nivel = addslashes(filter_input(INPUT_POST, "usr_nivel"));
$lstUsuarios = $oUsuario->Listado();
?>
<script type="text/javascript">
$(document).ready(function(e) {
    $("#dataTable").DataTable();

    $("#btnAgregar").button().click(function(e) {
        Editar("");
    });

});
</script>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3" style="text-align:left">
        <h5 class="m-0 font-weight-bold text-primary">Usuarios</h5>
        <div class="form-group" style="text-align:right">
            <input type="button" id="btnAgregar" class="btn btn-success" name="btnAgregar" value="Agregar nuevo" />
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo-E</th>
                        <th>Numero Cel.</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tfoot>
                    <th>Nombre</th>
                    <th>Correo-E</th>
                    <th>Numero Cel.</th>
                    <th>Eliminar</th>
                </tfoot>
                <tbody>
                    <?php
        if (count($lstUsuarios) > 0) {
            foreach ($lstUsuarios as $idx => $campo) {
                ?>
                    <tr>
                        <td style="text-align: center;"><a href="javascript:Editar('<?= $campo->usr_id ?>')"><?= $campo->usr_nombre ?></a></td>
                        <td style="text-align: center;"><?= $campo->usr_correoe ?></td>
                        <td style="text-align: center;"><?= $campo->usr_num ?></td>
                        <td><a href="javascript:Borrar('<?= $campo->usr_id ?>')"><img
                                    src="app/views/default/img/trash_22x22.png" border='0' width="22" /></a></td>
                    </tr>
                    <?php
            }
        }
        ?>
                </tbody>
            </table>
        </div>
    </div>
</div>