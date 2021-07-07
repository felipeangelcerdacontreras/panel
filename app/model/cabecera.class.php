<?php

/*
 * Copyright 2019 - Redzpot Impulso en Imagen S.A. de C.V. 
 * cerda@redzpot.com
 */
$_SITE_PATH = $_SERVER["DOCUMENT_ROOT"] . "/" . explode("/", $_SERVER["PHP_SELF"])[1] . "/";
require_once($_SITE_PATH . "/app/model/Redzpot.class.php");

class Cabecera extends REDZPOT
{
    public $id_index;
    public $color_plantilla;
    public $logo;
    public $imagen_1;  
    public $texto_1_1;  
    public $texto_2_1;  
    public $texto_3_1;  
    public $imagen_lateral_1;
    public $texto1_lateral_1;  
    public $texto2_lateral_1;  
    public $texto3_lateral_1;  
    public $imagen_lateral_2;
    public $texto1_lateral_2;
    public $texto2_lateral_2;  
    public $texto3_lateral_2; 
    public $texto_quienessomos;
    public $texto_superior;
    public $texto_elegirnos1;
    public $texto_elegirnos2;
    public $texto_elegirnos3;
    public $texto_servicios;
    public $publicacion_insta;
   


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
        $sql = "select * from cabecera where id_index = '1'";
        $res = $this->Query($sql);
        //echo nl2br($sql);
        if (count($res) > 0) {
            foreach ($res[0] as $idx => $campo) {
                $this->{$idx} = $campo;
            }
        }
    }

    public function Existe()
    {
        $sql = "select id_index from cabecera where id_index='1'";
        $res = $this->Query($sql);
        $bExiste = false;

        if (count($res) > 0) {
            $bExiste = true;
        }

        return $bExiste;
    }

    public function Actualizar()
    {   
            $sql = "UPDATE `cabecera`
            SET
            `color_plantilla` = '{$this->color_plantilla}',
            `logo` = '{$this->logo}',
            `imagen_1` = '{$this->imagen_1}',
            `texto_1_1` = '{$this->texto_1_1}',
            `texto_2_1` = '{$this->texto_2_1}',
            `texto_3_1` = '{$this->texto_3_1}',
            `imagen_lateral_1` = '{$this->imagen_lateral_1}',
            `texto1_lateral_1` = '{$this->texto1_lateral_1}',
            `texto2_lateral_1` = '{$this->texto2_lateral_1}',
            `texto3_lateral_1` = '{$this->texto3_lateral_1}',
            `imagen_lateral_2` = '{$this->imagen_lateral_2}',
            `texto1_lateral_2` = '{$this->texto1_lateral_2}',
            `texto2_lateral_2` = '{$this->texto2_lateral_2}',
            `texto3_lateral_2` = '{$this->texto3_lateral_2}',
            `texto_quienessomos` = '{$this->texto_quienessomos}',
            `texto_superior` = '{$this->texto_superior}',
            `texto_elegirnos1` = '{$this->texto_elegirnos1}',
            `texto_elegirnos2` = '{$this->texto_elegirnos2}',
            `texto_elegirnos3` = '{$this->texto_elegirnos3}',
            `texto_servicios` = '{$this->texto_servicios}',
            `publicacion_insta` = '{$this->publicacion_insta}'
                    where
                    id_index = '1'";
            //echo nl2br($sql);
            return $this->NonQuery($sql);
        }
    public function Agregar()
    {
        $sql = "INSERT INTO `cabecera`
        (`id_index`,`color_plantilla`,`logo`,`imagen_1`,`texto_1_1`,`texto_2_1`,`texto_3_1`,`imagen_lateral_1`,`texto1_lateral_1`,`texto2_lateral_1`,`texto3_lateral_1`,`imagen_lateral_2`
        ,`texto1_lateral_2`,`texto2_lateral_2`,`texto3_lateral_2`,'texto_quienessomos','texto_superior','texto_elegirnos1','texto_elegirnos2','texto_elegirnos3',texto_servicios,publicacion_insta)
        VALUES
        ('1','{$this->color_plantilla}','{$this->logo}','{$this->imagen_1}','{$this->texto_1_1}','{$this->texto_2_1}','{$this->texto_3_1}','{$this->imagen_lateral_1}',
        '{$this->texto1_lateral_1}','{$this->texto2_lateral_1}','{$this->texto3_lateral_1}','{$this->imagen_lateral_2}','{$this->texto1_lateral_2}','{$this->texto2_lateral_2}','{$this->texto3_lateral_2}',
        '{$this->texto_quienessomos}','{$this->texto_superior}','{$this->texto_elegirnos1}','$this->texto_elegirnos2','{$this->texto_elegirnos3}','{$this->texto_servicios}','{$this->publicacion_insta}')";
        //echo nl2br($sql);
        $bResultado = $this->NonQuery($sql);


        $sql = "select id_index from cabecera order by id_index desc limit 1";
        $res = $this->Query($sql);

        $this->id_index = $res[0]->id_index; // obtengo el ID que le dio el sistema

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

    public function Quitar($val_1)
    {

        $sql = "select $val_1 from cabecera where id_index='{$this->id_index}'";
        $res = $this->Query($sql);

        @unlink($this->RutaAbsoluta . $res[0]->age_logo);

        $sql = "update cabecera set $val_1=null where id_index='{$this->id_index}'";
        return parent::NonQuery($sql);
    }

     public function SubirArchivo($archivo,$campo) {

        $bResultado = false;
        $dirFotos = $this->RutaAbsoluta . "inicio/";
        @mkdir($dirFotos);
        $dirFotos .= "cabecera/";
        @mkdir($dirFotos);

        $archivoDir = "inicio/cabecera/";

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
                
                $sql = "update cabecera set $campo = '{$archivoDir}' where id_index = '1'";
                $bResultado = parent::NonQuery($sql);
                //echo nl2br(" consulta ".$sql);
            }
        }
        return $bResultado == 1 ? true : false;
    }
}