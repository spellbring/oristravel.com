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
        $this->_view->setJs(array('Servicios'));
        
        $this->_view->objCiudadesHotel = $this->_hotel->getCiudadesHot('');
        $this->_view->objCiudadesServ = $this->_servicio->getCiudadesServ('');
        
        $this->_view->objCiudadesPRG = $this->_programa->getCiudadesPRG();
        $this->_view->objCategoriaHoteles = $this->_hotel->getCatHoteles('');
        
        
        $this->_view->objServicios = $this->_servicio->getServicios('');
        $nombreServicio = $this->_servicio->getServicios(Session::get('sess_sBP_serv'));
        $this->_view->nombreServicio = $nombreServicio[0]->getNombre();
        
       
        
        $this->_view->objBusquedaSer = $this->_servicio->getBuscarServicios();
        
        $objTiposer= $this->_servicio->getServiciosNum(Session::get('sess_sBP_serv'));
        
        $this->_view->objTiposSer = $objTiposer[0]->getCodigo();
        
        $objdgcomag = $this->_servicio->getDgComac($objTiposer[0]->getCodigo());
        
        $this->_view->objDescrip =  $this->_servicio->traeDescripcionServ('');
        
        
        $this->_view->objDgComag = $objdgcomag[0]->getDgcomac();
        
        $this->_view->mL_expandeFiltrosServ = 'block';
        
        $this->_view->currentMenu = 9;
        $this->_view->titulo = 'ORISTRAVEL';
        
      $this->_view->renderizaSistema('buscarServicios');  
    }
    
    public function servicios(){
     Session::acceso('Usuario');
     $this->_view->objCiudadesHotel = $this->_hotel->getCiudadesHot('');
    
        
     $this->_view->objCiudadesPRG = $this->_programa->getCiudadesPRG();
     $this->_view->objCategoriaHoteles = $this->_hotel->getCatHoteles('');
     $this->_view->currentMenu=12;
     $this->_view->objCiudadesServ = $this->_servicio->getCiudadesServ(''); 
     $this->_view->objServicios = $this->_servicio->getServicios('');
     
     $this->_view->objAdminServicios = $this->_servicio->getAdminServicios(Session::get('sess_pC_aS_ciudad'), Session::get('sess_pC_aS_servicio'));
     
     
     $this->_view->renderizaSistema('adminServicios');  
     
     
    }
    
    public function editarServicio(){
        Session::set('sess_cod_serv', $this->getTexto('post_cod'));
         $texto_cambiado = str_replace(" ", "_",$this->getTexto('post_cod'));
                                        
                                           $foto = array('jpg', 'jpge','png', 'gif');
                                           $nomArchivo='';
                                           $archivoa = '';
                                           for($i=0; $i<count($foto); $i++){
                                               $rutaArchivo = ROOT. 'public'. DS .'img'. DS .'upl_'.$texto_cambiado.'.'.$foto[$i];
                                               $archivo = 'upl_'.$texto_cambiado.'.'.$foto[$i];
                                               //echo $rutaArchivo;
                                             if(file_exists($rutaArchivo)){  
                                             $nomArchivo = $rutaArchivo;
                                             $archivoa = $archivo;
                                             }
                                           }
        $this->_view->SP_rutaFoto  = BASE_URL.'public/img/'.$archivoa;                                   
        $this->_view->SP_Foto = $archivoa;  
        $this->_view->SP_archivoFoto =  $nomArchivo;
        
          $objDescripcion = $this->_servicio->traeDescripcionServ($this->getTexto('post_cod'));
        
        if($objDescripcion){
            $this->_view->objDescripcion = $objDescripcion[0]->getNotas(); 
        }
        else{
             $this->_view->objDescripcion = "";
        }
        
        $this->_view->renderizaCenterBox('editarServicio');
    }
    
    
    public function subirFoto(){
         $SP_codigoFoto = $this->getTexto('txtFileFotoServ');
        if (isset($_FILES['SpFileFoto']['name'])) {
                                            if ($_FILES['SpFileFoto']['name']) {
                                                if (Funciones::validaFoto($_FILES['SpFileFoto']['type']) == false) {
                                                    echo 'La Imagen debe ser formato [.JPG] [.GIF] [.PNG]';
                                                    exit;
                                                }

                                                if ($_FILES['SpFileFoto']['size'] > 524288) { //512KB
                                                    echo 'La Imagen debe ser menor a <b>500kb</b>';
                                                    exit;
                                                }
                                            }
                                        
            $this->getLibrary('upload' . DS . 'class.upload');
            $rutaFoto = ROOT . 'public' . DS . 'img' . DS;
            $upload = new upload($_FILES['SpFileFoto'], 'es_ES');
            $upload->allowed = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
            $upload->file_max_size = '1048576'; //1Mb
            $upload->file_new_name_body = 'upl_' . $SP_codigoFoto;

            $upload->file_overwrite = true;
            $upload->process($rutaFoto);
            if ($upload->processed) {   //THUMBNAILS

                            $thumb = new upload($upload->file_dst_pathname);
                            $thumb->image_resize = true;
                            $thumb->image_x = 150;
                            $thumb->image_y = 150;
                            $thumb->file_name_body_pre = 'thumb_';
                            $thumb->process($rutaFoto . 'thumb' . DS);
                            //$upload->process($rutaFoto);
                             echo 'OK';
            }

           
               
             else {
                //echo 'Error al subir el archivo';
                throw new Exception('Error al subir el archivo');
            }
        }
        else {
            throw new Exception('Error inesperado, intente nuevamente. Si el error persiste comuniquese con el administrador.');
        }
                                        
        
    }
    
    
     public function subirDescripcion(){
    if (strtolower($this->getServer('HTTP_X_REQUESTED_WITH')) == 'xmlhttprequest') {    
   
    $objDescripcion = $this->_servicio->traeDescripcionServ(Session::get('sess_cod_serv'));
    
     if($objDescripcion){
        
      $sql = "UPDATE h2h_servicios SET descripcion = '".  str_replace('\\', '' ,  htmlentities($this->getPost('areaDescrip')))."' WHERE codigo = '".Session::get('sess_cod_serv')."'"; 
      
    }
    else
    {
        $sql = "INSERT INTO h2h_servicios(codigo, descripcion) VALUES('".Session::get('sess_cod_serv')."', '".  str_replace('\\', '' ,  htmlentities($this->getPost('areaDescrip')))."')";
       
    }
   
    if($this->_servicio->exeSQL($sql)){
         echo 'OK';
        
         
    }
    else{
         echo 'Error inesperado, intente nuevamente. Si el error persiste comuniquese con el administrador.';
    }
    
    
       
    }
    
    else{
        throw new Exception('Error inesperado, intente nuevamente. Si el error persiste comuniquese con el administrador.');
    }
    
  }
  public function verDescripcion(){
      
      
      
      $objDescripcion = $this->_servicio->traeDescripcionServ($this->getTexto('cod_serv'));
      
      if($objDescripcion){
            $this->_view->objDescripcion = $objDescripcion[0]->getNotas(); 
        }
        else{
             $this->_view->objDescripcion = $this->getTexto('desc');
        }
      
      $this->_view->renderizaCenterBox('verDescripcion');
      
  }



}
