<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class contactoController extends Controller
{
    public function __construct() {
        parent::__construct();
        $this->_view->setJs(array('Contacto'));
    }
       /**
     * Metodo procesador: Renderiza la vista contáctenos 
     * <PRE>
     * -.Creado: 08/04/2015(Jaime Reyes)
     * -.Modificado: 28/04/2015 (Jaime Reyes)
     * </PRE>
     * @return String Retorna contáctenos renderizado
     * @author: Jaime Reyes
     */
    public function index() {
        
    }
    
    ########################contactoController################################### 
       /**
     * Metodo procesador: Renderiza la vista contáctenos 
     * <PRE>
     * -.Creado: 08/04/2015(Jaime Reyes)
     * -.Modificado: 28/04/2015 (Jaime Reyes)
     * </PRE>
     * @return String Retorna contáctenos renderizado
     * @author: Jaime Reyes
     */
    public function contactenos() {
        Session::acceso('Usuario');
        $this->_view->currentMenu = 7;
        $this->_view->titulo = 'ORISTRAVEL';
        $this->_view->renderizaSistema('contactenos');
    }
 
    /**
     * Metodo procesador: Valida los campos que vienen de la vista de contactos,
     * valida anti-spam de correo y envía correo al cliente 
     * <PRE>
     * -.Creado: 08/05/2015(Jaime Reyes)
     * -.Modificado: 28/04/2015 (Jaime Reyes)
     * </PRE>
     * @return String Mensaje de exito del correo enviado
     * @author: Jaime Reyes
     */

    public function enviarContacto() {
        Session::set('sess_ultima_hora', date('H:i:s'));
        if (Session::get('sess_ipcfg')) {
            if (Session::get('sess_ultima_hora')) {
                Session::destroy('sessError');
                $hd_Cliente = Session::get('sess_agencia');
                $usuario = Session::get('sess_nombre') . ' ' . Session::get('sess_apellido');
                $mensaje = $this->getTexto('Cntac_areaNota');
                
                $html = file_get_contents(ROOT . 'views' . DS . 'contacto' . DS . 'mails' . DS . 'correoContacto.html');
                $reempl = array('logo' => ENT_LOGO,
                    'subdominio' => ENT_SUB_DOMAIN,
                    'comentario' => $mensaje,
                    'hdCliente' => $hd_Cliente,
                    'nombre_completo' => $usuario,
                    'fecha' => date('d/m/Y'),
                    'hora' => date('H:i:s'));

                foreach ($reempl as $nombre => $valor) {
                    $html = str_replace('{' . $nombre . '}', $valor, $html);
                }

                if (!empty($mensaje)) {
                    //--------------------------Configuracion Correo---------------------  
                    $this->getLibrary('class.phpmailer');
                    $mail = new PHPMailer();
                    $mail->IsSMTP();
                    $mail->SMTPAuth = true;

                    //$mail->Port = 25;
                    $mail->Host = "mail.oristravel.com";
                    $mail->Username = "oris@oristravel.com";
                    $mail->Password = "tsyacom01";

                    $mail->From = 'oris@oristravel.com';
                    $mail->FromName = 'Solicitud de Contacto WEB-ORIS';
                    $mail->CharSet = CHARSET;
                    $mail->Subject = 'Confirmacion de reserva online: ';
                    $mail->Body = $mensaje;

                    $mail->MsgHTML($html);

                    $mail->AddAddress('jjreyes.romero88@gmail.com', "Jaime Reyes");
                    if (date('H:i:s') <= date('H:i:s', strtotime('+60 second', strtotime(Session::get('sess_ultima_hora'))))) {

                        if (Session::get('sess_intentos') >= 5) {

                            echo 'Debe cerrar sesion';
                        } else {
                            if ($mail->Send()) {
                                Session::set('sess_intentos', (Session::get('sess_intentos') + 1));
                                echo 'OK';
                            } else {

                                echo 'Error al enviar el Correo';
                            }
                        }
                    }
                } else {
                    echo 'Escriba un mensaje';
                }
            }
        }
    }
}