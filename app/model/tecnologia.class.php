<?php

/*
 * Copyright 2019 - Redzpot Impulso en Imagen S.A. de C.V. 
 * cerda@redzpot.com
 */
$_SITE_PATH = $_SERVER["DOCUMENT_ROOT"] . "/" . explode("/", $_SERVER["PHP_SELF"])[1] . "/";
require_once($_SITE_PATH . "/app/model/Redzpot.class.php");

class Tecnologia extends REDZPOT
{
    public $id_tecnologia;
    public $imagen_tecnologia;
    public $tipod_tecnologia;
    public $texto1_tecnologia;
    public $texto2_tecnologia;  
    public $texto3_tecnologia;  


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
        $sql = "select * from tecnologia where id_tecnologia = '{$this->id_tecnologia}'";
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

        $sql = "select * from tecnologia order by ord_tecnologia";
        //echo nl2br($sql);
        return $this->Query($sql);
    }

    public function Existe()
    {
        $sql = "select id_tecnologia from tecnologia where id_tecnologia='{$this->id_tecnologia}'";
        $res = $this->Query($sql);
        $bExiste = false;

        if (count($res) > 0) {
            $bExiste = true;
        }

        return $bExiste;
    }

    public function Actualizar()
    {   
            $sql = "UPDATE `tecnologia`
            SET
            `texto1_tecnologia` = '{$this->texto1_tecnologia}',
            `texto2_tecnologia` = '{$this->texto2_tecnologia}',
            `texto3_tecnologia` = '{$this->texto3_tecnologia}'
                    where
                    id_tecnologia = '{$this->id_tecnologia}'";
            //echo nl2br($sql);
            return $this->NonQuery($sql);
        }
    public function Agregar()
    {
        $sql = "INSERT INTO `tecnologia`
        (`texto1_tecnologia`,`texto2_tecnologia`,`texto3_tecnologia`)
        VALUES
        ('{$this->texto1_tecnologia}','{$this->texto2_tecnologia}','{$this->texto3_tecnologia}')";
        //echo nl2br($sql);
        $bResultado = $this->NonQuery($sql);


        $sql = "select id_tecnologia from tecnologia order by id_tecnologia desc limit 1";
        $res = $this->Query($sql);

        $this->id_tecnologia = $res[0]->id_tecnologia; // obtengo el ID que le dio el sistema

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

        $sql = "select imagen_tecnologia from tecnologia where id_tecnologia='{$ids}'";
        $res = $this->Query($sql);

        @unlink($this->RutaAbsoluta . $res[0]->imagen_tecnologia);
        $sql = "update tecnologia set imagen_tecnologia=null,tipod_tecnologia=null where id_tecnologia='{$ids}'";
        return parent::NonQuery($sql);
    }

     public function SubirArchivo($archivo,$campo,$ids) {

        $bResultado = false;
        $dirFotos = $this->RutaAbsoluta . "inicio/";
        @mkdir($dirFotos);
        $dirFotos .= "tecnologia/";
        @mkdir($dirFotos);

        $archivoDir = "inicio/tecnologia/";

        if ($archivo['error'] == 0) {// si se subió el archivo
            $nomArchivoTemp = explode(".", $archivo['name']);
            $extArchivo = strtoupper(trim(end($nomArchivoTemp)));

            if (!($extArchivo == "MP4" || $extArchivo == "JPG" || $extArchivo == "PNG" || $extArchivo == "JPGE")) {// si no es igual a jpg
                return 2;
            }

            $nomArchivo = $archivo['name'];
            $archivoDir .= $nomArchivo;
            $uploadfile = $dirFotos . basename($nomArchivo);

            if (move_uploaded_file($archivo['tmp_name'],$uploadfile)) {
                $sql = "update tecnologia set $campo = '{$archivoDir}', tipod_tecnologia='{$extArchivo}' where id_tecnologia = '{$ids}'";
                $bResultado = parent::NonQuery($sql);
                //echo nl2br($sql);
            }
        }
        return $bResultado == 1 ? true : false;
    }

    public function Borrar($ids) {
        $sql = "select imagen_tecnologia from tecnologia where id_tecnologia='{$ids}'";
        $res = $this->Query($sql);

        @unlink($this->RutaAbsoluta . $res[0]->imagen_tecnologia);
        $sql1 = "delete from tecnologia where id_tecnologia='{$ids}'";
        return $this->NonQuery($sql1);
    }
    public function GenerarLista($id,$orden) {

        $sql = "update tecnologia set  ord_tecnologia='{$orden}' where id_tecnologia='{$id}'";
        //echo nl2br($sql);
        return $this->NonQuery($sql);
    }
}