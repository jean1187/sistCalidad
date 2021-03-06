<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Sistemas
 *
 * Administracion del inicio de sesion del cualquier usuario que use este sistema
 *
 * @package      Application
 * @author       Sistema de Calidad Total
 * @copyright    Copyright (c) 2013 - 2013.
 * @link                http://w2w.sistCalidad
 * @filesource ./application/controllers/login.php
 */

// ------------------------------------------------------------------------

/**
 * Clase Login
 * 
 * Acciones sobre el logueo del usuario
 * 
 * @package	base
 * @category    base
 * @author	Nestor Maitin
 * @fecha	21-02-2013
 */
class login extends CI_Controller {
    
    function  __construct() {
        parent::__construct();
        $this->load->library("encrypt");
        $this->load->model('m_login');
        $this->msgerror="";
        $this->msg="";
    }
  
    function index() {
        //hocks
        if($this->session->userdata('userLogin')!="")
            redirect('welcome', 'refresh');
       

	//echo $this->encrypt->encode("123");
        $user=$this->input->post("usuario");
        $password=$this->input->post("clave");

            //autenticacion
            if(!empty ($user))
            {
                $resultado=$this->m_login->ValUser($user,$password);
                 //Valido si el usuario existe
                  if(is_array($resultado))
                  {
                        $this->load->library("_menu");
                            $this->session->sess_destroy();
                            $this->session->sess_create();
                            $this->session->set_userdata(array('userLogin' => $resultado, 'user' => $resultado["userLogin"]));
                            $this->session->set_userdata("menu",($this->config->item("mantenimiento") && $resultado["grupo_id"] != 1)?"":$this->_menu->CrearMaquetadoMenu());
                            $this->m_login->HistorialLogin();
                       if($resultado["url_index"]!="")
                        redirect($resultado["url_index"], 'refresh');
                       else if($resultado["url_grupo"]!="")
                        redirect($resultado["url_grupo"], 'refresh');
                       else if($this->config->item("mantenimiento"))
                       {
                           redirect('login/mantenimiento', 'refresh');
                       }
                       else
                           redirect('welcome', 'refresh');
                  }
                 else 
                  {

                      switch ($resultado)
                      {
                        case 0:
                            $user="";
                            $this->msgerror = '<br>La combinaci&oacute;n nombre de usuario y su contrase&ntilde;a, no concuerda. Rectifique e intente de nuevo.';
                        break;
                        case 1:
                            $this->msgerror = '<br>Contrase&ntilde;a, no concuerda. Rectifique e intente de nuevo.';
                        break;
                        case 2:
                            $this->msg = '<br>El usuario  "'.$user.'"  se encuentra INACTIVO, por favor comuniquese con el Administrador del Sistema  <a href="mailto:'.$this->config->item('email').'?subject=Urgente para el Administrador">'.$this->config->item('email');
                        break;                    
                      }
                  }
            }
        $this->login_view($this->msgerror,$this->msg,$user);
    }//fin index
	    /**
	    *function salir del sistema y destruccion de las sessiones
	    */
    
    function login_view($msgerror='', $msg='',$user='') {
        $this->load->view('login', array('msgerror' => $msgerror, 'msg' => $msg,'user'=>$user));
    
    }
    
    function salir() {
        $this->session->sess_destroy();
        redirect(base_url(), 'refresh');
    }

    function Mantenimiento()
    {
        $this->cargar->menu_system("mantenimiento");
    }

//*********************
//fin CI_Controller
//*********************
}
/** End of file login.php */
/** Location: ./application/controllers/login.php */
?>
