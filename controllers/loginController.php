<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class loginController extends Controller
{
    private $_login;
    
    public function __construct() {
        parent::__construct();
        $this->_login= $this->loadModel('usuario');
        $this->_servicio = $this->loadModel('servicio');// para cargar el modelo para todo el controller
    }
    
    public function index()
    {
        $this->_view->titulo='Iniciar sesi&oacute;n';
        $this->_view->renderizaPrincipal('login');
        $this->_alertDestroy();
    }
    
    
    public function ingresar()
    {
        $LC_user= strtolower($this->getTexto('txtUser'));
        $LC_pass= strtolower($this->getTexto('txtPass'));        
        
        if(!empty($LC_user) && !empty($LC_pass))
        {   
            $objUsuarios= $this->_login->getUsuarios($LC_user);
            
            if($objUsuarios)
            {
                if(strtolower($objUsuarios[0]->getLogin())==$LC_user && $objUsuarios[0]->getClave()==crypt($LC_pass,'t5y4c0m'))
                {
                    if($objUsuarios[0]->getEstado()!=1)
                    {
                        $this->redireccionar();
                    }
                    else
                    {
                        /*
                        ***************************************************************** 
                        */
                        //genera key
                        $A_genera=array(rand(10,99),rand(10,99),rand(10,99),rand(10,99),rand(10,99));
                        $numero_aleatorio = $A_genera[0].$A_genera[1].$A_genera[2].$A_genera[3].$A_genera[4];
                        
                        Session::set('Autenticado', true);
                        Session::set('sess_key_', $numero_aleatorio);//
                        Session::set('sess_tipo_usuario', $objUsuarios[0]->getTipoUsuario());
                        Session::set('sess_usuario', $LC_user);
                        
                        $fecha = date('d-m-Y');
                        $nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
                        $nuevafecha = date ( 'd-m-Y' , $nuevafecha);
    
                        Session::set('sess_fecha_lsb', str_replace('-', '/', $nuevafecha));
                        
                        Session::set('sess_pass', $LC_pass);
                        Session::set('sess_nombre', $objUsuarios[0]->getNombre());
                        Session::set('sess_apellido', $objUsuarios[0]->getApellido());
                        Session::set('sess_id_usuario', $objUsuarios[0]->getIdUsuario());
                        Session::set('sess_id_agencia', $objUsuarios[0]->getIdAgencNa());
                        Session::set('sess_status', $objUsuarios[0]->getEstado());
                        
                        Session::set('sess_comag', $objUsuarios[0]->getComag());
                        Session::set('sess_agencia', $objUsuarios[0]->getAgencia());
                        Session::set('sess_correo', $objUsuarios[0]->getCorreo());
                        Session::set('sess_correo_admin', $objUsuarios[0]->getCorreoAdmin());
                        Session::set('sess_correo_ejecutivo', $objUsuarios[0]->getCorreoEjecutivo());
                        Session::set('sess_grupo', $objUsuarios[0]->getGrupo());
                        
                        Session::set('level', 'Admin');
                        Session::set('tiempo', time());
                        Session::set('sess_intentos', 0);
                        Session::set('sess_ipcfg', $_SERVER["REMOTE_ADDR"]);
                        
                        $carroHotel= array(array(0 => ''));
                        Session::set('sess_CarroHotel',$carroHotel);
                        
                        $carroPrograma = array(array(0=>''));
                        Session::set('sess_CarroPrograma',$carroPrograma);
                        
                        $carroServicio = array(array(0=>''));
                        Session::set('sess_CarroServicio',$carroServicio);
                        
                        $objTcambio = $this->_servicio->traeCambio();
                        Session::set('sess_t_cambioServ', $objTcambio[0]->getTcambio());
                        
                        /*$_SESSION[0][0]='10:30';
                        $_SESSION[0][1]='10:40';
                        $_SESSION[0][2]='10:50';*/
                        
                        //Session::set($clave, $valor)
                        /*Session::set('sess_CarroServicio',[0][0]);
                        Session::set('sess_CarroPrograma',[0][0]);*/
                        
                        
                        ######################################################################################
                        //Session::set('sess_sp_acceso', $this->_login->sp_perfilClave($LC_user, 'ADMWEB'));
                        ######################################################################################
                        
                        
                        $business= $this->loadModel('business');
                        $business->deleteOlVenta($LC_user);
                        Session::set('sess_tcambio', $business->getTipoCambio());
                        $ua= Funciones::getBrowser();
                        
                        $browser_web= $ua['name']." ".$ua['version'];
                        $so= $ua['platform'];
                        $business->auditor($LC_user, $browser_web, $so);
                        /*
                        ***************************************************************** 
                        */

                        $this->redireccionar('sistema');
                    }
                }
                else
                {
                    $this->_alert(2, 'Usuario o password son incorrectos. 1');
                    $this->redireccionar(); //Error Usuario o Pass
                }
            }
            else
            {
                $this->_alert(2, 'Usuario o password son incorrectos. 2');
                $this->redireccionar(); //No existe
            }
        }
        else
        {
            $this->_alert(2, 'Ingrese un usuario o password. 2');
            $this->redireccionar(); //Ingrese un usuario o Pass
        }
    }
    
    
    
    
    
    private function _alert($tipo = false, $msg = false) {
        Session::set('sess_alerts', $tipo); //Tipo alerta
        Session::set('sess_alerts_msg', $msg);
    }

    private function _alertDestroy() {
        Session::destroy('sess_alerts');
        Session::destroy('sess_alerts_msg');
    }
    
    
}

?>