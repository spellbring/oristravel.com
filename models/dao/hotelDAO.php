<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class hotelDAO extends Model
{
    public function __construct() {
        parent::__construct();
    }
        
    public function getCatHoteles($cod) {
        $sql = 'SELECT codigo, nombre FROM cath';
        if($cod != ''){
            $sql .= " WHERE codigo = '".$cod."' ";
        }     
        $sql.= ' ORDER BY nombre ASC';

        $datos = $this->_db->consulta($sql);
        if ($this->_db->numRows($datos) > 0) {
            
            $htlArray = $this->_db->fetchAll($datos);
            $objetosHtl = array();
            
            foreach ($htlArray as $htldb) {
                $htlObj = new hotelDTO();
                
                $htlObj->setCodCat(trim($htldb['codigo']));
                $htlObj->setCategoria(trim($htldb['nombre']));
                
                $objetosHtl[] = $htlObj;
            }
            
            return $objetosHtl;
            
            //return $this->_db->fetchAll($datos);
        } else {
            return false;
        }
    }

    public function getAdmHoteles($ciudad, $hotel, $cat) {
        $sql = 'SELECT * FROM hotel WHERE 1=1 ';

        if (!empty($ciudad)) {
            $sql.=' AND ciudad="' . $ciudad . '" ';
        }
        if (!empty($hotel)) {
            $sql.=' AND hotel LIKE "%' . $hotel . '%" ';
        }
        if (!empty($cat)) {
            $sql.=' AND cat="' . $cat . '" ';
            //$sql.=' AND pais="CHILE" ';
        }

        //echo $sql;

        $datos = $this->_db->consulta($sql);
        if ($this->_db->numRows($datos) > 0) {
            return $this->_db->fetchAll($datos);
        } else {
            return false;
        }
    }

    public function getCiudadesHot($id) {
        $sql = 'SELECT pais.nombre AS nombre_pais, pais.codigo AS codigo_pais, ciudad.nombre AS nombre_ciudad, ciudad.codigo AS codigo_ciudad '
                . 'FROM pais '
                . 'JOIN ciudad ON (pais.codigo = ciudad.codigop) ';
                if($id != ''){
                 $sql .= " WHERE ciudad.codigo = '" .$id."'";    
                }
                
        $sql .= ' ORDER BY ciudad.nombre ASC';        
              
                //. 'ciudad.nombre LIKE "%'.$nombre_h.'%" OR pais.nombre LIKE "%'.$nombre_h.'%" OR ciudad.codigo LIKE "%'.$nombre_h.'%" '
                //. 'ORDER BY ciudad.nombre ASC';

        $ciudadesHot = $this->_db->consulta($sql);
        if ($this->_db->numRows($ciudadesHot) > 0) {
            
            $htlArray = $this->_db->fetchAll($ciudadesHot);
            $objetosHtl = array();
            
            foreach ($htlArray as $htldb) {
                $htlObj = new hotelDTO();
                
                $htlObj->setCodPais(trim($htldb['codigo_pais']));
                $htlObj->setPais(trim($htldb['nombre_pais']));
                $htlObj->setCodCiudad(trim($htldb['codigo_ciudad']));
                $htlObj->setCiudad(trim($htldb['nombre_ciudad']));
                
                $objetosHtl[] = $htlObj;
            }
            
            return $objetosHtl;
            
            //return $this->_db->fetchAll($ciudadesHot);
        } else {
            return false;
        }
    }
    
     public function getHotel($codHotel)
    {// variables mysql no validas convert(varchar, nota) as Allot_web, marca_web, prepago, dias_prepago, comag
        $sql='SELECT codigo, hotel, pais, ciudad, fono, direc, cat, ope, nota, rut, dv, suc, fax, razon, nombre2, compve, compvn, compvr, prio, codsicon, codclisi, crubro, estado, 
	      timestamp_column, email, marca, usuariocrea, fechacrea, usuariomod, fechamod, marca_web_n, marca_web_R, Allot_web_n, Allot_web_R, Marca_Web_P, marca_sur, 
	      tipo_comag, femergen, fcomision, SWEB, restaurante, bar, cafeteria, s_habitacion, busness_center, internet_hotel, estacionamiento, piscina_cub, piscina_des, gym, 
	      spa, tenis, guarderia, salas_reunion, jardin, discapacitados, bautique, acondicionado, calefaccion, no_fuma, caja_fuerte, mini_bar, television, tv_cable, inter_hab, 
	      secador_pelo, barra_seguridad, lavanderia, telefono, img_encabezado, img_contenido, img_contenido2, img_contenido3, img_contenido4, mini_img_encabezado, 
	      mini_img_contenido, mini_img_contenido2, mini_img_contenido3, mini_img_contenido4, lat, lon, child_free
            FROM hotel WHERE codigo="'.$codHotel.'"';
        
        $datos= $this->_db->consulta($sql);
        if($this->_db->numRows($datos)>0)
        {
            $objetosHotel= array();
            $arrayHotel= $this->_db->fetchAll($datos);
            
            foreach ($arrayHotel as $hDB)
            {
                $objHotel= new hotelDTO();
                
                $objHotel->setCodigo(trim($hDB['codigo']));
                $objHotel->setHotel(trim($hDB['hotel']));
                $objHotel->setCat(trim($hDB['cat']));
                $objHotel->setLat(trim($hDB['lat']));
                $objHotel->setLon(trim($hDB['lon']));
                $objHotel->setDirec(trim($hDB['direc']));
                $objHotel->setSitioWeb(trim($hDB['SWEB']));
                
                
                $objHotel->setRestaurante(trim($hDB['restaurante']));
                $objHotel->setBar(trim($hDB['bar']));
                $objHotel->setCafeteria(trim($hDB['cafeteria']));
                $objHotel->setServHab(trim($hDB['s_habitacion']));
                $objHotel->setBusiness(trim($hDB['busness_center']));
                $objHotel->setInterHotel(trim($hDB['internet_hotel']));
                $objHotel->setEstaciona(trim($hDB['estacionamiento']));
                $objHotel->setPiscinaCub(trim($hDB['piscina_cub']));
                $objHotel->setPiscinaDes(trim($hDB['piscina_des']));
                $objHotel->setGym(trim($hDB['gym']));
                $objHotel->setSpa(trim($hDB['spa']));
                $objHotel->setTenis(trim($hDB['tenis']));
                $objHotel->setGuarderia(trim($hDB['guarderia']));
                $objHotel->setSalasReu(trim($hDB['salas_reunion']));
                $objHotel->setJardin(trim($hDB['jardin']));
                $objHotel->setDiscapacitados(trim($hDB['discapacitados']));
                $objHotel->setBoutique(trim($hDB['bautique']));
                $objHotel->setAcondicionado(trim($hDB['acondicionado']));
                $objHotel->setCalefaccion(trim($hDB['calefaccion']));
                $objHotel->setNoFuma(trim($hDB['no_fuma']));
                $objHotel->setCajaFuerte(trim($hDB['caja_fuerte']));
                $objHotel->setMiniBar(trim($hDB['mini_bar']));
                $objHotel->setTV(trim($hDB['television']));
                $objHotel->setTvCable(trim($hDB['tv_cable']));
                $objHotel->setInterHab(trim($hDB['inter_hab']));
                $objHotel->setSecador(trim($hDB['secador_pelo']));
                $objHotel->setBarraSeg(trim($hDB['barra_seguridad']));
                $objHotel->setLavanderia(trim($hDB['lavanderia']));
                $objHotel->setTelefono(trim($hDB['telefono']));
                $objHotel->setImgEnc(trim($hDB['img_encabezado']));
                $objHotel->setImgCont(trim($hDB['img_contenido']));
                $objHotel->setImgCont2(trim($hDB['img_contenido2']));
                $objHotel->setImgCont3(trim($hDB['img_contenido3']));
                $objHotel->setImgCont4(trim($hDB['img_contenido4']));
                /*$objHotel->setMiniImgEnc(trim($hDB['mini_img_encabezado']));
                $objHotel->setMiniImgCont(trim($hDB['mini_img_contenido']));
                $objHotel->setMiniImgCont2(trim($hDB['mini_img_contenido2']));
                $objHotel->setMiniImgCont3(trim($hDB['mini_img_contenido3']));
                $objHotel->setMiniImgCont4(trim($hDB['mini_img_contenido4']));*/
                
                
                
                $objetosHotel[]= $objHotel;
            }
            
            return $objetosHotel;
        }
        else
        {
            return false;
        }
        
        
    }
    public function exeSQL($sql)
    {
        $this->_db->consulta($sql);
    }
}
    
    
    

