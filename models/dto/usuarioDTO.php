<?php

/* 
 * Proyecto : Allways
 * Autor    : Tsyacom Ltda.
 * Fecha    : Martes, 4 de marzo de 2014
 */

class usuarioDTO
{
    private $_id_usuario;
    private $_id_agencia;
    private $_clave;
    private $_login;
    private $_nombre;
    private $_apellido;
    private $_correo;
    private $_correo_admin;
    private $_correo_ejecutivo;
    private $_estado;
    private $_tipo_usuario;
    private $_comag;
    private $_agencia;
    private $_grupo;
    private $_acceso;
    
    
    public function getAcceso() {
        return $this->_acceso;
    }
    
    public function setAcceso($acceso) {
        $this->_acceso = $acceso;
    }
    
    public function setIdUsuario($id_usuario) {
        $this->_id_usuario = $id_usuario;
    }
    
    public function getIdUsuario() {
        return $this->_id_usuario;
    }

    public function setIdAgencNa($idAgen)
    {
        $this->_id_agencia=$idAgen;
    }
    public function getIdAgencNa()
    {
        return $this->_id_agencia;
    }
    
    public function setClave($clave)
    {
        $this->_clave=$clave;
    }
    
    public function getClave()
    {
        return $this->_clave;
    }
    
    public function setLogin($login)
    {
        $this->_login=$login;
    }
    
    public function getLogin()
    {
        return $this->_login;
    }
    
    public function setNombre($nombre)
    {
        $this->_nombre=$nombre;
    }
    
    public function getNombre()
    {
        return $this->_nombre;
    }
    
    public function setApellido($apellido)
    {
        $this->_apellido=$apellido;
    }
    
    public function getApellido()
    {
        return $this->_apellido;
    }
    
    public function setCorreo($correo)
    {
        $this->_correo=$correo;
    }
    
    public function getCorreo()
    {
        return $this->_correo;
    }
    
    public function setCorreoAdmin($correoAd)
    {
        $this->_correo_admin=$correoAd;
    }
    
    public function getCorreoAdmin()
    {
        return $this->_correo_admin;
    }
    
    public function setCorreoEjecutivo($correoEj)
    {
        $this->_correo_ejecutivo=$correoEj;
    }
    
    public function getCorreoEjecutivo()
    {
        return $this->_correo_ejecutivo;
    }
    
    public function setEstado($estado)
    {
        $this->_estado=$estado;
    }
    
    public function getEstado()
    {
        return $this->_estado;
    }
    
    public function setTipoUsuario($tipoUser)
    {
        $this->_tipo_usuario=$tipoUser;
    }
    
    public function getTipoUsuario()
    {
        return $this->_tipo_usuario;
    }
    
    public function setComag($comag)
    {
        $this->_comag=$comag;
    }
    
    public function getComag()
    {
        return $this->_comag;
    }
    
    public function setAgencia($agencia)
    {
        $this->_agencia=$agencia;
    }
    
    public function getAgencia()
    {
        return $this->_agencia;
    }
    
    public function setGrupo($grupo)
    {
        $this->_grupo=$grupo;
    }
    
    public function getGrupo()
    {
        return $this->_grupo;
    }
}
?>