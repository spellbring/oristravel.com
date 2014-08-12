<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class commonModel extends Model
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
    
    public function getCiudadesHot()
    {
        $sql= 'SELECT pais.nombre AS nombre_pais, pais.codigo AS codigo_pais, ciudad.nombre AS nombre_ciudad, ciudad.codigo AS codigo_ciudad '
            . 'FROM pais '
            . 'JOIN ciudad ON (pais.codigo = ciudad.codigop) '
            //. 'WHERE'
            //. 'ciudad.nombre LIKE "%'.$nombre_h.'%" OR pais.nombre LIKE "%'.$nombre_h.'%" OR ciudad.codigo LIKE "%'.$nombre_h.'%" '
            . 'ORDER BY ciudad.nombre ASC';
        
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
    
    public function getCiudadesPRG()
    {
        $sql= 'SELECT pais.nombre AS nombre_pais, pais.codigo AS codigo_pais, ciudad.nombre AS nombre_ciudad, ciudad.codigo AS codigo_ciudad '
            . 'FROM pais '
            . 'JOIN ciudad ON (pais.codigo = ciudad.codigop) '
            //. 'WHERE'
            //. 'ciudad.nombre LIKE "%'.$nombre_h.'%" OR pais.nombre LIKE "%'.$nombre_h.'%" OR ciudad.codigo LIKE "%'.$nombre_h.'%" '
            . 'ORDER BY ciudad.nombre ASC';
        
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
    
    public function getCiudadesServ()
    {
        $sql= 'SELECT pais.nombre AS nombre_pais, pais.codigo AS codigo_pais, ciudad.nombre AS nombre_ciudad, ciudad.codigo AS codigo_ciudad '
            . 'FROM pais '
            . 'JOIN ciudad ON (pais.codigo = ciudad.codigop) '
            //. 'WHERE'
            //. 'ciudad.nombre LIKE "%'.$nombre_h.'%" OR pais.nombre LIKE "%'.$nombre_h.'%" OR ciudad.codigo LIKE "%'.$nombre_h.'%" '
            . 'ORDER BY ciudad.nombre ASC';
        
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