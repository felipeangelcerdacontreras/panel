<?php
$_SITE_PATH = $_SERVER["DOCUMENT_ROOT"] . "/" . explode("/", $_SERVER["PHP_SELF"])[1] . "/";
require_once($_SITE_PATH . "Configuracion.class.php");

$oConfig = new Configuracion();

$imgLogo = "app/views/default/images/no-image.png";
if (!empty($_SESSION[$oConfig->NombreSesion]))
    $imgLogo = $_SESSION[$oConfig->NombreSesion]->cli_logo;

?>
<script>
    $(document).ready(function(e){
        $("#btnSugerencias").button().click(function(e){
            document.location = "index.php?action=buzon_sugerencias";
        });
    });
</script>
<div style="text-align: center; width: 95%;">
    <img src="<?= $imgLogo ?>" style="max-height: 100px; max-width: 240px;" border="0"/><br/>
    <span style="font-size: 12px;"><?= $_SESSION[$oConfig->NombreSesion]->cli_slogan ?></span>
    <br/><br />
    <div style="margin: 0px auto; text-align: center; font-size: 10px;">
        <input type="button" id="btnSugerencias" name="btnSugerencias" value="Buzón de Sugerencias" />
    </div>
</div>