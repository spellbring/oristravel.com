<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

//require_once ROOT . 'libs' . DS . 'smarty' . DS . 'libs' . DS . 'Smarty.class.php';

class View /*extends Smarty*/
{
    private $_controlador;
    private $_js;
    
    public function __construct(Request $peticion) { //$peticion es un objeto de Request
        //parent::__construct(); SMARTY
        $this->_controlador= $peticion->getControlador();
        $this->_js=array();
    }
    
    
    
    public function renderizaPrincipal($vista, $item=false)
    {
        $this->template_dir= ROOT . 'views' . DS . 'layout' . DEFAULT_LAYOUT . DS; //utilizando SMARTY
        
        //se incluye directamente el '/' ya que estas rutas siempre van a ser asi
        $_layoutParams= array(
            'ruta_css' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/css/', 
            'ruta_img' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/img/', 
            'ruta_js' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/js/', 
        );
        $rutaView= ROOT . 'views' . DS . $this->_controlador . DS . $vista . '.phtml';
        
        if(is_readable($rutaView))
        {
            //include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'header.php';
            //include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'menu-left.php';
            include_once $rutaView;
            //include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'footer.php';
        }
        else
        {
            throw new Exception('Error de vista: '.$rutaView);
        }
    }
    
    
    
    
    
    public function renderizaSistema($vista, $item=false)
    {
        $this->template_dir= ROOT . 'views' . DS . 'layout' . DEFAULT_LAYOUT . DS; //utilizando SMARTY
        
        //se incluye directamente el '/' ya que estas rutas siempre van a ser asi
        $_layoutParams= array(
            'ruta_css' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/css/', 
            'ruta_img' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/img/', 
            'ruta_js' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/js/',
            'ruta_hoteles' => BASE_URL . 'views/' . 'sistema' . '/img/hoteles/'
        );
        $rutaView= ROOT . 'views' . DS . $this->_controlador . DS . $vista . '.phtml';
        
        if(is_readable($rutaView))
        {
            include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'header.php';
            include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'menu-left.php';
            include_once $rutaView;
            include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'footer.php';
        }
        else
        {
            throw new Exception('Error de vista: '.$rutaView);
        }
    }
    
    
    
    
    public function renderizaSistemaSmarty($vista, $item=false)
    {
        //Begin: SMARTY;
        $this->template_dir= ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS; //Directorio de los template
        $this->config_dir= ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'configs' . DS; //Directorio de configuracion
        $this->cache_dir= ROOT . 'tmp' . DS . 'cache' . DS;//Directorio cache
        $this->compile_dir= ROOT . 'tmp' . DS . 'template' . DS; //Directorio de compilacion
        //End: SMARTY;
        
        
        //se incluye directamente el '/' ya que estas rutas siempre van a ser asi
        $_params= array(
            'ruta_css' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/css/', 
            'ruta_img' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/img/', 
            'ruta_js' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/js/',
            'ruta_hoteles' => BASE_URL . 'views/' . 'sistema' . '/img/hoteles/',
            'item' => $item,
            'root' => BASE_URL,
            'configs' => array(
                'app_name' => APP_NAME,
                'app_slogan' => APP_SLOGAN,
                'app_company' => APP_COMPANY
            )
        );
        $rutaView= ROOT . 'views' . DS . $this->_controlador . DS . $vista . '.phtml';
        
        if(is_readable($rutaView))
        {
            $this->assign('_contenido', $rutaView);
        }
        else
        {
            throw new Exception('Error de vista: '.$rutaView);
        }
        
        $this->assign('_layoutParams', $_params);
        $this->display('template.tpl');
    }
    
    
    
    
    public function renderizaCentro($vista, $item=false)
    {
        $rutaView= ROOT . 'views' . DS . $this->_controlador . DS . $vista . '.phtml';
        
        if(is_readable($rutaView))
        {
            //include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'header.php';
            //include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'menu-left.php';
            include_once $rutaView;
            //include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'footer.php';
        }
        else
        {
            throw new Exception('Error de vista');
        }
    }
}