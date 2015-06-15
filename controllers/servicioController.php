<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */
class servicioController extends Controller{
   public function __construct() {
       parent::__construct();
       $this->_view->setJs(array('Servicios'));
       $this->_hotel = $this->loadModel('hotel');
        $this->_servicio = $this->loadModel('servicio');
        $this->_programa = $this->loadModel('programa');
        $this->_categoria = $this->loadModel('categoria');
        $this->_ciudad = $this->loadModel('ciudad');
   }
   /**
     * Metodo procesador: Renderiza buscarServicios y sus respectivos comoboBox y tablas, dependiendo del filtro del leftSideBar
     * <PRE> 
     * -.Creado: 11/05/2015 (Jaime Reyes)
     * </PRE>
    
     * @return _view 
     * @author: Jaime Reyes
     */
    public function index() {
      
        Session::acceso('Usuario');
        $this->_view->setJs(array('ajax'));
        
        $this->_view->objCiudadesHotel = $this->_hotel->getCiudadesHot();
        $this->_view->objCiudadesServ = $this->_servicio->getCiudadesServ();
        $this->_view->objCiudadesPRG = $this->_programa->getCiudadesPRG();
        $this->_view->objCategoriaHoteles = $this->_hotel->getCatHoteles();
        
        
        $this->_view->objServicios = $this->_servicio->getServicios();
        
        
        
        $this->_view->mL_expandeFiltrosServ = 'block';
        
        $this->_view->currentMenu = 9;
        $this->_view->titulo = 'ORISTRAVEL';
        
      $this->_view->renderizaSistema('buscarServicios');  
    }
    
    public function servicios(){
     Session::acceso('Usuario');
     $this->_view->currentMenu=12;
     $this->_view->objCiudadesServ = $this->_servicio->getCiudadesServ(); 
     $this->_view->objServicios = $this->_servicio->getServicios();
     
     
     $this->_view->renderizaSistema('adminServicios');  
     
     
    }
}
