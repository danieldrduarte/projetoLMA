<?php

class RedeModel extends Model{
	
    public function __construct(){
    	parent::__construct();   	
    }
    
	public function getCombo($where = array()){
		
		$sql = "SELECT 
					cod_rede as codigo,
  					nom_rede as descricao
				FROM 
					escola.rede
				ORDER BY
					2";
		
		return ($this->carregar($sql));
	}
}