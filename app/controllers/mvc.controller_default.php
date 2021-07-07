<?php

/*
 * Copyright 2019 - Redzpot Impulso en Imagen S.A. de C.V. 
 * cerda@redzpot.com
 *  */
$_SITE_PATH = $_SERVER["DOCUMENT_ROOT"] . "/" . explode("/", $_SERVER["PHP_SELF"])[1] . "/";
require_once($_SITE_PATH . "/app/controllers/mvc.controller.php");
require_once($_SITE_PATH . "/app/model/Redzpot.class.php");

class mvc_controller_default extends mvc_controller {

    public function __construct() {
        parent::__construct();
        /*
         * Constructor de la clase
         */
    }
    public function bienvenida() {
        include_once("app/views/default/modules/m.bienvenida.php");
    }
    public function micuenta()
    {
        include_once("app/views/default/modules/micuenta/m.micuenta.php");
    }
    public function cabecera () {
        include_once("app/views/default/modules/formato/cabecera/m.cabecera.php");
    }
    public function servicios () {
        include_once("app/views/default/modules/formato/servicios/m.servicios.php");
    }
    public function tecnologia () {
        include_once("app/views/default/modules/formato/tecnologia/m.tecnologia.php");
    }
}

?>
