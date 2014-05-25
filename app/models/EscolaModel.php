<?php

class EscolaModel extends Model{
	
    public function __construct(){
    	parent::__construct();   	
    }
    
	public function getListaEscolas($where = array()){
		
		$sql = "SELECT 
					* 
				FROM 
					escola.vw_lista_escolas";
		
		return ($this->carregar($sql));
	}
}