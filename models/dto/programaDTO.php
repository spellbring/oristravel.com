<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class programaDTO
{
    private $_cod_pais;
    private $_pais;
    private $_cod_ciudad;
    private $_ciudad;
    private $_nombre;
    private $_codigo;
    private $_id;
    private $_descripcion;
    
    function getDescripcion() {
        return $this->_descripcion;
    }

    function setDescripcion($descripcion) {
        $this->_descripcion = $descripcion;
        return $this;
    }

        
     public function getNombre() {
        return $this->_nombre;
    }
    public function setNombre($nomb) {
        $this->_nombre = $nomb;
    }
     public function getCodigo() {
        return $this->_codigo;
    }
    public function setCodigo($cod) {
        $this->_codigo = $cod;
    }
     public function getId() {
        return $this->_id;
    }
    public function setId($id) {
        $this->_id = $id;
    }
     
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
}