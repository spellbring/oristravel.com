<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */
class usuarioController extends Controller{
    
    public function __construct() {
        parent::__construct();
        $this->_view->setJs(array('Usuarios'));
        $this->_usuarios = $this->loadModel('usuario');
        $this->_agencia = $this->loadModel('agencia');
        $this->_hotel = $this->loadModel('hotel');
        $this->_categorias = $this->loadModel('categoria');
        $this->_servicio = $this->loadModel('servicio');
        $this->_programa = $this->loadModel('programa');
        
    }
     /**
     * Metodo procesador: Renderiza la vista de administración de usuarios
     * <PRE>
     * -.Creado: 22/04/2015 (Jaime Reyes)
     * </PRE>
    
     * @return _view 
     * @author: Jaime Reyes
     */  
    public function index(){
      
    }
    ###############################usuarioController################################
    
    public function usuarios() {
         Session::acceso('Usuario');

        $this->_view->objAgencia = $this->_agencia->getAgencias(0);
        $this->_view->setJs(array('ajax'));

        $this->_view->objEditUs = $this->_usuarios->getUsuariosEdit(0);
        $this->_view->objCiudadesHotel = $this->_hotel->getCiudadesHot();
        $this->_view->objCiudadesServ = $this->_servicio->getCiudadesServ();
        $this->_view->objCiudadesPRG = $this->_programa->getCiudadesPRG();
        $this->_view->objCategoriaHoteles = $this->_hotel->getCatHoteles();
        
        $this->_view->objServicios = $this->_servicio->getServicios();



        $this->_view->currentMenu = 4;
        $this->_view->titulo = 'ORISTRAVEL';
        $this->_view->renderizaSistema('usuarios'); 
        
    }
 /**
     * Metodo procesador: Realiza el proceso de insertar datos de usuarios a la BBDD
     * <PRE>
     * -.Creado: 22/04/2015 (Jaime Reyes)     
     * </PRE>
    
     * @return String devuelve un mensaje que se realizó el proceso de insertar usuarios de forma correcta. 
     * @author: Jonathan Estay
     */
    public function insertUsuarios() {
        
        if (strtolower($this->getServer('HTTP_X_REQUESTED_WITH')) == 'xmlhttprequest') {

            $US_idAgencia = $this->getTexto('US_cmbAgencia');
            $US_clave = crypt($this->getTexto('US_txtClave'), 't5y4c0m');
            $US_login = $this->getTexto('US_txtLogin');
            $US_nombre = $this->getTexto('US_txtNombre');
            $US_apellido = $this->getTexto('US_txtApe');
            $US_correo = Funciones::validarEmail($this->getTexto('US_txtCorreo'));
            $US_correoAdm = Funciones::validarEmail($this->getTexto('US_txtCorreoAdm'));
            $US_correoEj = Funciones::validarEmail($this->getTexto('US_txtCorreoEj'));
            $US_Estado = $this->getTexto('US_cmbEstado');
            $US_tipoUs = $this->getTexto('US_cmbTipoUs');

            if ($US_login & $US_idAgencia & $US_clave & $US_nombre & $US_apellido & $US_tipoUs) {
                if ($US_correo & $US_correoAdm & $US_correoEj) {

                    $US_sql = "INSERT INTO usuarios(id_agenc_na, clave, login, nombre, apellido, correo , correo_admin, correo_ejecutivo, estado, tipo_usuario)
                        VALUES(" . $US_idAgencia . ",'" . $US_clave . "','" . $US_login . "','" . $US_nombre . "','" . $US_apellido . "','" . $US_correo . "','" . $US_correoAdm . "','" . $US_correoEj . "','" . $US_Estado . "','" . $US_tipoUs . "')";

                    $this->_usuarios->exeSQL($US_sql);

                    echo 'OK';
                } else {
                    echo "Ingrese correos válidos, por ejemplo: juan@empresa.com";
                }
            } else {
                echo "No se admiten campos vacíos";
            }
        } else {
            throw new Exception('Error inesperado, intente nuevamente. Si el error persiste comuniquese con el administrador.');
        }
    }
  /**
     * Metodo procesador: Carga todos los usuarios en tablas para realizar su posterior modificación
     * <PRE>
     * -.Creado: 28/07/2014 (Jaime Reyes)
     * </PRE>
    
     * @return String devuelve mensaje de error en el caso ed que no se encuientra los registros
     * @author: Jaime Reyes
     */
    public function editUsuarios() {
        Session::acceso('Usuario');
        $this->_view->setJs(array('ajax'));
        $EU_idus = $this->getTexto('post_cod');
        Session::set('sess_EU_codUs', $EU_idus);
        //$this->_view->objEditUsCenter = $this->_usuarios->getUsuarios($EU_idus);  

        $objEditUsuario = $this->_usuarios->getUsuariosEdit($EU_idus);
        $this->_view->objAgencias = $this->_agencia->getAgencias(0);
        if ($EU_idus) {

            if ($objEditUsuario) {
                $this->_view->EU_Id = $objEditUsuario[0]->getIdUsuario();
                $this->_view->EU_idAgen = $objEditUsuario[0]->getIdAgencNa();
                $this->_view->EU_clave = $objEditUsuario[0]->getClave();
                $this->_view->EU_login = $objEditUsuario[0]->getLogin();
                $this->_view->EU_nombre = $objEditUsuario[0]->getNombre();
                $this->_view->EU_apellido = $objEditUsuario[0]->getApellido();
                $this->_view->EU_correo = $objEditUsuario[0]->getCorreo();
                $this->_view->EU_correoAdm = $objEditUsuario[0]->getCorreoAdmin();
                $this->_view->EU_correoEjec = $objEditUsuario[0]->getCorreoEjecutivo();
                $this->_view->EU_tipoUs = $objEditUsuario[0]->getTipoUsuario();
                $this->_view->EU_estado = $objEditUsuario[0]->getEstado();
                $this->_view->EU_Agen = $objEditUsuario[0]->getAgencia();
                
            } else {

                throw new Exception('Error al desplegar la edicion del usuario');
            }
        } else {
            throw new Exception('Error al tratar de editar el usuario');
        }


        $this->_view->renderizaCenterBox('editUsuario');
    }

    
    
    /**
     * Metodo procesador: Permite realizar el proceso de update de usuarios en administración de usuarios
     * <PRE>
     * -.Creado: 28/04/2015 (Jaime Reyes)
     * </PRE>
    
     * @return String Devuelve un mensaje de que se proceso se realizó con éxito
     * @author: Jaime Reyes
     */
    public function modificarUsuario() {
        if (strtolower($this->getServer('HTTP_X_REQUESTED_WITH')) == 'xmlhttprequest') {

            $EU_idAgencia = $this->getTexto('EU_cmbAgencia');
            $EU_clave = $this->getTexto('EU_txtClave');
            //$EU_login = $this->getTexto('EU_txtLogin');
            $EU_nombre = $this->getTexto('EU_txtNombre');
            $EU_apellido = $this->getTexto('EU_txtApe');
            $EU_correo = Funciones::validarEmail($this->getTexto('EU_txtCorreo'));
            $EU_correoAdm = Funciones::validarEmail($this->getTexto('EU_txtCorreoAdm'));
            $EU_correoEj = Funciones::validarEmail($this->getTexto('EU_txtCorreoEj'));
            $EU_Estado = $this->getInt('EU_cmbEstado');
            $EU_tipoUs = $this->getTexto('EU_cmbTipoUs');
            
            if ($EU_idAgencia & $EU_clave & $EU_nombre & $EU_apellido & $EU_tipoUs) {
                
                if ($EU_correoAdm & $EU_correo & $EU_correoEj) {
                    $EU_sql = 'UPDATE usuarios '
                            . 'SET id_agenc_na=' . $EU_idAgencia . ','
                            . 'nombre = "' . $EU_nombre . '",'
                            . 'apellido="' . $EU_apellido . '", correo="' . $EU_correo . '",'
                            . 'correo_admin ="' . $EU_correoAdm . '", correo_ejecutivo="' . $EU_correoEj . '",'
                            . 'estado = ' . $EU_Estado . ', tipo_usuario = ' . $EU_tipoUs . ' ';

                    if ($EU_clave != '************') {
                        $EU_sql .= ' clave="' . crypt($EU_clave, 't5y4c0m') . '"';
                    }

                    $EU_sql.=' WHERE id = ' . Session::get('sess_EU_codUs') . '';


                    $this->_usuarios->exeSQL($EU_sql);
                    //echo $EU_sql; 

                    echo 'OK';
                } else {
                    echo "Ingrese correos válidos, por ejemplo: juan@empresa.com";
                }
            } else {
                echo "No se admiten campos vacíos";
            }
        } else {
            throw new Exception('Error inesperado, intente nuevamente. Si el error persiste comuniquese con el administrador.');
        }
    }
 /**
     * Metodo procesador: Renderiza el centerBox para realizar el proceso de eliminación. 
     * <PRE>
     * -.Creado: 28/07/2014 (Jaime Reyes)
     * </PRE>   
     * @return _view
     * @author: Jonathan Estay
     */
    public function borrarUsuariosPopUp(){

      $this->_view->renderizaCenterBox('borrarUsuario');
    
    }
     /**
     * Metodo procesador: Realiza el proceso de eliminación de usuarios
     * <PRE>
     * -.Creado: 29/04/2015

     * </PRE>
    
     * @return String devuelve mensje de que se realizo el proceso de eliminación de forma correcta.
     * @author: Jaime Reyes
     */
    public function borrarUsuarios(){
     if (strtolower($this->getServer('HTTP_X_REQUESTED_WITH')) == 'xmlhttprequest') {
     $BU_sql = 'DELETE FROM usuarios WHERE id='.Session::get('sess_EU_codUs').'';
     
        if($this->_usuarios->exeSQL($BU_sql)){
         echo 'OK';
           
        }
        else{
         echo 'No se pudo eliminar el Usuario';
        }
     }

    else{
                throw new Exception('Error inesperado, intente nuevamente. Si el error persiste comuniquese con el administrador.');
     } 
        
    }
    
}

