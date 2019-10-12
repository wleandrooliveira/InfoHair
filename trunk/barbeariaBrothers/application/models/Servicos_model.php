<?php
class Servicos_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        
        public function get_servicos($idServico = FALSE)
        {
        	if ($idServico === FALSE)
        	{
        		$query = $this->db->get('servico');
        		return $query->result_array();
        	}
        
        	$query = $this->db->get_where('servico', array('idServico' => $idServico));
        	return $query->row_array();
        }
        
        public function insert_or_update() {
        	
        	$idServico = $this->input->post('idServico') !== null ? $this->input->post('idServico') : false;
        	
        	$data = array(
        			'descricao' => $this->input->post('servico'),
        			'precoBase' => $this->input->post('preco'),
        	);
        	
        	if($idServico != false) {
        		$this->db->where('idServico', $idServico);
        		return $this->db->update('servico', $data);
        	}
        	
        	return $this->db->insert('servico', $data);
        }
        
        public function delete($idServico) {
        	$this->db->where('idServico', $idServico);
        	return $this->db->delete('servico');
        }
}