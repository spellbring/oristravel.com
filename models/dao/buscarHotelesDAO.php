<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class buscarHotelesDAO extends Model
{
    public function getHoteles($idUs, $ciudad, $fechain, $fechaout, $grupo, $cantHab, $cantS, $cantD, $cantT, $cantC, $cantChild)
    {
        $sql= "CALL get_hoteles(".$idUs.",'".$ciudad."','".$fechain."','".$fechaout."','".$grupo."',".$cantHab.",".$cantS.",".$cantD.",".$cantT.",".$cantC.",".$cantChild.")";
        //echo $sql;
        
        $this->_db->consultaSP($sql);

        /*if($this->_db->numRows($datos)>0)
        {*/
            $arrayHoteles = $this->_db->fetchAllSP();
            $objetosHoteles = array();

            foreach($arrayHoteles as $objarrHot)
            {
                $objHoteles = new buscarHotelesDTO();

                $objHoteles->setUsuario($objarrHot['usuario']);
                $objHoteles->setNota($objarrHot['nota']);
                $objHoteles->setTipoh($objarrHot['tipoh']);
                $objHoteles->setCat($objarrHot['cat']);
                $objHoteles->setPalimt($objarrHot['palimt']);
                $objHoteles->setPrecioFinal($objarrHot['precio_final']);
                $objHoteles->setCompv($objarrHot['compv']);
                $objHoteles->setComcts($objarrHot['comcts']);
                $objHoteles->setDgcomag($objarrHot['dgcomag']);
                $objHoteles->setCodigoHtl($objarrHot['codigo_htl']);





                $objHoteles->setHotel($this->_llenarHotel(trim($objarrHot['codigo_htl'])));





                $objHoteles->setCodProvee($objarrHot['cod_provee']);
                $objHoteles->setTotal_hab($objarrHot['total_hab']);
                $objHoteles->setTotPax($objarrHot['tot_pax']);
                $objHoteles->setTotalNeto($objarrHot['total_neto']);
                $objHoteles->setTotalVenta($objarrHot['total_venta']);
                $objHoteles->setNumDias($objarrHot['num_dias']);
                $objHoteles->setMoneda($objarrHot['moneda']);
                $objHoteles->setStatus($objarrHot['status']);
                $objHoteles->setTarifaIG($objarrHot['tarifa_i_g']);

                $objetosHoteles[]=$objHoteles;
            }
         
          return $objetosHoteles;                    
        /*}
        else 
        {        
           return false;            
        }*/

    }
    
    
    
    
    
    
    
    
    
    public function _llenarHotel($cod) {
        $sql = 'SELECT * FROM hotel WHERE codigo = ' . $cod;
        //echo $sql;
        $datos = $this->_db->consulta($sql);
        $objetosHotel = array();
        if($this->_db->numRows($datos)>0) {
            $arrayHotel = $this->_db->fetchAll($datos);
            foreach($arrayHotel as $dbHotel) {
                $objHotel = new hotelDTO();
                $objHotel->setNombre(trim($dbHotel['hotel']));
                $objHotel->setCiudad(trim($dbHotel['ciudad']));
                $objHotel->setCat(trim($dbHotel['cat']));
                $objHotel->setImgEnc(trim($dbHotel['img_encabezado']));
                $objHotel->setDirec(trim($dbHotel['direc']));
                //servicios de hotel
                $objHotel->setRestaurante(trim($dbHotel['restaurante']));
                $objHotel->setBar(trim($dbHotel['bar']));
                $objHotel->setCafeteria(trim($dbHotel['cafeteria']));
                $objHotel->setServHab(trim($dbHotel['s_habitacion']));
                $objHotel->setDiscapacitados(trim($dbHotel['discapacitados']));
                $objHotel->setLavanderia(trim($dbHotel['lavanderia']));
                $objHotel->setBusiness(trim($dbHotel['busness_center']));
                $objHotel->setInterHotel(trim($dbHotel['internet_hotel']));
                $objHotel->setEstaciona(trim($dbHotel['estacionamiento']));
                $objHotel->setBoutique(trim($dbHotel['bautique']));
                $objHotel->setPiscinaDes(trim($dbHotel['piscina_des']));
                $objHotel->setSpa(trim($dbHotel['spa'])); 
                $objHotel->setGym(trim($dbHotel['gym']));
                $objHotel->setPiscinaCub(trim($dbHotel['piscina_cub']));    
                $objHotel->setTenis(trim($dbHotel['tenis']));
                $objHotel->setGuarderia(trim($dbHotel['guarderia']));
                $objHotel->setSalasReu(trim($dbHotel['salas_reunion']));
                $objHotel->setJardin(trim($dbHotel['jardin']));
                //servicios habitación
                
                $objHotel->setAcondicionado(trim($dbHotel['acondicionado']));
                $objHotel->setCalefaccion(trim($dbHotel['calefaccion']));
                $objHotel->setNoFuma(trim($dbHotel['no_fuma']));
                $objHotel->setCajaFuerte(trim($dbHotel['caja_fuerte']));
                $objHotel->setMiniBar(trim($dbHotel['mini_bar']));
                $objHotel->setTV(trim($dbHotel['television']));
                $objHotel->setTvCable(trim($dbHotel['tv_cable']));
                $objHotel->setTelefono(trim($dbHotel['telefono']));
                $objHotel->setInterHab(trim($dbHotel['inter_hab']));
                $objHotel->setSecador(trim($dbHotel['secador_pelo']));
                $objHotel->setBarraSeg(trim($dbHotel['barra_seguridad']));
                
                $objHotel->setLat(trim($dbHotel['lat']));
                $objHotel->setLon(trim($dbHotel['lon']));
                
                
                
               
                
                $objetosHotel[] = $objHotel;
            }
            
            //$this->_db->closeConex();
            return $objetosHotel;
            
        } else {
            return false;
        }
    }
    
}
