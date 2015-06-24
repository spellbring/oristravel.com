<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class servicioDAO extends Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function getCiudadesServ($id) {
           $sql = 'SELECT pais.nombre AS nombre_pais, pais.codigo AS codigo_pais, ciudad.nombre AS nombre_ciudad, ciudad.codigo AS codigo_ciudad '
                . 'FROM pais '
                . 'JOIN ciudad ON (pais.codigo = ciudad.codigop) ';
                if($id != ''){
                 $sql .= 'WHERE codigo_ciudad = ' .$id.'';    
                }
                
        $sql .= ' ORDER BY ciudad.nombre ASC';  
        
      // echo $sql; 

        $ciudadesServ = $this->_db->consulta($sql);
        if ($this->_db->numRows($ciudadesServ) > 0) {
            
            $servArray = $this->_db->fetchAll($ciudadesServ);
            $objetosServ = array();
            
            foreach ($servArray as $servdb) {
                $servObj = new servicioDTO();
                
                $servObj->setCodPais(trim($servdb['codigo_pais']));
                $servObj->setPais(trim($servdb['nombre_pais']));
                $servObj->setCodCiudad(trim($servdb['codigo_ciudad']));
                $servObj->setCiudad(trim($servdb['nombre_ciudad']));
                
                $objetosServ[] = $servObj;
            }
            
            return $objetosServ;
            //return $this->_db->fetchAll($ciudadesServ);
            
        } else {
            return false;
        }
    }
    
    public function getServicios($id){
        $sql = 'SELECT numero, nombre FROM tablaser';
        if($id!= ''){
        $sql .=' WHERE numero ='.$id;
        }
        //echo $sql;
        $serv= $this->_db->consulta($sql);
        if($this->_db->numRows($serv)> 0){
            
            $servArray = $this->_db->fetchAll($serv);
            $objetosServ = array();
            
            foreach($servArray as $objServAr){
                $servObj = new servicioDTO();
                
                $servObj->setNumero(trim($objServAr['numero']));
                $servObj->setNombre(trim($objServAr['nombre']));
                
               $objetosServ[] = $servObj;
                
            }
            
            return $objetosServ;
            
        }
        else{
            return false;
        }
           
    }
    
    public function getBuscarServicios(){//AND servicio.pais = '".$nom_pais['nombre']."'
        
        $pax = Session::get('sess_sum_paxSer');
        $servicios = Session::get('sess_sBP_serv');
        $f_servicio = Funciones::invertirFecha(Session::get('sess_sBP_fechaIn'), '/', '-');
        $nom_ciudad = Session::get('sess_sCH_ciudad');
        $t_cambio = Session::get('sess_t_cambioServ');
 
         $sql = "CALL get_servicios(".$pax.", ".$servicios.",'".$f_servicio."','".$nom_ciudad."',".$t_cambio.",".Session::get('sess_id_agencia').")";  
         $datos = $this->_db->consultaSP($sql);
        //if($this->_db->numRows($datos)>0){
         
            $serviciosArray = $this->_db->fetchAllSP($datos);
            $arrayObjSer = array();
            foreach($serviciosArray as $serObj){
               $objServ = new servicioDTO();
               $objServ->setNombre($serObj['nombre']);
               $objServ->setNotas($serObj['notas']);
               $objServ->setCodigo($serObj['codigo']);
               
               $objTipoSer = $this->getServiciosNum($serObj['tipos']);
               $objServ->setTipos($objTipoSer);
               $objServ->setDesde($serObj['desde']);
               $objServ->setHasta($serObj['hasta']);
               $objServ->setCiudad($serObj['ciudad']);
               $objServ->setPais($serObj['pais']);
               $objServ->setPor($serObj['por']);
               $objServ->setConv($serObj['conv']);
               $objServ->setDSpax_i($serObj['pax_i']);
               $objServ->setDSpax_f($serObj['pax_f']);
               $objServ->setComcts($serObj['comcts']);
               $objServ->setCompv($serObj['compv']);
               $objServ->setMoneda($serObj['moneda']);
               $objServ->setMoneda($serObj['moneda']);
               $objServ->setOpe($serObj['ope']);
               $objServ->setTarifa($serObj['tarifa']);
               //$objDgcomag = $this->getDgComac($objTipoSer);
               //$objServ->setDgcomac($objDgcomag);
               
              $arrayObjSer[] =  $objServ;
               
               
            }
            
            return $arrayObjSer;
            
        //}
        //else{
            
            //return false;
        //}

        
        
    }
    
    public function getServiciosNum($num){
        $sql = 'SELECT codigo FROM tablaser WHERE numero ='.$num;
        
        $serv= $this->_db->consulta($sql);
        if($this->_db->numRows($serv)> 0){
            
            $servArray = $this->_db->fetchAll($serv);
            $objetosServ = array();
            
            foreach($servArray as $objServAr){
                $servObj = new servicioDTO();
                
                $servObj->setCodigo(trim($objServAr['codigo']));
               
                
               $objetosServ[] = $servObj;
                
            }
            
            return $objetosServ;
            
        }
        else{
            return false;
        }
        
    }
    
    public function getDgComac($codigo){
        $sql = "SELECT comag FROM dgcomag WHERE codigo = '".Session::get('sess_grupo')."' and tipo = '".$codigo."'";
        //echo $sql;
        $datos = $this->_db->consulta($sql);
        
        if($this->_db->numRows($datos)>0){
            $fetchArray = $this->_db->fetchAll($datos);
            $array = array();
            
            foreach($fetchArray as $dgComag){
                $objDgComac = new servicioDTO();
                
                $objDgComac->setDgcomac($dgComag['comag']);
                
                $array[] = $objDgComac;
            }
            return $array;
        }
        else{
            return false;
        }
        
    }
    
    
    public function traeCambio(){
     $sql = 'select cambio from tcambio where curdate() between fechad and fechah limit 0,1';  
     $datos = $this->_db->consulta($sql);
     
        if($this->_db->numRows($datos)> 0){
            $arrayCambio = $this->_db->fetchAll($datos);
            $array = array();
            foreach($arrayCambio as $arrCambio){
                $servCambio = new servicioDTO();
                
                $servCambio->setTcambio($arrCambio['cambio']);
                $arrayC[] = $servCambio;
            }
            return $arrayC;

        }
        else{
            return false;
        }
    
    }
    
    public function getAdminServicios($ciudad, $serv){
      $sql = 'SELECT codigo, nombre, ciudad, tipos FROM servicio';
      if($ciudad != '' && $serv != '' ){
          $sql.= " WHERE ciudad = '".$ciudad."' and tipos = ".$serv.""; 
      }
      if($ciudad != '' && $serv == ''){
        $sql.= " WHERE ciudad = '".$ciudad."'";  
      }
      if($serv != '' && $ciudad == ''){
        $sql.= " WHERE tipos = ".$serv."";  
      }
      //echo $sql;
      $datos = $this->_db->consulta($sql);
        if($this->_db->numRows($datos)>0){
            $arrayServicios = $this->_db->fetchAll($datos);
            $array = array();
            foreach($arrayServicios as $arrServ){
                $objServ = new servicioDTO();
                $objServ->setCodigo($arrServ['codigo']);
                $objServ->setNombre($arrServ['nombre']);
                $objServ->setCiudad($arrServ['ciudad']);
                $objServ->setTipos($arrServ['tipos']);
             $array[] = $objServ; 
                
            }
           return $array; 
        }
        else{
            return false;
        }
        
    }
    
    public function traeDescripcionServ($id){
        
        $sql = "SELECT codigo,descripcion FROM h2h_servicios";
        if($id != ''){
            $sql .= " WHERE codigo = ".$id;  
        }
        
       //echo $sql;
       $datos = $this->_db->consulta($sql);
        if($this->_db->numRows($datos)> 0){
            
             $objetosPacke = array();
            $arrayDescripcion =  $this->_db->fetchAll($datos);
            
            foreach($arrayDescripcion as $descDB){
                $objDescripcion = new servicioDTO();
                $objDescripcion->setCodigo(trim($descDB['codigo']));
                $objDescripcion->setNotas(trim($descDB['descripcion']));   
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