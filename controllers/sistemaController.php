<?php

/*
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class sistemaController extends Controller {

    private $_pdf;

    public function __construct() {
        parent::__construct();
        $this->_hotel = $this->loadModel('hotel');
        $this->_servicio = $this->loadModel('servicio');
        $this->_programa = $this->loadModel('programa');
        
    }
    
     /**
     * Metodo procesador: Renderiza index.phtml
     * <PRE>
     * -.Creado: 28/07/2014
     * -.Modificado: 20/05/2015 (Jaime Reyes) 
     * </PRE> 
     * @return _view Retorna la pagina principal
     * @author: Jonathan Estay
     */

    public function index() {
        Session::acceso('Usuario');

        $this->_view->objCiudadesHotel = $this->_hotel->getCiudadesHot();
        $this->_view->objCiudadesServ = $this->_servicio->getCiudadesServ();
        $this->_view->objCiudadesPRG = $this->_programa->getCiudadesPRG();
        $this->_view->objCategoriaHoteles = $this->_hotel->getCatHoteles();
        
        $this->_view->objServicios = $this->_servicio->getServicios();

        $this->_view->setJs(array('ajax'));

        //if(Session::get('sess_pBP_ciudadDes'))
        //{
        $this->_view->mL_expandeFiltros = 'block';
        /* }
          else
          {
          
         * $this->_view->mL_expandeFiltros='none';
          } */


        //$this->_view->assign('titulo', 'ORISTRAVEL'); SMARTY
        $this->_view->currentMenu = false;
        $this->_view->titulo = 'ORISTRAVEL';
        $this->_view->renderizaSistema('index');
    }
   
    public function pagina2() {
        Session::acceso('Especial');
        //$servicios= $this->loadModel('servicios');
        //$this->_view->servicios= $servicios->getServicios();

        $imagen = '';
        if (isset($_FILES['imagen']['name'])) {
            $this->getLibrary('upload' . DS . 'class.upload');
            $rutaImg = ROOT . 'public' . DS . 'img' . DS . 'hoteles' . DS;
            $upload = new upload($_FILES['imagen'], 'es_ES');
            $upload->allowed = array('image/jpg', 'image/png', 'image/gif');
            $upload->file_new_name_body = 'upl_' . uniqid();
            $upload->process($rutaImg);

            if ($upload->processed) {
                $imagen = $upload->file_dst_name; //nombre de la imagen
                $thumb = new upload($upload->file_dst_pathname);
                $thumb->image_resize = true;
                $thumb->image_x = 100;
                $thumb->image_y = 100;
                $thumb->file_name_body_pre = 'thumb_';
                $thumb->process($rutaImg . 'thumb' . DS);
            } else {
                $this->_view->errorImg = $upload->error;
            }
        }

        $this->_view->titulo = 'ORISTRAVEL';
        $this->_view->renderizaSistema('pagina2');
        //header('Location: ' . BASE_URL . 'confirmar');
    }   
    /*******************************************************************************
    *                                                                              *
    *                             METODOS PROCESADORES                             *
    *                                                                              *
    *******************************************************************************/

    /**
     * Metodo procesador: Calcula el valor total a pagar antes de reservar un programa.
     * <PRE>
     * -.Creado: 19/05/2015
     * -.Modificado: 20/05/2015 (Jaime Reyes)
     * -.Modificado: 21/05/2015 (Segio Orellana)
     * </PRE>
     * @param $hab Cantidad de habitaciones
     * @return int valor total de la habitacion
     * @author: Jonathan Estay
     */
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