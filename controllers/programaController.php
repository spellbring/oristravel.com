<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class programaController extends Controller{
    public function __construct() {
        parent::__construct();
        $this->_view->setJs(array('Programas'));
        $this->_hotel = $this->loadModel('hotel');
        $this->_servicio = $this->loadModel('servicio');
        $this->_programa = $this->loadModel('programa');
        $this->_categoria = $this->loadModel('categoria');
        $this->_pais = $this->loadModel('pais');
        $this->_ciudad = $this->loadModel('ciudad');
        //$this->_view->setJs(array('ajax'));
    }
    
    public function index(){
     Session::acceso('Usuario');
             
       $this->_view->objCiudadesHotel = $this->_hotel->getCiudadesHot('');
       $this->_view->objCiudadesServ = $this->_servicio->getCiudadesServ('');
       $this->_view->objCiudadesPRG = $this->_programa->getCiudadesPRG();
       $this->_view->objCategoriaHoteles = $this->_hotel->getCatHoteles();
       
        $this->_view->objServicios = $this->_servicio->getServicios();
        
        $this->_view->mL_expandeFiltrosProg = 'block';
       
       $this->_view->currentMenu = 10;
       $this->_view->titulo = 'ORISTRAVEL'; 
       $this->_view->renderizaSistema('buscarProgramas');   
        
    }
    ###################### programaControler############################
     /**
     * Metodo procesador: Carga todos los ComboBox para el proceso de administracion de programas y las tablas
     * <PRE>
     * -.Creado: 28/07/2014
     * -.Modificado: 10/04/2015 (Jaime Reyes)
     * -.Modificado: 20/05/2015 (Jaime Reyes)
     * </PRE>
    
     * @return _view devuelve todos los hoteles segun el filtro que se elija
     * @author: Jonathan Estay
     */
    public function adminProgramas() {
        Session::acceso('Usuario');
        $this->_view->setJs(array('ajax'));

        $this->_view->objCiudadesHotel = $this->_hotel->getCiudadesHot();
        $this->_view->objCiudadesServ = $this->_servicio->getCiudadesServ();
        $this->_view->objCiudadesPRG = $this->_programa->getCiudadesPRG(); //Session::get('sess_combo_pais')
        $this->_view->objServicios = $this->_servicio->getServicios();
        $this->_view->objPais = $this->_pais->getPaises();

        $this->_view->objProgramas = $this->_programa->getAdmProgramas();

        $this->_view->currentMenu = 3;
        $this->_view->titulo = 'ORISTRAVEL';
        $this->_view->renderizaSistema('adminProgramas');
    }
    public function subirFoto(){
         $SP_codigoFoto = $this->getTexto('txtFileFoto');
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
 /**
     * Metodo procesador: Renderiza el centerBox para subir los pdf
     * <PRE>
     * -.Creado: 10/04/2015 (Jaime Reyes)
     * </PRE>
    
     * @return _view 
     * @author: Jonathan Estay
     */
    public function subirPdf() {//Pagina
        Session::acceso('Usuario');

        Session::set('sess_Cod_Prog', $this->getTexto('post_cod'));
        //$this->_view->setJs(array('ajax'));
       
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
        $objDescripcion = $this->_programa->traeDescripcion($this->getTexto('post_cod'));
        
        if($objDescripcion){
            $this->_view->objDescripcion = $objDescripcion[0]->getDescripcion(); 
        }
        else{
             $this->_view->objDescripcion = "";
        }
       
        $this->_view->renderizaCenterBox('editarPrograma');
    }
     /**
     * Metodo procesador: Renderiza una vista para ver los pdf
     * <PRE>
     * -.Creado: 13/04/2015 (Jaime Reyes)
     * </PRE>
    
     * @return _view
     * @author: Jaime Reyes
     */

    public function verPDF() {
        Session::acceso('Usuario');

        $texto = $this->getTexto('post_cod');
        $texto_cambiado = str_replace(" ", "_", $texto);
        $this->_view->VP_codPDF = $texto_cambiado;

        $this->_view->setJs(array('ajax'));
        $this->_view->renderizaCenterBox('verPdf');
    }
    /**
     * Metodo procesador: Permite cargar pdf al proceso de administración de programas
     * <PRE>
     * -.Creado: 14/04/2015 (Jaime Reyes) 
     * </PRE>
    
     * @return String devuelve un mensaje de que se realizó el proceso con éxito.
     * @author: Jaime Reyes
     */
    public function subirCarPdf() {
        $SP_codigo = $this->getTexto('txtFile');

        //$SP_codigo = $this->SP_codProg;
        if (isset($_FILES['SpFile']['name'])) {

            if ($_FILES['SpFile']['name']) {
                if (Funciones::validaArchivo($_FILES['SpFile']['type']) == false) {
                    echo 'El Archivo debe ser formato [.PDF]';
                    exit;
                }

                if ($_FILES['SpFile']['size'] > 1048576) { //1Mb
                    echo 'El archivo debe ser menor a <b>1Mb</b>';
                    exit;
                }
            }
            $this->getLibrary('upload' . DS . 'class.upload');
            $rutaPdf = ROOT . 'public' . DS . 'pdf' . DS;
            $upload = new upload($_FILES['SpFile'], 'es_ES');
            $upload->allowed = ('application/pdf');
            $upload->file_max_size = '1048576'; //1Mb
            $upload->file_new_name_body = 'upl_' . $SP_codigo;

            $upload->file_overwrite = true;
            $upload->process($rutaPdf);

            if ($upload->processed) {
                echo 'OK';
            } else {
                //echo 'Error al subir el archivo';
                throw new Exception('Error al subir el archivo');
            }
        } else {
            throw new Exception('Error inesperado, intente nuevamente. Si el error persiste comuniquese con el administrador.');
        }
        //$this->redireccionar('sistema/adminProgramas');
    }
     /**
     * Metodo procesador: Elimina el pdf cargado en la adminsitración de programas
     * <PRE>
     * -.Creado: 14/04/2015 (Jaime Reyes) 
     * </PRE>
    
     * @return String devuelve un mensaje de que se eliminó con éxito el pdf del proceso de administración de programas.
     * @author: Jaime Reyes
     */
    public function eliminarPdf() {
        $archivo = $this->getTexto('txtNombreFile');
        $ruta = ROOT . 'public' . DS . 'pdf' . DS . $archivo;
        if (@unlink($ruta)) {
            echo 'OK';
        } else {
            echo 'No se puede eliminar PDF';
        }
        //$this->redireccionar('programa/adminProgramas');
    }
    
    public function eliminarFoto() {
        $archivo = $this->getTexto('txtNombreFoto');
        $ruta = ROOT . 'public' . DS . 'img' . DS . $archivo;
        $rutaThumb = ROOT . 'public' . DS . 'img' . DS . 'thumb'. DS . 'thumb_'.$archivo ;
        if (@unlink($ruta)) {
            @unlink($rutaThumb);
            echo 'OK';
        } else {
            echo $archivo;
        }
        //$this->redireccionar('programa/adminProgramas');
    }
    
    /**
     * Metodo procesador: Renderiza buscarProgramas y sus respectivos comoboBox y tablas, dependiendo del filtro del leftSideBar
     * <PRE> 
     * -.Creado: 11/05/2015 (Jaime Reyes)
     * </PRE>
    
     * @return _view 
     * @author: Jaime Reyes
     */
    public function subirDescripcion(){
    if (strtolower($this->getServer('HTTP_X_REQUESTED_WITH')) == 'xmlhttprequest') {    
   
    $objDescripcion = $this->_programa->traeDescripcion(Session::get('sess_Cod_Prog'));
    
     if($objDescripcion){
        
      $sql = "UPDATE h2h_pdfprog SET descripcion = '".  str_replace('\\', '' ,  htmlentities($this->getPost('areaDescrip')))."' WHERE codigo = '".Session::get('sess_Cod_Prog')."'"; 
      
    }
    else
    {
        $sql = "INSERT INTO h2h_pdfprog(codigo, descripcion) VALUES('".Session::get('sess_Cod_Prog')."', '".  str_replace('\\', '' ,  htmlentities($this->getPost('areaDescrip')))."')";
       
    }
   
    if($this->_programa->exeSQL($sql)){
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

    
}

