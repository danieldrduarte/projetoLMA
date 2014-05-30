<?php
    class Escola extends Controller{
    	
        public function ListaAction(){
        	
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
        	
        	$this->view('escola/lista', $arDados);
        }
        
        public function carregaEscolasAction(){
        	$modelo  = new EscolaModel();
        	$retorno = $modelo->getListaEscolas();
        	die(json_encode($retorno));
        }
        
        public function detalhaAction(){
        	$cod_escola 	= $this->getParam('cod_escola');
        	$tipo 			= $this->getParam('tipo');

        	$dadosCategoria = $this->montaGridInformacoes($cod_escola, $tipo);
        	
        	$arDados = array('cod_escola'	=> $cod_escola,
        			         'dadostela'	=> $dadosCategoria );
        	
        	$this->view('escola/detalha', $arDados);
        }
        
        private function montaGridInformacoes($cod_escola,$tipo = null){
        	$escola      = new EscolaModel();
        	$dadosEscola = $escola->getDadosEscola($cod_escola);
        	
        	if($tipo && $tipo == 'endereco'){
        		$dados = $escola->montaGridEndereco($cod_escola);
        		
        	}elseif(!$tipo || $tipo == 'principal'){
        		$dados = $escola->montaGridPrincipal($cod_escola);
        	}
        	
        	//se tiver um tipo setado então é uma requisição ajax
        	if($tipo){
        		die ($dados);
        	}else{
        		return $dados;
        	}
        	
        }
    }