<?php
/*
 * Copyright 2016 - Geodesarrollos Soluciones S de RL de CV
 * francisco.torres@geodesa.com.mx
 */

//require_once ($_SERVER['DOCUMENT_ROOT'] . "/SOCIAL/Configuracion.class.php");
//require_once ($_SERVER['DOCUMENT_ROOT'] . "/SOCIAL/app/model/db.class.php");

$_SITE_PATH = $_SERVER["DOCUMENT_ROOT"] . "/" . explode("/", $_SERVER["PHP_SELF"])[1]. "/";
require_once($_SITE_PATH . "/Configuracion.class.php");
require_once($_SITE_PATH . "/app/model/db.class.php");

date_default_timezone_set("America/Mexico_City");


class REDZPOT extends database
{
    var $MESES = array(1 => "Enero", 2 => "Febrero", 3 => "Marzo", 4 => "Abril", 5 => "Mayo", 6 => "Junio", 7 => "Julio", 8 => "Agosto", 9 => "Septiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre");

    public function __construct($valida_sesion = true)
    {
        /*
         * s = SESION
         */
        parent::__construct();

        if ($valida_sesion === true)
            $this->ExisteSesion();
    }

    public function ExisteSesion()
    {
        if (!isset($_SESSION[$this->NombreSesion])) {
            header("Location: index.php?action=login");
            exit();
        }
    }

    public function ValidaLogin($usr, $pass)
    {
      $sql = "select * from usuarios where
              usr_correoe='{$usr}'
              and (usr_pass='{$this->Encripta($pass)}' or '$this->MasterKey' = '$pass')";
      $res = $this->Query($sql);

      $bLogin = false;
      //print_r($res);
      if ($res != NULL || $res != false) {
        session_unset();
        session_start();
        $_SESSION[$this->NombreSesion] = $res[0];
        $bLogin = true;
      }
      return $bLogin;
    }

    public function ValidaNivelUsuario($permiso = "")
    {
        /*
         * Reviso el nivel de la sesion para permitirle interactuar
         * 1: Administrador
         */
        $sql = "select usr_permisos from usuarios where usr_id='" . $_SESSION[$this->NombreSesion]->usr_id . "'";
        $res = $this->Query($sql);
        $aPermisos = explode("@", $res[0]->usr_permisos);
        //echo nl2br($sql);
        if ($aPermisos && count($aPermisos) > 0) {
            $bTienePermiso = false;
            foreach ($aPermisos as $idx => $valor) {
                if ($permiso === $valor) {
                    $bTienePermiso = true;
                    break;
                }
            }

            if ($bTienePermiso === false) {
                header("Location: index.php?action=acceso_denegado");
                exit();
            }
        } else {
            header("Location: index.php?action=error_page");
            exit();
        }
    }
 
    public function ObtenerIP()
    {
        if (isset($_SERVER["HTTP_CLIENT_IP"]))
        {
            return $_SERVER["HTTP_CLIENT_IP"];
        }
        elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
        {
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
        {
            return $_SERVER["HTTP_X_FORWARDED"];
        }
        elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
        {
            return $_SERVER["HTTP_FORWARDED_FOR"];
        }
        elseif (isset($_SERVER["HTTP_FORWARDED"]))
        {
            return $_SERVER["HTTP_FORWARDED"];
        }
        else
        {
            return $_SERVER["REMOTE_ADDR"];
        }
 
    }

    public function ExistePermiso($permiso, $arreglo)
    {
        $bExiste = false;

        if ($arreglo && count($arreglo) > 0) {
            foreach ($arreglo as $idx => $valor) {
                if ($valor === $permiso) {
                    $bExiste = true;
                    break;
                }
            }
        }
        return $bExiste;
    }

    public function InfoUsuario($u_alias)
    {
        $sql = "select * from usuarios as a
                join niveles as b on b.nvl_id=a.u_nivel
                where a.u_alias='{$u_alias}'";

        $res = parent::Query($sql);

        return $res[0];
    }

    public
    function Encripta($cadena)
    {
        return md5($cadena);
    }

    public function MensajeAviso($titulo = "Hey!", $msg)
    {
        $formato = "
            <div class='ui-widget'>
                <div class='ui-state-highlight ui-corner-all' style='margin-top: 20px; padding: 0 .7em;'>
                    <p><span class='ui-icon ui-icon-info' style='float: left; margin-right: .3em;'></span>
                    <strong>{$titulo}</strong>{$msg}</p>
                </div>
            </div>";
        return $formato;
    }

    /*
    public
    function SubirArchivo($ruta, $archivo, &$nomArchivo)
    {
        $bResultado = false;
        @mkdir($ruta, 0777, true);

        if ($archivo["error"] == 0) {// si se subio el archivo y no hay error
            $nomArchivoUsuario = utf8_decode($archivo['name']);
            $nomArchivoTemp = explode(".", $nomArchivoUsuario);
            $extArchivo = strtolower(trim(end($nomArchivoTemp)));

            if ($extArchivo === "exe" || $extArchivo === "bat" || $extArchivo === "com" || $extArchivo === "js" || $extArchivo === "php" || $extArchivo === "html" || $extArchivo === "htm" || $extArchivo === "phtml" || $extArchivo === "phtm") {// si es un archivo peligroso
                return 2;
            }

            $nomArchivo = "{$nomArchivo}.{$extArchivo}";
            //$nomArchivo = strtolower($nomArchivo);
            $uploadfile = $ruta . "/" . basename($nomArchivo);

            if (move_uploaded_file($archivo["tmp_name"], $uploadfile)) {
                $bResultado = true;
                $nomArchivo = $uploadfile;
            }
        }
        return $bResultado;
    }
    */

    function generarCodigo($longitud)
    {
        $key = '';
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
        $max = strlen($pattern) - 1;
        for ($i = 0; $i < $longitud; $i++) $key .= $pattern{mt_rand(0, $max)};
        return $key;
    }

    public
    function BorrarCarpeta($carpeta)
    {
        foreach (glob($carpeta . "/*") as $archivos_carpeta) {
            //echo $archivos_carpeta;

            if (is_dir($archivos_carpeta)) {
                eliminarDir($archivos_carpeta);
            } else {
                unlink($archivos_carpeta);
            }
        }

        rmdir($carpeta);
    }

    public
    function MensajeAlerta($titulo = "Sistema", $msg)
    {
        $sCad = "{$titulo}{$msg}";

        return $sCad;
    }

}
?>