<?php

class Relatorio {

    public function run(){

            switch(App::$action){
                case 'cliente':

                    $dados = Connection::select( "SELECT * FROM clientelog ORDER BY data_hora DESC" );

                    $html_usuario = new Html();
                    $html = $html_usuario->load('view/relario-cliente-show.html');
                    
                    $tbody='';

                    foreach( $dados as $reg){
                        $tbody .= '<tr>
                                     <td align="center"><strong>'.$reg['idClienteLog'].'</strong></td>
                                     <td>'.$reg['nome'].'</td>
									 <td>'.$reg['data_hora'].'</td>
                                     <td align="center">'.$reg['acao'].'</td>
                                  </tr>';
                    }
                    
					$html = str_replace('#ACAO1#',header("Content-type: application/vnd.ms-excel"),$html);
					$html = str_replace('#ACAO2#',header("Content-type: application/force-download"),$html);
					$html = str_replace('#ACAO3#',header("Content-Disposition: attachment; filename=file.xls"),$html);
					$html = str_replace('#ACAO4#',header("Pragma: no-cache"),$html);
                    $html = str_replace('#TBODY#',$tbody,$html);
                    
                    return $html;
                    break;

                case 'agenda':

                    $dados = Connection::select( "SELECT a.idAgendaLog, a.data, a.hora, a.data_now, a.acao,a.data_hora, c.nomeCliente, p.nomeProfessor FROM agendalog a, cliente c, professor p WHERE a.professor = p.idprofessor AND  a.cliente = c.idcliente ORDER BY data_hora DESC" );

                    $html_usuario = new Html();
                    $html = $html_usuario->load('view/relario-agenda-show.html');
                    
                    $tbody='';

                    foreach( $dados as $reg){
                        $tbody .= '<tr>
                                     <td align="center"><strong>'.$reg['idAgendaLog'].'</strong></td>
                                     <td>'.implode("/",array_reverse(explode("-",$reg['data']))).'</td>
									 <td>'.$reg['hora'].'</td>
									 <td>'.implode("/",array_reverse(explode("-",$reg['data_now']))).'</td>
									 <td>'.$reg['nomeCliente'].'</td>
									 <td>'.$reg['nomeProfessor'].'</td>
                                     <td align="center">'.$reg['acao'].'</td>
									 <td>'.$reg['data_hora'].'</td>
                                  </tr>';
                    }
                    
					$html = str_replace('#ACAO1#',header("Content-type: application/vnd.ms-excel"),$html);
					$html = str_replace('#ACAO2#',header("Content-type: application/force-download"),$html);
					$html = str_replace('#ACAO3#',header("Content-Disposition: attachment; filename=file.xls"),$html);
					$html = str_replace('#ACAO4#',header("Pragma: no-cache"),$html);
                    $html = str_replace('#TBODY#',$tbody,$html);
                    
                    return $html;
                    break;

                case 'mensalidade':

                    $dados = Connection::select( "SELECT m.*, c.nomeCliente FROM mensalidadelog AS m LEFT JOIN cliente AS c ON m.cliente = c.idcliente ORDER BY data_hora DESC" );

                    $html_usuario = new Html();
                    $html = $html_usuario->load('view/relario-mensalidade-show.html');
                    
                    $tbody='';

                    foreach( $dados as $reg){
                        $tbody .= '<tr>
                                     <td align="center"><strong>'.$reg['idmensalidadeLog'].'</strong></td>
                                     <td>'.$reg['mes'].'</td>
									 <td>'.$reg['valor'].'</td>
									 <td>'.$reg['status'].'</td>
									 <td>'.implode("/",array_reverse(explode("-",$reg['data_pg']))).'</td>
									 <td>'.$reg['nomeCliente'].'</td>
                                     <td align="center">'.$reg['acao'].'</td>
									 <td>'.$reg['data_hora'].'</td>
                                  </tr>';
                    }
                    
					$html = str_replace('#ACAO1#',header("Content-type: application/vnd.ms-excel"),$html);
					$html = str_replace('#ACAO2#',header("Content-type: application/force-download"),$html);
					$html = str_replace('#ACAO3#',header("Content-Disposition: attachment; filename=file.xls"),$html);
					$html = str_replace('#ACAO4#',header("Pragma: no-cache"),$html);
                    $html = str_replace('#TBODY#',$tbody,$html);
                    
                    return $html;
                    break;

            }

    }
}

