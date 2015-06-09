<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class carroDTO{
    private $_id;    
    private $_servicio;
    private $_habitacion;
    private $_pa;
    private $_nhab;
    private $_a;
    private $_c;
    private $_pais;
    private $_ciudad;
    private $_fecha_in;
    private $fecha_out;
    private $_vuelo;
    private $_total;
    private $_status;
    private $_nombre;//
    private $_apellido;//
    private $_nombreCh;
    private $_apellidoCh;
    private $_programa;
    private $_habitacionCh;
    private $_habitacionPax;
    
    function getHabitacionPax() {
        return $this->_habitacionPax;
    }

    function setHabitacionPax($habitacionPax) {
        $this->_habitacionPax = $habitacionPax;
        return $this;
    }

        
    function getHabitacionCh() {
        return $this->_habitacionCh;
    }

    function setHabitacionCh($habitacionCh) {
        $this->_habitacionCh = $habitacionCh;
        return $this;
    }

        
    function getPrograma() {
        return $this->_programa;
    }

    function setPrograma($programa) {
        $this->_programa = $programa;
        return $this;
    }

        
    function getId() {
        return $this->_id;
    }

    function setId($id) {
        $this->_id = $id;
        return $this;
    }
    
    function getNombreCh() {
        return $this->_nombreCh;
    }

    function getApellidoCh() {
        return $this->_apellidoCh;
    }

    function setNombreCh($nombreCh) {
        $this->_nombreCh = $nombreCh;
        return $this;
    }

    function setApellidoCh($apellidoCh) {
        $this->_apellidoCh = $apellidoCh;
        return $this;
    }

    
    
        
    function getNombre() {
        return $this->_nombre;
    }

    function getApellido() {
        return $this->_apellido;
    }

    function setNombre($nombre) {
        $this->_nombre = $nombre;
        return $this;
    }

    function setApellido($apellido) {
        $this->_apellido = $apellido;
        return $this;
    }

        
    function getStatus() {
        return $this->_status;
    }

    function setStatus($status) {
        $this->_status = $status;
        return $this;
    }

        
    function getCiudad() {
        return $this->_ciudad;
    }

    function setCiudad($ciudad) {
        $this->_ciudad = $ciudad;
        return $this;
    }

       
    
    function getServicio() {
        return $this->_servicio;
    }

    function getHabitacion() {
        return $this->_habitacion;
    }

    function getPa() {
        return $this->_pa;
    }

    function getNhab() {
        return $this->_nhab;
    }

    function getA() {
        return $this->_a;
    }

    function getC() {
        return $this->_c;
    }

    function getPais() {
        return $this->_pais;
    }

  

    function getFecha_in() {
        return $this->_fecha_in;
    }

    function getFecha_out() {
        return $this->fecha_out;
    }

    function getVuelo() {
        return $this->_vuelo;
    }

    function getTotal() {
        return $this->_total;
    }

    function setServicio($servicio) {
        $this->_servicio = $servicio;
        return $this;
    }

    function setHabitacion($habitacion) {
        $this->_habitacion = $habitacion;
        return $this;
    }

    function setPa($pa) {
        $this->_pa = $pa;
        return $this;
    }

    function setNhab($nhab) {
        $this->_nhab = $nhab;
        return $this;
    }

    function setA($a) {
        $this->_a = $a;
        return $this;
    }

    function setC($c) {
        $this->_c = $c;
        return $this;
    }

    function setPais($pais) {
        $this->_pais = $pais;
        return $this;
    }

 

    function setFecha_in($fecha_in) {
        $this->_fecha_in = $fecha_in;
        return $this;
    }

    function setFecha_out($fecha_out) {
        $this->fecha_out = $fecha_out;
        return $this;
    }

    function setVuelo($vuelo) {
        $this->_vuelo = $vuelo;
        return $this;
    }

    function setTotal($total) {
        $this->_total = $total;
        return $this;
    }


            

    
}


