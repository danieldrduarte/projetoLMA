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
    
	public function getCoordenadasEscolas($where = array()){
		
		$where[] = " num_latitude != '' AND num_longitude != '' ";
		
		$sql = "SELECT DISTINCT 
					num_latitude::float AS lat,
					num_longitude::float AS lng,
					cod_escola as data,
					nom_escola
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
		$listas = new Listas();
		return $listas->montaGridEndereco($dadosEscola);
	}
	
	public function montaGridPrincipal($cod_escola){
		$dadosEscola = $this->getDadosEscola($cod_escola);
		$listas = new Listas();
		return $listas->montaGridPrincipal($dadosEscola);		
	}
	
	public function montaGridGeral($cod_escola){
		$dadosEscola = $this->getDadosComplementaresEscola($cod_escola);
		$listas = new Listas();
		return $listas->montaGridGeral($dadosEscola);		
	}
	
	public function montaGridEquipamentos($cod_escola){
		$dadosEscola = $this->getDadosComplementaresEscola($cod_escola);
		$listas = new Listas();
		return $listas->montaGridEquipamentos($dadosEscola);		
	}
	
	public function montaGridEstrutura($cod_escola){
		$dadosEscola = $this->getDadosComplementaresEscola($cod_escola);
		$listas = new Listas();
		return $listas->montaGridEstrutura($dadosEscola);		
	}
}