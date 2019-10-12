<?php
class Atendimentos_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        
        public function get_atendimentos($limit = 10, $dia = false)
        {
        	if(isset($limit))
        		$limit = " LIMIT $limit";
        	
        	if($dia)
        		$dia = 'WHERE DATE(data) = CURRENT_DATE';
        	
        	$sql = "SELECT GROUP_CONCAT(s.descricao SEPARATOR ' | ') AS servico, f.nome AS funcionario,
						c.nome AS cliente, DATE_FORMAT(data, '%d/%m/%Y') AS data, DATE_FORMAT(data, '%H:%i') AS hora, ROUND(total, 2) AS total
					FROM atendimento a
					JOIN servicoAtendimento sa USING(idAtendimento)
					JOIN servico s USING(idServico)
					JOIN funcionario f USING(idFuncionario)
					JOIN cliente c USING(idCliente)
					$dia
					GROUP BY idAtendimento
        			$limit";
        	$query = $this->db->query($sql);
        	return $query->result_array();
        }
        
        public function insert_servicosAtendimento() {
        	
        	$idCliente = $this->input->post('cliente');
        	$idFuncionario = $this->input->post('funcionario');
        	
        	$query = $this->db->query("CALL inserirAtendimento($idCliente, $idFuncionario)");
        	return $query->row_array();
        }

        public function insert_servicoQuantidade() {
        
        	$data = array(
        			'idServico' => $this->input->post('idServico'),
        			'quantidade' => $this->input->post('quantidade'),
        			'subtotal' => str_replace(',', '.', $this->input->post('subtotal'))
        	);
        	
        	return $this->db->insert('temp_servicoAtendimento', $data);
        }

        public function update_servicoQuantidade() {
        
        	$data = array(
        			'quantidade' => $this->input->post('quantidade'),
        			'subtotal' => str_replace(',', '.', $this->input->post('subtotal'))
        	);
        
        	$this->db->where('idServico', $this->input->post('idServico'));
        	
			return $this->db->update('temp_servicoAtendimento', $data);
        }
        
        public function deleteServicoQuantidade($idServico) {
        	$this->db->where('idServico', $idServico);
        	return $this->db->delete('temp_servicoAtendimento');
        }
        
        public function clearServicoQuantidade() {
        	$this->db->query("TRUNCATE temp_servicoAtendimento");
        }
        
        public function get_clientesByCelOrName($desc) {
        	$sql = "SELECT idCliente AS id, CONCAT(nome, ' - ', telefone) AS value
					FROM cliente c
        			WHERE nome LIKE '%{$desc}%' OR maskRemove(telefone) LIKE '%{$desc}%'
        			ORDER BY value";
        	
        	$query = $this->db->query($sql);
        	return $query->result_array();
        }
        
        public function get_funcionarios($nome = null) {
        	if(isset($nome) && $nome != "")
        		$nome = "WHERE nome LIKE '%{$nome}%'";
        	
        	$sql = "SELECT idFuncionario AS id, nome AS value
		        	FROM funcionario f
		        	$nome
		        	ORDER BY value";
        	 
        	$query = $this->db->query($sql);
        	return $query->result_array();
        }
        
        public function get_servicos($desc = null, $inList = "") {
        	
        	if($inList != "")
        		$inList = "AND idServico NOT IN ({$inList})";
        	
        	$desc = "WHERE descricao LIKE '%{$desc}%'";
        		 
        	$sql = "SELECT idServico AS id, CONCAT(descricao, ' - R$ ', ROUND(precoBase, 2)) AS value, ROUND(precoBase, 2) AS subtotal
		        	FROM servico s
		        	$desc $inList
		        	ORDER BY value";
        
        	$query = $this->db->query($sql);
        	return $query->result_array();
        }
        
        public function get_servicoQuantidade() {
			$sql = "SELECT idServico, descricao, ROUND(precoBase, 2) AS precoBase, quantidade, ROUND(subtotal, 2) AS  subtotal
					FROM servico
					JOIN temp_servicoAtendimento USING(idServico);";
        
			$query = $this->db->query($sql);
			return $query->result_array();
        }
        
        public function get_tempServicoTotal() {
        	$sql = "SELECT ROUND(SUM(subtotal), 2) AS total, GROUP_CONCAT(idServico) AS inList
					FROM servico
					JOIN temp_servicoAtendimento USING(idServico);";
        
        	$query = $this->db->query($sql);
        	return $query->row_array();
        }
}