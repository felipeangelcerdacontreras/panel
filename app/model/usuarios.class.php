<?php
/*
 * Copyright 2019 - Redzpot Impulso en Imagen S.A. de C.V. 
 * cerda@redzpot.com
 */
//require_once ($_SERVER['DOCUMENT_ROOT'] . "/SOCIAL/app/model/Reaccion.class.php");
$_SITE_PATH = $_SERVER["DOCUMENT_ROOT"] . "/" . explode("/", $_SERVER["PHP_SELF"])[1] . "/";
require_once($_SITE_PATH . "/app/model/Redzpot.class.php");

class usuarios extends REDZPOT {

    var $usr_id;
    var $usr_pass;
    var $usr_nombre;
    var $usr_nivel;
    var $usr_foto;
    var $usr_correoe;
    var $usr_num; 
    var $usr_permisos;
    var $root;

    var $age_nom_empresa;

    public function __construct($sesion = true, $datos = NULL) {
        parent::__construct($sesion);

        if (!($datos == NULL)) {
            if (count($datos) > 0) {
                foreach ($datos as $idx => $valor) {
                    if (gettype($valor) === "array") {
                        $this->{$idx} = $valor;
                    } else {
                        $this->{$idx} = addslashes($valor);
                    }
                }
            }
        }
    }

    public function Listado() {

        $sqlUsuario = "";
        if (!empty($this->usr_nivel)) {
            $sqlUsuario = "and a.usr_nivel >='{$this->usr_nivel}'";
        }

        $sql = "SELECT * FROM usuarios  ";
        //echo nl2br($sql);
        return $this->Query($sql);
        
    }

    public function Informacion() {

        $sql = "select * from usuarios where  usr_id='{$this->usr_id}'";
        $res = parent::Query($sql);

        if (!empty($res) && !($res === NULL)) {
            foreach ($res [0] as $idx => $valor) {
                $this->{$idx} = $valor;
            }
        } else {
            $res = NULL;
        }

        return $res;
    }
    public function Gerentes() {
        $sqlAgencia = "";
        if (!empty($this->age_id)) {
            $sqlAgencia = "and age_id= {$this->age_id}";
        }

        $sql = "select * from usuarios where  usr_nivel>=1 and usr_nivel<= 2 $sqlAgencia";
        $res = parent::Query($sql);

        if (!empty($res) && !($res === NULL)) {
            foreach ($res [0] as $idx => $valor) {
                $this->{$idx} = $valor;
            }
        } else {
            $res = NULL;
        }

        return $res;
    }
    public function Vendedores() {
        $sqlAgencia = "";
        if (!empty($this->age_id)) {
            $sqlAgencia = "and age_id= {$this->age_id}";
        }
        $sql = "select * from usuarios where  usr_nivel = 3  $sqlAgencia";
        $res = parent::Query($sql);
        //echo nl2br($sql);
        if (!empty($res) && !($res === NULL)) {
            foreach ($res [0] as $idx => $valor) {
                $this->{$idx} = $valor;
            }
        } else {
            $res = NULL;
        }

        return $res;
    }
    public function Valuadores() {
        $sqlAgencia = "";
        if (!empty($this->age_id)) {
            $sqlAgencia = "and age_id= {$this->age_id}";
        }
        $sql = "select * from usuarios where  usr_nivel = 4  $sqlAgencia";
        $res = parent::Query($sql);
        //echo nl2br($sql);
        if (!empty($res) && !($res === NULL)) {
            foreach ($res [0] as $idx => $valor) {
                $this->{$idx} = $valor;
            }
        } else {
            $res = NULL;
        }

        return $res;
    }
    public function Hostess() {
        $sqlAgencia = "";
        if (!empty($this->age_id)) {
            $sqlAgencia = "and age_id='{$this->age_id}'";
        }

        $sql = "select * from usuarios where usr_nivel = 5 $sqlAgencia";
        $res = parent::Query($sql);
        //echo nl2br($sql);
        if (!empty($res) && !($res === NULL)) {
            foreach ($res [0] as $idx => $valor) {
                $this->{$idx} = $valor;
            }
        } else {
            $res = NULL;
        }

        return $res;
    }
    

    public function Existe() {
        $sql = "select usr_id from usuarios where usr_id='{$this->usr_id}'";
        $res = $this->Query($sql);

        $bExiste = false;

        if (count($res) > 0) {
            $bExiste = true;
        }

        return $bExiste;
        //echo nl2br($bExiste." func");
    }

    public function Actualizar() {
        $sqlPass = "";
        if (!empty($this->usr_pass)) {
            $sqlPass = "usr_pass='{$this->Encripta($this->usr_pass)}',";
        }
        $sPermisos = "";
        if (! empty($this->usr_permisos)) {
            foreach ($this->usr_permisos as $idx => $valor) {
                $sPermisos .= $valor . "@";
            }
        }

        $sql = "update
                    usuarios
                set
                  usr_nombre='{$this->usr_nombre}',
                  usr_foto='{$this->usr_foto}',
                  {$sqlPass}
                  usr_correoe='{$this->usr_correoe}',
                  usr_num='{$this->usr_num}',
                  usr_permisos='{$sPermisos}'
                where
                  usr_id='{$this->usr_id}'";

        //echo nl2br($sql);
        return $this->NonQuery($sql);
    }

    public function Agregar() {
        $sPermisos = "";
        if (! empty($this->usr_permisos)) {
            foreach ($this->usr_permisos as $idx => $valor) {
                $sPermisos .= $valor . "@";
            }
        }

        $sql = "insert into usuarios
                (usr_id,usr_pass, usr_nombre,usr_correoe,usr_num,usr_permisos)
                values
                ('0','{$this->Encripta($this->usr_pass)}', '{$this->usr_nombre}', '{$this->usr_correoe}','{$this->usr_num}', '{$sPermisos}')";

        $bResultado = $this->NonQuery($sql);

        $sql1 = "select usr_id from usuarios order by usr_id desc limit 1";
        $res = $this->Query($sql1);

        $this->usr_id = $res[0]->usr_id; // obtengo el ID que le dio el sistema

            //echo nl2br($sql);
            return $bResultado;
    }

    public function Guardar() {

        $bRes = false;
        if ($this->Existe() === true) {
            $bRes = $this->Actualizar();
        } else {
            $bRes = $this->Agregar();
        }

        return $bRes;
    }

    public function SubirArchivo($archivo) {

        $bResultado = false;
        $dirFotos = $this->RutaAbsoluta . "perfil";
        @mkdir($dirFotos);
        $dirFotos .= "/usuarios";
        @mkdir($dirFotos);
        $dirFotos .= "/{$this->usr_id}/";
        @mkdir($dirFotos);

        $archivoDir = "perfil/usuarios/{$this->usr_id}/";

        if ($archivo['error'] == 0) {// si se subió el archivo
            $nomArchivoTemp = explode(".", $archivo['name']);
            $extArchivo = strtoupper(trim(end($nomArchivoTemp)));

            if (!($extArchivo == "JPG" || $extArchivo == "PNG")) {// si no es igual a jpg
                return 2;
            }

            $nomArchivo = $this->usr_id . ".{$extArchivo}";
            $archivoDir .= $nomArchivo;
            $uploadfile = $dirFotos . basename($nomArchivo);

            if (move_uploaded_file($archivo['tmp_name'], $uploadfile)) {
                $sql = "update usuarios set usr_foto='{$archivoDir}' where usr_id='{$this->usr_id}'";
                $bResultado = parent::NonQuery($sql);
                //echo nl2br($sql);
            }
        }
        return $bResultado == 1 ? true : false;
    }

    public function QuitarFoto() {
        $sql = "select usr_foto from usuarios where usr_id='{$this->usr_id}'";
        $res = $this->Query($sql);

        if(@unlink($this->RutaAbsoluta . $res[0]->usr_foto)){
            $sql1 = "update usuarios set usr_foto=null where usr_id='{$this->usr_id}'";
        return parent::NonQuery($sql1);
        }else{
            echo"noo";
        }
        
    }

    public function ActualizarRutaFoto() {
        return true;
    }

    public function Borrar() {
        $sql = "select usr_foto from usuarios where usr_id='{$this->usr_id}'";
        $res = $this->Query($sql);

        @unlink($this->RutaAbsoluta . $res[0]->usr_foto);

        $sql1 = "delete from usuarios where usr_id='{$this->usr_id}'";
        return $this->NonQuery($sql1);
    }

}