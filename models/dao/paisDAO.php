<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class paisDAO extends Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function getPaises() {
        $sql = 'SELECT nombre AS nombre_pais, codigo AS codigo_pais '
                . 'FROM pais '
                . 'ORDER BY nombre ASC';

        $paises = $this->_db->consulta($sql);
        if ($this->_db->numRows($paises) > 0) {
            
            $paisArray = $this->_db->fetchAll($paises);
            $objetosPais = array();
            
            foreach ($paisArray as $paisdb) {
                $paisObj = new paisDTO();
                
                $paisObj->setCodPais(trim($paisdb['codigo_pais']));
                $paisObj->setPais(trim($paisdb['nombre_pais']));
                
                $objetosPais[] = $paisObj;
            }
            
            return $objetosPais;
            //return $this->_db->fetchAll($paises);
        } else {
            return false;
        }
    }

}