<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class sistemaController extends Controller
{
    public function __construct() {
        parent::__construct();
    }
    
    public function index()
    {
        Session::acceso('Usuario');
        
        ////$servicios= $this->loadModel('servicios');
        //$this->_view->servicios= $servicios->getServicios();
        
        
        //if(Session::get('sess_pBP_ciudadDes'))
        //{
                $this->_view->mL_expandeFiltros='block';
        /*}
        else
        {
                $this->_view->mL_expandeFiltros='none';
        }*/
        
        $this->_view->titulo='ORISTRAVEL';
        $this->_view->renderizaSistema('index');
    }
    
    
    
    public function salir()
    {
        Session::destroy();
        header('Location: ' . BASE_URL . 'login?ex');
        exit;
        /*
         * Session::destroy();
         * Session::destroy('sess_nombreUser');
         * Session::destroy(array('sess_nombreUser', 'otra'));
         */
    }
    
    
    public function pagina2()
    {
        Session::acceso('Especial');
        //$servicios= $this->loadModel('servicios');
        //$this->_view->servicios= $servicios->getServicios();
        $this->_view->titulo='ORISTRAVEL';
        $this->_view->renderizaSistema('pagina2');
        //header('Location: ' . BASE_URL . 'confirmar');
    }
    
    
    public function hoteles()
    {
        Session::acceso('Usuario');
        $this->_view->currentMenu=2;
        $this->_view->titulo='ORISTRAVEL';
        $this->_view->renderizaSistema('hoteles');
    }
    
    public function adminProgramas()
    {
        Session::acceso('Usuario');
        $this->_view->currentMenu=3;
        $this->_view->titulo='ORISTRAVEL';
        $this->_view->renderizaSistema('adminProgramas');
    }
    
    public function imagenes()
    {
        Session::acceso('Usuario');
        $this->_view->currentMenu=5;
        $this->_view->titulo='ORISTRAVEL';
        $this->_view->renderizaSistema('imagenes');
    }
    
    public function consultarBooking($pagina = false)
    {
        Session::acceso('Usuario');
        
        
        $this->_view->CR_fechaDesde=date('d/m/Y');
        if(Session::get('sess_pCR_fechaDesde'))
        {
            $this->_view->CR_fechaDesde=Session::get('sess_pCR_fechaDesde');
        }
        
        $this->_view->CR_fechaHasta=Funciones::sumFecha(date('d/m/Y'), 0, 3);
        if(Session::get('sess_pCR_tipoFecha')==1)
        {
                $this->_view->rdbRes='checked';
        }
        else
        {
                $this->_view->rdbVia='checked';
        }
        
        $booking= $this->loadModel('booking');
      
        $this->_view->getBookings= $booking->getConsRes(
                Funciones::invertirFecha(Session::get('sess_pCR_fechaDesde'), '/', '-'),
                Funciones::invertirFecha(Session::get('sess_pCR_fechaHasta'), '/', '-'),
                Session::get('sess_pCR_tipoFecha'),
                Session::get('sess_id_agencia'),
                Session::getLevel('Admin'),
                Session::get('sess_usuario')
                );
        
        
        
        $pagina= $this->filtrarInt($pagina);
        
        $this->getLibrary('paginador');
        $paginador= new Paginador();
        $paginador->paginar($booking->getConsRes(
                Funciones::invertirFecha(Session::get('sess_pCR_fechaDesde'), '/', '-'),
                Funciones::invertirFecha(Session::get('sess_pCR_fechaHasta'), '/', '-'),
                Session::get('sess_pCR_tipoFecha'),
                Session::get('sess_id_agencia'),
                Session::getLevel('Admin'),
                Session::get('sess_usuario')
                ), $pagina);
        
        
        $this->_view->paginacion = $paginador->getView('prueba', 'sistema/consultarBooking');
        
        $this->_view->currentMenu=1;
        $this->_view->titulo='ORISTRAVEL';
        $this->_view->renderizaSistema('consultarBooking');
    }
    
    
    public function buscarHoteles()
    {
        Session::acceso('Usuario');
        $this->_view->currentMenu=8;
        $this->_view->titulo='ORISTRAVEL';
        $this->_view->renderizaSistema('buscarHoteles');
    }
    
}

?>