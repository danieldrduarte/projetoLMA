<?php

class CategoriaModel extends Model{
	
    public function __construct(){
    	parent::__construct();   	
    }
    
	public function getCombo($where = array()){
		
		$sql = "SELECT 
					cod_cat_dependencia as codigo,
  					nom_cat_dependencia as descricao
				FROM 
					escola.categoria_dependencia_administrativa
				ORDER BY
					2";
		
		return ($this->carregar($sql));
	}
}