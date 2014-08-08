<script type='text/javascript' src='<?php echo $_layoutParams['ruta_js']; ?>funciones.js'></script>

<link href="<?php echo $_layoutParams['ruta_css']; ?>custom-theme/jquery-ui-1.10.4.custom.css" rel="stylesheet">
<script src="<?php echo $_layoutParams['ruta_js']; ?>jquery-1.10.2.min.js"></script>
<script>
$(function()
{
    $( "#txtCR_fechaPrepago" ).datepicker({
            minDate: +1,
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
            'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
            'Jul','Ago','Sep','Oct','Nov','Dic'],
            dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
            dateFormat: 'dd/mm/yy',
            firstDay: 1
    });
});

</script>

<style>
	.cambioColor:hover{background-color:#CCC;}
</style>

<nav id="page-leftbar" role="navigation">

            <!-- BEGIN SIDEBAR MENU -->
            <ul class="acc-menu" id="sidebar">
                <li id="search">
                     <form id="frmBuscarProgramas" method="post" action="process/procesoBuscaProgramas.php">
                     	
                        
                        <!-- <input id="mL_txtCiudadDestino" name="mL_txtCiudadDestino" type="text" class="search-query" placeholder="Ingrese ciudad de destino" 
                        autocomplete="off" value="< php echo $_SESSION["sess_pBP_ciudadDes"]; ?> "
                        onkeyup="buscarCiudad(this.value, 'frmBuscarProgramas', 'spnCiudad-left', 'mL_txtCiudadDestino');" >
                        <span id="spnCiudad-left" class="twitter-typeahead" style="position: relative; display: none; direction: ltr;"></span> -->
                        
                        <select name="mL_txtCiudadDestino" id="mL_txtCiudadDestino" class="form-control" >
                            <option value="0">Seleccione destino</option>
                            <?php 
                            $var_getCiudades= $privateFunctions->getCiudades($pOC_ciudad);
							if($var_getCiudades!=FALSE)
							{ 
								foreach($var_getCiudades as $columCiudades)
								{
									$pOC_codigoCiu= mb_convert_encoding(trim($columCiudades['ccodigo']), "UTF-8", "ISO-8859-1");
									$pOC_nombreCiu= mb_convert_encoding(trim($columCiudades['cnombre']), "UTF-8", "ISO-8859-1");
									$pOC_nombreCiudad = $pOC_nombreCiu." (".$pOC_codigoCiu.")";
									
									if($_SESSION["sess_pBP_ciudadDes"]==$pOC_nombreCiu)
									{
									?>
                                    	<option value="<?php echo $pOC_nombreCiu; ?>" selected="selected"><?php echo $pOC_nombreCiudad; ?></option>
									<?php
									}
									else
									{
									?>
                                    	<option value="<?php echo $pOC_nombreCiu; ?>"><?php echo $pOC_nombreCiudad; ?></option>
									<?php
									}
								}
							}
                            ?>
                        </select>
                        
                     	<table width="100%" id="tblFormBusqueda" style="display:<?php echo $mL_expandeFiltros; ?>; margin-top:5px;">
                            <tr>
                            	<td width="30%"><span style="padding-left:10px;">Fecha In:</span></td>
                                <td>
                                	<!-- style="background:#d2d3d6;" -->
                                	<input type="text" class="form-control" id="mL_txtFechaIn" name="mL_txtFechaIn" value="<?php echo $mL_ini; ?>">
                                </td>
                            </tr>
                            <tr>
                            	<td><span style="padding-left:10px;">Fecha Out:</span></td>
                                <td>
                                	<input type="text" class="form-control" id="mL_txtFechaOut" name="mL_txtFechaOut" value="<?php echo $mL_out; ?>">
                                </td>
                            </tr>
                            
                           <tr>
                            	<td><span style="padding-left:10px;">Hotel:</span></td>
                                <td>
                                	<input class="form-control" type="text" id="mL_txtHotel" name="mL_txtHotel" placeholder="Nombre del hotel" autocomplete="off">
                                </td>
                            </tr>
                            
                            
                            <tr>
                            	<td><span style="padding-left:10px;">Habitaci&oacute;n:</span></td>
                                <td>
                                	<select name="ML_cmbHab" id="ML_cmbHab" class="form-control" onchange="habitaciones(this.value)">
                                    	<option value="0">Seleccione</option>
										<?php 
										for($i=1; $i<=3; $i++)
										{
											if($_SESSION["sess_pBP_cntHab"]==$i)
											{
										?>
                                        	<option value="<?php echo $i; ?>" selected="selected"><?php echo $i; ?></option>
                                        <?php }else{ ?>
                                        	<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } 
										} ?>
                                    </select>
                                </td>
                            </tr>
                            
                            <tr>
                            	<td colspan="2">
                                	<div id="ML_tblHab_1" style="display: <?php if($_SESSION["sess_pBP_cntHab"] > 0){ echo "block"; }else{ echo "none"; }?>">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                        <tr>
                                          <td>Adultos</td>
                                          <td>
                                          <select name="mL_cmbAdultos_1" id="mL_cmbAdultos_1">
                                            <?php
                                                for($x=1;$x<=6;$x++)
                                                { 
                                                    if($_SESSION["sess_pBP_Adl_1"] == $x)
                                                    { ?>
                                                    <option selected="selected" value="<?php echo $_SESSION["sess_pBP_Adl_1"]; ?>"><?php echo $_SESSION["sess_pBP_Adl_1"]; ?></option>
                                                    <?php 
                                                  }
                                                  else
                                                  { ?>                          
                                                  <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                            <?php }
                                                } ?>
                                          </select>                          </td>
                                          <td>Edad C1</td>
                                          <td>
                                          <select id="mL_edadChild_1_1" name="mL_edadChild_1_1" <?php if($_SESSION["sess_pBP_Chd_1"]>=1){}else{ echo "disabled='disabled'"; }?> >
                                                  <?php for($x=2;$x<=12;$x++){ ?>
                                                  <?php if($_SESSION["sess_pBP_edadChd_1_1"] == $x){ ?>
                                                  <option selected="selected" value="<?php echo $_SESSION["sess_pBP_edadChd_1_1"]; ?>"><?php echo $_SESSION["sess_pBP_edadChd_1_1"]; ?></option>
                                                  <?php }else{ ?>                          
                                                  <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                                  <?php }  } ?>
                                          </select>
                                          </td>
                                      </tr>
                                        <tr>
                                          <td>Child</td>
                                          <td><select name="mL_child_1" id="mL_child_1" onchange="habilitaEdadChild(this.value,1);">
                                            <?php if(trim($_SESSION["sess_pBP_Chd_1"]) == ""){$_SESSION["sess_pBP_Chd_1"]=0;}
                                                  for($x=0;$x<=2;$x++){ ?>
                                                  <?php if($_SESSION["sess_pBP_Chd_1"] == $x){ ?>
                                                  <option selected="selected" value="<?php echo $_SESSION["sess_pBP_Chd_1"]; ?>"><?php echo $_SESSION["sess_pBP_Chd_1"]; ?></option>
                                                  <?php }else{ ?>                          
                                                  <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                                  <?php }  } ?>
                                          </select>
                                          </td>                    	  
                                          
                                          <td>Edad C2</td>
                                          <td><select id="mL_edadChild_2_1" name="mL_edadChild_2_1" <?php if($_SESSION["sess_pBP_Chd_1"]==2){}else{ echo "disabled='disabled'"; }?> >
                                                  <?php for($x=2;$x<=12;$x++){ ?>
                                                  <?php if($_SESSION["sess_pBP_edadChd_2_1"] == $x){ ?>
                                                  <option selected="selected" value="<?php echo $_SESSION["sess_pBP_edadChd_2_1"]; ?>"><?php echo $_SESSION["sess_pBP_edadChd_2_1"]; ?></option>
                                                  <?php }else{ ?>                          
                                                  <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                                  <?php }  } ?>
                                          </select></td>
                                      </tr>
                                      
                                      
                                        <tr>
                                          <td>Infant</td>
                                          <td colspan="3">
                                          <select name="mL_inf_1" id="mL_inf_1">
                                            <?php if(trim($_SESSION["sess_pBP_Inf_1"]) == ""){$_SESSION["sess_pBP_Inf_1"]=0;}
                                              for($x=0;$x<=1;$x++){ ?>
                                              <?php if($_SESSION["sess_pBP_Inf_1"] == $x){ ?>
                                              <option selected="selected" value="<?php echo $_SESSION["sess_pBP_Inf_1"]; ?>"><?php echo $_SESSION["sess_pBP_Inf_1"]; ?></option>
                                              <?php }else{ ?>                          
                                              <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                              <?php }  } ?>
                                          </select>
                                          </td>                    	  
                                        </tr>
                                      
                                    </table>
                                    </div>      
                                    
                                    
                                    
                                    
                                    
                                    <div id="ML_tblHab_2" style="display: <?php if($_SESSION["sess_pBP_cntHab"] > 1){ echo "block"; }else{ echo "none"; }?>">
                                    <li class="divider"></li>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                        <tr>
                                          <td>Adultos</td>
                                          <td>
                                          <select name="mL_cmbAdultos_2" id="mL_cmbAdultos_2">
                                            <?php for($x=1;$x<=6;$x++){ ?>
                                                  <?php if($_SESSION["sess_pBP_Adl_2"] == $x){ ?>
                                                  <option selected="selected" value="<?php echo $_SESSION["sess_pBP_Adl_2"]; ?>"><?php echo $_SESSION["sess_pBP_Adl_2"]; ?></option>
                                                  <?php }else{ ?>                          
                                                  <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                            <?php }  } ?>
                                          </select>                          </td>
                                          <td>Edad C1</td>
                                          <td><select id="mL_edadChild_1_2" name="mL_edadChild_1_2" <?php if($_SESSION["sess_pBP_Chd_2"]>=1){}else{ echo "disabled='disabled'"; }?> >
                                                  <?php for($x=2;$x<=12;$x++){ ?>
                                                  <?php if($_SESSION["sess_pBP_edadChd_1_2"] == $x){ ?>
                                                  <option selected="selected" value="<?php echo $_SESSION["sess_pBP_edadChd_1_2"]; ?>"><?php echo $_SESSION["sess_pBP_edadChd_1_2"]; ?></option>
                                                  <?php }else{ ?>                          
                                                  <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                                  <?php }  } ?>
                                          </select></td>
                                      </tr>
                                        <tr>
                                          <td>Child</td>
                                          <td><select name="mL_child_2" id="mL_child_2" onchange="habilitaEdadChild(this.value,2);">
                                            <?php if(trim($_SESSION["sess_pBP_Chd_2"]) == ""){$_SESSION["sess_pBP_Chd_2"]=0;}
                                                  for($x=0;$x<=2;$x++){ ?>
                                                  <?php if($_SESSION["sess_pBP_Chd_2"] == $x){ ?>
                                                  <option selected="selected" value="<?php echo $_SESSION["sess_pBP_Chd_2"]; ?>"><?php echo $_SESSION["sess_pBP_Chd_2"]; ?></option>
                                                  <?php }else{ ?>                          
                                                  <option value="<?php echo $x;  ?>"><?php echo $x; ?></option>
                                                  <?php }  } ?>                           
                                          </select>                          </td>                    	  
                                          <td>Edad C2</td>
                                          <td><select id="mL_edadChild_2_2" name="mL_edadChild_2_2" <?php if($_SESSION["sess_pBP_Chd_2"]==2){}else{ echo "disabled='disabled'"; }?> >
                                                  <?php for($x=2;$x<=12;$x++){ ?>
                                                  <?php if($_SESSION["sess_pBP_edadChd_2_2"] == $x){ ?>
                                                  <option selected="selected" value="<?php echo $_SESSION["sess_pBP_edadChd_2_2"]; ?>"><?php echo $_SESSION["sess_pBP_edadChd_2_2"]; ?></option>
                                                  <?php }else{ ?>                          
                                                  <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                                  <?php }  } ?>
                                          </select></td>
                                      </tr>
                                      
                                      
                                      
                                      
                                      <tr>
                                          <td>Infant</td>
                                          <td colspan="3"><select name="mL_inf_2" id="mL_inf_2">
                                            <?php if(trim($_SESSION["sess_pBP_Inf_2"]) == ""){$_SESSION["sess_pBP_Inf_2"]=0;}
                                                  for($x=0;$x<=1;$x++){ ?>
                                                  <?php if($_SESSION["sess_pBP_Inf_2"] == $x){ ?>
                                                  <option selected="selected" value="<?php echo $_SESSION["sess_pBP_Inf_2"]; ?>"><?php echo $_SESSION["sess_pBP_Inf_2"]; ?></option>
                                                  <?php }else{ ?>                          
                                                  <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                                  <?php }  } ?>
                                          </select>
                                          </td>                    	  
                                      </tr>
                                      
                                    </table>
                                    </div>      
                                    
                                    
                                    
                                    
                                    <div id="ML_tblHab_3" style="display: <?php if($_SESSION["sess_pBP_cntHab"] > 2){ echo "block"; }else{ echo "none"; }?>">
                                    <li class="divider"></li>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                        <tr>
                                          <td>Adultos</td>
                                          <td>
                                          <select name="mL_cmbAdultos_3" id="mL_cmbAdultos_3">
                                            <?php for($x=1;$x<=6;$x++){ ?>
                                                  <?php if($_SESSION["sess_pBP_Adl_3"] == $x){ ?>
                                                  <option selected="selected" value="<?php echo $_SESSION["sess_pBP_Adl_3"]; ?>"><?php echo $_SESSION["sess_pBP_Adl_3"]; ?></option>
                                                  <?php }else{ ?>
                                                  <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                            <?php }  } ?>
                                          </select></td>
                                          <td>Edad C1</td>
                                          <td><select id="mL_edadChild_1_3" name="mL_edadChild_1_3" <?php if($_SESSION["sess_pBP_Chd_3"]>=1){}else{ echo "disabled='disabled'"; }?> >
                                                  <?php for($x=2;$x<=12;$x++){ ?>
                                                  <?php if($_SESSION["sess_pBP_edadChd_1_3"] == $x){ ?>
                                                  <option selected="selected" value="<?php echo $_SESSION["sess_pBP_edadChd_1_3"]; ?>"><?php echo $_SESSION["sess_pBP_edadChd_1_3"]; ?></option>
                                                  <?php }else{ ?>                          
                                                  <option value="<?php echo $x;  ?>"><?php echo $x; ?></option>
                                                  <?php }  } ?>
                                          </select></td>
                                      </tr>
                                        <tr><td>Child</td>
                                          <td><select name="mL_child_3" id="mL_child_3" onchange="habilitaEdadChild(this.value,3);">
                                            <?php if(trim($_SESSION["sess_pBP_Chd_3"]) == ""){$_SESSION["sess_pBP_Chd_3"]=0;}
                                                  for($x=0;$x<=2;$x++){ ?>
                                                  <?php if($_SESSION["sess_pBP_Chd_3"] == $x){ ?>
                                                  <option selected="selected" value="<?php echo $_SESSION["sess_pBP_Chd_3"]; ?>"><?php echo $_SESSION["sess_pBP_Chd_3"]; ?></option>
                                                  <?php }else{ ?>                          
                                                  <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                                  <?php }  } ?>
                                          </select></td>
                                          
                                          <td>Edad C2</td>
                                          <td><select id="mL_edadChild_2_3" name="mL_edadChild_2_3" <?php if($_SESSION["sess_pBP_Chd_3"]==2){}else{ echo "disabled='disabled'"; }?> >
                                                  <?php for($x=2;$x<=12;$x++){ ?>
                                                  <?php if($_SESSION["sess_pBP_edadChd_2_3"] == $x){ ?>
                                                  <option selected="selected" value="<?php echo $_SESSION["sess_pBP_edadChd_2_3"]; ?>"><?php echo $_SESSION["sess_pBP_edadChd_2_3"]; ?></option>
                                                  <?php }else{ ?>                          
                                                  <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                                  <?php }  } ?>
                                          </select></td>
                                      </tr>
                                      
                                      
                                      
                                      
                                      <tr>
                                          <td>Infant</td>
                                          <td colspan="3">
                                          <select name="mL_inf_3" id="mL_inf_3">
                                            <?php if(trim($_SESSION["sess_pBP_Inf_3"]) == "")
                                                  {
                                                      $_SESSION["sess_pBP_Inf_3"]=0; 
                                                  }
                                                      for($x=0;$x<=1;$x++)
                                                      { 
                                                    ?>
                                                  <?php if($_SESSION["sess_pBP_Inf_3"] == $x){ ?>
                                                  <option selected="selected" value="<?php echo $_SESSION["sess_pBP_Inf_3"]; ?>"><?php echo $_SESSION["sess_pBP_Inf_3"]; ?></option>
                                                  <?php }else{ ?>                          
                                                  <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                                  <?php }  } ?>
                                          </select>
                                          </td>                    	  
                                      </tr>
                                    </table>
                                    </div>
                                </td>
                            </tr>
                            
                            
                            <tr>
                                <td colspan="2" align="right">
                                	<input type="button"  id="btnBuscarProgramas" class="btn btn-primary" style="margin-right:5px" value="Buscar">
                                </td>
                            </tr>
                        </table>

                    </form>
                </li>
                
                <li class="divider"></li>
                
                <!-- <li><a id="menuInicio" href="javascript:;" ><span>Inicio</span></a></li> -->
                <li <?php if($menuActive==1){ ?>class="active"<?php } ?>><a id="menuConsReserva" href="javascript:;">
                	<i><img src="iconos/right.png" width="12px" /></i>
                    <span>Consultar Reservas</span></a></li>
                
                <?php if(trim($_SESSION["sess_sp_acceso"]) == "S"){ ?>
                <li <?php if($menuActive==2 || $menuActive==3 || $menuActive==4){ ?>class="open active hasChild"<?php } ?>>
                	<a href="javascript:;"><i><img src="iconos/right.png" width="12px" /></i><span>Administraci&oacute;n</span></a>
                    <ul class="acc-menu" <?php if($menuActive==2 || $menuActive==3 || $menuActive==4){ ?>style="display: block;"<?php } ?>>
                        <li <?php if($menuActive==2){ ?>class="active"<?php } ?>><a id="menuHoteles" href="javascript:;"><span>Hoteles</span></a></li>
                        <li <?php if($menuActive==3){ ?>class="active"<?php } ?>><a id="menuAdminProg" href="javascript:;"><span>Programas</span></a></li>
                        <li <?php if($menuActive==4){ ?>class="active"<?php } ?>><a id="menuLogoVoucherAgen" href="javascript:;"><span>Logo Clientes</span></a></li>
                    </ul>
                </li>
                <?php } ?>
                
            </ul>
          	<!-- END SIDEBAR MENU -->

        </nav>
        
<script>

	$('#btnBuscarProgramas').on('click',function()
	{
		var mL_Error=0;
		$("#btnBuscarProgramas").attr('disabled', 'disabled');
		if($('#mL_txtCiudadDestino').val() != '' && $('#mL_txtCiudadDestino').val() != 'Ingrese ciudad de destino')
		{
			if($('#ML_cmbHab').val() != 0)
			{
				$(document).skylo('start');
				
				setTimeout(function(){
					$(document).skylo('set',50);
				},1000);
				
				setTimeout(function(){
					$(document).skylo('end');
				},1500);
				setTimeout(function(){
				   document.getElementById('frmBuscarProgramas').submit();
				},2500);
			}
			else
			{
				mL_Error=1;
				$('#mensajeWar').html('Debe seleccionar la cantidad de habitaciones');
			}
		}
		else
		{
			mL_Error=1;
			$('#mensajeWar').html('Debe ingresar una ciudad de destino');	
		}
		
		
		
		
		if( mL_Error==1 )
		{
			$('#divAlertWar').delay( 10 ).fadeIn( 500 );
			$('#divAlertWar').animate({
				'display': 'block'
			});
			
			$('#divAlertWar').delay( 2000 ).fadeOut( 500 );
			$('#divAlertWar').animate({
								'display': 'none'
							});
							
			$("#btnBuscarProgramas").delay(2000).queue(function(dis)
			{
				$("#btnBuscarProgramas").removeAttr("disabled");
				dis();
			});	
		}
		
    });
	
	
	
	
	
	
	
	
	
	$('#menuConsReserva').on('click',function(){
        $(document).skylo('start');

        setTimeout(function(){
            $(document).skylo('set',50);
        },1000);

        setTimeout(function(){
            $(document).skylo('end');
        },1500);
		setTimeout(function(){
            window.location.href = 'consultarReserva.php';
        },2500);
    });
	
	$('#menuHoteles').on('click',function(){
        $(document).skylo('start');

        setTimeout(function(){
            $(document).skylo('set',50);
        },1000);

        setTimeout(function(){
            $(document).skylo('end');
        },1500);
		setTimeout(function(){
            window.location.href = 'hoteles.php';
        },2500);
    });
	
	
	$('#menuAdminProg').on('click',function(){
        $(document).skylo('start');

        setTimeout(function(){
            $(document).skylo('set',50);
        },1000);

        setTimeout(function(){
            $(document).skylo('end');
        },1500);
		setTimeout(function(){
            window.location.href = 'adminProgramas.php';
        },2500);
    });
	
	
	$('#menuLogoVoucherAgen').on('click',function(){
        $(document).skylo('start');

        setTimeout(function(){
            $(document).skylo('set',50);
        },1000);

        setTimeout(function(){
            $(document).skylo('end');
        },1500);
		setTimeout(function(){
            window.location.href = 'logoVoucherAgen.php';
        },2500);
    });




	$('#mL_txtCiudadDestino').on('click',function(){
		$('#tblFormBusqueda').fadeIn( 1500 );
		$('#tblFormBusqueda').animate({
			'display': 'block'
		});
	});

</script>


<!--<div class="ui-pnotify " id="divAlertExito" style="width: 300px; right: 25px; top: 25px; opacity: 1; display: none; cursor: auto;">
	<div class="alert ui-pnotify-container alert-success ui-pnotify-shadow" style="min-height: 16px;">
        <h4 class="ui-pnotify-title">Terminado</h4>
		<div class="ui-pnotify-text"><img src="iconos/ok.png" width="32" border="0" /> Proceso realizado con &eacute;xito.</div>
    </div>
</div>-->

<div class="ui-pnotify " id="divAlertWar" style="width: 300px; right: 25px; top: 25px; opacity: 1; display: none; cursor: auto;">
	<div class="alert ui-pnotify-container alert-danger ui-pnotify-shadow" style="min-height: 16px;">
        <h4 class="ui-pnotify-title">&iexcl;Atenci&oacute;n!</h4>
        <div class="ui-pnotify-text" id="mensajeWar"></div>
    </div>
</div>

<div class="ui-pnotify " id="divAlertInfo" style="width: 300px; right: 25px; top: 25px; opacity: 1; display: none; cursor: auto;">
	<div class="alert ui-pnotify-container alert-info ui-pnotify-shadow" style="min-height: 16px;">
        <div class="ui-pnotify-text">
        	<span class="fa fa-spin"><img src="iconos/loading.png" width="32" border="0" /></span> Procesando, espere un momento.</div>
    </div>
</div>

