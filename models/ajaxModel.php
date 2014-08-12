<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class ajaxModel extends Model
{   
    public function __construct() {
        parent::__construct();
    }
    
    public function getPaises()
    {
        $sql= 'SELECT nombre AS nombre_pais, codigo AS codigo_pais '
            . 'FROM pais '
            . 'ORDER BY nombre ASC';
        
        $ciudadesHot= $this->_db->consulta($sql);
        if($this->_db->numRows($ciudadesHot)>0)
        {
            return $this->_db->fetchAll($ciudadesHot);
        }
        else
        {
            return false;
        }
    }
    
    public function getCiudades()
    {
        $sql= 'SELECT nombre AS nombre_ciudad, codigo AS codigo_ciudad '
            . 'FROM ciudad '
            . 'ORDER BY nombre ASC';
        
        $ciudadesHot= $this->_db->consulta($sql);
        if($this->_db->numRows($ciudadesHot)>0)
        {
            return $this->_db->fetchAll($ciudadesHot);
        }
        else
        {
            return false;
        }
    }
}