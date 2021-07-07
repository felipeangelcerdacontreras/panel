<?php
/*
 * Copyright 2019 - Redzpot Impulso en Imagen S.A. de C.V. 
 * cerda@redzpot.com
 */
$_SITE_PATH = $_SERVER["DOCUMENT_ROOT"] . "/" . explode("/", $_SERVER["PHP_SELF"])[1] . "/";
require_once($_SITE_PATH . "/Configuracion.class.php");
require_once($_SITE_PATH . "/app/model/Redzpot.class.php");

class mvc_controller extends Configuracion
{
    public function __construct()
    {
        parent::__construct();
        /*
         * Constructor de la clase
         */
    }

    public function ExisteSesion()
    {
        if (!isset($_SESSION[$this->NombreSesion])) {
            echo "<script> window.location='index.php?action=login'; </script>";
            exit();
        }

    }

    public function CerrarSesion()
    {
        if (isset($_SESSION[$this->NombreSesion])) {
            session_unset();
            session_destroy();
        }
        echo "<script> window.location='index.php' </script>";
        exit();
    }

    public function login()
    {
        include_once("app/views/default/modules/login/m.login.php");
    }

    public function acceso_denegado()
    {
        include_once("app/views/default/modules/m.acceso_denegado.php");
    }

    public function error_page()
    {
        include_once("app/views/default/modules/m.error_page.php");
    }
}

?>
