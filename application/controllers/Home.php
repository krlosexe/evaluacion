<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
		$this->load->model('usuarios_model');
	}
	public function index()
	{
		if ($this->session->userdata("login")) {
			redirect(base_url()."home/user");
		}
		$this->load->view('login');
	}

	public function sreg()
	{
		
		if ($this->session->userdata("login")) {
			redirect(base_url()."home/user");
		}
		$this->load->view('registro');
	}


	public function login()
	{
		if ($this->session->userdata("login")) {
			redirect(base_url()."home/user");
		}
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$res      = $this->usuarios_model->login($username, sha1($password));

		if (!$res) {
			$error = array('error' => "Usuario y/o contraseña incorrectos");
			$this->session->set_flashdata($error);
			redirect(base_url());
		}else{
			$data_login = array('id'       => $res->id,
			 					'nombre'   => $res->nombre,
			 					'username' => $res->username,
			 					'login'    => TRUE);
			$this->session-> set_userdata($data_login);
			redirect(base_url()."home/user");
		}
	}


	public function user()
	{
		if (!$this->session->userdata("login")) {
			redirect(base_url()."home/sreg");
		}else{
			$id_user = $this->session->userdata("id");
		 	$data = array('usuario'  => $this->usuarios_model->getuser($id_user),
		                  'ip'       => $this->input->ip_address(),
		                  'usuarios' => $this->usuarios_model->getusers());
			$this->load->view('usuario', $data);
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}

	public function store()
	{
	   $name  =  $this->input->post("nombre");
       $user  =  $this->input->post("username");
       $pass  =  $this->input->post("password");

		$data = array(
			'nombre'    => $name,
		    'username'  => $user,
		    'password'  => sha1($pass)
		);

		$this->form_validation->set_data($data);
		$this->form_validation->set_rules('nombre',  'nombre', 'required');
		$this->form_validation->set_rules('username', 'nombre de usuario', 'required|is_unique[usuarios.username]');
		$this->form_validation->set_rules('password', 'contraseña', 'required');

		if ($this->form_validation->run()){
			if ($this->usuarios_model->create($data)) {
				$this->session->set_flashdata('valid', 'USUARIO REGISTRADO');
				redirect(base_url());
			}
		}else{
			$this->session->set_flashdata('error', 'A ocurrido un error');
			$this->sreg();
		}
	}


	public function modify()
	{
		$pass  = $this->input->post("pass");
    	$pass1 = $this->input->post("pass1");
    	$pass2 = $this->input->post("pass2");

    	$data = array(
			'pass'  => $pass,
			'pass1' => $pass1,
			'pass2' => $pass2
		);
		$this->form_validation->set_data($data);
    	$this->form_validation->set_rules('pass', 'contraseña actual', 'required');
		$this->form_validation->set_rules('pass1', 'nueva contraseña', 'required');
		$this->form_validation->set_rules('pass2', 'repita contraseña', 'required');

		if ($this->form_validation->run()) {
			$id_user = $this->session->userdata("id");
			$user    = $this->usuarios_model->getuser($id_user);
			if ($user->password != sha1($pass))  {
				$this->session->set_flashdata('error', 'La contraseña actual es incorrecta');
				$this->user();
			}else if ($pass1 != $pass2) {
				$this->session->set_flashdata('error', 'Las nuevas contraseñas no coinciden');
				$this->user();
			}else{
				$datos   = array('password'  => sha1($pass1));
				if ($this->usuarios_model->modify($id_user, $datos)) {
        			$this->session->set_flashdata('valid', 'Contraseña cambiada');
					$this->user();
	        	}else{
	        		$this->session->set_flashdata('error', 'A ocurrido 1 error');
					$this->user();
	        	}
			}
		}else{
			$this->session->set_flashdata('error', 'A ocurrido un error');
			$this->user();
		}
	}

	public function register()
	{
		$this->load->view('registro');
	}

	public function delete($id)
	{
		if ($this->usuarios_model->remove($id)) {
			$this->session->set_flashdata('valid', 'Usuario Eliminado');
		    $this->user();
		}
	}

	public function update($id)
	{
		$this->load->view('update');
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */