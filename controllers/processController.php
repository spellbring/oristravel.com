<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class processController extends Controller
{
    public function __construct() {
        parent::__construct();
    }
    
    public function index()
    {
        $this->redireccionar('sistema');
    }
    
    public function consBooking()
    {
        Session::acceso('Usuario');
        Session::set('sess_pCR_fechaDesde', $this->getTexto('txtFechaDesde-ConsRes'));
        Session::set('sess_pCR_fechaHasta', $this->getTexto('txtFechaHasta-ConsRes'));
        Session::set('sess_pCR_tipoFecha', $this->getTexto('rdbFecha'));

        $this->redireccionar('sistema/consultarBooking');
    }
    
    public function bsHot()
    {
        Session::acceso('Usuario');
        //Session::set('sess_pCR_fechaDesde', $this->getTexto('txtFechaDesde-ConsRes'));
        //Session::set('sess_pCR_fechaHasta', $this->getTexto('txtFechaHasta-ConsRes'));
        //Session::set('sess_pCR_tipoFecha', $this->getTexto('rdbFecha'));

        $this->redireccionar('sistema/buscarHoteles');
    }
}