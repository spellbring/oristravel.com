<?php /* Smarty version Smarty-3.1.19, created on 2014-08-11 14:02:00
         compiled from "C:\AppServ\www\oristravel.com\views\sistema\index.phtml" */ ?>
<?php /*%%SmartyHeaderCode:2304653e90518c7ca98-58145762%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fafcbfe7299730722292eb0771ad6723fddb1912' => 
    array (
      0 => 'C:\\AppServ\\www\\oristravel.com\\views\\sistema\\index.phtml',
      1 => 1407513318,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2304653e90518c7ca98-58145762',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_53e90518c890d4_98387666',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53e90518c890d4_98387666')) {function content_53e90518c890d4_98387666($_smarty_tpl) {?><div id="page-content">
	<div id='wrap'>
		<div id="page-heading">
                    <h1>Bienvenido al sistema <<?php ?>?php echo Session::get('sess_nombre'); ?<?php ?>></h1>
		</div>
            
                <div class="container">
                    <div class="row" align="center">
                        <img  src="<<?php ?>?php echo $_layoutParams['ruta_img']; ?<?php ?>>fondo_index.jpg" class="img-responsive">
                    </div>
                </div>
		
	</div> <!--wrap -->
</div> <!-- page-content -->

<?php }} ?>
