<?php

class DependenciaModel extends Model{
	
    public function __construct(){
    	parent::__construct();   	
    }
    
	public function getCombo ($where = array()){
		
		$sql = "SELECT 
					cod_dependencia as codigo,
  					nom_dependencia as descricao
				FROM 
					escola.dependencia_administrativa
				ORDER BY
					2";
		
		return ($this->carregar($sql));
	}
}