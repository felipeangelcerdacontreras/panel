<?php
/*
 * Copyright 2019 - Redzpot Impulso en Imagen S.A. de C.V. 
 * cerda@redzpot.com
 *  */
session_start();

$_SITE_PATH = $_SERVER["DOCUMENT_ROOT"] . "/" . explode("/", $_SERVER["PHP_SELF"])[1] . "/";
require_once($_SITE_PATH . "app/model/agencias.class.php");

$accion = filter_input(INPUT_POST, "accion");

if ($accion === "GUARDAR"){
    $oAgencias = new Agencias($_POST);
    if ($oAgencias->Guardar() === true){
        echo "Sistema@Se ha registrado la información del cliente exitosamente.@success";
        if (isset($_FILES["foto"])) {
            if ($oAgencias->SubirArchivo($_FILES["foto"])) {
                echo "@ Se ha subido el archivo exitosamente";
            }else{
              echo "@  Fallo al subir el archivo";
            }
        }
    }
    else{
        echo "Sistema@ Ha ocurrido un problema al guardar la información del cliente, vuelva intentarlo o consulte con su administrador del sistema.@error@";
  }
}else if ($accion === "BORRAR"){
    $oAgencias = new Agencias();
    $oAgencias->age_id = filter_input(INPUT_POST, "age_id");
    if ($oAgencias->Borrar() === true){
        echo "Sistema@Se ha eliminado la información del cliente exitosamente.@success@";
    }
    else
        echo "Sistema@Error Ha ocurrido un problema al eliminar la información del cliente, vuelva intentarlo o consulte con su administrador del sistema.@success@";
}
else if ($accion === "QUITAR_LOGO") {
    $oAgencias = new Agencias();
    $oAgencias->age_id = filter_input(INPUT_POST, "age_id");
    if ($oAgencias->QuitarLogo() === true)
        echo "Sistema@Se ha quitado el logo exitosamente del cliente.@success@";
    else
        echo "Sistema@Ha ocurrido un error al quitar el logotipo, vuelva a intentarlo o consulte con su administrador del sistema.@success@";
}
?>
