<?php
/*
 * Copyright 2019 - Redzpot Impulso en Imagen S.A. de C.V. 
 * cerda@redzpot.com
 *  */
session_start();

$_SITE_PATH = $_SERVER["DOCUMENT_ROOT"] . "/" . explode("/", $_SERVER["PHP_SELF"])[1] . "/";
require_once($_SITE_PATH . "app/model/agencias.class.php");

$oAgencias = new Agencias($_POST);
$lstAgencias = $oAgencias->Listado();
?>
<script>
$(document).ready(function(e) {
    $("#dataTable").DataTable();

    $("#btnAgregar").button().click(function(e) {
        Editar("");
    });
});
</script>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Agencias</h6>
        <div class="form-group" style="text-align:right">
            <input type="button" id="btnAgregar" class="btn btn-success" name="btnAgregar"
                value="Agregar" />
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th >Agencias</th>
                        <th >Gerente</th>
                        <th >Activo</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th >Agencias</th>
                        <th >Gerente</th>
                        <th >Activo</th>
                        <th>Eliminar</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
        if (count($lstAgencias) > 0) {
            foreach ($lstAgencias as $idx => $campo) {
                ?>
                    <tr>
                        <td style="text-align: center;"><a href="javascript:Editar('<?= $campo->age_id ?>');"><?= $campo->age_nom_empresa ?></a>
                        </td>
                        <td style="text-align: center;"><?php
                        echo "<strong>{$campo->usr_nombre}</strong><br />";
                        ?>
                        </td>
                        <td style="text-align: center;">
                            <?php
                        $sImg = "app/views/default/img/no.png";
                        if ($campo->age_activo == true)
                            $sImg = "app/views/default/img/yes.png";
                        ?>
                            <img src="<?= $sImg ?>" />
                        </td>
                        <td>
                        <a href="javascript:Borrar('<?= $campo->age_id ?>')"><img
                                    src="app/views/default/img/trash_22x22.png" border='0' width="22" /></a>
                        </td>
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