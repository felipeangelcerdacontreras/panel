<?php
$_SITE_PATH = $_SERVER["DOCUMENT_ROOT"] . "/" . explode("/", $_SERVER["PHP_SELF"])[1] . "/";
require_once($_SITE_PATH . "Configuracion.class.php");

$oConf = new Configuracion();

?>
    <script type="text/javascript">
        $(document).ready(function (e) {
            $("#btnCerrarSesion").button().click(function (e) {
                document.location = "index.php?action=cerrar_sesion";
            });
        });
    </script>

    <div style="float: left; padding: 0px; margin-left: 150px; ">
        <h2 style="font-weight: bolder; color: #373748;">#TITLE#</h2>
    </div>
<?php
if (isset($_SESSION[$oConf->NombreSesion])) {
    $sesion = $_SESSION[$oConf->NombreSesion]
    ?>
    <div style="float: right;
								text-align: center;
								font-size: 9px;
								padding: 0px;
								width: 300px;
								height: 88px;
								margin-top: 5px;
								border-radius: 5px;
								background-color: #373748;">
        <?php
        $srcImagen = "app/views/default/images/profile.png";
        if (!empty($sesion->usr_foto))
            $srcImagen = $sesion->usr_foto;
        ?>
        <div style="text-align: center; float: left; width: 75px; height: 80px; padding: 2px; margin: 5px;">
            <img src="<?= $srcImagen ?>" style="max-width: 75px; max-height: 75px;" border="0"/>
        </div>
        <div style="float: left; padding: 0px; margin: 5px; width: 200px; height: 80px;">
            Bienvenido(a) <span style="font-weight: bold;"><?= $sesion->usr_alias ?></span>
            <br/><input type="button" id="btnCerrarSesion" name="btnCerrarSesion" value="Cerrar Sesión"/>
        </div>
    </div>
    <?php
}
?>