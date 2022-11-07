<?php

//Carregamento das Classes do Sistema
function __autoload($classe){
    // Menu
    $pastas = array('controller','model','view');
    foreach($pastas as $pasta){
        if(file_exists( "{$pasta}/{$classe}.class.php" )){
            include_once "{$pasta}/{$classe}.class.php";
        }
    }
}

//Ativando Configuracoes
require_once("config/config.php");

//Chamada da Classe Principal
$app = new App;
$app->run();