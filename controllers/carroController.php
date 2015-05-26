<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class carroController extends Controller{
    public function __construct() {
        parent::__construct();
         $this->_carro = $this->loadModel('carro');
    }
    public function index(){
        
    }
      /**
     * Metodo procesador: Renderiza carro.phtml con las reservas agregadas al carro.
     * <PRE>
     * -.Creado: 06/05/2015 (Jaime Reyes)
    
     * </PRE>
    
     * @return _view 
     * @author: Jaime Reyes
     */
    
    public function carroCompra() {
        Session::acceso('Usuario');
        
        $this->_view->currentMenu = false;
        $this->_view->titulo = 'ORISTRAVEL';
        
        $this->_view->objCarro = $this->_carro->getAddCarro(Session::get('sess_usuario'));
        
        $this->_view->renderizaSistema('carro');       
    }              


   
################################ fin usuarioController###########################  
 

     
    
     /**
     * Metodo procesador: Permite cargar el paso 3 del proceso del carro de compra.
     * <PRE>
     * -.Creado: 12/05/2014 (Jaime Reyes)
   
     * </PRE>
    
     * @return _view 
     * @author: Jaime Reyes
     */
    public function paso3(){
    Session::acceso('Usuario');
    //if (strtolower($this->getServer('HTTP_X_REQUESTED_WITH')) == 'xmlhttprequest') {
    //$this->_view->carrAdltNombre = $this->getTexto('Carr_txtNombrePas_1_1');
    $objCarrPax = array();
            if(Session::get('sess_pBP_cntHab')){
                for($i = 1; $i<=Session::get('sess_pBP_cntHab'); $i++){


                        if(Session::get('sess_BP_Adl_'.$i)){
                               for($j = 1; $j <= Session::get('sess_BP_Adl_'.$i); $j++){
                                    $objCarroPax = new carroDTO();
                                    
                                    $objCarroPax->setHabitacion($i);
                                    if($this->getTexto('Carr_txtNombrePas_'.$i.'_'.$j)!="" & $this->getTexto('Carr_txtApellidoPas_'.$i.'_'.$j)!=""){
                                    $objCarroPax->setNombre($this->getTexto('Carr_txtNombrePas_'.$i.'_'.$j)); //$this->getTexto('Carr_txtNombrePas_'.$i.'_'.$j);                              
                                    $objCarroPax->setApellido($this->getTexto('Carr_txtApellidoPas_'.$i.'_'.$j)); //$this->getTexto('Carr_txtApellidoPas_'.$i.'_'.$j);   
                                     
                                    $objCarrPax[] = $objCarroPax;
                                   }
                                   else{
 
                                       throw new Exception("Error") ;          
                                      
                                   }
                                    
                                }
                                 
                        }
                }
                
               
                $this->_view->objTextoArea = $this->getTexto('Carr_textAreaNota');
                $this->_view->objPaxCarro = $objCarrPax;
               
                $this->_view->objNombrePax  =  $objCarrPax[0]->getNombre();
                $this->_view->objApellidoPax  =  $objCarrPax[0]->getApellido();
                
               }

             $this->_view->objCarro = $this->_carro->getAddCarro(Session::get('sess_usuario'));

    $this->_view->renderizaCenterBox('paso3');
     
    }
    
    
    
}

