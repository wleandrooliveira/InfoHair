<?php
class Clientes_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        
        public function get_clientes($idCliente = false)
        {    
        	
        	$sql = "SELECT idCliente, nome, telefone, DATE_FORMAT(dataNascimento, '%d/%m/%Y') AS dataNascimento
        			FROM cliente";
        	
        	if ($idCliente !== false) {
        		
        		if ($idCliente == null)
        			return null;
        		
        		$sql = "$sql
        				WHERE idCliente = $idCliente";
        		
        		$query = $this->db->query($sql);
        		return $query->row_array();
        	}
        
        	$query = $this->db->query($sql);
        	return $query->result_array();
        }
        
        public function insert_or_update() {
        	 
        	$idCliente = $this->input->post('idCliente') !== null && $this->input->post('idCliente') != '' ? $this->input->post('idCliente') : 'NULL';
        	$nome = $this->input->post('nome');
        	$telefone = $this->input->post('telefone') != '' ? "'".$this->input->post('telefone')."'" : "NULL";
        	$dataNascimento = $this->input->post('dataNascimento');
        	
        	$sql = "CALL insertUpdateCliente($idCliente, '$nome', $telefone, '$dataNascimento')";
        	
        	$query = $this->db->query($sql);
        	return $query->row_array();
        	 
        }
        
        public function delete($idCliente) {
        	$this->db->where('idCliente', $idCliente);
        	return $this->db->delete('cliente');
        }
}