<?php

class EstadoModel extends Model{
	
    public function __construct(){
    	parent::__construct();   	
    }
    
	public function getCombo($where = array()){
		
		$where[] = " true ";
		
		$sql = "SELECT 
					cod_estado as codigo,
  					slg_estado || ' - ' || nom_estado as descricao
				FROM 
					endereco.estado
				WHERE
					" . implode(' AND ', $where) ."
				ORDER BY
					2";
		
		return ($this->carregar($sql));
	}
}