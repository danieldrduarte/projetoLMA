<?php

class MunicipioModel extends Model{
	
    public function __construct(){
    	parent::__construct();   	
    }
    
	public function getCombo($where = array()){
		
		$where[] = " true ";
		
		$sql = "SELECT 
					cod_municipio as codigo,
  					nom_municipio as descricao
				FROM 
					endereco.municipio
				WHERE
					" . implode(' AND ', $where) ."
				ORDER BY
					2";

		return ($this->carregar($sql));
	}
}