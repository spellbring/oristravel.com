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
    
    public function getCiudadesServ() {
        $sql = 'SELECT pais.nombre AS nombre_pais, pais.codigo AS codigo_pais, ciudad.nombre AS nombre_ciudad, ciudad.codigo AS codigo_ciudad '
                . 'FROM pais '
                . 'JOIN ciudad ON (pais.codigo = ciudad.codigop) '
                //. 'WHERE'
                //. 'ciudad.nombre LIKE "%'.$nombre_h.'%" OR pais.nombre LIKE "%'.$nombre_h.'%" OR ciudad.codigo LIKE "%'.$nombre_h.'%" '
                . 'ORDER BY ciudad.nombre ASC';

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
    
    public function getServicios(){
        $sql = 'SELECT numero, nombre FROM tablaser';
        
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
        
        $sql="SELECT servicio.nombre, 
                                    servicio.notas, 
                                    servicio.codigo,
                                    servicio.tipos,
                                    servicio.desde, 
                                    servicio.hasta, 
                                    servicio.ciudad,
                                    servicio.pais, 
                                    servicio.por, 
                                    servicio.conv, 
                                    det_ser.pax_i, 
                                    det_ser.pax_f,
                                    servicio.comcts,
                                    CASE WHEN det_ser.compv > 0
                                    THEN det_ser.compv
                                    ELSE servicio.compv
                                    END compv,
                                    servicio.moneda,
                                    servicio.ope,
                                    CASE 
                                    WHEN servicio.por=1 AND servicio.tcambio>0 AND servicio.moneda='P' THEN (det_ser.tarifa * ".$pax." ) / servicio.tcambio
                                    WHEN servicio.por=2 AND servicio.tcambio>0 AND servicio.moneda='P' THEN (det_ser.tarifa / ".$pax." ) / servicio.tcambio
                                    WHEN servicio.por=1 AND ".$t_cambio.">0 AND servicio.moneda='P' THEN (det_ser.tarifa * ".$pax." ) / ".$t_cambio." 
                                    WHEN servicio.por=2 AND ".$t_cambio.">0 AND servicio.moneda='P' THEN (det_ser.tarifa / ".$pax." ) / ".$t_cambio."
                                    WHEN servicio.por=1 AND servicio.moneda='D' THEN (det_ser.tarifa * ".$pax." ) 
                                    WHEN servicio.por=2 AND servicio.moneda='D' THEN (det_ser.tarifa / ".$pax.")
                                    END tarifa
        FROM servicio
        JOIN det_ser ON ( servicio.codigo = det_ser.codigo )
        WHERE estado != 'N'
        AND servicio.tipos = ".$servicios."
        AND ".$pax."  BETWEEN det_ser.pax_i AND det_ser.pax_f
        AND '".$f_servicio."' BETWEEN servicio.desde AND servicio.hasta
        
        AND servicio.ciudad = '".$nom_ciudad."'
        AND det_ser.tarifa > 0";

        $sql.=" AND ((servicio.id_agen= 0 OR servicio.id_agen= '') OR (servicio.id_agen= '". Session::get('sess_id_agencia')."'))";

        $sql.=" ORDER BY det_ser.tarifa ASC";
        //echo $sql;  
        $datos = $this->_db->consulta($sql);
        if($this->_db->numRows($datos)>0){
         
            $serviciosArray = $this->_db->fetchAll($datos);
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
            
        }
        else{
            
            return false;
        }

        
        
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
}