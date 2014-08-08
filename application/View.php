<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class view
{
    private $_controlador;
    
    public function __construct(Request $peticion) { //$peticion es un objeto de Request
        $this->_controlador= $peticion->getControlador();
    }
    
    
    
    public function renderizaPrincipal($vista, $item=false)
    {
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