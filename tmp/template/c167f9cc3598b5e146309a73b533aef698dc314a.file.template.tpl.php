<?php /* Smarty version Smarty-3.1.19, created on 2014-08-11 14:03:59
         compiled from "C:\AppServ\www\oristravel.com\views\layout\default\template.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1148953e905189063c0-84514633%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c167f9cc3598b5e146309a73b533aef698dc314a' => 
    array (
      0 => 'C:\\AppServ\\www\\oristravel.com\\views\\layout\\default\\template.tpl',
      1 => 1407780235,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1148953e905189063c0-84514633',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_53e90518c33ee3_46604034',
  'variables' => 
  array (
    'titulo' => 0,
    '_layoutParams' => 0,
    '_contenido' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53e90518c33ee3_46604034')) {function content_53e90518c33ee3_46604034($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo (($tmp = @$_smarty_tpl->tpl_vars['titulo']->value)===null||$tmp==='' ? "Sin titulo" : $tmp);?>
</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ORISTRAVEL">
    <meta name="author" content="The Red Team">

    <link href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_css'];?>
styles.min.css?=121" rel="stylesheet" >
    
    <link href='<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_css'];?>
google-fonts.css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css'>


    
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries. Placeholdr.js enables the placeholder attribute -->
	<!--[if lt IE 9]>
        <link rel="stylesheet" href="assets/css/ie8.css">
		<script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.1.0/respond.min.js"></script>
        <script type="text/javascript" src="js/excanvas.min.js"></script>
	<![endif]-->


    <link rel='stylesheet' type='text/css' href='<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_css'];?>
jquery.pnotify.default.css' /> 
    <link rel='stylesheet' type='text/css' href='<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_css'];?>
skylo.css' /> 
    <link rel='stylesheet' type='text/css' href='<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_css'];?>
jqueryui.css' /> 
    <link rel='stylesheet' type='text/css' href='<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_css'];?>
prettify.css' /> 
    <link rel='stylesheet' type='text/css' href='<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_css'];?>
toggles.css' /> 
</head>

<body >




    <header class="navbar navbar-inverse navbar-fixed-top" role="banner">
        <!-- <a id="leftmenu-trigger" class="tooltips" data-toggle="tooltip" data-placement="right" title="Menu"></a> -->



        <div class="navbar-header pull-left">
            <a href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['base_url'];?>
sistema">
                <img src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_img'];?>
logo.png" height="48" style="margin-left:20px;">
            </a>
        </div>

        <ul class="nav navbar-nav pull-right toolbar">

           <li class="dropdown">

                <a href="#" class="dropdown-toggle username" data-toggle="dropdown" >
                    <img src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_img'];?>
closed.png" width="24" />
                </a> 

                <ul class="dropdown-menu userinfo arrow" style="width:300px">

                    <li class="username">
                        <a href="#">
                            <div><h5>Hola, <b><?php echo Session::get('sess_nombre');?>
 <?php echo Session::get('sess_apellido');?>
</b>!</h5></div>
                        </a>
                    </li>

                    <li class="userlinks">
                        <ul class="dropdown-menu">
                            <!-- <li><a href="#">Usuario: <i class="pull-right"><b>jestay</b></i></a></li> -->
                            <li><a href="#">Usuario: <b><?php echo Session::get('sess_usuario');?>
</b></a></li>
                            <li><a href="#">Perfil: <b><?php echo Session::get('level');?>
</b></a></li>
                            <li><a href="#">Cliente: <b><?php echo Session::get('sess_agencia');?>
</b></a></li>

                            <li class="divider"></li>
                            <li><a href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['base_url'];?>
sistema/salir" class="text-right">Cerrar sesi&oacute;n</a></li>
                        </ul>
                    </li>
                </ul>

            </li>            

            <li class="dropdown">
                            <a href="#" class="hasnotifications dropdown-toggle" data-toggle='dropdown'>
                                <img src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_img'];?>
info.png" width="24" />
                            </a>
                            <ul class="dropdown-menu messages arrow" style="width:300px">
                                    <li class="dd-header">
                                            <span><?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ent_name'];?>
</span>
                                            <span><a href="http://<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ent_web'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ent_web'];?>
</a></span>
                                    </li>


                                <div class="scrollthis">
                                    <li><a href="#">
                                            <span class="time"><?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ent_comuna'];?>
</span>
                                            <img src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_img'];?>
home.png" />
                                            <div>
                                                <span class="name">Direcci&oacute;n</span>
                                                <span class="msg"><?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ent_direc'];?>
<br><?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ent_ciudad'];?>
</span>
                                            </div>
                                    </a></li>
                                    <li><a href="#">
                                            <img src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_img'];?>
fono.png" />
                                            <div><span class="name">Telefono</span><span class="msg"><?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ent_fono'];?>
</span></div>
                                    </a></li>
                                </div>



                                    <li class="dd-footer">
                                        <a href="mailto:<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ent_email'];?>
?Subject=Consulta: " target="_top">
                                            <?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ent_email'];?>

                                        </a>
                                    </li>
                            </ul>
                    </li>
        </ul>

    </header>
    
    <div id="page-container" style="min-height: 600px;">
        
        
        
<script type='text/javascript' src='<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_js'];?>
funciones.js'></script>

<link href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_css'];?>
custom-theme/jquery-ui-1.10.4.custom.css" rel="stylesheet">
<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_js'];?>
jquery-1.10.2.min.js"></script>
<script>
$(function()
{
    $( "#mL_txtFechaIn_H" ).datepicker({
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
$(function()
{
    $( "#mL_txtFechaOut_H" ).datepicker({
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



$(function()
{
    $( "#mL_txtFechaIn_S" ).datepicker({
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



$(function()
{
    $( "#mL_txtFechaIn_P" ).datepicker({
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









        
        <?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['_contenido']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        
        
        

        <footer role="contentinfo">
            <div class="clearfix">
                <ul class="list-unstyled list-inline pull-left">
                    <li><?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_js'];?>
 &copy; <?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_js'];?>
</li>
                </ul>
            </div>
        </footer>

    </div> <!-- page-container -->



    <script type='text/javascript' src='<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_js'];?>
jquery-1.10.2.min.js'></script> 
    <script type='text/javascript' src='<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_js'];?>
jqueryui-1.10.3.min.js'></script> 
    <script type='text/javascript' src='<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_js'];?>
bootstrap.min.js'></script> 
    <script type='text/javascript' src='<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_js'];?>
enquire.js'></script> 
    <script type='text/javascript' src='<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_js'];?>
jquery.cookie.js'></script> 
    <script type='text/javascript' src='<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_js'];?>
jquery.nicescroll.min.js'></script> 
    <script type='text/javascript' src='<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_js'];?>
prettify.js'></script> 
    <script type='text/javascript' src='<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_js'];?>
jquery.easypiechart.min.js'></script> 
    <script type='text/javascript' src='<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_js'];?>
jquery.sparklines.min.js'></script> 
    <script type='text/javascript' src='<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_js'];?>
toggle.min.js'></script> 
    <script type='text/javascript' src='<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_js'];?>
jquery.dataTables.min.js'></script> 
    <script type='text/javascript' src='<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_js'];?>
dataTables.bootstrap.js'></script> 
    <script type='text/javascript' src='<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_js'];?>
demo-datatables.js'></script> 

    <script type='text/javascript' src='<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_js'];?>
jquery.knob.min.js'></script> 
    <script type='text/javascript' src='<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_js'];?>
skylo.js'></script> 
    <script type='text/javascript' src='<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_js'];?>
demo-slider.js'></script>

    <script type='text/javascript' src='<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_js'];?>
placeholdr.js'></script> 
    <script type='text/javascript' src='<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_js'];?>
application.js'></script> 
    <script type='text/javascript' src='<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_js'];?>
demo.js'></script>
    
    </body>
</html><?php }} ?>
