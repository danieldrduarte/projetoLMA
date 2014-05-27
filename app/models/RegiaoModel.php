<?php

class RegiaoModel extends Model{
	
    public function __construct(){
    	parent::__construct();   	
    }
    
	public function getCombo($where = array()){
		
		$sql = "SELECT 
					cod_regiao as codigo,
  					nom_regiao as descricao
				FROM 
					endereco.regiao
				ORDER BY
					2";
		
		return ($this->carregar($sql));
	}
}