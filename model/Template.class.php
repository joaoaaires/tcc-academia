<?php

class Template{

    public function run(){
        
        $html          = '';
        $html_menu     = '';
        $html_conteudo = '';
        $html_rodape   = '';
        
        if(file_exists(TEMPLATE)):
        
            $html        = file_get_contents(TEMPLATE);
            
            $menu        = new Menu();
            $html_menu   = $menu->run();
            
            $rodape      = new Rodape();
            $html_rodape = $rodape->run();
            
            if(Session::getValue('logado')):
              $modulo=App::getModulo();
            else:
              $modulo='Acesso';
            endif;
            
            if($modulo):
                if(class_exists($modulo)):
                    $class_modulo = $modulo;
                    $obj_modulo=new $class_modulo;
                    $html_conteudo = $obj_modulo->run();
                endif;
            endif;
            
            $html_erro = Session::getValue('erro');
            $html      = str_replace('#MENU#'   ,$html_menu     ,$html);
            $html      = str_replace('#ERRO#'   ,$html_erro     ,$html);
            $html      = str_replace('#CONTEUDO#',$html_conteudo,$html);
            $html      = str_replace('#RODAPE#' ,$html_rodape   ,$html);
            $html      = str_replace('#URL#'    ,URL            ,$html);
        
        else:
        
            $html = 'Arquivo '.TEMPLATE.' Nao Encontrado';
        
        endif;
        
        return $html;
    }
}
