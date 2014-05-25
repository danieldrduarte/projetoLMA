<?php

class Util{

	
	public static function ver(){
		
	   $parar   = false;
	   $caminho = array_shift(debug_backtrace());
	   
	   echo '
	       <div style="background-color: #ddd; color: #000; font-size: 14px;">
	       <div>
	           <label>
	               Linha   --> <label class="valorCaminho">'.$caminho['line']    .'</label><br />
	               Caminho --> <label class="valorCaminho">'.$caminho['file']    .'</label><br />
	           </label>
	       </div>';
	
	   echo '<div><pre>';
	
	
	   foreach( $caminho['args'] as $indice => $valor ){
	
	       if(  $valor == 'die' ) $parar = true;
	       echo '<label style="color:red; font-weight: bold;">Argumento '.( $indice + 1 ).'</label><br />';
	       var_dump( $valor );
	       echo '<br /><br />';
	
	   }
	
	   echo '</div></pre></div>';
	
	
	   // Verifica se é para dar o die no final
	   if( $parar ){ die; }
	}

}