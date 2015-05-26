<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */
class imagenController extends Controller{
    public function __construct() {
        parent::__construct();
        
        $this->_hotel = $this->loadModel('hotel');
        $this->_servicio = $this->loadModel('servicio');
        $this->_programa = $this->loadModel('programa');
        $this->_agencia = $this->loadModel('agencia');
    }
    public function index(){
        
        
    }
    
    #####################imagenesController#######################
     /**
     * Metodo procesador: Renderiza la vista de administración de imágenes, ademas con sus respectivos comboBox.
     * <PRE>
     * -.Creado: 22/04/2014(Jaime Reyes)
     * </PRE>
    
     * @return _view 
     * @author: Jaime Reyes
     */
    public function imagenes() {
        Session::acceso('Usuario');

        $this->_view->objCiudadesHotel = $this->_hotel->getCiudadesHot();
        $this->_view->objCiudadesServ = $this->_servicio->getCiudadesServ();
        $this->_view->objCiudadesPRG = $this->_programa->getCiudadesPRG();
        $this->_view->objAgenciaImagenes= $this->_agencia->getAgencias(0);

        $this->_view->currentMenu = 5;
        $this->_view->titulo = 'ORISTRAVEL';
        $this->_view->renderizaSistema('imagenes');
    }
    /**
     * Metodo procesador: Renderiza el proceso de administración de programas con sus respectivos centerBox
     * <PRE>
     * -.Creado: 24/04/2014
     * </PRE>
    
     * @return _view
     * @author: Jaime Reyes
     */
    
    public function logoVoucher(){
Session::acceso('Usuario');

$id_Agen = $this->getTexto('post_f_valor');
Session::set('sess_id_agen', $id_Agen);
$objEditUsuario = $this->_agencia->getAgencias($id_Agen);
    if($id_Agen){
        if($objEditUsuario){
            $this->_view->I_imagen = $objEditUsuario[0]->getImagen();
            $this->_view->I_nombre = $objEditUsuario[0]->getNombre();
            $this->_view->I_Id = $objEditUsuario[0]->getId();
        }
        else{
            throw new Exception('Error al desplegar la edicion del programa');
        }
    }
    else
    {
    throw new Exception('Error al tratar de desplegar las imagenes');
    }
   
$this->_view->renderizaCenterBox('logoVoucher');
}
  /**
     * Metodo procesador: Realiza el proceso de modificacion o inclusion de una foto.
     * <PRE>
     * -.Creado: 24/04/2014
     * </PRE>
    
     * @return _view
     * @author: Jaime Reyes
     */
    public function modificarLogoVoucher()
    {
        if(strtolower($this->getServer('HTTP_X_REQUESTED_WITH'))=='xmlhttprequest')
        {
            $rutaIMG= ROOT . 'public' . DS . 'img' . DS . 'voucher' . DS;
            $MLV_agencia= $this->_agencia->getAgencias(Session::get('sess_id_agen'));
           
            
            if(isset($_FILES['flImagenVouAgen']['name']))
            {
                if($_FILES['flImagenVouAgen']['name'])
                {
                    $this->getLibrary('upload' . DS . 'class.upload');

                    $upload= new upload($_FILES['flImagenVouAgen'], 'es_ES');
                    $upload->allowed= array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
                    $upload->file_max_size = '524288'; // 512KB
                    //$upload->file_new_name_body= 'upl_' . uniqid();
                    $upload->file_new_name_body= 'upl_' . Session::get('sess_id_agen');
                    $upload->process($rutaIMG);

                    if($upload->processed)
                    {
                        //echo $upload->file_dst_name_body.'.'.$upload->file_dst_name_ext;
                       $this->_agencia->actualizaVoucherAgen(Session::get('sess_id_agen'), $upload->file_dst_name_body.'.'.$upload->file_dst_name_ext);
                        echo 'OK';
                        
                    }
                    else
                    {
                        throw new Exception( $upload->error );
                    }
                }
                else
                {
                    throw new Exception('Debe seleccionar una foto');
                }
            }
            else
            {
                
                if($this->getTexto('chk_flImagenVouAgen'))
                {
                    if($this->getTexto('chk_flImagenVouAgen')=='on')
                    {
                        if(Funciones::eliminaFile($rutaIMG . $this->getTexto('txtImg')))
                        {
                            $this->_agencia->actualizaVoucherAgen(Session::get('sess_id_agen'), '');
                            
                            echo 'OK';
                        }
                        else
                        {
                            throw new Exception('Error al eliminar el archivo, intente nuevamente');
                        }
                    }
                    else
                    {
                        throw new Exception('Debe seleccionar un archivo a eliminar');
                    }
                }
                else
                {
                    throw new Exception('Debe seleccionar un archivo desde su computador');
                }
            }
        }
        else
        {
            throw new Exception('Error inesperado, intente nuevamente. Si el error persiste comuniquese con el administrador');
        }
    }
    
}

