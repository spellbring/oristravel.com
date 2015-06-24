<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class programaDAO extends Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function getCiudadesPRG() {//WHERE pais.nombre =  '".$asd."'
        $sql = "SELECT pais.nombre AS nombre_pais, pais.codigo AS codigo_pais, ciudad.nombre AS nombre_ciudad, ciudad.codigo AS codigo_ciudad 
                FROM pais 
                JOIN ciudad ON (pais.codigo = ciudad.codigop) 
                 
                 ORDER BY ciudad.nombre ASC";

        $ciudadesProg = $this->_db->consulta($sql);
        if ($this->_db->numRows($ciudadesProg) > 0) {
            $prgArray = $this->_db->fetchAll($ciudadesProg);
            $objetosPRG = array();

            foreach ($prgArray as $prgdb) {
                $prgObj = new programaDTO();
                
                $prgObj->setCodPais(trim($prgdb['codigo_pais']));
                $prgObj->setPais(trim($prgdb['nombre_pais']));
                $prgObj->setCodCiudad(trim($prgdb['codigo_ciudad']));
                $prgObj->setCiudad(trim($prgdb['nombre_ciudad']));
                
                $objetosPRG[] = $prgObj;
            }

            return $objetosPRG;
            //return $this->_db->fetchAll($ciudadesProg);
        } else {
            return false;
        }
    }
    
    public function getAdmProgramas()// cuando son dos condicionales en una busqueda
    {
        

        $sql="SELECT P.id, P.nombre, P.codigo, C.nombre AS nombreC
            FROM h2h_programa P
            JOIN ciudad	C ON (C.codigo = P.Ciudad)
             
            WHERE C.nombre = '" . Session::get('sess_prog_Ciudad') ."'
	    ORDER BY P.nombre ASC";
           
        //echo $sql;
        $datos= $this->_db->consulta($sql);
        
        if($this->_db->numRows($datos)>0)
        {
            
            $objetosPack= array();
            $arrayPackages= $this->_db->fetchAll($datos);
            
            foreach ($arrayPackages as $packDB)
            {
                $objPackages= new programaDTO();
                
                $objPackages->setCodigo(trim($packDB['codigo']));
                $objPackages->setNombre(trim($packDB['nombre']));
                $objPackages->setId(trim($packDB['id']));
                $objPackages->setCiudad(trim($packDB['nombreC']));
                
                $objetosPack[]= $objPackages;
            }
            
            return $objetosPack;
        }
        else
        {
            return false;
        }
    }
    
    public function traeDescripcion($id){
       $sql = "SELECT descripcion FROM h2h_pdfprog WHERE codigo = '".$id."'";
       //echo $sql;
       $datos = $this->_db->consulta($sql);
        if($this->_db->numRows($datos)> 0){
            
             $objetosPacke = array();
            $arrayDescripcion =  $this->_db->fetchAll($datos);
            
            foreach($arrayDescripcion as $descDB){
                $objDescripcion = new programaDTO();

                $objDescripcion->setDescripcion(trim($descDB['descripcion']));   
                $objetosPacke[] = $objDescripcion;
                
            }
            
            return $objetosPacke;
        }
        else{
            return false;
        }
        
    }
    
    public function exeSQL($sql)
    {
        $this->_db->consulta($sql);
        return true;
    
    }
    
    

}