<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

	public function create($data)
	{
		return $this->db->insert('usuarios', $data);
	}


	public function login($username='', $password='')
	{
		$this->db->where("username", $username);
		$this->db->where("password", $password);

		$resultados = $this->db->get("usuarios");
		if ($resultados->num_rows() > 0) {
			return $resultados->row();
		}else{
			return false;
		}
	}

	public function getusers()
	{
		$resultado = $this->db->get("usuarios");
		return $resultado->result();
	}

	public function getuser($id)
	{
		$this->db->where('id', $id);
		$resultado = $this->db->get("usuarios");
		return $resultado->row();
	}

	public function modify($id, $datos)
	{
		$this->db->where('id', $id);
		return $this->db->update('usuarios', $datos);
	}

	public function remove($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('usuarios');
	}

}

/* End of file Usuarios_model.php */
/* Location: ./application/models/Usuarios_model.php */