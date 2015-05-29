<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class hotelController extends Controller{

public function __construct() {
    parent::__construct();
    $this->_view->setJs(array('Hoteles'));
    $this->_hotel = $this->loadModel('hotel');
    $this->_categoria = $this->loadModel('categoria');
    $this->_servicio = $this->loadModel('servicio');
    $this->_programa = $this->loadModel('programa');
    $this->_buscarHoteles = $this->loadModel('buscarHoteles');
}
/**
     * Metodo procesador: Carga todos los ComboBox para el proceso de administracion de hoteles
     * <PRE>
     * -.Creado: 28/07/2014
     * -.Modificado: 10/04/2015 (Jaime Reyes)
     * -.Modificado: 20/05/2015 (Jaime Reyes)
     * </PRE>
    
     * @return _view devuelve todos los hoteles segun el filtro que se elija
     * @author: Jonathan Estay
     */
public function index() {
    Session::acceso('Usuario');
        $this->_view->setJs(array('ajax'));
        $this->_view->objCiudadesHotel = $this->_hotel->getCiudadesHot();
        $this->_view->objCiudadesServ = $this->_servicio->getCiudadesServ();
        $this->_view->objCiudadesPRG = $this->_programa->getCiudadesPRG();
        $this->_view->mL_expandeFiltrosHot='block';
        
       
       
        
        
        $this->_view->objCategoriaHoteles = $this->_hotel->getCatHoteles();
        

        
        /* BEIGN: Paginador; */
        $pagina = 0;
        $pagina = $this->filtrarInt($pagina);
        $this->getLibrary('paginador');
        $paginador = new Paginador();
        /* $this->_view->getHoteles=$paginador->paginar($hoteles->getHoteles(), $pagina); */
        //$this->_view->paginacion = $paginador->getView('prueba', 'sistema/buscarHoteles');
        /* END: Paginador; */
        
        $adult1_h=0;
        $adult2_h=0;
        $adult3_h=0;
        $adult4_h=0;
        
        for ($i = 1; $i <= Session::get('sess_pBP_cntHab'); $i++) {
         
                if(Session::get('sess_BP_Adl_' . $i)==1){
                    //$adult1_h+=Session::get('sess_BP_Adl_' . $i);
                    $adult1_h++;
                }
                if(Session::get('sess_BP_Adl_' . $i)==2){
                    //$adult2_h+=Session::get('sess_BP_Adl_' . $i);
                    $adult2_h++;
                }
                if(Session::get('sess_BP_Adl_' . $i)==3){
                    //$adult3_h+=Session::get('sess_BP_Adl_' . $i);
                    $adult3_h++;
                }
                if(Session::get('sess_BP_Adl_' . $i)==4){
                    //$adult4_h+=Session::get('sess_BP_Adl_' . $i);
                    $adult4_h++;
                }
        
        }
        
        
        $objGetHoteles = $this->_buscarHoteles->getHoteles(Session::get('sess_id_usuario'),
                                                                      Session::get('sess_pCH_ciudad'),
                                                                      Funciones::invertirFecha(Session::get('sess_pBP_FechaIn'),'/','-'),
                                                                      Funciones::invertirFecha(Session::get('sess_pBP_FechaOut'),'/','-'),
                                                                      Session::get('sess_grupo'),
                                                                      Session::get('sess_pBP_cntHab'),
                                                                      $adult1_h,
                                                                      $adult2_h,
                                                                      $adult3_h,
                                                                      $adult4_h,
                                                                      Session::get('sess_total_child'));
                $adult1_h=0;
                $adult2_h=0;
                $adult3_h=0;
                $adult4_h=0;
    
        
        $this->_view->objGetHoteles = $objGetHoteles;
        //$objHotel = $this->_buscarHoteles->getHotel();
        
        //if
        
        
        
        $this->_view->currentMenu = 8;
        $this->_view->titulo = 'ORISTRAVEL';
        $this->_view->renderizaSistema('buscarHoteles');
  
}
##########hotelControler#####################
    
    public function hoteles() {
         Session::acceso('Usuario');
        //$hotel= $this->loadModel('hotel');


        //$this->_view->setJs(array('ajax'));

        $this->_view->objCategoriaHoteles = $this->_hotel->getCatHoteles();
        $this->_view->objCiudadesHotel = $this->_hotel->getCiudadesHot();
        $this->_view->objCiudadesServ = $this->_servicio->getCiudadesServ();
        $this->_view->objCiudadesPRG = $this->_programa->getCiudadesPRG();
        
         $this->_view->objServicios = $this->_servicio->getServicios();


        $this->_view->getHoteles = $this->_hotel->getAdmHoteles(
                Session::get('sess_pAdm_ciudad'), Session::get('sess_pAdm_nombre'), Session::get('sess_pAdm_cat')
        );

        $this->_view->currentMenu = 2;
        $this->_view->titulo = 'ORISTRAVEL';
        $this->_view->renderizaSistema('hoteles'); 
        
    }
    
     /**
     * Metodo procesador: Carga todos los ComboBox para el proceso de administracion de hoteles
     * <PRE>
     * -.Creado: 13/04/2015
     * </PRE>
     * @return _view Según el hotel seleccionado, muestra todos los detalles del hotel para su posterior edición
     * @author: Jaime Reyes
     */

    public function editHotel() {
        Session::acceso('Usuario');
        
        $EH_codHotel = $this->getTexto('post_cod');
        if ($EH_codHotel) {
            Session::set('sessMOD_EH_codHotel', $EH_codHotel);

            //$hoteles= $this->loadModel('hotel');
            //$categorias= $this->loadModel('categoria');

            $objHotel = $this->_hotel->getHotel($EH_codHotel);

            $this->_view->objCategorias = $this->_categoria->getCategorias();
            //$this->_view->objCategoriaHoteles= $this->_hotel->getCatHoteles();
            //$this->_views->objHoteles= $this->_hotel->getHotel($objHotel);


            if ($objHotel) {
                //echo 'ASDASD'; exit;
                $this->_view->EH_cod = $objHotel[0]->getCodigo();
                $this->_view->EH_hotel = $objHotel[0]->getHotel();
                $this->_view->EH_cat = $objHotel[0]->getCat();
                $this->_view->EH_lat = $objHotel[0]->getLat();
                $this->_view->EH_lon = $objHotel[0]->getLon();
                $this->_view->EH_direc = $objHotel[0]->getDirec();
                $this->_view->EH_web = $objHotel[0]->getSitioWeb();

                $this->_view->EH_imgEnc = $objHotel[0]->getImgEnc();
                $this->_view->EH_imgCont = $objHotel[0]->getImgCont();
                $this->_view->EH_imgCont2 = $objHotel[0]->getImgCont2();
                $this->_view->EH_imgCont3 = $objHotel[0]->getImgCont3();
                $this->_view->EH_imgCont4 = $objHotel[0]->getImgCont4();

                /* SERVICIOS HOTEL */
                if ($objHotel[0]->getRestaurante() == 1) {
                    $this->_view->EH_rest = 'checked="checked"';
                } else {
                    $this->_view->EH_rest = 'nochecked';
                }
                if ($objHotel[0]->getLavanderia() == 1) {
                    $this->_view->EH_lavan = 'checked="checked"';
                } else {
                    $this->_view->EH_lavan = 'nochecked';
                }
                if ($objHotel[0]->getBar() == 1) {
                    $this->_view->EH_bar = 'checked="checked"';
                } else {
                    $this->_view->EH_bar = 'nochecked';
                }
                if ($objHotel[0]->getCafeteria() == 1) {
                    $this->_view->EH_cafe = 'checked="checked"';
                } else {
                    $this->_view->EH_cafe = 'nochecked';
                }
                if ($objHotel[0]->getServHab() == 1) {
                    $this->_view->EH_servHab = 'checked="checked"';
                } else {
                    $this->_view->EH_servHab = 'nochecked';
                }
                if ($objHotel[0]->getBusiness() == 1) {
                    $this->_view->EH_business = 'checked="checked"';
                } else {
                    $this->_view->EH_business = 'nochecked';
                }
                if ($objHotel[0]->getInterHotel() == 1) {
                    $this->_view->EH_intHot = 'checked="checked"';
                } else {
                    $this->_view->EH_intHot = 'nochecked';
                }
                if ($objHotel[0]->getEstaciona() == 1) {
                    $this->_view->EH_est = 'checked="checked"';
                } else {
                    $this->_view->EH_est = 'nochecked';
                }
                if ($objHotel[0]->getPiscinaCub() == 1) {
                    $this->_view->EH_pCub = 'checked="checked"';
                } else {
                    $this->_view->EH_pCub = 'nochecked';
                }
                if ($objHotel[0]->getPiscinaDes() == 1) {
                    $this->_view->EH_pDes = 'checked="checked"';
                } else {
                    $this->_view->EH_pDes = 'nochecked';
                }
                if ($objHotel[0]->getGym() == 1) {
                    $this->_view->EH_gym = 'checked="checked"';
                } else {
                    $this->_view->EH_gym = 'nochecked';
                }
                if ($objHotel[0]->getSpa() == 1) {
                    $this->_view->EH_spa = 'checked="checked"';
                } else {
                    $this->_view->EH_spa = 'nochecked';
                }
                if ($objHotel[0]->getTenis() == 1) {
                    $this->_view->EH_tenis = 'checked="checked"';
                } else {
                    $this->_view->EH_tenis = 'nochecked';
                }
                if ($objHotel[0]->getGuarderia() == 1) {
                    $this->_view->EH_guard = 'checked="checked"';
                } else {
                    $this->_view->EH_guard = 'nochecked';
                }
                if ($objHotel[0]->getSalasReu() == 1) {
                    $this->_view->EH_salas = 'checked="checked"';
                } else {
                    $this->_view->EH_salas = 'nochecked';
                }
                if ($objHotel[0]->getJardin() == 1) {
                    $this->_view->EH_jardin = 'checked="checked"';
                } else {
                    $this->_view->EH_jardin = 'nochecked';
                }
                if ($objHotel[0]->getDiscapacitados() == 1) {
                    $this->_view->EH_disca = 'checked="checked"';
                } else {
                    $this->_view->EH_disca = 'nochecked';
                }
                if ($objHotel[0]->getBoutique() == 1) {
                    $this->_view->EH_bou = 'checked="checked"';
                } else {
                    $this->_view->EH_bou = 'nochecked';
                }


                /* SERVICIOS HABITACION */
                if ($objHotel[0]->getAcondicionado() == 1) {
                    $this->_view->EH_acon = 'checked="checked"';
                } else {
                    $this->_view->EH_acon = 'nochecked';
                }
                if ($objHotel[0]->getCalefaccion() == 1) {
                    $this->_view->EH_cale = 'checked="checked"';
                } else {
                    $this->_view->EH_cale = 'nochecked';
                }
                if ($objHotel[0]->getNoFuma() == 1) {
                    $this->_view->EH_noFuma = 'checked="checked"';
                } else {
                    $this->_view->EH_noFuma = 'nochecked';
                }
                if ($objHotel[0]->getCajaFuerte() == 1) {
                    $this->_view->EH_cajaF = 'checked="checked"';
                } else {
                    $this->_view->EH_cajaF = 'nochecked';
                }
                if ($objHotel[0]->getMiniBar() == 1) {
                    $this->_view->EH_mBar = 'checked="checked"';
                } else {
                    $this->_view->EH_mBar = 'nochecked';
                }
                if ($objHotel[0]->getTV() == 1) {
                    $this->_view->EH_tv = 'checked="checked"';
                } else {
                    $this->_view->EH_tv = 'nochecked';
                }
                if ($objHotel[0]->getTvCable() == 1) {
                    $this->_view->EH_tvC = 'checked="checked"';
                } else {
                    $this->_view->EH_tvC = 'nochecked';
                }
                if ($objHotel[0]->getInterHab() == 1) {
                    $this->_view->EH_intHab = 'checked="checked"';
                } else {
                    $this->_view->EH_intHab = 'nochecked';
                }
                if ($objHotel[0]->getSecador() == 1) {
                    $this->_view->EH_seca = 'checked="checked"';
                } else {
                    $this->_view->EH_seca = 'nochecked';
                }
                if ($objHotel[0]->getBarraSeg() == 1) {
                    $this->_view->EH_barra = 'checked="checked"';
                } else {
                    $this->_view->EH_barra = 'nochecked';
                }
                if ($objHotel[0]->getTelefono() == 1) {
                    $this->_view->EH_fono = 'checked="checked"';
                } else {
                    $this->_view->EH_fono = 'nochecked';
                }


                $this->_view->renderizaCenterBox('editHotel');
            } else {
                //echo 'asd'; exit;
                throw new Exception('Error al desplegar la edicion del hotel');
            }
        } else {
            //echo 'asd2'; exit;
            throw new Exception('Error al tratar de editar el hotel');
        }
    }
    
     /**
     * Metodo procesador: Realiza el proceso de modificación de los hoteles.
     * <PRE>
     * -.Creado: 13/04/2014
     * -.Modificado: 20/04/2015 (Jaime Reyes)
     
     * </PRE>
    
     * @return String devuelve un mensaje de que se modificó el registro
     * @author: Jonathan Estay
     */

    public function modificarHotel() {
        if (strtolower($this->getServer('HTTP_X_REQUESTED_WITH')) == 'xmlhttprequest') {

            $MH_nombreHotel = $this->getTexto('txtEH_nombreHotel');
            $MH_direc = $this->getTexto('txtEH_direc');
            $MH_cate = $this->getTexto('cmbEH_categoria');
            $MH_lat = $this->getTexto('txtEH_latitud');
            $MH_lon = $this->getTexto('txtEH_longitud');
            $MH_sitWeb = $this->getTexto('txtEH_sitioWeb');



            if (!$MH_nombreHotel) {
                echo 'Debe ingresar un nombre de hotel';
                exit;
            } else if (!$MH_cate) {
                echo 'El hotel debe tener una categor&iacute;a';
                exit;
            } else if (!$MH_direc) {
                echo 'Debe ingresar una direcci&oacute;n para el hotel';
                exit;
            }

            if ($MH_nombreHotel) {

                // echo 'OK';
            }





            //$MH_Hotel= $this->_hotel;
            //$this->getLibrary('upload' . DS . 'class.upload');
            $rutaImg = ROOT . 'public' . DS . 'img' . DS . 'hoteles' . DS;


            for ($i = 1; $i <= 5; $i++) {
                if (isset($_FILES['flImagen' . $i]['name'])) {
                    if ($_FILES['flImagen' . $i]['name']) {
                        if (Funciones::validaFoto($_FILES['flImagen' . $i]['type']) == false) {
                            echo 'La Imagen ' . $i . ' debe ser formato [.JPG] [.GIF] [.PNG]';
                            exit;
                        }

                        if ($_FILES['flImagen' . $i]['size'] > 524288) { //512KB
                            echo 'La Imagen ' . $i . ' debe ser menor a <b>500kb</b>';
                            exit;
                        }
                    }
                }
            }





            //Servicios Hotel
            $MH_chkRest = Funciones::validaChk($this->getTexto('chkEH_rest'));
            $MH_chkLavan = Funciones::validaChk($this->getTexto('chkEH_lavan'));
            $MH_chkPisDesc = Funciones::validaChk($this->getTexto('chkEH_pisDesc'));
            $MH_chkCanTenis = Funciones::validaChk($this->getTexto('chkEH_cTenis'));
            $MH_chkBar = Funciones::validaChk($this->getTexto('chkEH_bar'));
            $MH_chkBusCen = Funciones::validaChk($this->getTexto('chkEH_busCen'));
            $MH_chkSpa = Funciones::validaChk($this->getTexto('chkEH_spa'));
            $MH_chkGuard = Funciones::validaChk($this->getTexto('chkEH_guarderia'));
            $MH_chkCafe = Funciones::validaChk($this->getTexto('chkEH_cafe'));
            $MH_chkInterHot = Funciones::validaChk($this->getTexto('chkEH_interHot'));
            $MH_chkGym = Funciones::validaChk($this->getTexto('chkEH_gym'));
            $MH_chkSaReu = Funciones::validaChk($this->getTexto('chkEH_sReu'));
            $MH_chkServHab = Funciones::validaChk($this->getTexto('chkEH_servHab'));
            $MH_chkEst = Funciones::validaChk($this->getTexto('chkEH_estaciona'));
            $MH_chkPisCub = Funciones::validaChk($this->getTexto('chkEH_pisCub'));
            $MH_chkJar = Funciones::validaChk($this->getTexto('chkEH_jardin'));
            $MH_chkDisca = Funciones::validaChk($this->getTexto('chkEH_disca'));
            $MH_chkBou = Funciones::validaChk($this->getTexto('chkEH_bou'));


            //Servicios Habitacion
            $MH_chkAirAcond = Funciones::validaChk($this->getTexto('chkEH_airAcond'));
            $MH_chkCaFuerte = Funciones::validaChk($this->getTexto('chkEH_cFuerte'));
            $MH_chkTvCable = Funciones::validaChk($this->getTexto('chkEH_tvCable'));
            $MH_chkSecPelo = Funciones::validaChk($this->getTexto('chkEH_sPelo'));
            $MH_chkCalef = Funciones::validaChk($this->getTexto('chkEH_calefac'));
            $MH_chkMinBar = Funciones::validaChk($this->getTexto('chkEH_mBar'));
            $MH_chkFono = Funciones::validaChk($this->getTexto('chkEH_fono'));
            $MH_chkBarraSeg = Funciones::validaChk($this->getTexto('chkEH_barraSeg'));
            $MH_chkNoFumar = Funciones::validaChk($this->getTexto('chkEH_noFumar'));
            $MH_chkTV = Funciones::validaChk($this->getTexto('chkEH_tv'));
            $MH_chkInterHab = Funciones::validaChk($this->getTexto('chkEH_interHab'));


            $MH_sql = 'UPDATE hotel 
                    SET hotel="' . mb_convert_encoding($MH_nombreHotel, "ISO-8859-1", "UTF-8") . '", direc="' . mb_convert_encoding($MH_direc, "ISO-8859-1", "UTF-8") . '", cat="' . $MH_cate . '", SWEB="' . $MH_sitWeb . '", estado="", 
                    lat="' . $MH_lat . '", lon="' . $MH_lon . '", restaurante=' . $MH_chkRest . ', bar=' . $MH_chkBar . ', cafeteria=' . $MH_chkCafe . ', 
                    s_habitacion=' . $MH_chkServHab . ', busness_center=' . $MH_chkBusCen . ', internet_hotel=' . $MH_chkInterHot . ', estacionamiento=' . $MH_chkEst . ', 
                    piscina_cub=' . $MH_chkPisCub . ', piscina_des=' . $MH_chkPisDesc . ', gym=' . $MH_chkGym . ', spa=' . $MH_chkSpa . ', tenis=' . $MH_chkCanTenis . ', 
                    guarderia=' . $MH_chkGuard . ', salas_reunion=' . $MH_chkSaReu . ', jardin=' . $MH_chkJar . ', discapacitados=' . $MH_chkDisca . ', 
                    bautique=' . $MH_chkBou . ', acondicionado=' . $MH_chkAirAcond . ', calefaccion=' . $MH_chkCalef . ', no_fuma=' . $MH_chkNoFumar . ', 
                    caja_fuerte=' . $MH_chkCaFuerte . ', mini_bar=' . $MH_chkMinBar . ', television=' . $MH_chkTV . ', tv_cable=' . $MH_chkTvCable . ', 
                    inter_hab=' . $MH_chkInterHab . ', secador_pelo=' . $MH_chkSecPelo . ', barra_seguridad=' . $MH_chkBarraSeg . ', 
                    lavanderia=' . $MH_chkLavan . ', fono=' . $MH_chkFono;




            for ($i = 1; $i <= 5; $i++) {
                if (isset($_FILES['flImagen' . $i]['name'])) {
                    if ($_FILES['flImagen' . $i]['name']) {
                        $this->getLibrary('upload' . DS . 'class.upload');
                        $upload = new upload($_FILES['flImagen' . $i], 'es_ES');
                        $upload->allowed = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
                        $upload->file_max_size = '524288'; // 512KB
                        $upload->file_new_name_body = 'upl_' . sha1(uniqid());
                        $upload->process($rutaImg);

                        if ($upload->processed) {   //THUMBNAILS
                            $imagen = $upload->file_dst_name; //nombre de la imagen
                            //$MH_sql.= ', foto' . $i . '= "' . $imagen . '" ';

                            $thumb = new upload($upload->file_dst_pathname);
                            $thumb->image_resize = true;
                            $thumb->image_x = 150;
                            $thumb->image_y = 150;
                            $thumb->file_name_body_pre = 'thumb_';
                            $thumb->process($rutaImg . 'thumb' . DS);

                            if ($i == 1) {
                                $MH_sql.=', img_encabezado = "' . $imagen . '", mini_img_encabezado = "' . $imagen . '" ';
                            } else if ($i == 2) {
                                $MH_sql.=', img_contenido = "' . $imagen . '", mini_img_contenido = "' . $imagen . '" ';
                            } else {
                                $MH_sql.=', img_contenido' . ($i - 1) . ' = "' . $imagen . '", mini_img_contenido' . ($i - 1) . ' = "' . $imagen . '" ';
                            }
                        } else {
                            echo '(Imagen ' . $i . ')' . $upload->error . '<br>';
                        }
                    }
                } else {
                    if ($i == 1) {
                        if ($this->getTexto('chkEH_flImagen' . $i) == 'on') {
                            Funciones::eliminaFile($rutaImg . Session::get('sessMOD_DTH_img' . $i));
                            Funciones::eliminaFile($rutaImg . 'thumb' . DS .'thumb_'. Session::get('sessMOD_DTH_img' . $i));
                            $MH_sql.=', img_encabezado = "", mini_img_encabezado = "" ';
                        }
                    } else if ($i == 2) {
                        if ($this->getTexto('chkEH_flImagen' . $i) == 'on') {
                            Funciones::eliminaFile($rutaImg . Session::get('sessMOD_DTH_img' . $i));
                            Funciones::eliminaFile($rutaImg . 'thumb' . DS .'thumb_'. Session::get('sessMOD_DTH_img' . $i));
                            $MH_sql.=', img_contenido = "", mini_img_contenido = "" ';
                        }
                    } else {
                        if ($this->getTexto('chkEH_flImagen' . $i) == 'on') {
                            Funciones::eliminaFile($rutaImg . Session::get('sessMOD_DTH_img' . $i));
                            Funciones::eliminaFile($rutaImg . 'thumb' . DS .'thumb_'. Session::get('sessMOD_DTH_img' . $i));
                            $MH_sql.=', img_contenido' . ($i - 1) . ' = "", mini_img_contenido' . ($i - 1) . ' = "" ';
                        }
                    }
                }
            }


            $MH_sql.=' WHERE codigo=' . $_SESSION['sessMOD_EH_codHotel'];

            //echo $MH_sql; exit;
            $this->_hotel->exeSQL($MH_sql);

            echo 'OK';
        } else {
            throw new Exception('Error inesperado, intente nuevamente. Si el error persiste comuniquese con el administrador.');
        }
    }
    
    /**
     * Metodo procesador: Realiza el proceso de búsqueda de los hoteles
     * <PRE>
     * -.Creado: 11/05/2015
     * -.Modificado: 20/05/2015 (Jaime Reyes)
   
     * </PRE>
    
     * @return _view devuelve el SP que trae todos los hoteles con sus respectivos tipos de habitacion
     * @author: Jaime Reyes
     */

     public function buscarHoteles() {
        
    }
      /**
     * Metodo procesador: Renderiza mapasHotel.phtml
     * <PRE> 
     * -.Creado: 20/05/2015 (Jaime Reyes)
     * </PRE>
    
     * @return _view 
     * @author: Jaime Reyes
     */
  
     public function cargarMapas($lat, $lon, $nombre, $div){
       Session::acceso('Usuario');
       $this->_view->objLatitud = $lat;
       $this->_view->objLongitud = $lon;
       $this->_view->objDivMH = $div;
       $this->_view->objNombre = $nombre;
       //echo 'HOLA';
       $this->_view->renderizaCenterBox('mapaHotel');
       
   }
   
        
}

