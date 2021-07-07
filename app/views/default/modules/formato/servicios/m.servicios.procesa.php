<?php
/*
 * Copyright 2019 - Redzpot Impulso en Imagen S.A. de C.V. 
 * cerda@redzpot.com
 *  */
session_start();

$_SITE_PATH = $_SERVER["DOCUMENT_ROOT"] . "/" . explode("/", $_SERVER["PHP_SELF"])[1] . "/";
require_once($_SITE_PATH . "/app/model/servicios.class.php");

$accion = filter_input(INPUT_POST, "accion");

$final = addslashes(filter_input(INPUT_POST, "final"));

if ($accion === "GUARDAR"){
    $oServicios = new Servicios($_POST);

    if ($oServicios->Guardar() === true ){
        echo "Sistema@Se ha registrado la solicitud correctamente.@success";
        $valfro = "";
                    if (isset($_FILES["foto"])) {
                            $Campo = "imagen_servicios";
                            if ($oServicios->SubirArchivo($_FILES["foto"],$Campo)) {
                               $valfro = 1;
                            }else{
                                $valfro = 2;
                            }
                    }else{
                        echo "";
                    }
                    if($valfro == 1 ){
                        echo '@'. "\r\n".' Se han subido las fotos correctamente'; 
                    }else{
                        echo "";
                    }
    }
    else{
        echo "Sistema@ Ha ocurrido un problema al guardar solicitud, vuelva intentarlo o consulte con su administrador del sistema.@error@";
  }
}else if ($accion == "LISTA"){
    $oServicios = new Servicios($_POST);
    $res = 1;
    $i = 1;
    $res2 = 1;
    $numRow = $final-1;
    if ($numRow > 0){
    for ($i = 1; $i <= $numRow; $i++) {
        $id = addslashes(filter_input(INPUT_POST, "id_servicios_".$i));
        $orden = addslashes(filter_input(INPUT_POST, "ord_servicios_".$i));
        //update de orden
        $oServicios->GenerarLista($id ,$orden);
        $res2++;
    }
    if ($i == $res2) {
        echo "@Se ha registrado exitosamente el orden.@success@";
    }else{
        echo "Error@No se actualizo el orden.@success@";
    }
}
}else if ($accion == "BORRAR") {
    $oServicios = new Servicios();
    $id_servicios = filter_input(INPUT_POST, "id_servicios");
    if ($oServicios->Borrar($id_servicios) === true) {
        echo "Sistema@Se a quitado correctamente.@success@";
    }
    else {
        echo "Sistema@Ha ocurrido un error al quitar la foto, vuelva a intentarlo o consulte con su administrador del sistema.@error@";
    }
}else if ($accion === "QUITAR") {
    $oServicios = new Servicios();
    $id_servicios = filter_input(INPUT_POST, "id_servicios");
    if ($oServicios->Quitar($id_servicios) === true){
        echo "Sistema@Se a quitado la foto correctamente.@success@";
    }
    else{
        echo "Sistema@Ha ocurrido un error al quitar la foto, vuelva a intentarlo o consulte con su administrador del sistema.@error@";
     }
}
?>