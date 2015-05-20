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
        $this->_conexion= new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        if ($this->_conexion->connect_error) {
            throw new Exception('Error de conexion');
        } else {
            return true;
        }
    }

    public function consulta($query) {
        //echo var_dump($this->_conexion);
        $rs = $this->_conexion->query($query);
        //$this->_conexion->free();
        if ($rs) {
            return $rs;
        } else {
            return false;
        }
    }
    
    public function consultaSP($query) {
        $this->_conexion->multi_query($query);
    }
    
    public function numRows($consulta) {
        return mysqli_num_rows($consulta);
    }
    
    public function fetchAll($consulta) {
        $arrayFetch = array();
        while ($reg = $consulta->fetch_array()) {
            $arrayFetch[] = $reg;
        }

        return $arrayFetch;
    }
    
    public function fetchAllSP() {
        $arrayFetch = array();
        do
        {
            if($result = $this->_conexion->store_result()) {
                while($row = $result->fetch_array()) {
                    $arrayFetch[] = $row;
                }
                $result->free();    
            }
            
            $this->_conexion->more_results();
        }
        while($this->_conexion->next_result());
        
        return $arrayFetch;
        //}
    }
    
    public function closeConex() {
        return $this->_conexion->close();
    }

}