<?php
    class Escola extends Controller{
    	
        public function ListaAction(){
        	$modelo = new EscolaModel();
        	$dados  = $modelo->getListaEscolas();
            $this->view('escola/lista', array('dadosEscolas' => $dados));
        }
        
        public function carregaEscolasAction(){
        	$modelo  = new EscolaModel();
        	$retorno = $modelo->getListaEscolas();
        	die(json_encode($retorno));
        }
    }