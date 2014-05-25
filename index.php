<?php
	//constantes
    define( 'CONTROLLERS','app/controllers/' );
    define( 'VIEWS','app/views/' );
    define( 'MODELS','app/models/' );
    define( 'IMAGENS','public/imagens/' );
    define( 'd','die' );

    //carregando arquivos básicos
    require_once('system/System.php');
    require_once('system/Controller.php');
    require_once('system/Model.php');
    require_once('system/Util.php');
    
    //autoload para carregar as modelos
    function __autoload( $file ){
        if ( file_exists(MODELS . $file . '.php') ){
            require_once( MODELS . $file . '.php' );
    	}else{
            die("Model ou não encontrada.");
        }
    }

    $start = new System;
    $start->run();