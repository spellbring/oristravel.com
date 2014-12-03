<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class ciudadDAO extends Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function getCiudades() {
        $sql = 'SELECT nombre AS nombre_ciudad, codigo AS codigo_ciudad '
                . 'FROM ciudad '
                . 'ORDER BY nombre ASC';

        $ciudades = $this->_db->consulta($sql);
        if ($this->_db->numRows($ciudades) > 0) {
            $ciuArray = $this->_db->fetchAll($ciudades);
            $objetosCiu = array();

            foreach ($ciuArray as $ciudb) {
                $ciuObj = new ciudadDTO();
                
                $ciuObj->setCodCiudad(trim($ciudb['codigo_ciudad']));
                $ciuObj->setCiudad(trim($ciudb['nombre_ciudad']));
                
                $objetosCiu[] = $ciuObj;
            }

            return $objetosCiu;
            //return $this->_db->fetchAll($ciudades);
        } else {
            return false;
        }
    }

}