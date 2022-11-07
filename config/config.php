<?php

// Mensagens de Erro
error_reporting(E_ALL);
ini_set('display_errors',true);

//Constantes
define('URL','http://'.$_SERVER['HTTP_HOST'].'/tcc/');
define('DS', DIRECTORY_SEPARATOR);
define('PATH', getcwd().DS );

define('TEMPLATE', PATH.'view'.DS.'template.html');