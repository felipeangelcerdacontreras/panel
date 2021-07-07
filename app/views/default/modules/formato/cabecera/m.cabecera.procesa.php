<?php
/*
 * Copyright 2019 - Redzpot Impulso en Imagen S.A. de C.V. 
 * cerda@redzpot.com
 *  */
session_start();

$_SITE_PATH = $_SERVER["DOCUMENT_ROOT"] . "/" . explode("/", $_SERVER["PHP_SELF"])[1] . "/";
require_once($_SITE_PATH . "/app/model/cabecera.class.php");

$accion = filter_input(INPUT_POST, "accion");

if ($accion === "GUARDAR"){
    $oCabecera = new Cabecera($_POST);

    if ($oCabecera->Guardar() === true ){
        echo "Sistema@Se ha registrado la solicitud correctamente.@success";
        $valfro = "";
                    if (isset($_FILES["foto"])) {
                            $Campo = "logo";
                            if ($oCabecera->SubirArchivo($_FILES["foto"],$Campo)) {
                               $valfro = 1;
                            }else{
                                $valfro = 2;
                            }
                    }else{
                        echo "";
                    }
                    $valtra ="";
                    if (isset($_FILES["foto1"])) {
                            $Campo = "imagen_1";
                            if ($oCabecera->SubirArchivo($_FILES["foto1"],$Campo)) {
                               $valtra = 1;
                            }else{
                                $valtra = 2;
                            }
                    }
                    $valizq ="";
                    if (isset($_FILES["foto2"])) {
                            $Campo = "imagen_lateral_1";
                        if ($oCabecera->SubirArchivo($_FILES["foto2"],$Campo)) {
                            $valizq = 1;
                        }else{
                            $valizq = 2;
                        }
                    }
                    $valder ="";
                    if (isset($_FILES["foto3"])) {
                            $Campo = "imagen_lateral_2";
                        if ($oCabecera->SubirArchivo($_FILES["foto3"],$Campo)) {
                            $valder = 1;
                        }else{
                            $valder = 2;
                        }
                    }
                    if($valfro == 1 || $valtra == 1 || $valizq == 1 || $valder == 1 ){
                        echo '@'. "\r\n".' Se han subido las fotos correctamente'; 
                    }else{
                        echo "";
                    }
             }else{
        echo "Sistema@ Ha ocurrido un problema al guardar solicitud, vuelva intentarlo o consulte con su administrador del sistema.@error@";
  }
}else if ($accion === "QUITAR") {
    $oCabecera = new Cabecera ();

    $oCabecera->id_index = filter_input(INPUT_POST, "id_index");
    $val = $oCabecera->val1 = filter_input(INPUT_POST, "val1");
    if ($oCabecera->Quitar($val) === true){
        echo "Sistema@Se a quitado la foto correctamente.@success@";
    }
    else{
        echo "Sistema@Ha ocurrido un error al quitar la foto, vuelva a intentarlo o consulte con su administrador del sistema.@error@";
     }
}
?>