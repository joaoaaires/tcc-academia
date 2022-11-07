<?php

class Acesso{
      public function run(){
          
          $html = '';

          Session::setValue('erro','');

          switch (App::getAction()) {
              case 'logout':
                  $this->logout();
                  break;
          
              case 'validar':
                  $this->validar();
                  break;

              default:
                  $html = $this->login();
                  break;
          }
          
          return $html;
          
      }
      public function login(){
      
            $html_login= new Html();
            $html=$html_login->load( 'view/login.html');
          
            return $html;
          
      }
      public function validar(){
          
          $dados = Connection::select( "SELECT login,senha FROM usuario WHERE login='".$_POST['usuario']."'" );
          Connection::close();
          
          foreach( $dados as $reg):
              if($_POST['senha']==$reg['senha']):
                    Session::setValue('logado',true);
              else:
                    Session::setValue('erro','Dados Invalidos');
              endif;
          endforeach;
          header( 'Location: '.URL ) ;
          
      }
      
      public function logout(){
             
          Session::setValue('logado',false);
          header( 'Location: '.URL ) ;
          
      }
      
}

