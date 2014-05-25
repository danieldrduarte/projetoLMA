<?php
class Controller extends System {
	
	protected function view($nome, $vars = null) {
		if (is_array ( $vars ) && count ( $vars ) > 0) {
			extract ( $vars, EXTR_PREFIX_ALL, 'view' );
		}
		
		$_caminho_view = VIEWS . $nome . '.phtml';
		require_once (VIEWS . 'main.phtml');
	}
}