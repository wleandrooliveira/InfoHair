<?php
class Funcionarios_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        
        public function signIn()
        {
			$username = $this->input->post('username');
			$passwd = $this->input->post('passwd');
        
        	$query = $this->db->get_where('funcionario', array('nome' => $username, 
        													'senha' => md5('brothers@' . $passwd),
        													'perfil' => 'Sócio'
        	));
        	return $query->row_array();
        }
        
        public function get_funcionarios($idFuncionario = FALSE)
        {
        	if ($idFuncionario === FALSE)
        	{
        		$query = $this->db->get('funcionario');
        		return $query->result_array();
        	}
        
        	$query = $this->db->get_where('funcionario', array('idFuncionario' => $idFuncionario));
        	return $query->row_array();
        }
        
        public function insert_or_update() {
        	
        	$idFuncionario = $this->input->post('idFuncionario') !== null ? $this->input->post('idFuncionario') : false;
        	
        	$data = array(
        			'nome' => $this->input->post('nome'),
        			'perfil' => $this->input->post('perfil'),
        			'senha' => md5('brothers@' . $this->input->post('senha'))
        	);
        	
        	if($idFuncionario != false) {
        		$this->db->where('idFuncionario', $idFuncionario);
        		return $this->db->update('funcionario', $data);
        	}
        	
        	return $this->db->insert('funcionario', $data);
        }
        
        public function delete($idFuncionario) {
        	$this->db->where('idFuncionario', $idFuncionario);
        	return $this->db->delete('funcionario');
        }
}