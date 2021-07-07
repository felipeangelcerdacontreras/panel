<?php
/*
 * Copyright 2019 - Redzpot Impulso en Imagen S.A. de C.V. 
 * cerda@redzpot.com
 *  */
$_SITE_PATH = $_SERVER["DOCUMENT_ROOT"] . "/" . explode("/", $_SERVER["PHP_SELF"])[1] . "/";
require_once($_SITE_PATH . "/app/model/Redzpot.class.php");

$usr = addslashes(filter_input(INPUT_POST, "usr"));
$pass = addslashes(filter_input(INPUT_POST, "pass"));
$accion = addslashes(filter_input(INPUT_POST, "accion"));

if ($accion === "LOGIN") {
    $oRedzpot = new REDZPOT(false);

    $aResultado = array();
    $aResultado["valido"] = false;
    $aResultado["msg"] = "La información de acceso no es válida, vuelva a intentarlo o consulte con el administrador del sistema.
     El sistema es sensible a mayúsculas y minúsculas.";

    if ($oRedzpot->ValidaLogin($usr, $pass) === true){
        $aResultado["valido"] = true;
        $aResultado["msg"] = "index.php?action=bienvenida";
    }

    echo json_encode($aResultado);
}
