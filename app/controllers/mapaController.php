<?php
    class Mapa extends Controller{
    	
        public function MapaAction(){
        	$mRede 		= new RedeModel();
        	$dadosRede	= $mRede->getCombo(array());
        	 
        	$mDependencia		= new DependenciaModel();
        	$dadosDependencia	= $mDependencia->getCombo(array());
        	 
        	$mRegiao		= new RegiaoModel();
        	$dadosRegiao	= $mRegiao->getCombo(array());
        	 
        	$mCategoria		= new CategoriaModel();
        	$dadosCategoria	= $mCategoria->getCombo(array());
        	
        	$arDados = array('dadosRede'		=> $dadosRede,
		        			 'dadosDependencia'	=> $dadosDependencia,
		        			 'dadosRegiao'		=> $dadosRegiao,
		        			 'dadosCategoria'	=> $dadosCategoria );
        	
            $this->view('mapa/mapa', $arDados);
        }
    }