<?php
    class Escola extends Controller{
    	
        public function ListaAction(){
        	$pesquisa = $_POST['pesquisaGeral'];
        
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
        					 'dadosCategoria'	=> $dadosCategoria,
        					 'pesquisa'			=> $pesquisa );
        	
        	$this->view('escola/lista', $arDados);
        }
        
        public function carregaEscolasAction(){
        	$modelo  = new EscolaModel();
        	$dados 	 = $_POST;
        	$where   = array();
        	
        	if(!empty($dados['pesquisa'])){
        		$where[] = "( cod_escola          ILIKE '%{$dados['pesquisa']}%' OR
        					  nom_escola          ILIKE '%{$dados['pesquisa']}%' OR
        		              nom_rede            ILIKE '%{$dados['pesquisa']}%' OR
        		              nom_dependencia     ILIKE '%{$dados['pesquisa']}%' OR
        		              nom_regiao          ILIKE '%{$dados['pesquisa']}%' OR
        					  nom_estado          ILIKE '%{$dados['pesquisa']}%' OR
        		              nom_municipio       ILIKE '%{$dados['pesquisa']}%' OR
        		              nom_cat_dependencia ILIKE '%{$dados['pesquisa']}%' OR
        		              nom_distrito        ILIKE '%{$dados['pesquisa']}%') ";
        	}else{
	        	if(!empty($dados['cod_escola'])){
	        		$where[] = " cod_escola ILIKE '%{$dados['cod_escola']}%' ";
	        	}
	        	
	        	if(!empty($dados['nom_escola'])){
	        		$where[] = " nom_escola ILIKE '%{$dados['nom_escola']}%' ";
	        	}
	        	
	        	if(!empty($dados['cod_rede'])){
	        		$where[] = " cod_rede = '{$dados['cod_rede']}' ";
	        	}
	        	
	        	if(!empty($dados['cod_dependencia'])){
	        		$where[] = " cod_dependencia = '{$dados['cod_dependencia']}' ";
	        	}
	        	
	        	if(!empty($dados['cod_regiao'])){
	        		$where[] = " cod_regiao = {$dados['cod_regiao']} ";
	        	}
	        	
	        	if(!empty($dados['cod_estado'])){
	        		$where[] = " cod_estado = {$dados['cod_estado']} ";
	        	}
	        	
	        	if(!empty($dados['cod_municipio'])){
	        		$where[] = " cod_municipio = '{$dados['cod_municipio']}' ";
	        	}
	        	
	        	if(!empty($dados['cod_cat_dependencia'])){
	        		$where[] = " cod_cat_dependencia = {$dados['cod_cat_dependencia']} ";
	        	}
        	}
        	
        	$retorno = $modelo->getListaEscolas($where);
        	die(json_encode($retorno));
        }
        
        public function carregaCoordenadasAction(){
        	$modelo  = new EscolaModel();
        	$dados 	 = $_POST;
        	$where   = array();

        	if(!empty($dados['cod_escola'])){
        		$where[] = " cod_escola ILIKE '%{$dados['cod_escola']}%' ";
        	}
        	
        	if(!empty($dados['nom_escola'])){
        		$where[] = " nom_escola ILIKE '%{$dados['nom_escola']}%' ";
        	}
        	
        	if(!empty($dados['cod_rede'])){
        		$where[] = " cod_rede = '{$dados['cod_rede']}' ";
        	}
        	
        	if(!empty($dados['cod_dependencia'])){
        		$where[] = " cod_dependencia = '{$dados['cod_dependencia']}' ";
        	}
        	
        	if(!empty($dados['cod_regiao'])){
        		$where[] = " cod_regiao = {$dados['cod_regiao']} ";
        	}
        	
        	if(!empty($dados['cod_estado'])){
        		$where[] = " cod_estado = {$dados['cod_estado']} ";
        	}
        	
        	if(!empty($dados['cod_municipio'])){
        		$where[] = " cod_municipio = '{$dados['cod_municipio']}' ";
        	}
        	
        	if(!empty($dados['cod_cat_dependencia'])){
        		$where[] = " cod_cat_dependencia = {$dados['cod_cat_dependencia']} ";
        	}

        	
        	$retorno = $modelo->getCoordenadasEscolas($where);
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
        	}elseif(!$tipo || $tipo == 'geral'){
        		$dados = $escola->montaGridGeral($cod_escola);
        	}elseif(!$tipo || $tipo == 'estrutura'){
        		$dados = $escola->montaGridEstrutura($cod_escola);
        	}elseif(!$tipo || $tipo == 'equip'){
        		$dados = $escola->montaGridEquipamentos($cod_escola);
        	}
        	
        	//se tiver um tipo setado então é uma requisição ajax
        	if($tipo){
        		die ($dados);
        	}else{
        		return $dados;
        	}
        	
        }
    }