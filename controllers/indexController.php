<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class indexController extends Controller
{
    public function __construct() {
        parent::__construct();
    }
    
    public function index()
    {
        //$this->_view->titulo='ORISTRAVEL';
        //$this->_view->renderizaPrincipal('index');
        header('Location: ' . BASE_URL . 'login');
    }
}

?>