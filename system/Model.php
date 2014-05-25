<?php

class Model{
	
    private $link;
    private $host 	  = '127.0.0.1';
    private $port 	  = '5433';
    private $dbname   = 'projeto';
    private $user 	  = 'postgres';
    private $password = 'pg01';

    function __construct(){
    	if(!isset($this->link) ){
    		$this->link = pg_connect("host= {$this->host} port= {$this->port} dbname= {$this->dbname} user= {$this->user} password= {$this->password}");
    	}    	
    }
    
	public function executar($sql){
		try {
			$resultado = pg_query($this->link,$sql);
			return $resultado;
		}catch (Exception $e){
			die("Exception: " . $e->getMessage());
		}
	}
	
	public function carregar($sql){
		return pg_fetch_all($this->executar($sql));
	}
}