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

}

?>