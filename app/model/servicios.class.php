<?php

/*
 * Copyright 2019 - Redzpot Impulso en Imagen S.A. de C.V. 
 * cerda@redzpot.com
 */
$_SITE_PATH = $_SERVER["DOCUMENT_ROOT"] . "/" . explode("/", $_SERVER["PHP_SELF"])[1] . "/";
require_once($_SITE_PATH . "/app/model/Redzpot.class.php");

class Servicios extends REDZPOT
{
    public $id_servicios;
    public $imagen_servicios;
    public $texto1_servicios;
    public $texto2_servicios;  
    public $texto3_servicios;  


   public function __construct($valores = null)
    {
        parent::__construct();

        if (is_array($valores) || is_object($valores)) {
            foreach ($valores as $idx => $valor) {
                // protego que los valores vengan seguros
                $this->{$idx} = addslashes($valor);
            }
        }
    }

    public function getInfo()
    {
        $sql = "select * from servicios where id_servicios = '{$this->id_servicios}'";
        $res = $this->Query($sql);
        //echo nl2br($sql);
        if (count($res) > 0) {
            foreach ($res[0] as $idx => $campo) {
                $this->{$idx} = $campo;
            }
        }
    }

    public function Listado()
    {

        $sql = "SELECT * FROM `servicios` order by ord_servicios";
        //echo nl2br($sql);
        return $this->Query($sql);
    }

    public function Existe()
    {
        $sql = "select id_servicios from servicios where id_servicios='{$this->id_servicios}'";
        $res = $this->Query($sql);
        $bExiste = false;

        if (count($res) > 0) {
            $bExiste = true;
        }

        return $bExiste;
    }

    public function Actualizar()
    {   
            $sql = "UPDATE `servicios`
            SET
            `texto1_servicios` = '{$this->texto1_servicios}',
            `texto2_servicios` = '{$this->texto2_servicios}',
            `texto3_servicios` = '{$this->texto3_servicios}'
                    where
                    id_servicios = '{$this->id_servicios}'";
            //echo nl2br($sql);
            return $this->NonQuery($sql);
        }
    public function Agregar()
    {
        $sql = "INSERT INTO `servicios`
        (`texto1_servicios`,`texto2_servicios`,`texto3_servicios`)
        VALUES
        ('{$this->texto1_servicios}','{$this->texto2_servicios}','{$this->texto3_servicios}')";
        //echo nl2br($sql);
        $bResultado = $this->NonQuery($sql);


        $sql = "select id_servicios from servicios order by id_servicios desc limit 1";
        $res = $this->Query($sql);

        $this->id_servicios = $res[0]->id_servicios; // obtengo el ID que le dio el sistema

        return $bResultado;
    }

    public function Guardar()
    {

        if ($this->Existe()) {
            return $this->Actualizar();
        } else {
            return $this->Agregar();
        }
    }

    public function Quitar($ids)
    {
        $sql = "select imagen_servicios from servicios where id_servicios='{$ids}'";
        $res = $this->Query($sql);

        @unlink($this->RutaAbsoluta . $res[0]->imagen_servicios);

        $sql = "update servicios set imagen_servicios=null where id_servicios='{$ids}'";
        return parent::NonQuery($sql);
    }

     public function SubirArchivo($archivo,$campo) {

        $bResultado = false;
        $dirFotos = $this->RutaAbsoluta . "inicio/";
        @mkdir($dirFotos);
        $dirFotos .= "servicios/";
        @mkdir($dirFotos);

        $archivoDir = "inicio/servicios/";

        if ($archivo['error'] == 0) {// si se subió el archivo
            $nomArchivoTemp = explode(".", $archivo['name']);
            $extArchivo = strtoupper(trim(end($nomArchivoTemp)));

            if (!($extArchivo == "JPG" || $extArchivo == "PNG" || $extArchivo == "JPGE")) {// si no es igual a jpg
                return 2;
            }

            $nomArchivo = $archivo['name'];
            $archivoDir .= $nomArchivo;
            $uploadfile = $dirFotos . basename($nomArchivo);

            if (move_uploaded_file($archivo['tmp_name'],$uploadfile)) {
                $sql = "update servicios set $campo = '{$archivoDir}' where id_servicios = '{$this->id_servicios}'";
                $bResultado = parent::NonQuery($sql);
                //echo nl2br($sql);
            }
        }
        return $bResultado == 1 ? true : false;
    }
    public function Borrar($ids) {
        $sql = "select imagen_servicios from servicios where id_servicios='{$ids}'";
        $res = $this->Query($sql);

        @unlink($this->RutaAbsoluta . $res[0]->imagen_servicios);

        $sql1 = "delete from servicios where id_servicios='{$ids}'";
        return $this->NonQuery($sql1);
    }
    public function GenerarLista($id,$orden) {

        $sql = "update servicios set  ord_servicios='{$orden}' where id_servicios='{$id}'";
        //echo nl2br($sql);
        return $this->NonQuery($sql);
    }

}