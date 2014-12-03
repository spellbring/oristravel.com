<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class businessDAO extends Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function getTipoCambio() {
        $sql = 'SELECT cambio FROM tcambio WHERE "' . date('Y-m-d') . '" BETWEEN fechad AND fechah ';
        $datos = $this->_db->consulta($sql);
        if ($this->_db->numRows($datos) > 0) {
            $tcambio = $this->_db->fetchAll($datos);
            $busiObj = new businessDTO();
            
            //foreach ($userArray as $usdb) {
            $busiObj->setTipoCambio(trim($tcambio[0]['cambio']));
            //}
            
            return $busiObj;
            
            //return $tcambio[0][0];
        } else {
            return false;
        }
    }

    public function deleteOlVenta($usuario) {
        $sql = 'DELETE FROM ol_venta WHERE usuario = "' . $usuario . '" AND fecha_proceso < "' . date('Y-m-d H:i:s') . '"';
        $this->_db->consulta($sql);

        return true;
    }

    public function auditor($user, $browser_web, $so) {
        $sql = 'INSERT INTO auditor (usuario, ip, browser, so)VALUES("' . $user . '", "' . $_SERVER['REMOTE_ADDR'] . '", "' . $browser_web . '", "' . $so . '") ';
        $this->_db->consulta($sql);

        return true;
    }

}