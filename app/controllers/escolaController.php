<?php
    class Escola extends Controller{
    	
        public function ListaAction(){
            $this->view('escola/lista', array());
        }
        
        public function carregaEscolasAction(){
        	$modelo  = new EscolaModel();
        	$retorno = $modelo->getListaEscolas();
        	die(json_encode($retorno));
        }
    }