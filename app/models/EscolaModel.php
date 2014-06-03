<?php

class EscolaModel extends Model{
	
    public function __construct(){
    	parent::__construct();   	
    }
    
	public function getListaEscolas($where = array()){
		
		$where[] = " 1 = 1 ";
		
		$sql = "SELECT 
					* 
				FROM 
					escola.vw_lista_escolas
				WHERE
					" . implode(" AND ", $where) .";";
		
		return ($this->carregar($sql));
	}

	public function getDadosEscola($cod_escola){
		
		$sql = "SELECT 
					* 
				FROM 
					escola.vw_dados_escola
				WHERE
					cod_escola = '" . (int) $cod_escola . "'";
		
		return ($this->carregarLinha($sql));
	}

	public function getDadosComplementaresEscola($cod_escola){
		
		$sql = "SELECT 
					* 
				FROM 
					escola.informacoes_adicionais info
				JOIN
					escola.informacoes_adicionais_comp infocomp ON info.cod_escola = infocomp.cod_escola
				WHERE
					info.cod_escola = '" . (int) $cod_escola . "'";
		
		return ($this->carregarLinha($sql));
	}
	
	public function montaGridEndereco($cod_escola){
		$dadosEscola = $this->getDadosEscola($cod_escola);
		
		$html  = "<br>";
		$html .= "<table class='table' style='width:95%; border:1px solid #F1F1F1; font-size:14px;'>";
		$html .= "<tr>";
		$html .= "<td bgcolor='#F1F1F1' align='center' colspan='2'><strong>Endereço</strong></td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Região</strong></td>";
		$html .= "<td>{$dadosEscola['nom_regiao']}</td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td><strong>Estado</strong></td>";
		$html .= "<td>{$dadosEscola['slg_estado']} - {$dadosEscola['nom_estado']}</td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td><strong>Município</strong></td>";
		$html .= "<td>{$dadosEscola['nom_municipio']}</td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td><strong>Distrito</strong></td>";
		$html .= "<td>{$dadosEscola['nom_distrito']}</td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td><strong>Endereço</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_endereco']}</td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td><strong>Bairro</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_bairro']}</td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td><strong>Número</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_numero']}</td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td><strong>Complemento</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_complemento']}</td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td><strong>CEP</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_cep']}</td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td><strong>Latitude</strong></td>";
		$html .= "<td>" . str_replace(',', '.', $dadosEscola['num_latitude']) ."</td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td><strong>Longitude</strong></td>";
		$html .= "<td>" . str_replace(',', '.', $dadosEscola['num_longitude']) ."</td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td colspan='2' align='center'>";
		$html .= "<input type='hidden' id='latitude' value='" . str_replace(',', '.', $dadosEscola['num_latitude']) ."' />";
		$html .= "<input type='hidden' id='longitude' value='" . str_replace(',', '.', $dadosEscola['num_longitude']) ."' />";
		$html .= "<div id='mapa' class='gmap3'></div>";
		$html .= "</td>";
		$html .= "</tr>";
		$html .= "</table>";
		
		return $html;
	}
	
	public function montaGridPrincipal($cod_escola){
		$dadosEscola = $this->getDadosEscola($cod_escola);
		
		$html  = "<br>";
		$html .= "<table class='table' style='width:95%; border:1px solid #F1F1F1; font-size:14px;'>";
		$html .= "<tr>";
		$html .= "<td bgcolor='#F1F1F1' align='center' colspan='2'><strong>Informações Principais</strong></td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Ano da informação</strong></td>";
		$html .= "<td>{$dadosEscola['cod_ano']}</td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td><strong>Código da Escola</strong></td>";
		$html .= "<td>{$dadosEscola['cod_escola']}</td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td><strong>Nome da Escola</strong></td>";
		$html .= "<td>{$dadosEscola['nom_escola']}</td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td><strong>Rede</strong></td>";
		$html .= "<td>{$dadosEscola['nom_rede']}</td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td><strong>Dependência</strong></td>";
		$html .= "<td>{$dadosEscola['nom_dependencia']}</td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td><strong>Categoria da Dependência</strong></td>";
		$html .= "<td>{$dadosEscola['nom_cat_dependencia']}</td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td><strong>Localização</strong></td>";
		$html .= "<td>{$dadosEscola['nom_localizacao']}</td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td><strong>Condição Atual</strong></td>";
		$html .= "<td>{$dadosEscola['nom_condicao']}</td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td bgcolor='#F1F1F1' align='center' colspan='2'><strong>Contato</strong></td>";
		$html .= "</tr>";	
		$html .= "<tr>";
		$html .= "<td><strong>DDD</strong></td>";
		$html .= "<td>{$dadosEscola['num_ddd']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td><strong>Telefone Principal</strong></td>";
		$html .= "<td>{$dadosEscola['num_telefone']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td><strong>Telefone Secundário</strong></td>";
		$html .= "<td>{$dadosEscola['num_telefonesecundario']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td><strong>Fax</strong></td>";
		$html .= "<td>{$dadosEscola['num_fax']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td><strong>Email</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_email']}</td>";
		$html .= "</tr>";			
		$html .= "</table>";
		
		return $html;
	}
	
	public function montaGridGeral($cod_escola){
		$dadosEscola = $this->getDadosComplementaresEscola($cod_escola);
		
		$html  = "<br>";
		$html .= "<table class='table' style='width:95%; border:1px solid #F1F1F1; font-size:14px;'>";
		$html .= "<tr>";
		$html .= "<td bgcolor='#F1F1F1' align='center' colspan='2'><strong>Informações Gerais</strong></td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Atividade Complementar</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_atividade_complementar']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Ensino Fundamental organizado em CICLOS</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_ensinoemciclos']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Acessibilidade adequada a alunos<br>com deficiência ou mobilidade reduzida</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_acessibilidade']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Dependências e vias adequadas a alunos<br>com deficiência ou mobilidade reduzida</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_depacessibilidade']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Sanitário adequado a alunos<br>com deficiência ou mobilidade reduzida</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_sanacessibilidade']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Atendimento Educacional Especializado (AEE)</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_atendimentoespec']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Alimentação Escolar para os alunos</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_alimentacaoescolar']}</td>";
		$html .= "</tr>";	
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Água Filtrada</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_aguafiltrada']}</td>";
		$html .= "</tr>";	
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Escola cede espaço para turmas do<br>Programa Brasil Alfabetização</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_espacopba']}</td>";
		$html .= "</tr>";	
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Escola abre aos finais de semana para a comunidade</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_abrefinalsemana']}</td>";
		$html .= "</tr>";	
		$html .= "</table>";
		
		return $html;
	}
	
	public function montaGridEquipamentos($cod_escola){
		$dadosEscola = $this->getDadosComplementaresEscola($cod_escola);
		
		$html  = "<br>";
		$html .= "<table class='table' style='width:95%; border:1px solid #F1F1F1; font-size:14px;'>";
		$html .= "<tr>";
		$html .= "<td bgcolor='#F1F1F1' align='center' colspan='2'><strong>Equipamentos Disponíveis</strong></td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Internet</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_internet']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Computadores para uso de Alunos</strong></td>";
		$html .= "<td>{$dadosEscola['num_computadoresalunos']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>DVD</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_equipdvd']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Impressora</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_equipimpressora']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Aparelho de Som</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_equipsom']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Projeto Multimidia (Datashow)</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_equipdatashow']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>FAX</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_equipfax']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Máquina Fotográfica / Filmadora</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_equipmaqfotografica']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Parabólica</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_equipparabolica']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Copiadora</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_equipcopiadora']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Retroprojetor</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_equipretroprojetor']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>TV</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_equiptv']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Videocassete</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_equipvideokct']}</td>";
		$html .= "</tr>";			
		$html .= "</table>";
		return $html;
	}
	
	public function montaGridEstrutura($cod_escola){
		$dadosEscola = $this->getDadosComplementaresEscola($cod_escola);
		
		$html  = "<br>";
		$html .= "<table class='table' style='width:95%; border:1px solid #F1F1F1; font-size:14px;'>";	
		$html .= "<tr>";
		$html .= "<td bgcolor='#F1F1F1' align='center' colspan='2'><strong>Informações Estrutura</strong></td>";
		$html .= "</tr>";	
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Número de Salas Existentes</strong></td>";
		$html .= "<td>{$dadosEscola['num_salasexistentes']}</td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Número de Salas Utilizadas</strong></td>";
		$html .= "<td>{$dadosEscola['num_salasusadas']}</td>";
		$html .= "</tr>";					
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Sala de Diretoria</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_diretoria']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Sala de Professor</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_salaprofessor']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Secretaria</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_secretaria']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Refeitório</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_refeitorio']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Despensa</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_despenca']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Almoxarifado</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_almoxarifado']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Auditório</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_auditorio']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Laboratório de Informática</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_laboratorioinformatica']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Laboratório de Ciências</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_laboratoriociencias']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Sala de Atendimento Especial</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_salaatendimentoespecial']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Quadra de Esportes Coberta</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_quadracoberta']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Quadra de Esportes Descoberta</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_quadradescoberta']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Pátio Coberto</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_patiocoberto']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Pátio Descoberto</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_patiodescoberto']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Parque Infantil</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_parqueinfantil']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Cozinha</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_cozinha']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Biblioteca</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_biblioteca']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Berçário</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_bercario']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Sanitário Dentro do Predio</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_sanitariodentro']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Sanitário Fora do Predio</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_sanitariofora']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Banheiro com Chuveiro</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_banheirochuveiro']}</td>";
		$html .= "</tr>";			
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Lavanderia</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_lavanderia']}</td>";
		$html .= "</tr>";	
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Alojamento de Aluno</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_alojamentoaluno']}</td>";
		$html .= "</tr>";	
		$html .= "<tr>";
		$html .= "<td style='width:30%;'><strong>Área Verde</strong></td>";
		$html .= "<td>{$dadosEscola['dsc_areaverde']}</td>";
		$html .= "</tr>";	
		$html .= "</table>";
		
		return $html;
	}
}