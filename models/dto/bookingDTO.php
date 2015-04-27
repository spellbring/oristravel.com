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
    private $_estado;//
    private $_glosa;
    private $_nombre_us;
    private $_apellido_us;
    private $_agencia;
    private $_registro;
    private $_fecha_anul;//nuevo atributo
    private $_cliente;//nuevo atributo
    private $_hotel;//nuevo atributo dbooking
    private $_tipoh;//nuevo atributo dbooking
    private $_pa;//nuevo atributo dbooking
    private $_tot_pax;//nuevo atributo dbooking
    private $_tot_hab;//nuevo atributo dbooking
    private $_tot_child1;//nuevo atributo dbooking
    private $_ciudad;//nuevo atributo dbooking
    private $_fecha_out;//nuevo atributo dbooking
    private $_total_venta;//nuevo atributo dbooking
    private $_apellido_pax;//nuevo atributo para pbooking
    private $_hab;//nuevo atributo para pbooking
    private $_nhab;//nuevo atributo para pbooking
    //pbooking
    function getApellido_pax() {
        return $this->_apelldo_pax;
    }

    function getHab() {
        return $this->_hab;
    }

    function getNhab() {
        return $this->_nhab;
    }

    function setApellido_pax($apelldo_pax) {
        $this->_apelldo_pax = $apelldo_pax;
        return $this;
    }

    function setHab($hab) {
        $this->_hab = $hab;
        return $this;
    }

    function setNhab($nhab) {
        $this->_nhab = $nhab;
        return $this;
    }

    
    //dbooking
    function getTot_pax() {
        return $this->_tot_pax;
    }

    function setTot_pax($tot_pax) {
        $this->_tot_pax = $tot_pax;
        return $this;
    }

        function getHotel() {
        return $this->_hotel;
    }

    function getTipoh() {
        return $this->_tipoh;
    }

    function getPa() {
        return $this->_pa;
    }

    function getTot_hab() {
        return $this->_tot_hab;
    }

    function getTot_child1() {
        return $this->_tot_child1;
    }

    function getCiudad() {
        return $this->_ciudad;
    }

    function getFecha_out() {
        return $this->_fecha_out;
    }

    function getTotal_venta() {
        return $this->_total_venta;
    }

    function setHotel($hotel) {
        $this->_hotel = $hotel;
        return $this;
    }

    function setTipoh($tipoh) {
        $this->_tipoh = $tipoh;
        return $this;
    }

    function setPa($pa) {
        $this->_pa = $pa;
        return $this;
    }

    function setTot_hab($tot_hab) {
        $this->_tot_hab = $tot_hab;
        return $this;
    }

    function setTot_child1($tot_child1) {
        $this->_tot_child1 = $tot_child1;
        return $this;
    }

    function setCiudad($ciudad) {
        $this->_ciudad = $ciudad;
        return $this;
    }

    function setFecha_out($fecha_out) {
        $this->_fecha_out = $fecha_out;
        return $this;
    }

    function setTotal_venta($total_venta) {
        $this->_total_venta = $total_venta;
        return $this;
    }

    ////// 
    
    function getRegistro() {
        return $this->_registro;
    }

    function setRegistro($registro) {
        $this->_registro = $registro;
        return $this;
    }

         public function getCliente(){
        return $this->_cliente;        
    }
    
    public function setCliente($clie){
         $this->_cliente = $clie;
    }
    
    public function getFecha_Anul(){
        return $this->_fecha_anul;        
    }
    
    public function setFecha_Anul($fecha_anul){
         $this->_fecha_anul = $fecha_anul;
    }
    
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