<?php
    class Index extends Controller{
    	
        public function IndexAction(){
//             $this->view('index/index', array());
        	$modelo = new EscolaModel();
        	$dados  = $modelo->getListaEscolas();
        	$this->view('escola/lista', array('dadosEscolas' => $dados));
        }
    }