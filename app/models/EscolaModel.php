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
		$html .= "<td bgcolor='#F1F1F1' align='center' colspan='2'><strong>Mapa</strong></td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td colspan='2' align='center'>";
		$html .= "<img style='border 0px; width: 181px; height:126px;' src='".IMAGENS."em_breve.png' >";
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
		$html .= "<td bgcolor='#F1F1F1' align='center' colspan='2'><strong>Informações da Escola</strong></td>";
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
		$html .= "</table>";
		
		return $html;
	}
}