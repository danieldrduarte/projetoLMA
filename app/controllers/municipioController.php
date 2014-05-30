<?php
    class Municipio extends Controller{
    	
        public function carregaMunicipiosAction(){
        	
        	$cod_estado = $this->getParam('cod_estado');
        	
        	if($cod_estado){
	        	$modelo = new MunicipioModel();
	        	$dados = $modelo->getCombo(array("cod_estado = " . (int) $cod_estado));
	        	die(Util::combo('cod_municipio', $dados, true, "Selecione..."));
        	}else{
        		die( Util::combo('cod_municipio', array(), false, "Selecione um Estado", "") );
        	}
        }

    }