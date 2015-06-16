<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class servicioDTO
{
    private $_cod_pais;//
    private $_pais;
    private $_cod_ciudad;//
    private $_ciudad;
    private $_numero;
    private $_nombre;
    private $_notas;
    private $_desde;
    private $_hasta;
    private $_por;
    private $_conv;
    private $_dSpax_i;
    private $_dSpax_f;
    private $_comcts;
    private $_dScompv;
    private $_compv;
    private $_moneda;
    private $_ope;
    private $_dStarifa;
    private $_tcambio;
    private $_tarifa;
    private $_codigo;
    private $_tipos;
    private $_dgcomac;
    
    function getDgcomac() {
        return $this->_dgcomac;
    }

    function setDgcomac($dgcomac) {
        $this->_dgcomac = $dgcomac;
        return $this;
    }

        
    function getTipos() {
        return $this->_tipos;
    }

    function setTipos($tipos) {
        $this->_tipos = $tipos;
        return $this;
    }

        
    function getCodigo() {
        return $this->_codigo;
    }

    function setCodigo($codigo) {
        $this->_codigo = $codigo;
        return $this;
    }

        
    function getTarifa() {
        return $this->_tarifa;
    }

    function setTarifa($tarifa) {
        $this->_tarifa = $tarifa;
        return $this;
    }

        
    function getCod_pais() {
        return $this->_cod_pais;
    }

    function getCod_ciudad() {
        return $this->_cod_ciudad;
    }

    function getNotas() {
        return $this->_notas;
    }

    function getDesde() {
        return $this->_desde;
    }

    function getHasta() {
        return $this->_hasta;
    }

    function getPor() {
        return $this->_por;
    }

    function getConv() {
        return $this->_conv;
    }

    function getDSpax_i() {
        return $this->_dSpax_i;
    }

    function getDSpax_f() {
        return $this->_dSpax_f;
    }

    function getComcts() {
        return $this->_comcts;
    }

    function getDScompv() {
        return $this->_dScompv;
    }

    function getCompv() {
        return $this->_compv;
    }

    function getMoneda() {
        return $this->_moneda;
    }

    function getOpe() {
        return $this->_ope;
    }

    function getDStarifa() {
        return $this->_dStarifa;
    }

    function getTcambio() {
        return $this->_tcambio;
    }

    function setCod_pais($cod_pais) {
        $this->_cod_pais = $cod_pais;
        return $this;
    }

    function setCod_ciudad($cod_ciudad) {
        $this->_cod_ciudad = $cod_ciudad;
        return $this;
    }

    function setNotas($notas) {
        $this->_notas = $notas;
        return $this;
    }

    function setDesde($desde) {
        $this->_desde = $desde;
        return $this;
    }

    function setHasta($hasta) {
        $this->_hasta = $hasta;
        return $this;
    }

    function setPor($por) {
        $this->_por = $por;
        return $this;
    }

    function setConv($conv) {
        $this->_conv = $conv;
        return $this;
    }

    function setDSpax_i($dSpax_i) {
        $this->_dSpax_i = $dSpax_i;
        return $this;
    }

    function setDSpax_f($dSpax_f) {
        $this->_dSpax_f = $dSpax_f;
        return $this;
    }

    function setComcts($comcts) {
        $this->_comcts = $comcts;
        return $this;
    }

    function setDScompv($dScompv) {
        $this->_dScompv = $dScompv;
        return $this;
    }

    function setCompv($compv) {
        $this->_compv = $compv;
        return $this;
    }

    function setMoneda($moneda) {
        $this->_moneda = $moneda;
        return $this;
    }

    function setOpe($ope) {
        $this->_ope = $ope;
        return $this;
    }

    function setDStarifa($dStarifa) {
        $this->_dStarifa = $dStarifa;
        return $this;
    }

    function setTcambio($tcambio) {
        $this->_tcambio = $tcambio;
        return $this;
    }

        
    
    function getNumero() {
        return $this->_numero;
    }

    function getNombre() {
        return $this->_nombre;
    }

    function setNumero($numero) {
        $this->_numero = $numero;
        return $this;
    }

    function setNombre($nombre) {
        $this->_nombre = $nombre;
        return $this;
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