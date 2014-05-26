<?php
    class Info extends Controller{
    	
        public function trabalhoAction(){
            $this->view('info/trabalho', array());
        }
    	
        public function autorAction(){
            $this->view('info/autor', array());
        }
    	
        public function arquivosAction(){
            $this->view('info/arquivos', array());
        }
    }