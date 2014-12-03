<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class sistemaController extends Controller
{
    private $_pdf;
    
    public function __construct() {
        parent::__construct();
        $this->_hotel= $this->loadModel('hotel');
        $this->_servicio= $this->loadModel('servicio');
        $this->_programa= $this->loadModel('programa');
    }
    
    public function index() {
        Session::acceso('Usuario');

        $this->_view->objCiudadesHotel = $this->_hotel->getCiudadesHot();
        $this->_view->objCiudadesServ = $this->_servicio->getCiudadesServ();
        $this->_view->objCiudadesPRG = $this->_programa->getCiudadesPRG();

        $this->_view->setJs(array('ajax'));

        //if(Session::get('sess_pBP_ciudadDes'))
        //{
        $this->_view->mL_expandeFiltros = 'block';
        /* }
          else
          {
          $this->_view->mL_expandeFiltros='none';
          } */


        //$this->_view->assign('titulo', 'ORISTRAVEL'); SMARTY
        $this->_view->currentMenu=false;
        $this->_view->titulo = 'ORISTRAVEL';
        $this->_view->renderizaSistema('index');
    }

    public function pagina2()
    {
        Session::acceso('Especial');
        //$servicios= $this->loadModel('servicios');
        //$this->_view->servicios= $servicios->getServicios();
        
        $imagen='';
        if(isset($_FILES['imagen']['name']))
        {
            $this->getLibrary('upload' . DS . 'class.upload');
            $rutaImg= ROOT . 'public' . DS . 'img' . DS .'hoteles' . DS;
            $upload= new upload($_FILES['imagen'], 'es_ES');
            $upload->allowed= array('image/jpg', 'image/png', 'image/gif');
            $upload->file_new_name_body= 'upl_' . uniqid();
            $upload->process($rutaImg);
            
            if($upload->processed)
            {
                $imagen= $upload->file_dst_name; //nombre de la imagen
                $thumb= new upload($upload->file_dst_pathname);
                $thumb->image_resize= true;
                $thumb->image_x= 100;
                $thumb->image_y= 100;
                $thumb->file_name_body_pre= 'thumb_';
                $thumb->process($rutaImg . 'thumb' . DS);
            }
            else
            {
                $this->_view->errorImg= $upload->error;
            }
        }
        
        $this->_view->titulo='ORISTRAVEL';
        $this->_view->renderizaSistema('pagina2');
        //header('Location: ' . BASE_URL . 'confirmar');
    }
    
    
    
    
    
    public function hoteles()
    {
        Session::acceso('Usuario');
        $hotel= $this->loadModel('hotel');

        
        $this->_view->setJs(array('ajax'));
        
        $this->_view->objCategoriaHoteles= $this->_hotel->getCatHoteles();
        $this->_view->objCiudadesHotel= $this->_hotel->getCiudadesHot();
        $this->_view->objCiudadesServ= $this->_servicio->getCiudadesServ();
        $this->_view->objCiudadesPRG= $this->_programa->getCiudadesPRG();
        
        
        $this->_view->getHoteles= $hotel->getAdmHoteles(
                Session::get('sess_pCH_ciudad'), 
                Session::get('sess_pCH_nombre'), 
                Session::get('sess_pCH_cat') 
                );
                
        $this->_view->currentMenu=2;
        $this->_view->titulo='ORISTRAVEL';
        $this->_view->renderizaSistema('hoteles');
    }
    
    public function editHotel()
    {
        Session::acceso('Usuario');
        $this->_view->renderizaCenterBox('editHotel');
    }
    
    
    
    public function adminProgramas()
    {
        Session::acceso('Usuario');
        
        $this->_view->objCiudadesHotel= $this->_hotel->getCiudadesHot();
        $this->_view->objCiudadesServ= $this->_servicio->getCiudadesServ();
        $this->_view->objCiudadesPRG= $this->_programa->getCiudadesPRG();
        
        $this->_view->currentMenu=3;
        $this->_view->titulo='ORISTRAVEL';
        $this->_view->renderizaSistema('adminProgramas');
    }
    
    public function imagenes()
    {
        Session::acceso('Usuario');
        
        $this->_view->objCiudadesHotel= $this->_hotel->getCiudadesHot();
        $this->_view->objCiudadesServ= $this->_servicio->getCiudadesServ();
        $this->_view->objCiudadesPRG= $this->_programa->getCiudadesPRG();
        
        $this->_view->currentMenu=5;
        $this->_view->titulo='ORISTRAVEL';
        $this->_view->renderizaSistema('imagenes');
    }
    
    
    
    
    
    
    
    public function consultarBooking($pagina = false)
    {
        Session::acceso('Usuario');
        
        $this->_view->objCiudadesHotel= $this->_hotel->getCiudadesHot();
        $this->_view->objCiudadesServ= $this->_servicio->getCiudadesServ();
        $this->_view->objCiudadesPRG= $this->_programa->getCiudadesPRG();
        
        
        $this->_view->CR_fechaDesde=date('d/m/Y');
        if(Session::get('sess_pCR_fechaDesde'))
        {
            $this->_view->CR_fechaDesde=Session::get('sess_pCR_fechaDesde');
        }
        
        
        $this->_view->rdbRes=false;
        $this->_view->rdbVia=false;
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
        
        
        
        /*BEIGN: Paginador; */
        $pagina= $this->filtrarInt($pagina);
        $this->getLibrary('paginador');
        $paginador= new Paginador();
        /*$this->_view->getBookings=$paginador->paginar($booking->getConsRes(
                Funciones::invertirFecha(Session::get('sess_pCR_fechaDesde'), '/', '-'),
                Funciones::invertirFecha(Session::get('sess_pCR_fechaHasta'), '/', '-'),
                Session::get('sess_pCR_tipoFecha'),
                Session::get('sess_id_agencia'),
                Session::getLevel('Admin'),
                Session::get('sess_usuario')
                ), $pagina);*/
        $this->_view->paginacion = $paginador->getView('prueba', 'sistema/consultarBooking');
        /*END: Paginador;*/
        
        
        
        $this->_view->currentMenu=1;
        $this->_view->titulo='ORISTRAVEL';
        $this->_view->renderizaSistema('consultarBooking');
    }
    
    public function verPDF($id = false)
    {
        Session::acceso('Usuario');
        
        $this->getLibrary('fpdf');
        //$this->_pdf= new FPDF();
        
        $this->getLibrary('pdf_html');
        $pdf= new PDF('P', 'mm','letter');
        
        $ruta_img= ROOT . 'public' . DS . 'img' . DS;
        require_once ROOT . 'views' . DS . 'sistema' . DS . 'pdf' . DS . 'voucherPDF.php';
        
        
        //$this->_pdf->AddPage();
        //$this->_pdf->SetFont('Arial','B',16);
        //$this->_pdf->Cell(40,10, utf8_decode('¡Hola, Mundo!'));
        //$this->_pdf->Cell(40,10,'¡Hola, Mundo!');
        //$this->_pdf->Output();
    }
    
    
    
    
    
    
    public function anularBooking()
    {
        Session::acceso('Usuario');
        
        $this->_view->objCiudadesHotel= $this->_hotel->getCiudadesHot();
        $this->_view->objCiudadesServ= $this->_servicio->getCiudadesServ();
        $this->_view->objCiudadesPRG= $this->_programa->getCiudadesPRG();
        
        
        $this->_view->CR_fechaDesde=date('d/m/Y');
        if(Session::get('sess_pCR_fechaDesde'))
        {
            $this->_view->CR_fechaDesde=Session::get('sess_pCR_fechaDesde');
        }
        
        $this->_view->rdbRes=false;
        $this->_view->rdbVia=false;
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
        
        
        
        /*BEIGN: Paginador; */
        $pagina=0;
        $pagina= $this->filtrarInt($pagina);
        $this->getLibrary('paginador');
        $paginador= new Paginador();
        /*$this->_view->getBookings=$paginador->paginar($booking->getConsRes(
                Funciones::invertirFecha(Session::get('sess_pCR_fechaDesde'), '/', '-'),
                Funciones::invertirFecha(Session::get('sess_pCR_fechaHasta'), '/', '-'),
                Session::get('sess_pCR_tipoFecha'),
                Session::get('sess_id_agencia'),
                Session::getLevel('Admin'),
                Session::get('sess_usuario')
                ), $pagina);*/
        $this->_view->paginacion = $paginador->getView('prueba', 'sistema/consultarBooking');
        /*END: Paginador;*/
        
        
        
        $this->_view->currentMenu=6;
        $this->_view->titulo='ORISTRAVEL';
        $this->_view->renderizaSistema('anularBooking');
    }
    
    
    
    
    public function carro() {
        Session::acceso('Usuario');

        $this->_view->titulo = 'ORISTRAVEL';
        $this->_view->renderizaSistema('carro');
    }

    public function contactenos() {
        Session::acceso('Usuario');

        $this->_view->currentMenu = 7;
        $this->_view->titulo = 'ORISTRAVEL';
        $this->_view->renderizaSistema('contactenos');
    }

    public function usuarios() {
        Session::acceso('Usuario');

        $this->_view->currentMenu = 4;
        $this->_view->titulo = 'ORISTRAVEL';
        $this->_view->renderizaSistema('usuarios');
    }

    public function buscarHoteles()
    {
        Session::acceso('Usuario');
        
        
        /*BEIGN: Paginador; */
        $pagina=0;
        $pagina= $this->filtrarInt($pagina);
        $this->getLibrary('paginador');
        $paginador= new Paginador();
        /*$this->_view->getHoteles=$paginador->paginar($hoteles->getHoteles(), $pagina);*/
        //$this->_view->paginacion = $paginador->getView('prueba', 'sistema/buscarHoteles');
        /*END: Paginador;*/
        
        
        $this->_view->currentMenu=8;
        $this->_view->titulo='ORISTRAVEL';
        $this->_view->renderizaSistema('buscarHoteles');
    }
    
    
    
    
    
    /*******************************************************************************
    *                                                                              *
    *                             METODOS PROCESADORES                             *
    *                                                                              *
    *******************************************************************************/
    
    public function salir() {
        Session::destroy();
        header('Location: ' . BASE_URL . 'login?ex');
        exit;
        /*
         * Session::destroy();
         * Session::destroy('sess_nombreUser');
         * Session::destroy(array('sess_nombreUser', 'otra'));
         */
    }

}

?>