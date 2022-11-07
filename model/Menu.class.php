<?php

class Menu {

    public function run(){

        $html = '';
        
        if(Session::getValue('logado')):

            $html_menu= new Html();
            $html=$html_menu->load( 'view/menu.html');

        endif;
        
        return $html;
        
    }
}


