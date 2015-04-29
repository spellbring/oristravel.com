<?php

/* 
 * Proyecto : Allways
 * Autor    : Tsyacom Ltda.
 * Fecha    : Martes, 4 de marzo de 2014
 */

class bookingDAO extends Model
{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getConsRes($desde, $hasta, $tipoFecha, $idAgencia, $tipoUser, $usuario) {
        $sql = "SELECT booking.id_booking,
                    booking.voucher,
                    DATE_FORMAT(booking.fecha,'%d/%m/%Y') AS fecha,
                    DATE_FORMAT(booking.fecha_in,'%d/%m/%Y') AS fecha_in,
                    booking.nombre_pax,
                    booking.total,
                    booking.moneda,
                    booking.vuelo_in,
                    booking.estado,
                    booking.glosa,
                    usuarios.nombre,
                    usuarios.apellido,
                    agenc_na.agencia

                    FROM booking
                    JOIN agenc_na ON (agenc_na.id=booking.id_agencia)
                    JOIN usuarios ON (usuarios.id=booking.id_usuario)
                    WHERE 1=1 ";
        //Session::getLevel('Admin');
        if ($tipoUser == 3) {
            $sql.=" AND login = '" . $usuario . "' AND booking.id_agencia=" . $idAgencia . " ";
        } else if ($tipoUser == 2) {
            $sql.=" AND booking.id_agencia=" . $idAgencia . " ";
        }


        if ($tipoFecha == 1) {
            $sql.=" AND fecha BETWEEN '" . $desde . "' AND '" . $hasta . "' ";
        } elseif ($tipoFecha == 2) {
            $sql.=" AND fecha_in BETWEEN '" . $desde . "' AND '" . $hasta . "' ";
        }


        if ($tipoFecha == 1) {
            $sql.=" ORDER BY fecha,id_booking ASC";
        } elseif ($tipoFecha == 2) {
            $sql.=" ORDER BY fecha_in,id_booking ASC";
        }

        //echo $sql;

        $datos = $this->_db->consulta($sql);
        if ($this->_db->numRows($datos) > 0) {
            
            $bookArray = $this->_db->fetchAll($datos);
            $objetosBook = array();
            
            foreach ($bookArray as $bookdb) {
                $bookObj = new bookingDTO();
                
                $bookObj->setId(trim($bookdb['id_booking']));
                $bookObj->setVoucher(trim($bookdb['voucher']));
                $bookObj->setFecha(trim($bookdb['fecha']));
                $bookObj->setFechaIn(trim($bookdb['fecha_in']));
                $bookObj->setNomPax(trim($bookdb['nombre_pax']));
                $bookObj->setTotal(trim($bookdb['total']));
                $bookObj->setMoneda(trim($bookdb['moneda']));
                $bookObj->setVueloIn(trim($bookdb['vuelo_in']));
                $bookObj->setEstado(trim($bookdb['estado']));
                $bookObj->setGlosa(trim($bookdb['glosa']));
                $bookObj->setNombreUser(trim($bookdb['nombre']));
                $bookObj->setApellidoUser(trim($bookdb['apellido']));
                $bookObj->setAgencia(trim($bookdb['agencia']));
                
                $objetosBook[] = $bookObj;
            }
            
            return $objetosBook;
            
            //return $this->_db->fetchAll($datos);
        } else {
            return false;
        }
    }
    
    public function getBooking($cod){// booking.total,
    
    $BK_sql='SELECT booking.id_booking,
                    agenc_na.agencia, 
                    booking.nombre_pax,
                    booking.fecha_anula,
                    usuarios.nombre,
                    usuarios.apellido,
                    booking.fecha_in,
                    dbooking.registro,
                    booking.moneda

             FROM   agenc_na, booking, usuarios, dbooking

             WHERE  agenc_na.id = booking.id_agencia
             
             AND    dbooking.id_booking = booking.id_booking

             AND    booking.id_usuario = usuarios.id
             
             AND    booking.id_booking = "'.$cod.'"';
    
    //echo $BK_sql;
    
    $datos = $this->_db->consulta($BK_sql);
    
    if ($this->_db->numRows($datos) > 0) {
        $bookArray = $this->_db->fetchAll($datos);
        $objetosBook = array();
        foreach($bookArray as $bookdb){
            $bookObj = new bookingDTO();
            
            $bookObj->setId(trim($bookdb['id_booking']));    
            $bookObj->setAgencia(trim($bookdb['agencia']));
            $bookObj->setNomPax(trim($bookdb['nombre_pax']));
            $bookObj->setFecha_Anul(trim($bookdb['fecha_anula']));
            $bookObj->setNombreUser(trim($bookdb['nombre']));
            $bookObj->setApellidoUser(trim($bookdb['apellido']));
            $bookObj->setFechaIn(trim($bookdb['fecha_in']));
            $bookObj->setRegistro(trim($bookdb['registro']));
            $bookObj->setMoneda(trim($bookdb['moneda']));
            //$bookObj->setTotal(trim($bookdb['total']));
        }
        $objetosBook[] = $bookObj; 
        return $objetosBook; 
    }
    
    else{
        
     return false;   
    }
        
        
    }
    
    public function getDbooking($cod){
    $DBK_sql='SELECT    dbooking.st, 
                        dbooking.hotel,
                        dbooking.tipoh,
                        dbooking.pa,
                        dbooking.tot_hab,
                        dbooking.tot_pax,
                        dbooking.tot_child_1,
                        dbooking.ciudad,
                        dbooking.fecha_in,
                        dbooking.fecha_out,
                        dbooking.total_venta
       
              FROM      dbooking

              WHERE     id_booking = "'.$cod.'"';
    
    //echo $DBK_sql;
    
    $datos = $this->_db->consulta($DBK_sql); 
     
        if ($this->_db->numRows($datos) > 0) {
           $bookArray = $this->_db->fetchAll($datos);
           $objetosBook = array();
           foreach($bookArray as $bookdb){
               $bookObj = new bookingDTO();
               
               $bookObj->setEstado($bookdb['st']);
               $bookObj->setHotel($bookdb['hotel']);
               $bookObj->setTipoh($bookdb['tipoh']);
               $bookObj->setPa($bookdb['pa']);
               $bookObj->setTot_hab($bookdb['tot_hab']);
               $bookObj->setTot_pax($bookdb['tot_pax']);
               $bookObj->setTot_child1($bookdb['tot_child_1']);
               $bookObj->setCiudad($bookdb['ciudad']);
               $bookObj->setFechaIn($bookdb['fecha_in']);
               $bookObj->setFecha_out($bookdb['fecha_out']);
               $bookObj->setTotal_venta($bookdb['total_venta']);
               $objetosBook[] = $bookObj; 
              
           }
            return $objetosBook; 
           

         }
        else{    
        
        return false;   
      }
      }
   public function getPbooking($cod){
     $PBK_sql = 'SELECT  nombre, 
                         apellido, 
                         hab, 
                         nhab

                 FROM    pbooking

                 WHERE   tipo_pax = "A" AND id_booking = "'.$cod.'" order by hab asc';
     
     $datos = $this->_db->consulta($PBK_sql); 
     
        if ($this->_db->numRows($datos) > 0) {
           $bookArray = $this->_db->fetchAll($datos);
           $objetosBook = array();
           foreach($bookArray as $bookdb){
              $bookObj = new bookingDTO();
              
              $bookObj->setNomPax($bookdb['nombre']);
              $bookObj->setApellido_pax($bookdb['apellido']);
              $bookObj->setHab($bookdb['hab']);
              $bookObj->setNhab($bookdb['nhab']);
              
              $objetosBook[] = $bookObj; 
               
           }
           return $objetosBook;
           
        }
        else{
            return false;
            
        }
        
   }
    
}
?>