<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class hotelDTO
{
    private $_codigo;
    private $_nombre;
    private $_hotel;
    private $_cod_cat;
    private $_categoria;
    private $_cod_pais;
    private $_pais;
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
    
    public function getCategoria() {
        return $this->_categoria;
    }
    public function setCategoria($cat) {
        $this->_categoria = $cat;
    }
    
    public function getCodCat() {
        return $this->_cod_cat;
    }
    public function setCodCat($cod) {
        $this->_cod_cat = $cod;
    }
    
    public function getHotel() {
        return $this->_hotel;
    }
    public function setHotel($hot) {
        $this->_hotel = $hot;
    }
    
    public function getNombre() {
        return $this->_nombre;
    }
    public function setNombre($nom) {
        $this->_nombre = $nom;
    }
    
    public function getCodigo() {
        return $this->_codigo;
    }
    public function setCodigo($cod) {
        $this->_codigo = $cod;
    }
}