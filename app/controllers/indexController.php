<?php
    class Index extends Controller{
    	
        public function IndexAction(){
            $this->view('index/index', array());
        }
    }