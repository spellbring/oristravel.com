<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class ajaxController extends Controller
{
    private $_ajax;
            
    public function __construct() {
        parent::__construct();
        $this->_ajax= $this->loadModel('ajax');
    }
    
    public function index()
    {
        $this->_view->titulo='AJAX';
        $this->_view->paises= $this->_ajax->getPaises();
        $this->_view->renderizaCentro('index');
    }
    
    public function getCiudades()
    {
        if($this->getInt('pais'))
        echo json_encode($this->_ajax->getCiudades($this->getInt('pais')));
    }
    
    public function insertarCiudad()
    {
        if($this->getInt('pais') && $this->getSql('ciudad'))
        {
            $this->_ajax->insertarCiudad(
                    $this->getInt('pais'),
                    $this->getSql('ciudad')
                    );
        }
    }
    
}
?>