<?php

/* 
 * Proyecto : Allways
 * Autor    : Tsyacom Ltda.
 * Fecha    : Martes, 4 de marzo de 2014
 */

class usuarioDAO extends Model
{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getUsuarios($usuario) {
        $sql = 'SELECT U.id,U.id_agenc_na,U.clave,U.login,U.nombre,U.apellido,
                U.correo,U.correo_admin,U.correo_ejecutivo,U.estado,U.tipo_usuario,
                AN.comag,AN.agencia, AN.grupo
                
                FROM usuarios U
                JOIN agenc_na AN ON (AN.id=U.id_agenc_na)
                WHERE login="' . $usuario . '"';

       
       
        $datos = $this->_db->consulta($sql);

        if ($this->_db->numRows($datos) > 0) {
            $userArray = $this->_db->fetchAll($datos);
            $objetosUser = array();

            foreach ($userArray as $usdb) {
                $userObj = new usuarioDTO();

                $userObj->setIdUsuario(trim($usdb['id']));
                $userObj->setIdAgencNa(trim($usdb['id_agenc_na']));
                $userObj->setClave(trim($usdb['clave']));
                $userObj->setLogin(trim($usdb['login']));
                $userObj->setNombre(trim($usdb['nombre']));
                $userObj->setApellido(trim($usdb['apellido']));
                $userObj->setCorreo(trim($usdb['correo']));
                $userObj->setCorreoAdmin(trim($usdb['correo_admin']));
                $userObj->setCorreoEjecutivo(trim($usdb['correo_ejecutivo']));
                $userObj->setEstado(trim($usdb['estado']));
                $userObj->setTipoUsuario(trim($usdb['tipo_usuario']));
                $userObj->setComag(trim($usdb['comag']));
                $userObj->setAgencia(trim($usdb['agencia']));
                $userObj->setGrupo(trim($usdb['grupo']));

                $objetosUser[] = $userObj;
            }

            return $objetosUser;
        } else {
            return false;
        }
        
    }
    
    public function getUsuariosEdit($usuario) {
        $sql = 'SELECT U.id,U.id_agenc_na,U.clave,U.login,U.nombre,U.apellido,
                U.correo,U.correo_admin,U.correo_ejecutivo,U.estado,U.tipo_usuario,
                AN.comag,AN.agencia, AN.grupo
                
                FROM usuarios U
                JOIN agenc_na AN ON (AN.id=U.id_agenc_na)';
                
            if($usuario != 0){    
                $sql .= ' WHERE U.id="' . $usuario . '"';
            }    
       
       
        $datos = $this->_db->consulta($sql);

        if ($this->_db->numRows($datos) > 0) {
            $userArray = $this->_db->fetchAll($datos);
            $objetosUser = array();

            foreach ($userArray as $usdb) {
                $userObj = new usuarioDTO();

                $userObj->setIdUsuario(trim($usdb['id']));
                $userObj->setIdAgencNa(trim($usdb['id_agenc_na']));
                $userObj->setClave(trim($usdb['clave']));
                $userObj->setLogin(trim($usdb['login']));
                $userObj->setNombre(trim($usdb['nombre']));
                $userObj->setApellido(trim($usdb['apellido']));
                $userObj->setCorreo(trim($usdb['correo']));
                $userObj->setCorreoAdmin(trim($usdb['correo_admin']));
                $userObj->setCorreoEjecutivo(trim($usdb['correo_ejecutivo']));
                $userObj->setEstado(trim($usdb['estado']));
                $userObj->setTipoUsuario(trim($usdb['tipo_usuario']));
                $userObj->setComag(trim($usdb['comag']));
                $userObj->setAgencia(trim($usdb['agencia']));
                $userObj->setGrupo(trim($usdb['grupo']));

                $objetosUser[] = $userObj;
            }

            return $objetosUser;
        } else {
            return false;
        }
        
    }

    public function sp_perfilClave($user, $prg) {
        $sql = 'exec SP_PERFIL_CLAVE_PRG "' . $user . '","' . $prg . '" ';
        $datos = $this->_db->consulta($sql);
        if ($this->_db->numRows($datos) > 0) {
            
            $userArray = $this->_db->fetchAll($datos);
            $userObj = new usuarioDTO();
            
            //foreach ($userArray as $usdb) {
                $userObj->setAcceso(trim($userArray[0]['acceso']));
            //}
            
            return $userObj;
            
        } else {
            return false;
        }
    }
    
    public function exeSQL($sql)
    {
        $this->_db->consulta($sql);
    }

}

?>