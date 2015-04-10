<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class Database
{
    protected $_conexion;
    
    public function __construct() {
        $this->_conexion= mysql_connect(DB_HOST, DB_USER, DB_PASS);
        
        if ($this->_conexion) {
            $bd = mysql_select_db(DB_NAME, $this->_conexion);
            if ($bd) {
                //mysql_set_charset('ISO-8859-1',$this->_conexion);
                return true;
            } else {
                throw new Exception('Base de datos no encontrada');
            }
        } else {
            throw new Exception('No se pudo conectar a la Base de datos');
        }
    }
    
    public function consulta($query) {
        //echo $query; exit;
        $rs = mysql_query($query, $this->_conexion);
        
        if ($rs) {
            return $rs;
        } else {
            return false;
        }
    }
    
    public function fetchAll($consulta) {
        $arrayFetch = array();
        while ($reg = mysql_fetch_array($consulta)) {
            $arrayFetch[] = $reg;
        }

        return $arrayFetch;
    }
    public function fetchRow($consulta){//jrr
        return mysql_fetch_row($consulta);
    }
    

    public function numRows($consulta) {
        return mysql_num_rows($consulta);
    }

    public function closeConex() {
        return mysql_close($this->conexion);
    }

}