<?php

/* 
 * Proyecto : Allways
 * Autor    : Tsyacom Ltda.
 * Fecha    : Martes, 4 de marzo de 2014
 */

class bookingDTO
{
    private $_id;
    private $_voucher;
    private $_fecha;
    private $_fecha_in;
    private $_nombre_pax;
    private $_total;
    private $_moneda;
    private $_vuelo_in;
    private $_estado;
    private $_glosa;
    private $_nombre_us;
    private $_apellido_us;
    private $_agencia;
    
    public function getAgencia() {
        return $this->_agencia;
    }
    public function setAgencia($agen) {
        $this->_agencia = $agen;
    }
    
    public function getApellidoUser() {
        return $this->_apellido_us;
    }
    public function setApellidoUser($ape) {
        return $this->_apellido_us = $ape;
    }
    
    public function getNombreUser() {
        return $this->_nombre_us;
    }
    public function setNombreUser($nom) {
        $this->_nombre_us = $nom;
    }
    
    public function getGlosa() {
        return $this->_glosa;
    }
    public function setGlosa($glosa) {
        $this->_glosa = $glosa;
    }
    
    public function getEstado() {
        return $this->_estado;
    }
    public function setEstado($st) {
        $this->_estado = $st;
    }
    
    public function getVueloIn() {
        return $this->_vuelo_in;
    }
    public function setVueloIn($v_in) {
        $this->_vuelo_in = $v_in;
    }
    
    public function getMoneda() {
        return $this->_moneda;
    }
    public function setMoneda($moneda) {
        $this->_moneda = $moneda;
    }
    
    public function getTotal() {
        return $this->_total;
    }
    public function setTotal($total) {
        $this->_total = $total;
    }
    
    public function getNomPax() {
        return $this->_nombre_pax;
    }
    public function setNomPax($pax) {
        $this->_nombre_pax = $pax;
    }
    
    public function getFechaIn() {
        return $this->_fecha_in;
    }
    public function setFechaIn($f_in) {
        $this->_fecha_in = $f_in;
    }
    
    public function getFecha() {
        return $this->_fecha;
    }
    public function setFecha($fecha) {
        $this->_fecha = $fecha;
    }
    
    public function getVoucher() {
        return $this->_voucher;
    }
    public function setVoucher($vou) {
        $this->_voucher = $vou;
    }
    
    public function getId() {
        return $this->_id;
    }
    public function setId($id) {
        $this->_id = $id;
    }
}
?>