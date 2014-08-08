<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class Model
{
    protected $_db;
    public function __construct() {
        $this->_db= new Database;
    }
}