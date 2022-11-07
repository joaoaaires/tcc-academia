<?php

Class Html{
    
    public static function load( $arquivo_html ){
        if(file_exists($arquivo_html)):
            return file_get_contents($arquivo_html);
        else:
            return '
			
			<div class="alert">
  <button type="button" class="close" data-dismiss="alert">×</button>
  O arquivo <strong>"'.$arquivo_html.'"</strong> não foi encontrado !
</div>';
        endif; 
    }
}

