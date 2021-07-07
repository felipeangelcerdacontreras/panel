<?php

/*
 * Copyright 2019 - Redzpot Impulso en Imagen S.A. de C.V. 
 * cerda@redzpot.com
 *  */
class Configuracion {
	protected $mysql_host;
	protected $mysql_user;
	protected $mysql_pass;
	protected $mysql_database;
    public $NombreSesion;
    protected $MasterKey;
    protected $RutaAbsoluta;

	public function __construct() {
        $this->mysql_database = "redzpot_publicidad";
        $this->mysql_host = "192.185.174.79";
        $this->mysql_user = "redzpot_redzpot";
        $this->mysql_pass = "Redzpot@2020";
        $this->NombreSesion = "Panel-redzpot";
        $this->MasterKey = "R3DZP07*";
        $this->RutaAbsoluta = $_SERVER["DOCUMENT_ROOT"] . "/" . explode("/", $_SERVER["PHP_SELF"])[1] . "/";
	}

	protected function getRealIP() {
		if (! empty ( $_SERVER ['HTTP_CLIENT_IP'] ))
			return $_SERVER ['HTTP_CLIENT_IP'];

		if (! empty ( $_SERVER ['HTTP_X_FORWARDED_FOR'] ))
			return $_SERVER ['HTTP_X_FORWARDED_FOR'];

		return $_SERVER ['REMOTE_ADDR'];
	}
}

?>
