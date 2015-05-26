<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class bookingController extends Controller{
    public function __construct(){
        parent::__construct();
        $this->_view->setJs(array('Booking'));
        $this->_hotel = $this->loadModel('hotel');
        $this->_servicio = $this->loadModel('servicio');
        $this->_programa = $this->loadModel('programa');       
        $this->_booking = $this->loadModel('booking');
      
    }
    
    public function index() {
        
    }
    ############################ bookingController #############################  
     /**
     * Metodo procesador: Carga todos los ComboBox para el proceso de administracion de hoteles
     * <PRE>
     * -.Creado: 28/07/2014
     * -.Modificado: 10/04/2015 (Jaime Reyes)
     * -.Modificado: 20/05/2015 (Jaime Reyes)
     * </PRE>
    
     * @return _view devuelve todos los hoteles segun el filtro que se elija
     * @author: Jonathan Estay
     */
    
    public function consultarBooking($pagina = false) {
        Session::acceso('Usuario');

        $this->_view->objCiudadesHotel = $this->_hotel->getCiudadesHot();
        $this->_view->objCiudadesServ = $this->_servicio->getCiudadesServ();
        $this->_view->objCiudadesPRG = $this->_programa->getCiudadesPRG();


        $this->_view->CR_fechaDesde = date('d/m/Y');
        if (Session::get('sess_pCR_fechaDesde')) {
            $this->_view->CR_fechaDesde = Session::get('sess_pCR_fechaDesde');
        }


        $this->_view->rdbRes = false;
        $this->_view->rdbVia = false;
        $this->_view->CR_fechaHasta = Funciones::sumFecha(date('d/m/Y'), 0, 3);
        if (Session::get('sess_pCR_tipoFecha') == 1) {
            $this->_view->rdbRes = 'checked';
        } else {
            $this->_view->rdbVia = 'checked';
        }
        $this->_view->getBookings = $this->_booking->getConsRes(
                Funciones::invertirFecha(Session::get('sess_pCR_fechaDesde'), '/', '-'), Funciones::invertirFecha(Session::get('sess_pCR_fechaHasta'), '/', '-'), Session::get('sess_pCR_tipoFecha'), Session::get('sess_id_agencia'), Session::getLevel('Admin'), Session::get('sess_usuario')
        );



        /* BEIGN: Paginador; */
        $pagina = $this->filtrarInt($pagina);
        $this->getLibrary('paginador');
        $paginador = new Paginador();
        /* $this->_view->getBookings=$paginador->paginar($booking->getConsRes(
          Funciones::invertirFecha(Session::get('sess_pCR_fechaDesde'), '/', '-'),
          Funciones::invertirFecha(Session::get('sess_pCR_fechaHasta'), '/', '-'),
          Session::get('sess_pCR_tipoFecha'),
          Session::get('sess_id_agencia'),
          Session::getLevel('Admin'),
          Session::get('sess_usuario')
          ), $pagina); */
        $this->_view->paginacion = $paginador->getView('prueba', 'booking/consultarBooking');
        /* END: Paginador; */



        $this->_view->currentMenu = 1;
        $this->_view->titulo = 'ORISTRAVEL';
        $this->_view->renderizaSistema('consultarBooking');
    }
      /**
     * Metodo procesador: Renderiza el proceso de booking, poblando en una tabla todos los datos traidos de la base de datos
     * <PRE>
     * -.Creado: 04/05/2015
     * </PRE>
    
     * @return _view
     * @author: Jaime Reyes
     */
    public function reservaBooking(){
    Session::acceso('Usuario');
    
    $objBooking = $this->_booking->getBooking($this->getTexto('n_file'));
    if($objBooking){
    $this->_view->BK_Id = $objBooking[0]->getId();
    $this->_view->BK_Agencia = $objBooking[0]->getAgencia();
    $this->_view->BK_NomPax = $objBooking[0]->getNomPax();
    $this->_view->BK_Fecha_Anul = $objBooking[0]->getFecha_Anul();
    $this->_view->BK_NombreUser = $objBooking[0]->getNombreUser();
    $this->_view->BK_ApellidoUser = $objBooking[0]->getApellidoUser();
    $this->_view->BK_FechaIn = $objBooking[0]->getFechaIn();
    $this->_view->BK_Total = $objBooking[0]->getTotal();
    $this->_view->BK_Registro = $objBooking[0]->getRegistro();
    $this->_view->BK_moneda  = $objBooking[0]->getMoneda();
    }
    else {
                throw new Exception('Error al desplegar la Reserva');
         }
    $this->_view->ObjDbk = $this->_booking->getDbooking($this->getTexto('n_file'));
    $this->_view->ObjPbk = $this->_booking->getPbooking($this->getTexto('n_file'));
    
    $objHabPbk = $this->_booking->getPbooking($this->getTexto('n_file'));
    if($objHabPbk){
    $this->_view->PBK_nhab = $objHabPbk[0]->getNhab();   
        
    }
    else {
                throw new Exception('Error al desplegar la Reserva');
         }
    
    $this->_view->renderizaCenterBox('reservaBooking');   

    
    }
 /**
     * Metodo procesador: Genera un excel de los registros llenados en el proceso de booking.
     * <PRE>  
     * -.Creado: 06/05/2015 (Jaime Reyes)
     * </PRE>
    
     * @return String devuelve el detalle de todas las reservas encontradas y genera un excel.
     * @author: Jonathan Estay
     */
    public function crearExcel(){
    header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");  
    header ("Cache-Control: no-cache, must-revalidate");  
    header ("Pragma: no-cache");  
    header ("Content-type: application/vnd.ms-excel");
    header ("Content-Disposition: attachment; filename=\"NengocioOris.csv\"" );
    
    $objBooking = $this->_booking->getConsRes(
                Funciones::invertirFecha(Session::get('sess_pCR_fechaDesde'), '/', '-'), Funciones::invertirFecha(Session::get('sess_pCR_fechaHasta'), '/', '-'), Session::get('sess_pCR_tipoFecha'), Session::get('sess_id_agencia'), Session::getLevel('Admin'), Session::get('sess_usuario')
        );
      echo "Negocio; Estado; Fecha; Fecha In; Nombre Cliente; Vendedor; Nombre Pasajero; Moneda; Total; \n";      
        foreach($objBooking as $objb){
          
                echo  $objb->getId().";"
                    . $objb->getEstado().";"
                    . $objb->getFecha().";"
                    . $objb->getFechaIn().";"
                    . $objb->getAgencia().";"
                    . $objb->getNombreUser().$objb->getApellidoUser().";"
                    . $objb->getNomPax().";"
                    . $objb->getMoneda().";"
                    . round($objb->getTotal()).";"; 
                echo "\n";
        }             
        
    }
      /**
     * Metodo procesador: Genera un excel con detalle de los registros llenados en el proceso de booking.
     * <PRE>  
     * -.Creado: 06/05/2015 (Jaime Reyes)
     * </PRE>
    
     * @return String devuelve el detalle de todas las reservas encontradas y genera un excel.
     * @author: Jonathan Estay
     */
    public function crearExcelDet(){
    header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");  
    header ("Cache-Control: no-cache, must-revalidate");  
    header ("Pragma: no-cache");  
    header ("Content-type: application/vnd.ms-excel");
    header ("Content-Disposition: attachment; filename=\"NegocioOrisDetalle.csv\"" );
    
    $objBooking = $this->_booking->getConsRes(
                Funciones::invertirFecha(Session::get('sess_pCR_fechaDesde'), '/', '-'), Funciones::invertirFecha(Session::get('sess_pCR_fechaHasta'), '/', '-'), Session::get('sess_pCR_tipoFecha'), Session::get('sess_id_agencia'), Session::getLevel('Admin'), Session::get('sess_usuario')
        );

      //echo "Negocio; Estado; Fecha; Fecha In; Nombre Cliente; Vendedor; Nombre Pasajero; Moneda; Total; \n\n"; 
        foreach($objBooking as $objb){
          echo "Negocio; Estado; Fecha; Fecha In; Nombre Cliente; Vendedor; Nombre Pasajero; Moneda; Total; \n";   
                echo  $objb->getId().";"
                    . $objb->getEstado().";"
                    . $objb->getFecha().";"
                    . $objb->getFechaIn().";"
                    . $objb->getAgencia().";"
                    . $objb->getNombreUser().$objb->getApellidoUser().";"
                    . $objb->getNomPax().";"
                    . $objb->getMoneda().";"
                    . round($objb->getTotal()).";"; 
                echo "\n\n";
                
               $objDBooking = $this->_booking->getDBooking($objb->getId());
               echo ";Status; Hotel; Habitación; P.A.; N°Hab; Adultos; Childs; Ciudad; Fecha In; Fecha Out; Total Venta;\n";
             foreach($objDBooking as $objdb){
               echo ";".$objdb->getEstado().";"
                       .$objdb->getHotel().";"
                       .$objdb->getTipoh().";"
                       .$objdb->getAgencia().";"
                       .$objdb->getPa().";"
                       .$objdb->getTot_hab().";"
                       .$objdb->getTot_pax().";"
                       .$objdb->getTot_child1().";"
                       .$objdb->getCiudad().";"
                       .$objdb->getFechaIn().";"
                       .$objdb->getFecha_out().";"
                       .round($objdb->getTotal_venta()).";";
                       echo "\n";                      
             }
              echo "\n";
             }   
        }

     
         public function anularBooking() {
        Session::acceso('Usuario');

        $this->_view->objCiudadesHotel = $this->_hotel->getCiudadesHot();
        $this->_view->objCiudadesServ = $this->_servicio->getCiudadesServ();
        $this->_view->objCiudadesPRG = $this->_programa->getCiudadesPRG();
        
        
        $this->_view->CR_fechaDesde = date('d/m/Y');
        if (Session::get('sess_pCR_fechaDesde')) {
            $this->_view->CR_fechaDesde = Session::get('sess_pCR_fechaDesde');
        }

        $this->_view->rdbRes = false;
        $this->_view->rdbVia = false;
        $this->_view->CR_fechaHasta = Funciones::sumFecha(date('d/m/Y'), 0, 3);
        if (Session::get('sess_pCR_tipoFecha') == 1) {
            $this->_view->rdbRes = 'checked';
        } else {
            $this->_view->rdbVia = 'checked';
        }

        $booking = $this->loadModel('booking');

        $this->_view->getBookings = $booking->getConsRes(
                Funciones::invertirFecha(Session::get('sess_pCR_fechaDesde'), '/', '-'), Funciones::invertirFecha(Session::get('sess_pCR_fechaHasta'), '/', '-'), Session::get('sess_pCR_tipoFecha'), Session::get('sess_id_agencia'), Session::getLevel('Admin'), Session::get('sess_usuario')
        );



        /* BEIGN: Paginador; */
        $pagina = 0;
        $pagina = $this->filtrarInt($pagina);
        $this->getLibrary('paginador');
        $paginador = new Paginador();
        /* $this->_view->getBookings=$paginador->paginar($booking->getConsRes(
          Funciones::invertirFecha(Session::get('sess_pCR_fechaDesde'), '/', '-'),
          Funciones::invertirFecha(Session::get('sess_pCR_fechaHasta'), '/', '-'),
          Session::get('sess_pCR_tipoFecha'),
          Session::get('sess_id_agencia'),
          Session::getLevel('Admin'),
          Session::get('sess_usuario')
          ), $pagina); */
        $this->_view->paginacion = $paginador->getView('prueba', 'booking/consultarBooking');
        /* END: Paginador; */



        $this->_view->currentMenu = 6;
        $this->_view->titulo = 'ORISTRAVEL';
        $this->_view->renderizaSistema('anularBooking');
    }
    
    /**
     * Metodo procesador: Carga todos los ComboBox para el proceso de administracion de hoteles
     * <PRE>
     * -.Creado: 28/07/2014
     * -.Modificado: 10/04/2015 (Jaime Reyes)
     * -.Modificado: 20/05/2015 (Jaime Reyes)
     * </PRE>
    
     * @return _view devuelve todos los hoteles segun el filtro que se elija
     * @author: Jonathan Estay
     */
    public function generaVoucherPdf($id){
    Session::acceso('Usuario');
    $this->getLibrary('fpdf');
    $pdfVou = new FPDF();
    $pdfVou->AddPage();
    $pdfVou->SetFont('Arial','B','11');
    $pdfVou->Cell(40,10,'Hola');
    $pdfVou->Output();   
    }
    
    
}

