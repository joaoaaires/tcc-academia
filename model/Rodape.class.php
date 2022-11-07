<?php

class Rodape{
    
    function run(){
        
        $html_rodape= new Html();
        $html=$html_rodape->load( 'view/rodape.html');

        return $html;
        
    }
}
