<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class programaDAO extends Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function getCiudadesPRG() {
        $sql = 'SELECT pais.nombre AS nombre_pais, pais.codigo AS codigo_pais, ciudad.nombre AS nombre_ciudad, ciudad.codigo AS codigo_ciudad '
                . 'FROM pais '
                . 'JOIN ciudad ON (pais.codigo = ciudad.codigop) '
                //. 'WHERE'
                //. 'ciudad.nombre LIKE "%'.$nombre_h.'%" OR pais.nombre LIKE "%'.$nombre_h.'%" OR ciudad.codigo LIKE "%'.$nombre_h.'%" '
                . 'ORDER BY ciudad.nombre ASC';

        $ciudadesProg = $this->_db->consulta($sql);
        if ($this->_db->numRows($ciudadesProg) > 0) {
            $prgArray = $this->_db->fetchAll($ciudadesProg);
            $objetosPRG = array();

            foreach ($prgArray as $prgdb) {
                $prgObj = new programaDTO();
                
                $prgObj->setCodPais(trim($prgdb['codigo_pais']));
                $prgObj->setPais(trim($prgdb['nombre_pais']));
                $prgObj->setCodCiudad(trim($prgdb['codigo_ciudad']));
                $prgObj->setCiudad(trim($prgdb['nombre_ciudad']));
                
                $objetosPRG[] = $prgObj;
            }

            return $objetosPRG;
            //return $this->_db->fetchAll($ciudadesProg);
        } else {
            return false;
        }
    }

}