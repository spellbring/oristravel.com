<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class ciudadDTO
{
    private $_cod_ciudad;
    private $_ciudad;
    
    
    public function getCiudad() {
        return $this->_ciudad;
    }
    public function setCiudad($ciu) {
        $this->_ciudad = $ciu;
    }

    public function getCodCiudad() {
        return $this->_cod_ciudad;
    }
    public function setCodCiudad($cod) {
        $this->_cod_ciudad = $cod;
    }
}