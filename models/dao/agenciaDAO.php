<?php

/* 
 * Proyecto : Euroandino.net
 * Autor    : Tsyacom Ltda.
 * Fecha    : Miercoles, 10 de octubre de 2014
 */

class agenciaDAO extends Model
{
    public function getAgencias($cod)
    {
        $sql='SELECT id, agencia, imagenv FROM agenc_na ';
        if($cod != 0)
        {
            $sql.=' WHERE id ='.$cod.''; 
        }
        
        $datos= $this->_db->consulta($sql);
        if($this->_db->numRows($datos)>0)
        {
            $agenciaArray= $this->_db->fetchAll($datos);
            $objetosAgencia= array();
            
            foreach ($agenciaArray as $agDB)
            {
                $objAgencia= new agenciaDTO();
                $objAgencia->setId(trim($agDB['id']));
                $objAgencia->setNombre(trim($agDB['agencia']));
                $objAgencia->setImagen(trim($agDB['imagenv']));
  
                $objetosAgencia[]= $objAgencia;
            }
            
            return $objetosAgencia;
        }
        else
        {
            return false;
        }
    }
    
    public function actualizaVoucherAgen($id, $imagen)
    {
        $sql='UPDATE agenc_na SET imagenv = "'.$imagen.'" WHERE id ='.$id;
        $this->_db->consulta($sql); 
        return true;
    }
}