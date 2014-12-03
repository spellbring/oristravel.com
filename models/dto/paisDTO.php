<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class paisDTO
{
    private $_cod_pais;
    private $_pais;
    
    public function getPais() {
        return $this->_pais;
    }
    public function setPais($pais) {
        $this->_pais = $pais;
    }
    
    public function getCodPais() {
        return $this->_cod_pais;
    }
    public function setCodPais($cod) {
        $this->_cod_pais = $cod;
    }
}