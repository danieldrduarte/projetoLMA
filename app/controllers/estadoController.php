<?php
    class Estado extends Controller{
    	
        public function carregaEstadosAction(){
        	
        	$cod_regiao = $this->getParam('cod_regiao');
        	
        	if($cod_regiao){
	        	$modelo = new EstadoModel();
	        	$dados = $modelo->getCombo(array("cod_regiao = " . (int) $cod_regiao));
	        	die(Util::combo('cod_estado', $dados, true, "Selecione...", "carregaMunicipios(this);"));
        	}else{
        		die( Util::combo('cod_estado', array(), false, "Selecione uma Região", ""));
        	}
        }

    }