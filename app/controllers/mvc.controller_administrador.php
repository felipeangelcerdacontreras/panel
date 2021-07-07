<?php
/*
 * Copyright 2019 - Redzpot Impulso en Imagen S.A. de C.V. 
 * cerda@redzpot.com
 *  */
$_SITE_PATH = $_SERVER["DOCUMENT_ROOT"] . "/" . explode("/", $_SERVER["PHP_SELF"])[1] . "/";
require_once($_SITE_PATH . "/app/controllers/mvc.controller.php");

class mvc_controller_administrador extends mvc_controller
{
    public function __construct()
    {
        parent::__construct();
        /*
         * Constructor de la clase
         */

        // valido que sea un administrador
        /*if ($_SESSION[$this->NombreSesion]->usr_nivel !== "1") {
            echo "<script> window.location = 'index.php?action=login'; </script>\n";
            exit();
        }*/
    }
    public function dashboard() {
        include_once("app/views/default/modules/m.dashboard.php");
    }
    public function sugerencias()
    {
        include_once("app/views/default/modules/preguntas_aclaraciones/m.buzon_master.php");
    }

    public function agencias()
    {
        include_once("app/views/default/modules/catalogos/agencias/m.agencias.php");
    }
    public function usuarios()
    {
          include_once("app/views/default/modules/catalogos/usuarios/m.usuarios.buscar.php");
    }
    
}

?>
