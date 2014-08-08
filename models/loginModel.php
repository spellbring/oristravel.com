<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class loginModel extends Model
{
    public function __construct() {
        parent::__construct();
    }
    
    
    public function getUsuarios($usuario)
    {
        $sql='SELECT usuarios.id,usuarios.id_agenc_na,usuarios.clave,usuarios.login,usuarios.nombre,usuarios.apellido,
                                           usuarios.correo,usuarios.correo_admin,usuarios.correo_ejecutivo,usuarios.estado,usuarios.tipo_usuario,
                                           agenc_na.comag,agenc_na.agencia, agenc_na.grupo
                            FROM usuarios
                            JOIN agenc_na ON (agenc_na.id=usuarios.id_agenc_na)
                            WHERE login="'.$usuario.' "';
        $datos= $this->_db->consulta($sql);
        if($this->_db->numRows($datos)>0)
        {
            return $this->_db->fetchAll($datos);
        }
        else
        {
            return false;
        }
    }
    
    
    public function getTipoCambio()
    {
        $sql='SELECT cambio FROM tcambio WHERE "'.date('Y-m-d').'" BETWEEN fechad AND fechah ';
        $datos= $this->_db->consulta($sql);
        if($this->_db->numRows($datos)>0)
        {
            $tcambio=$this->_db->fetchAll($datos);
            return $tcambio[0][0];
        }
        else
        {
            return false;
        }
    }
    
    
    public function deleteOlVenta()
    {
        $sql='DELETE FROM ol_venta WHERE usuario = "'.$usuario.'" AND fecha_proceso < "'.date('Y-m-d H:i:s').'"';
        $datos= $this->_db->consulta($sql);
        
        return true;
    }
    
    
    public function auditor($user, $browser_web, $so)
    {
        $sql='INSERT INTO auditor (usuario, ip, browser, so)VALUES("'.$user.'", "'.$_SERVER['REMOTE_ADDR'].'", "'.$browser_web.'", "'.$so.'") ';
        $datos= $this->_db->consulta($sql);
        
        return true;
    }
        
    public function sp_perfilClave($user, $prg)
    {
        $sql='exec SP_PERFIL_CLAVE_PRG "'.$user.'","'.$prg.'" ';
        $datos= $this->_db->consulta($sql);
        if($this->_db->numRows($datos)>0)
        {
            $acceso=$this->_db->fetchAll($datos);
            return $acceso[0]['acceso'];
        }
        else
        {
            return false;
        }
    }
}

?>