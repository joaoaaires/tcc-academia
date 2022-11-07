<?php
Class App{
    
    public static $modulo;
    public static $action;
    public static $key;
    
    public function run(){
		
        
        $geturl = explode('/', $_SERVER['REQUEST_URI']);

        self::$modulo = isset($geturl[2]) ? $geturl[2] : '' ;
        self::$action = isset($geturl[3]) ? $geturl[3] : '' ;
        self::$key    = isset($geturl[4]) ? $geturl[4] : '' ;
        
        Session::start();           // Inicializa Sessão
        Connection::open('mysql');  // Abre Conexão com o Banco de Dados
        
        if(self::$modulo=='Ajax'):
            $obj = new Ajax;
            $site = $obj->run();
        else:
            $template = new Template();
            $site     = $template->run();
        endif;
        
        echo $site;
        
        Connection::close();
        
    }    
    public static function getModulo(){
        return self::$modulo;
    }
    public static function getAction(){
        return self::$action;
    }
    public static function getKey(){
        return self::$key;
    }
}
