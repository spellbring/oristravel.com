<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class businessDTO
{
    private $_tcambio;
    
    public function getTipoCambio() {
        return $this->_tcambio;
    }
    public function setTipoCambio($cambio) {
        $this->_tcambio = $cambio;
    }
}