<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */


//include ("../conex/mysql.conex.php");

$conex	=	@mysql_connect (DB_HOST, DB_USER, DB_PASS);			
			@mysql_select_db (DB_NAME);
			@mysql_set_charset('utf8',$conex);

//include('fpdf.php');
//include('pdf_html.php');

// Diseño del PDF //
$id_booking = $id; //$_GET['id'];
$tipo_servicio = "";
$row3 = "";

$sql = '
	select dbooking.hotel, dbooking.registro,
	booking.nombre_pax,
	dbooking.num_dias, dbooking.tipoh, dbooking.pa,
	dbooking.codigo_htl, dbooking.cod_provee, dbooking.vuelo,
	dbooking.fecha_in, dbooking.fecha_out, dbooking.tipo_ser,
	dbooking.id_booking, dbooking.tot_pax, dbooking.cod_provee,
	dbooking.tot_pax_1, dbooking.tot_pax_2, dbooking.tot_pax_3,
	dbooking.tot_child_1, dbooking.tot_child_2, dbooking.tot_child_3,
	dbooking.voucher, dbooking.fecha_emi, dbooking.nconf,
	agenc_na.imagen, agenc_na.id, agenc_na.agencia, dbooking.linea
	from dbooking, booking, agenc_na
	where
	dbooking.id_booking = booking.id_booking
	and booking.id_agencia = agenc_na.id
	and dbooking.id_booking = '.$id_booking.'
	AND dbooking.tipo_ser <> "PRG"
	;';

// Datos de la compañia
$direccion = ENT_DIREC;//$_SESSION['direccion_emp_xml'];
$comuna = ENT_COMUNA;//$_SESSION['comuna_emp_xml'];
$ciudad = ENT_CIUDAD; //$_SESSION['ciudad_emp_xml'];	
$telefono = ENT_FONO; //$_SESSION['fono_xml'];

$res = mysql_query($sql, $conex);

$res3="";
$row3="";

if($res)
{
	$cantidad = mysql_num_rows($res);
	if($cantidad > 0)
	{
		$contador = 0;
		//$pdf= new PDF('P', 'mm','letter');
		$pdf->AddPage();
		$pos_imagen = 25;
		$pos_celda = 0;
		$fechaActual = date("Y-m-d");
		$fechaActual = '2001-02-03';
		while($row = mysql_fetch_array($res))
		{
			///////////////// Recopilacion de DATOS /////////////////////
			
			// Validar cantidad habitaciones
			$hab1 = $row['tot_pax_1'];
			$hab2 = $row['tot_pax_2'];
			$hab3 = $row['tot_pax_3'];
			
			$simple = 0;
			$double = 0;
			$triple = 0;
			$cuadruple = 0;
			
			// Validar Habitacion 1
			if($hab1 == 1)
				$simple++;
			elseif($hab1 == 2)
				$double++;
			elseif($hab1 == 3)
				$triple++;
			elseif($hab1 == 4)
				$cuadruple++;
				
			// Validar Habitacion 2
			if($hab2 == 1)
				$simple++;
			elseif($hab2 == 2)
				$double++;
			elseif($hab2 == 3)
				$triple++;
			elseif($hab2 == 4)
				$cuadruple++;
				
			// Validar Habitacion 3
			if($hab3 == 1)
				$simple++;
			elseif($hab3 == 2)
				$double++;
			elseif($hab3 == 3)
				$triple++;
			elseif($hab3 == 4)
				$cuadruple++;
				
			// Suma pasajeros
			$sumaPasajeros = ($simple * 1) + ($double * 2) + ($triple * 3) + ($cuadruple * 4);
				
			// Validar Cantidad de Niños
			$totalNinos = 0;
			if($row['tot_child_1'])
				$totalNinos = $totalNinos + $row['tot_child_1'];
			if($row['tot_child_2'])
				$totalNinos = $totalNinos + $row['tot_child_2'];
			if($row['tot_child_3'])
				$totalNinos = $totalNinos + $row['tot_child_3'];
		
		
			// Preguntar si es HOTEL
			if($row['tipo_ser'] == "HTL")
			{
				$tipo_servicio = "HTL";
				$sql3 = "select hotel.hotel, hotel.direc, hotel.ciudad, hotel.fono
					from hotel where hotel.codigo = ".$row['codigo_htl'].";";
				// echo $sql3."<br />";
				$res3 = mysql_query($sql3, $conex);
				$row3 = mysql_fetch_array($res3);
			}
			else
				$tipo_servicio = "";
			// Obtener encargado de PRE-PAGO
			
			$prov = "";
			$prov_fono = "";
			$prov_direc = "";
			$prov_ciudad = "";
			$prov_pais = "";
			if($row['cod_provee'] == "" || $row['cod_provee'] == NULL)
			{
				$sql2 = 'select nombre, direc, fono, ciudad, pais from proveedores where codigo = "'. ENT_OPERADOR .'";';
				$result = mysql_query($sql2, $conex);
				$row2 = mysql_fetch_array($result);
				$prov = $row2['nombre'];
				$prov_fono = $row2['fono'];
				$prov_direc = $row2['direc'];
				$prov_ciudad = $row2['ciudad'];
				$prov_pais = $row2['pais'];
			}
			else
			{
				$sql2 = 'select nombre, direc, fono, ciudad, pais from proveedores where codigo = "'.$row['cod_provee'].'";';
				$result = mysql_query($sql2, $conex);
				$row2 = mysql_fetch_array($result);
				$prov = $row2['nombre'];
				$prov_fono = $row2['fono'];
				$prov_direc = $row2['direc'];
				$prov_ciudad = $row2['ciudad'];
				$prov_pais = $row2['pais'];
			}
			
			// Obtener VOUCHER
			$voucher= "";
			if($row['voucher'] == "" || $row['voucher'] == NULL)
			{
				$sql2 = 'select max(voucher) as maximo from dbooking;';
				$result = mysql_query($sql2, $conex);
				$row2 = mysql_fetch_array($result);
				$maximo = $row2['maximo'];
				if($maximo == NULL || $maximo == "" || $maximo == 0)
					$maximo = 1;
				else
					$maximo= $maximo + 1;
					
				$sql3 = " update dbooking set voucher = '".$maximo."',
				fecha_emi = '".$fechaActual."'
				where id_booking = '".$row["id_booking"]."'
				and linea= '".$row['linea']."'
				;";
				
				$result = mysql_query($sql3, $conex);
				$voucher = $maximo;
			}
			else
				$voucher= $row['voucher'];
			
			////////////////// Generar PDF /////////////////////////
			$contador = $contador + 1;
			if($contador > 3)
			{
				$pdf->AddPage();
				$pos_imagen = 25;
				$contador = 1;
			}
			
			$pdf->SetLeftMargin(20);
			$pdf->SetFontSize(12);
			$pdf->Cell(200, 10, "", 0, 'L');
			$pdf->Ln();
			
			$pdf->SetLeftMargin(20);
			$pdf->SetFontSize(8);
			if($row['imagen'] == "" || $row['imagen'] == NULL)
				$pdf->Image($ruta_img . 'logovoucher.jpg', 20, $pos_imagen-5, 40, 18);
			else
				$pdf->Image("../logos/".$row['imagen'], 20, $pos_imagen-5, 40, 18);

			$pdf->Cell(40, 18, "", LT, R);
			
			// Direccion (Calle)
			$pdf->SetLeftMargin(20);
			$pdf->SetFontSize(8);
			$pdf->Cell(40, 9, $direccion." - ".$comuna, TR, 'C');
			
			// Numero voucher
			$pdf->SetFont('Arial');
			$pdf->Cell(15, 9, "Voucher: ", LTB, 'C');
			$pdf->SetFont('Arial', B);
			$pdf->Cell(25, 9, Funciones::add_ceros($voucher, 6), TBR, 'C');
			
			// Numero Archivo
			$pdf->SetFont('Arial');
			$pdf->Cell(15, 9, "File:", LTB, 'C');
			$pdf->SetFont('Arial', B);
			$pdf->Cell(25, 9, Funciones::add_ceros($row['id_booking'], 6), TBR, 'C');
			$pdf->Cell(0, 6, "", 0, 0);
			$pdf->Ln();
			
			// Direccion (Comuna)
			$pdf->SetFont('Arial');
			$pdf->Cell(40, 6, "", 0, R);
			$pdf->Cell(40, 6, $ciudad, R, 'L');
			// Fecha
			$pdf->SetFont('Arial');
			$pdf->Cell(30, 12, "Issue Date:", LB, C);
			$pdf->SetFont('Arial', B);
                        $freg="";
                        $freg= explode(" ", $row['registro']);
			$pdf->Cell(50, 12, Funciones::invertirFecha($freg[0], '-', '/'), BR, C);
			$pdf->Cell(0, 6, "", 0, 0);
			$pdf->Ln();
			
			// Telefono
			$pdf->SetFont('Arial');
			$pdf->Cell(40, 6, "", 0, R);
			$pdf->Cell(40, 3, "Phone ".$telefono, R, L);
			$pdf->Cell(0, 6, "", 0, R);
			$pdf->Ln();
			
			// PARA ......... //
			if($tipo_servicio == "HTL")
			{
				$pdf->SetFont('Arial');
				$pdf->Cell(15, 4, "To: ", LT, L);
				$pdf->SetFont('Arial', B);
				$pdf->Cell(70, 4, $row['hotel'], RT, L);
				$pdf->SetFont('Arial');
				$pdf->Cell(15, 4, "Mr/Ms", 0, L);
				$pdf->SetFont('Arial', B);
				$pdf->Cell(60, 4, $row['nombre_pax'], R, L);
				$pdf->Ln();
				
				$pdf->SetFont('Arial');
				$pdf->Cell(15, 4, " ", L, L);
				$pdf->SetFont('Arial', B);
				$pdf->Cell(70, 4, $row3['direc'], R, L);
				if($totalNinos > 0)
					$pdf->Cell(75, 4, "        0".($sumaPasajeros)." Passenger(s) + 0".($totalNinos)." Child(s)", R, L);
				else
					$pdf->Cell(75, 4, "        0".($sumaPasajeros)." Passenger(s)", R, L);
				$pdf->Ln();
				
				$pdf->SetFont('Arial');
				$pdf->Cell(15, 4, " ", L, L);
				$pdf->SetFont('Arial', B);
				$pdf->Cell(70, 4, $row3['ciudad'], R, L);
				$pdf->Cell(75, 4, "", R, L);
				$pdf->Ln();
				
				$pdf->SetFont('Arial');
				
				$pdf->Cell(15, 4, "Phone:", LB, L);
				$pdf->SetFont('Arial', B);
				$pdf->Cell(70, 4, $row3['fono'], RB, L);
				$pdf->Cell(75, 4, "", RB, L);
				$pdf->Ln();
			}
			else // Cualquier otro servicio que no sea hotel
			{	
				$pdf->SetFont('Arial');
				$pdf->Cell(15, 4, "Prov: ", LT, L);
				if($row['codigo_htl'] != "" && $row['codigo_htl'] == NULL && $row['codigo_htl'] != "0")
				{	
					$sql4 = "select
						hotel.direc, hotel.ciudad, hotel.fono
						from hotel, dbooking
						where dbooking.codigo_htl = hotel.codigo
						and dbooking.id_booking = ".$id_booking.";";
					$res4 = mysql_query($sql4, $conex);
					$row4 = mysql_fetch_array($res4);
			
					$pdf->SetFont('Arial', B);
					$pdf->Cell(70, 4, $row['hotel'], TR, L);
					$pdf->SetFont('Arial');
					$pdf->Cell(15, 4, "Mr/Ms", 0, L);
					$pdf->SetFont('Arial', B);
					$pdf->Cell(60, 4, $row['nombre_pax'], R, L);
					$pdf->Ln();
					
					$pdf->SetFont('Arial');
					$pdf->Cell(15, 4, " ", L, L);
					$pdf->SetFont('Arial', B);
					$pdf->Cell(70, 4, $row4['direc'], R, L);
					if($totalNinos > 0)
						$pdf->Cell(75, 4, "        0".($sumaPasajeros)." Passenger(s) + 0".($totalNinos)." Child(s)", R, L);
					else
						$pdf->Cell(75, 4, "        0".($sumaPasajeros)." Passenger(s)", R, L);
					$pdf->Ln();
					
					$pdf->SetFont('Arial');
					$pdf->Cell(15, 4, " ", L, L);
					$pdf->SetFont('Arial', B);
					$pdf->Cell(70, 4, $row4['ciudad'], R, L);
					$pdf->Cell(75, 4, "", R, L);
					$pdf->Ln();
					
					if($row4['fono'] != NULL && $row4['fono'] != "" && $row4['fono'] != "0")
					{
						$pdf->SetFont('Arial');
						$pdf->Cell(15, 4, "Phone:", LB, L);
						$pdf->SetFont('Arial', B);
						$pdf->Cell(70, 4, $row4['fono'], RB, L);
						$pdf->Cell(75, 4, "", RB, L);
						$pdf->Ln();
					}
					else
					{
						$pdf->Cell(85, 4, "", LRB, L);
						$pdf->Cell(75, 4, "", RB, L);
						$pdf->Ln();
					}
				}
				else // if($row['cod_provee'] != "" && $row['cod_provee'] != NULL)
				{
					$pdf->SetFont('Arial', B);
					$pdf->Cell(70, 4, $prov, TR, L);
					$pdf->SetFont('Arial');
					$pdf->Cell(15, 4, "Mr/Ms", 0, L);
					$pdf->SetFont('Arial', B);
					$pdf->Cell(60, 4, $row['nombre_pax'], R, L);
					$pdf->Ln();
					
					$pdf->SetFont('Arial');
					$pdf->Cell(15, 4, " ", L, L);
					$pdf->SetFont('Arial', B);
					$pdf->Cell(70, 4, $prov_direc, R, L);
					if($totalNinos > 0)
						$pdf->Cell(75, 4, "        0".($sumaPasajeros)." Passenger(s) + 0".($totalNinos)." Child(s)", R, L);
					else
						$pdf->Cell(75, 4, "        0".($sumaPasajeros)." Passenger(s)", R, L);
					$pdf->Ln();
					
					$pdf->SetFont('Arial');
					$pdf->Cell(15, 4, " ", L, L);
					$pdf->SetFont('Arial', B);
					$pdf->Cell(70, 4, $prov_ciudad, R, L);
					$pdf->Cell(75, 4, "", R, L);
					$pdf->Ln();
					
					if($prov_fono != NULL && $prov_fono != "" && $prov_fono != "0")
					{
						$pdf->SetFont('Arial');
						$pdf->Cell(15, 4, "Phone:", LB, L);
						$pdf->SetFont('Arial', B);
						$pdf->Cell(70, 4, $prov_fono, RB, L);
						$pdf->Cell(75, 4, "", RB, L);
						$pdf->Ln();
					}
					else
					{
						$pdf->Cell(85, 4, "", LRB, L);
						$pdf->Cell(75, 4, "", RB, L);
						$pdf->Ln();
					}
				}
			}
			
			if($tipo_servicio == "HTL")
			{
				$pdf->SetFont('Arial');
				$pdf->Cell(160, 2, "", LR, L);
				$pdf->Ln();
				
				$pdf->SetFont('Arial', B);
				$pdf->Cell(160, 4, $row['num_dias']." Noche(s) de Alojamiento", LR, L);
				$pdf->Ln();
				
				
				
				// Escribir STRING Final
				$stringFinal = "";
				if($simple > 0) 	// Agregar habitaciones SIMPLES
					$stringFinal = $stringFinal."0".$simple." Single(s) + ";
				if($double > 0) 	// Agregar habitaciones DOBLES
					$stringFinal = $stringFinal."0".$double." Doble(s) + ";
				if($triple > 0) 	// Agregar habitaciones TRIPLES
					$stringFinal = $stringFinal."0".$triple." Triple(s) + ";
				if($cuadruple > 0) 	// Agregar habitaciones CUADRUPLES
					$stringFinal = $stringFinal."0".$cuadruple." Cuadruple(s) + ";
				if($totalNinos > 0) // Agregar NIÑOS
					$stringFinal = $stringFinal."0".$totalNinos." Child(s) + "; 
					
				$longitud = strlen($stringFinal);
				$stringFinal = substr($stringFinal,0 , $longitud - 3);
				
				$pdf->SetFont('Arial', B);
				$pdf->Cell(160, 4, $stringFinal." / ".$row['tipoh']." / ".$row['pa']." ", LR, L);
				$pdf->Ln();
				
				$pdf->SetFont('Arial', B);
				$pdf->Cell(160, 4, "IN: ".Funciones::invertirFecha($row['fecha_in'], '-', '/')." / OUT: ".Funciones::invertirFecha($row['fecha_out'], '-', '/')." ", LR, L);
				$pdf->Ln();
			}
			else
			{
				$arreglo = array();
				$arreglo = explode(" ", $row['hotel']);
				
				$pdf->SetFont('Arial');
				$pdf->Cell(160, 2, "", LR, L);
				$pdf->Ln();
				
				$pdf->SetFont('Arial', B);
				$pdf->Cell(160, 4, $arreglo[0]." ".$arreglo[1]." ".$arreglo[2]." ".$arreglo[3]." ".$arreglo[4]." ".$arreglo[5]." ".$arreglo[6]." ".$arreglo[7]." ".$arreglo[8]." ".$arreglo[9]." ". $arreglo[10]." ".$arreglo[11], LR, L);
				$pdf->Ln();
				
				if($row['vuelo'] != "" && $row['vuelo'] != NULL)
				{
					$pdf->SetFont('Arial');
					$pdf->Cell(20, 4, "Vuelo :", L, L);
					$pdf->SetFont('Arial', B);
					$pdf->Cell(140, 4, $row['vuelo'], R, L);
					$pdf->Ln();
					
					$pdf->SetFont('Arial');
					$pdf->Cell(20, 4, "Fecha:", L, L);
					$pdf->SetFont('Arial', B);
					$pdf->Cell(140, 4, Funciones::invertirFecha($row['fecha_in'], '-', '/'), R, L);
					$pdf->Ln();
				}
				else
				{
					$pdf->SetFont('Arial');
					$pdf->Cell(20, 4, "Fecha:", L, L);
					$pdf->SetFont('Arial', B);
					$pdf->Cell(140, 4, Funciones::invertirFecha($row['fecha_in'], '-', '/'), R, L);
					$pdf->Ln();
					
					$pdf->SetFont('Arial', B);
					$pdf->Cell(160, 4, "", LR, L);
					$pdf->Ln();
				}
				
				
			}
			
			$pdf->SetFont('Arial');
			$pdf->Cell(160, 6, "", LR, L);
			$pdf->Ln();
			
			$pdf->SetFont('Arial');
			$pdf->Cell(20, 4, "Prepaid By:", L, L);
			
			$pdf->SetFont('Arial', B);
			if(	($row['cod_provee'] != "" && $row['cod_provee'] != NULL && $row['cod_provee'] != "0") && 
				($row['codigo_htl'] == "" || $row['codigo_htl'] == NULL || $row['codigo_htl'] == "0"))
			{
				
				$pdf->Cell(70, 4, ENT_NAME , 0, L);
			}
			else
				$pdf->Cell(70, 4, $prov, 0, L);
			
			$pdf->SetFont('Arial');
			if($prov_fono == "")
				$pdf->Cell(70, 4, "", R, L);
			else
			{
				$pdf->SetFont('Arial');
				$pdf->Cell(30, 4, "Phone Emergency:", 0, L);
				$pdf->SetFont('Arial', B);
				$pdf->Cell(40, 4, $prov_fono, R, L);
			}
			$pdf->Ln();
			
			if($tipo_servicio == "HTL")
			{
				if($row['nconf'] != "" && $row['nconf'] != NULL)
				{
					$pdf->SetFont('Arial');
					$pdf->Cell(20, 4, "Conf.Number :", L, L);
					$pdf->SetFont('Arial', B);
					$pdf->Cell(140, 4, $row['nconf'], R, L);
				}
				else
				{
					$pdf->SetFont('Arial', B);
					$pdf->Cell(160, 4, "", LR, L);
				}
				
				$pdf->SetFont('Arial');
				$pdf->Ln();
			}
			else
			{
				if($row['nconf'] != "" && $row['nconf'] != NULL && $row['nconf'] != NULL)
				{
					$pdf->SetFont('Arial');
					$pdf->Cell(20, 4, "Conf.Number :", L, L);
					$pdf->SetFont('Arial', B);
					$pdf->Cell(140, 4, $row['nconf'], R, L);
					
					$pdf->SetFont('Arial');
					$pdf->Ln();
				}
				else
				{
					$pdf->SetFont('Arial');
					$pdf->Cell(160, 4, "", LR, L);
					$pdf->Ln();
				}
				
			}
			
			$pdf->Cell(160, 4, "", LBR, L);
			
			$pdf->Ln();
			
			// Tijeras
			$pos_imagen = $pos_imagen + 76;
			
			if($contador == 1 || $contador == 2)
			{
				$pdf->Image($ruta_img . 'tijeras_derecha.png', 16, ($pos_imagen-12.5), 5);
				$pdf->Image($ruta_img . 'tijeras_izquierda.png', 180, ($pos_imagen-12.5), 5);
				$pdf->SetLeftMargin(1);
				$pdf->SetFontSize(12);
				$pdf->Cell(200, 10, "- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -", 0, 'L');
				// $pdf->Ln();
			}
		}
		$pdf->Output();
	}
}