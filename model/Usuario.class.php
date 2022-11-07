<?php

class Usuario {

    public function run(){

            switch(App::$action){
                case 'show':

                    $dados = Connection::select( "SELECT * FROM usuario" );

                    $html_usuario = new Html();
                    $html = $html_usuario->load('view/usuario-show.html');
                    
                    $tbody='';

                    foreach( $dados as $reg){
                        $tbody .= '<tr>
                                     <td align="center"><strong>'.$reg['id'].'</strong></td>
                                     <td>'.$reg['nome'].'</td>
									 <td>'.$reg['login'].'</td>
                                     <td align="center"><a class="btn btn-mini btn-primary" href="'.URL.'Usuario/editar/'.$reg['id'].'">Editar</a> | <a class="btn btn-mini  btn-danger" href="'.URL.'Usuario/excluir/'.$reg['id'].'" onclick="return confirm(\'Confirma Exclusao do Registro?\')">Excluir</a>
                                     </td>
                                  </tr>';
                    }
                    
                    $html = str_replace('#TBODY#',$tbody,$html);
                    
                    return $html;
                    break;

                case 'incluir':

                    $html_usuario = new Html();
                    $html = $html_usuario->load('view/usuario-form.html');
                    
					$html = str_replace( '#TITULO#','Incluir',$html);
                    $html = str_replace( '#ACTION#',URL.'Usuario/salvar',$html);
                    $html = str_replace( '#NOME#','',$html);
					$html = str_replace( '#LOGIN#','',$html);
                    $html = str_replace( '#SENHA#','',$html);

                    return $html;
                    break;

                case 'editar':

                    $dados = Connection::select( "SELECT * FROM usuario where id=".App::$key );
                    $reg   = $dados->fetchObject();
                    
                    $html_usuario = new Html();
                    $html = $html_usuario->load('view/usuario-form.html');
                    
					$html = str_replace( '#TITULO#','Editar',$html);
                    $html = str_replace( '#ACTION#',URL.'Usuario/salvar/'.App::$key,$html);
                    $html = str_replace( '#NOME#',$reg->nome,$html);
					$html = str_replace( '#LOGIN#',$reg->login,$html);
                    $html = str_replace( '#SENHA#',$reg->senha,$html);
                    
                    return $html;
                    break;

                case 'salvar':

                    if(App::$key){
                        $sql = "update usuario set nome='".$_POST["nome"]."',login='".$_POST["login"]."'
                                                   ,senha='".$_POST["senha"]."' where id=".App::$key  ;
                    }else{
                        $sql = "insert into usuario ( nome,login,senha )
                                       values ( '".$_POST["nome"]."','".$_POST["login"]."','".$_POST["senha"]."' )";
                    }

                    $dados = Connection::exec( $sql );

                    header('Location: ' .URL.'Usuario/show');
                    break;

                case 'excluir':

                    $dados = Connection::exec( "delete from usuario where id = ".App::$key );

                    header('Location: ' .URL.'Usuario/show');
                    break;

            }

    }
}

