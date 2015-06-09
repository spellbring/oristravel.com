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
        $sql = "INSERT INTO `ol_venta` (`id`, `usuario`, `key_`, `tipo_ser`, `num_dias`, `hotel`, `codigo_htl`, `cod_provee`, `cod_servicio`, `cod_programa`, `tipoh`, `c_tipoh`, `pa`, `c_pa`, `fecha_in`, `fecha_out`, `tot_hab`, `pais`, `ciudad`, `tot_pax`, `tot_pax_1`, `tot_child_1`, `edad_child_1_1`, `edad_child_1_2`, `tot_pax_2`, `tot_child_2`, `edad_child_2_1`, `edad_child_2_2`, `tot_pax_3`, `tot_child_3`, `edad_child_3_1`, `edad_child_3_2`, `total_neto`, `total_venta`, `moneda`, `tipo_vta`, `status`, `adultos_a`, `adultos_b`, `adultos_c`, `clave`, `vuelo`, `registro`, `comcts`, `compv`, `comag`, `conv`, `fecha_proceso`) VALUES"

                                        ."(3136, 'ereyes', '".Session::get('sess_key_')."', 'TRF', 0, 'Traslado Acercamiento Hoteles Exc. v.v. Privado', 0, 'SEA', 89, '', '', NULL, '', NULL, '2015-06-05', '0000-00-00', 0, 'CHILE', 'SANTIAGO', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 18, 25.91, 'D', NULL, 'AVAILABLE', 0, 0, 0, '88afdfc1', NULL, NULL, '0.00', '50.87', '30.00', '', '2015-06-02 19:04:15')";
    
        $this->_buscarHoteles->exeSQL($sql);    
    $tmp = Session::get('sess_CarroServicio');
    $tmp1 = Session::get('sess_CarroPrograma');
    $tmp2 = Session::get('sess_CarroHotel');
    $tmp[0][] = date('H:i:s');
    Session::set('sess_CarroServicio',$tmp);
    echo (count($tmp[0])-1)+(count($tmp1[0])-1)+(count($tmp2[0])-1);
    }
     
    public function insertPrograma(){
         $sql = "INSERT INTO `ol_venta` (`id`, `usuario`, `key_`, `tipo_ser`, `num_dias`, `hotel`, `codigo_htl`, `cod_provee`, `cod_servicio`, `cod_programa`, `tipoh`, `c_tipoh`, `pa`, `c_pa`, `fecha_in`, `fecha_out`, `tot_hab`, `pais`, `ciudad`, `tot_pax`, `tot_pax_1`, `tot_child_1`, `edad_child_1_1`, `edad_child_1_2`, `tot_pax_2`, `tot_child_2`, `edad_child_2_1`, `edad_child_2_2`, `tot_pax_3`, `tot_child_3`, `edad_child_3_1`, `edad_child_3_2`, `total_neto`, `total_venta`, `moneda`, `tipo_vta`, `status`, `adultos_a`, `adultos_b`, `adultos_c`, `clave`, `vuelo`, `registro`, `comcts`, `compv`, `comag`, `conv`, `fecha_proceso`) VALUES"

                                       ."(3137, 'ereyes', '".Session::get('sess_key_')."', 'PRG', 0, 'ALTO ATACAMA 03 DIAS/ 02 NOCHES                               ', 10364, '', 0, 'ALTO ATACAMA 2 NTS', '', NULL, '', NULL, '2015-06-05', '2015-06-07', 1, 'CHILE            ', 'SAN PEDRO            ', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1700, 1326, 'D', NULL, 'ON REQUEST  ', 1, 0, 0, '370YD93E', NULL, NULL, '0.00', '0.00', '22.00', '', '2015-06-02 19:08:55'),"

                                       ."(3138, 'ereyes', '".Session::get('sess_key_')."', 'TRF', 1, '- TRASLADO AEROPUERTO / HOTEL                                                   ', 0, 'AAT', 0, 'ALTO ATACAMA 2 NTS', '', '', '', '', '0000-00-00', '0000-00-00', 1, '', '', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'D', NULL, '', 1, 0, 0, 'VF10U7RL', NULL, NULL, '0.00', '0.00', '22.00', '', '2015-06-02 19:08:55'),"

                                       ."(3139, 'ereyes', '".Session::get('sess_key_')."', 'HTL', 2, '- 2 NOCHES EN ALTO ATACAMA HOTEL', 10364, '', 0, 'ALTO ATACAMA 2 NTS', '', 'TIL', '', 'ALL', '2015-06-05', '2015-06-07', 1, '', '', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'D', NULL, 'ON REQUEST  ', 1, 0, 0, 'VF10UN3L', NULL, NULL, '0.00', '0.00', '22.00', '', '2015-06-02 19:08:55'),"

                                       ."(3140, 'ereyes', '".Session::get('sess_key_')."', 'COM', 1, '- PENSION COMPLETA                                                              ', 0, 'AAT', 0, 'ALTO ATACAMA 2 NTS', '', '', '', '', '0000-00-00', '0000-00-00', 1, '', '', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'D', NULL, '', 1, 0, 0, 'VF10V601', NULL, NULL, '0.00', '0.00', '22.00', '', '2015-06-02 19:08:55'),"

                                       ."(3141, 'ereyes', '".Session::get('sess_key_')."', 'EXC', 1, '- EXCURSIONES DIARIAS SEGUN MENU                                                ', 0, 'AAT', 0, 'ALTO ATACAMA 2 NTS', '', '', '', '', '0000-00-00', '0000-00-00', 1, '', '', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'D', NULL, '', 1, 0, 0, 'VF10VXTE', NULL, NULL, '0.00', '0.00', '22.00', '', '2015-06-02 19:08:55'),"

                                       ."(3142, 'ereyes', '".Session::get('sess_key_')."', 'TRF', 1, '- TRASLADO HOTEL / AEROPUERTO EN CALAMA                                         ', 0, 'AAT', 0, 'ALTO ATACAMA 2 NTS', '', '', '', '', '0000-00-00', '0000-00-00', 1, '', '', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'D', NULL, '', 1, 0, 0, 'VF10XI8I', NULL, NULL, '0.00', '0.00', '22.00', '', '2015-06-02 19:08:55');";
         //echo $sql;
                $this->_buscarHoteles->exeSQL($sql);
 
        
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
    public function paso2(){
     if(strtolower($this->getServer('HTTP_X_REQUESTED_WITH')) == 'xmlhttprequest') {
     $arrayFechas = array(0=>'');
     $arrayVuelos = array(0=>'');
         
        for($i=1; $i<=$this->getInt('cantProd'); $i++){
           
                $arrayFechas[] = $this->getTexto('txtFechasCarro_'.$i);
                $arrayVuelos[] = $this->getTexto('txtCarroVuelo_'.$i);
           
        }
        Session::set('sess_arrayFechasCarro',$arrayFechas);
        Session::set('sess_arrayVuelosCarro',$arrayVuelos);
        
        //echo var_dump(Session::get('sess_arrayVuelosCarro'));

     }
    }

     
    
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
    if (strtolower($this->getServer('HTTP_X_REQUESTED_WITH')) == 'xmlhttprequest') {
    
    //$this->_view->carrAdltNombre = $this->getTexto('Carr_txtNombrePas_1_1');
    $objHeader ='';
    $objChild = '';
    
    $arraySesiones = max(array(Session::get('sess_pBP_cntHab'), Session::get('sess_sBP_Hab'), Session::get('sess_pBP_cntHab_P')));
          for($i = 1; $i<=$arraySesiones; $i++){
              $objHeader.='<tr>
                            <th width="100">Habitaci&oacute;n '.$i.'</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>

                        </tr>';
              
              for($j = 1; $j<= Session::get('sess_BP_Adl_'.$i); $j++){
                 $objHeader.='<tr>
                                    <td>Adulto '.$j.'</td>
                                    <td>'.$this->getTexto('Carr_txtNombrePas_'.$i.'_'.$j).'</td> 
                                    <td>'.$this->getTexto('Carr_txtApellidoPas_'.$i.'_'.$j).'</td> 
                                                                       
                              </tr>'; 
                 $this->_view->objNombrePax = $this->getTexto('Carr_txtNombrePas_1_1').' '.$this->getTexto('Carr_txtApellidoPas_1_1');
                      
                 
                  
              }
              
              for($k = 1; $k<= Session::get('sess_BP_Chd_'.$i); $k++){
                  
                  $objHeader .= '<tr>
                                    <td>Children '.$k.'</td>
                                    <td>'.$this->getTexto('Carr_txtNombreCh_'.$i.'_'.$k).'</td> 
                                    <td>'.$this->getTexto('Carr_txtApellidoCh_'.$i.'_'.$k).'</td> 
                                                                       
                              </tr>';    
                  
                  }
     
                
               
                $this->_view->objTextoArea = $this->getTexto('Carr_textAreaNota');
                $this->_view->objPaxCarro = $objHeader;
                
                //$this->_view->objNombrePax  =  $objCarrPax[0]->getNombre();
                //$this->_view->objApellidoPax  =  $objCarrPax[0]->getApellido();
                //$this->_view->objNombreChild = $objCarrPax[0]->getNombreCh();
                //$this->_view->objApellidoChild = $objCarrPax[0]->getApellidoCh();
                
               }

             $this->_view->objCarro = $this->_carro->getAddCarro(Session::get('sess_usuario'));

    $this->_view->renderizaCenterBox('paso3');
    }
    else{
        throw new Exception('Ha ocurrido un error, favor de comincarse con el administrador.');
    }
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
    
    //echo var_dump($tmpH);
    //echo var_dump($tmpP);
    echo $listaH.$listaP.$listaS;
    }
    
    
    

    
    public function mostrarPopUpCarro(){
     $this->_view->objCodCarro = $this->getTexto('post_cod');
     $this->_view->objContCarro = $this->getTexto('post_cont');
     Session::set('sess_cod_progCarro',$this->getTexto('post_codProg'));
     Session::set('sess_cod_servCarro',$this->getTexto('post_serv'));   
     $this->_view->renderizaCenterBox('borraProducto');   
    }
    
    public function borrarProductoCarro($cod, $cont){
        $cod_programa = Session::get('sess_cod_progCarro');
        $serv = Session::get('sess_cod_servCarro');
                if($cod_programa){
                    $sql="DELETE FROM ol_venta WHERE usuario='".$_SESSION['sess_usuario']."' AND key_='".$_SESSION['sess_key_']."' AND cod_programa='".$cod_programa."'  ";
                }
                else{    
                    $sql="DELETE FROM ol_venta WHERE usuario='".$_SESSION['sess_usuario']."' AND key_='".$_SESSION['sess_key_']."' AND id=".$cod;
                }
                echo $sql;
        //$sql = 'DELETE FROM ol_venta WHERE id ='.$cod;
         if($serv == 'PRG'){       
        $tmp = Session::get('sess_CarroPrograma');
                unset($tmp[0][$cont]);   

                $tmp[0] = array_values($tmp[0]);
           
                echo var_dump($tmp);
           Session::set('sess_CarroPrograma', $tmp);
         }
         if($serv == 'HTL'  &&  $cod_programa == ''){       
        $tmp1 = Session::get('sess_CarroHotel');
                unset($tmp1[0][$cont]);   

                $tmp1[0] = array_values($tmp1[0]);
           
                echo var_dump($tmp1);
           Session::set('sess_CarroHotel', $tmp1);
         }
        if($serv != 'HTL' && $serv != 'PRG' && $cod_programa == ''){       
        $tmp2 = Session::get('sess_CarroServicio');
                unset($tmp2[0][$cont]);   

                $tmp2[0] = array_values($tmp2[0]);
           
                echo var_dump($tmp2);
           Session::set('sess_CarroServicio', $tmp2);
         }

        if($this->_buscarHoteles->exeSQL($sql)){      
               echo "OK";
        }
        else{
            throw new Exception("Error inesperado, póngase en contacto con el administrador");
        }
    
    }     
}

