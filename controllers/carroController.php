<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class carroController extends Controller{
    public function __construct() {
        parent::__construct();
         $this->_view->setJs(array('Carro'));   
         $this->_carro = $this->loadModel('carro');
         $this->_hotel = $this->loadModel('hotel');
         $this->_programa = $this->loadModel('programa');
         $this->_servicio = $this->loadModel('servicio');
         $this->_buscarHoteles = $this->loadModel('buscarHoteles');
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
        $this->_view->objCiudadesHotel = $this->_hotel->getCiudadesHot();
        $this->_view->objCiudadesServ = $this->_servicio->getCiudadesServ();
        $this->_view->objCiudadesPRG = $this->_programa->getCiudadesPRG();
        $this->_view->objCategoriaHoteles = $this->_hotel->getCatHoteles();
        
        $this->_view->objServicios = $this->_servicio->getServicios();
        
        $this->_view->renderizaSistema('carro');       
    }    
    public function contenido() {
       
    }
    
    public function mostrarCantidad() {
        count(Session::get('sess_carroHotel'));
        count(Session::get('sess_carroServicios'));
        count(Session::get('sess_carroProgramas'));
        
        echo $suma;
    }
    
    public function insertServicio(){
    $tmp = Session::get('sess_CarroServicio');
    $tmp1 = Session::get('sess_CarroPrograma');
    $tmp2 = Session::get('sess_CarroHotel');
    $tmp[0][] = date('H:i:s');
    Session::set('sess_CarroServicio',$tmp);
    echo (count($tmp[0])-1)+(count($tmp1[0])-1)+(count($tmp2[0])-1);
    }
     
    public function insertPrograma(){
 
        
     $tmp = Session::get('sess_CarroPrograma');
     $tmp1 = Session::get('sess_CarroHotel');
     $tmp2 = Session::get('sess_CarroServicio');
     
              $tmp[0][] = date('H:i:s');
              Session::set('sess_CarroPrograma',$tmp);
              echo (count($tmp[0])-1)+(count($tmp1[0])-1)+(count($tmp2[0])-1);   
    }
    public function insertHotel(){
        $id=$this->getTexto('BH_codHotel');
        $tipoh=$this->getTexto('BH_tipoh');
        $palimt= $this->getTexto('BH_palimt');
        $precioF=$this->getTexto('BH_precioFinal');
        $objGetHoteles = $this->_buscarHoteles->getHoteles();
        if($objGetHoteles){
        foreach($objGetHoteles as $objChoteles){
            foreach($objChoteles->getHotel() as $objHotel ){
            if($id==$objChoteles->getCodigoHtl() && $tipoh==$objChoteles->getTipoh() && $palimt==$objChoteles->getPalimt()  && $precioF==$objChoteles->getPrecioFinal()){
            
              $sql = "INSERT INTO ol_venta(usuario, "
                                        . "key_, "
                                        . "tipo_ser, "
                                        . "num_dias, "
                                        . "hotel, "
                                        . "codigo_htl,"
                                        . "cod_provee,"
                                        . "cod_servicio,"
                                        . "cod_programa,"
                                        . "tipoh,"
                                        . "c_tipoh,"    
                                        . "pa,"
                                        . "c_pa,"
                                        . "fecha_in,"
                                        . "fecha_out,"
                                        . "tot_hab,"
                                        . "pais,"
                                        . "ciudad,"
                                        . "tot_pax,"
                                        . "tot_pax_1,"
                                        . "tot_child_1,"
                                        . "edad_child_1_1,"
                                        . "edad_child_1_2,"
                                        . "tot_pax_2,"
                                        . "tot_child_2,"
                                        . "edad_child_2_1,"
                                        . "edad_child_2_2,"
                                        . "tot_pax_3,"
                                        . "tot_child_3,"
                                        . "edad_child_3_1,"
                                        . "edad_child_3_2,"
                                        . "total_neto,"
                                        . "total_venta,"
                                        . "moneda,"
                                        . "tipo_vta,"
                                        . "status,"
                                        . "adultos_a,"
                                        . "adultos_b,"
                                        . "adultos_c,"
                                        . "clave,"
                                        . "vuelo,"
                                        . "registro,"
                                        . "comcts,"
                                        . "compv,"
                                        . "comag,"
                                        . "conv,"
                                        . "fecha_proceso)"
                      
                . "VALUES('".Session::get('sess_usuario')."',"
                                        . "'".Session::get('sess_key_')."',"
                                        . "'HTL',"
                                        . "'".$objChoteles->getNumDias()."',"
                                        . "'".$objHotel->getNombre()."',"
                                        . "'".$objChoteles->getCodigoHtl()."',"
                                        . "'".Session::get('sess_agencia')."',"
                                        . "'',"//servicio
                                        . "'',"//programa
                                        . "'".$objChoteles->getTipoh()."',"//este es el completo, pero no se de que tabla sacarlo
                                        . "'".$objChoteles->getTipoh()."',"
                                        . "'".$objChoteles->getPalimt()."',"
                                        . "'',"
                                        . "'".Funciones::invertirFecha(Session::get('sess_pBP_FechaIn'), '/','-')."',"
                                        . "'".Funciones::invertirFecha(Session::get('sess_pBP_FechaOut'), '/','-')."',"
                                        . "'".Session::get('sess_pBP_cntHab')."',"
                                        . "'".$objHotel->getPais()."',"
                                        . "'".$objHotel->getCiudad()."',"
                                        . "'".$objChoteles->getTotPax()."',"
                                        . "'',"
                                        . "'',"
                                        . "'',"
                                        . "'',"
                                        . "'',"
                                        . "'',"
                                        . "'',"
                                        . "'',"
                                        . "'',"
                                        . "'',"
                                        . "'',"
                                        . "'',"
                                        . "'".$objChoteles->getTotalNeto()."',"
                                        . "'".$objChoteles->getTotalVenta()."',"
                                        . "'".$objChoteles->getMoneda()."',"
                                        . "'',"//tipo venta
                                        . "'".$objChoteles->getStatus()."',"
                                        . "'',"//adultos_a
                                        . "'',"//adultos_b
                                        . "'',"//adultos_c
                                        . "'',"//clave
                                        . "'',"//vuelo
                                        . "'',"//registro
                                        . "'',"//comcts
                                        . "'',"//compv
                                        . "'',"//compg
                                        . "'',"//conv
                                        . "'')";//fechaproceso.
                                        
              //echo $sql;
              
              $this->_buscarHoteles->exeSQL($sql);
              $tmp = Session::get('sess_CarroHotel');
              $tmp1 = Session::get('sess_CarroPrograma');
              $tmp2 = Session::get('sess_CarroServicio');
              $tmp[0][] = date('H:i:s');
              Session::set('sess_CarroHotel',$tmp);
              echo (count($tmp[0])-1)+(count($tmp1[0])-1)+(count($tmp2[0])-1);
            }       
            
            }
        }
        }
        else{
          throw new Exception('Error inesperado, intente nuevamente. Si el error persiste comuniquese con el administrador.');  
            
        }     
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
    
    public function seccionCarro(){
        $tmpH = Session::get('sess_CarroHotel');
        $cantTmpH = (count($tmpH[0])-1);
        
        $tmpP = Session::get('sess_CarroPrograma');
        $cantTmpP = (count($tmpP[0])-1);
        
        $tmpS = Session::get('sess_CarroServicio');
        $cantTmpS = (count($tmpS[0])-1);
        $contCarro=0;
        $listaH = '';
        $listaP = '';
        $listaS = '';
        
        if($cantTmpH > 0) {
           foreach($tmpH[0] as $objCarroHot =>$hora){
               if($hora) {
                   //$contCarro++;
                    $listaH .= "<li>"
                                 ."<a href='#' class='notification-failure'>"
                                 ."<span class='time'>".$hora."</span>"
                                     ."<i>H&nbsp;</i>" 
                                 ."<span class='msg'>Hotel</span>"
                                 ."</a>"
                             ."</li>";
               }
               
           }
        }
        if($cantTmpP > 0){
           foreach($tmpP[0] as $objCarroProg =>$hora){
               if($hora) {
                   //$contCarro++;
                    $listaP .= "<li>"
                                 ."<a href='#' class='notification-order'>"
                                 ."<span class='time'>".$hora."</span>"
                                     ."<i>P&nbsp;</i>" 
                                 ."<span class='msg'>Programa</span>"
                                 ."</a>"
                             ."</li>";
               }
               
           }
        }
           if($cantTmpS > 0){
           foreach($tmpS[0] as $objCarroServ =>$hora){
               if($hora) {
                   //$contCarro++;
                    $listaS .= "<li>"
                                 ."<a href='#' class='notification-warning'>"
                                 ."<span class='time'>".$hora."</span>"
                                     ."<i>S&nbsp;</i>" 
                                 ."<span class='msg'>Servicio</span>"
                                 ."</a>"
                             ."</li>";
               }
               
           }
         
         
          
    }
    echo $listaH.$listaP.$listaS;
    }
    
    
    

    
    public function mostrarPopUpCarro(){
     $this->_view->objCodCarro = $this->getTexto('post_cod');
     $this->_view->objContCarro = $this->getTexto('post_cont');
     $this->_view->renderizaCenterBox('borraProducto');   
    }
    
    public function borrarProductoCarro($cod, $cont, $cod_programa){
                if($cod_programa){
                    $sql="DELETE FROM ol_venta WHERE usuario='".$_SESSION['sess_usuario']."' AND key_='".$_SESSION['sess_key_']."' AND cod_programa='".$cod_programa."'  ";
                }
                else{    
                    $sql="DELETE FROM ol_venta WHERE usuario='".$_SESSION['sess_usuario']."' AND key_='".$_SESSION['sess_key_']."' AND id=".$cod;
                }
        //$sql = 'DELETE FROM ol_venta WHERE id ='.$cod;
        $tmp = Session::get('sess_CarroHotel');
                unset($tmp[0][$cont]);   

                $tmp[0] = array_values($tmp[0]);
           
                echo var_dump($tmp);
           Session::set('sess_CarroHotel', $tmp);
        if($this->_buscarHoteles->exeSQL($sql)){      
               echo "OK";
        }
        else{
            throw new Exception("Error inesperado, póngase en contacto con el administrador");
        }
    
    }     
}

