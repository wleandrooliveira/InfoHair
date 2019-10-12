<?php 

class Relatorios_model extends CI_Model {

        public function __construct()
        {
           $this->load->database();
        }
		
        public function generateRelatorio()
        {
        	$tipo = $this->input->post('tipo');
        	$dataInicio = $this->input->post('dataInicio');
        	$dataFim = $this->input->post('dataFim');

        	if($tipo == 'dia') {
        		$sql = "SELECT DATE_FORMAT(data, '%d/%m/%Y') AS dia, COUNT(DISTINCT idCliente) AS qtdCliente, 
							COUNT(idServico) AS qtdServico, ROUND(SUM(total), 2) AS totalDia
						FROM atendimento
						JOIN servicoAtendimento USING(idAtendimento)
						WHERE DATE(data) BETWEEN DATE('$dataInicio') AND DATE('$dataFim')
						GROUP BY dia
						UNION 
						SELECT 'Total' AS dia, COUNT(DISTINCT idCliente) AS qtdCliente, 
							COUNT(idServico) AS qtdServico, SUM(total) AS total
						FROM atendimento
						JOIN servicoAtendimento USING(idAtendimento)
						WHERE DATE(data) BETWEEN DATE('$dataInicio') AND DATE('$dataFim')";
        	} else if($tipo == 'servico') {
        		$sql = "SELECT descricao, COUNT(idAtendimento) qtdAtendimento, COUNT(DISTINCT idCliente) AS qtdCliente, 
							COALESCE(ROUND(SUM(COALESCE(subtotal), 0)), 2), '-') AS totalServico
						FROM servico
						LEFT JOIN (SELECT idServico, idAtendimento, idCliente, subtotal
									FROM servicoAtendimento
									JOIN atendimento USING(idAtendimento)
									WHERE DATE(data) BETWEEN DATE('$dataInicio') AND DATE('$dataFim')) a USING(idServico)
						GROUP BY idServico
						UNION 
						SELECT 'Total' AS servico, COUNT(idAtendimento) qtdAtendimento, COUNT(DISTINCT idCliente) AS qtdCliente,
						    COALESCE(ROUND(SUM(COALESCE(subtotal, 0)), 2), '-') AS totalServico
						FROM servico
						LEFT JOIN (SELECT idServico, idAtendimento, idCliente, subtotal
									FROM servicoAtendimento
									JOIN atendimento USING(idAtendimento)
									WHERE DATE(data) BETWEEN DATE('$dataInicio') AND DATE('$dataFim')) a USING(idServico);";
        	} else if($tipo == 'funcionario') {
        		$sql = "SELECT nome, COUNT(idAtendimento) qtdAtendimento, COUNT(DISTINCT idCliente) AS qtdCliente, 
							ROUND(SUM(COALESCE(total, 0)), 2) AS totalFuncionario, COUNT(DISTINCT dia) AS diasTrabalhados, 
							COALESCE(ROUND(COUNT(idAtendimento)/COUNT(DISTINCT dia), 2), '-') AS mediaAtendimento, 
							COALESCE(ROUND(SUM(COALESCE(total, 0))/COUNT(DISTINCT dia), 2), '-') AS mediaValor
						FROM funcionario
						LEFT JOIN (SELECT idFuncionario, idAtendimento, idCliente, total, DATE(data) AS dia
									FROM servicoAtendimento
									JOIN atendimento USING(idAtendimento)
									WHERE DATE(data) BETWEEN DATE('$dataInicio') AND DATE('$dataFim')) a USING(idFuncionario)
						GROUP BY idFuncionario
						UNION 
						SELECT 'Total' AS nome, COUNT(idAtendimento) AS qtdAtendimento, COUNT(DISTINCT idCliente) AS qtdCliente,
						   ROUND(SUM(COALESCE(total, 0)), 2) AS totalFuncionario, COUNT(DISTINCT dia), 
						   ROUND(COUNT(idAtendimento)/COUNT(DISTINCT dia), 2) AS media,
						   COALESCE(ROUND(SUM(COALESCE(total, 0))/COUNT(DISTINCT dia), 2), '-') AS mediaValor
						FROM funcionario
						LEFT JOIN (SELECT idFuncionario, idAtendimento, idCliente, total, DATE(data) AS dia
									FROM servicoAtendimento
									JOIN atendimento USING(idAtendimento)
									WHERE DATE(data) BETWEEN DATE('$dataInicio') AND DATE('$dataFim')) a USING(idFuncionario)";
        	} else if($tipo == 'mensagem') {
        		$sql = "SELECT nome AS cliente, texto AS mensagem, descricao AS tipo, status AS situacao,
	        				DATE_FORMAT(data, '%d/%m/%Y') AS data, COALESCE(DATE_FORMAT(dataEnvio, '%d/%m/%Y %H:%i'), '-') AS dataEnvio,
	        				COALESCE(erroMisterPostman, statusMisterPostman) AS descMisterPostman
		        		FROM mensagem
						JOIN cliente USING(idCliente)
						JOIN modelo_mensagem USING(idModelo)
		        		WHERE DATE(data) BETWEEN DATE('$dataInicio') AND DATE('$dataFim')";
        	}
        	
        	else {
        		return array();
        	}

        	$query = $this->db->query($sql);
        	return $query->result_array();
        }

}