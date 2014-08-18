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
        $this->_login= $this->loadModel('login');   // para cargar el modelo para todo el controller
    }
    
    public function index()
    {
        $this->_view->titulo='Iniciar sesi&oacute;n';
        $this->_view->renderizaPrincipal('login');
    }
    
    
    public function ingresar()
    {
        $LC_user= strtolower($this->getTexto('txtUser'));
        $LC_pass= strtolower($this->getTexto('txtPass'));        
        
        if(!empty($LC_user) && !empty($LC_pass))
        {   
            $rowUsuarios= $this->_login->getUsuarios($LC_user);
            
            if($rowUsuarios!=false)
            {
                if(strtolower(trim($rowUsuarios[0]['login']))==$LC_user && $rowUsuarios[0]['clave']==crypt($LC_pass,'t5y4c0m'))
                {
                    if($rowUsuarios[0]['estado']!=1)
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
                        Session::set('sess_key_', $numero_aleatorio);
                        Session::set('sess_tipo_usuario', $rowUsuarios[0]['tipo_usuario']);
                        Session::set('sess_usuario', $LC_user);
                        
                        Session::set('sess_nombre', trim($rowUsuarios[0]['nombre']));
                        Session::set('sess_apellido', trim($rowUsuarios[0]['apellido']));
                        Session::set('sess_id_usuario', $rowUsuarios[0]['id']);
                        Session::set('sess_id_agencia', $rowUsuarios[0]['id_agenc_na']);
                        Session::set('sess_status', $rowUsuarios[0]['estado']);
                        
                        Session::set('sess_comag', trim($rowUsuarios[0]['comag']));
                        Session::set('sess_agencia', trim($rowUsuarios[0]['agencia']));
                        Session::set('sess_correo', trim($rowUsuarios[0]['correo']));
                        Session::set('sess_correo_admin', trim($rowUsuarios[0]['correo_admin']));
                        Session::set('sess_correo_ejecutivo', trim($rowUsuarios[0]['correo_ejecutivo']));
                        Session::set('sess_grupo', $rowUsuarios[0]['grupo']);
                        
                        Session::set('level', 'Admin');
                        Session::set('tiempo', time());
                        
                        
                        ######################################################################################
                        //Session::set('sess_sp_acceso', $this->_login->sp_perfilClave($LC_user, 'ADMWEB'));
                        ######################################################################################
                        
                        
                        $this->_login->deleteOlVenta();
                        Session::set('sess_tcambio', $this->_login->getTipoCambio());
                        $ua= Funciones::getBrowser();
                        
                        $browser_web= $ua['name']." ".$ua['version'];
                        $so= $ua['platform'];
                        $this->_login->auditor($LC_user, $browser_web, $so);
                        /*
                        ***************************************************************** 
                        */

                        $this->redireccionar('sistema');
                    }
                }
                else
                {
                     $this->redireccionar(); //Error Usuario o Pass
                }
            }
            else
            {
                 $this->redireccionar(); //No existe
            }
        }
        else
        {
             $this->redireccionar(); //Ingrese un usuario o Pass
        }
    }
}

?>