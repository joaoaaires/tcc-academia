<?php

class Agenda {

    public function run(){

            switch(App::$action){
                case 'show':

                    $dados = Connection::select( "SELECT a.idagenda, a.data, a.hora, p.nomeProfessor, c.nomeCliente FROM agenda a, professor p, cliente c WHERE a.cliente_idcliente = c.idcliente AND a.professor_idprofessor = p.idprofessor AND a.data >= now()" );
                    $dados2 = Connection::select( "SELECT a.idagenda, a.data, a.hora, a.descricao, p.nomeProfessor, c.nomeCliente FROM agenda a, professor p, cliente c WHERE a.cliente_idcliente = c.idcliente AND a.professor_idprofessor = p.idprofessor AND a.data >= now()" );


                    $html_usuario = new Html();
                    $html = $html_usuario->load('view/agenda-show.html');
                    
                    $tbody='';
					$tbody2='';

                    foreach( $dados as $reg){
                        $tbody .= '<tr>
                                     <td align="center">'.$reg['idagenda'].'</td>
                                     <td><strong>'.implode("/",array_reverse(explode("-",$reg['data']))).' às '.$reg['hora'].'</strong></td>
									 <td>'.$reg['nomeCliente'].'</td>
									 <td>'.$reg['nomeProfessor'].'</td>
                                     <td align="center"><a href="#myDetalhe'.$reg['idagenda'].'" role="button" class="btn btn-mini btn-primary" data-toggle="modal">Visualizar</a> | <a class="btn btn-mini btn-primary" href="'.URL.'Agenda/editar/'.$reg['idagenda'].'">Editar</a> | <a class="btn btn-mini  btn-danger" href="'.URL.'Agenda/excluir/'.$reg['idagenda'].'" onclick="return confirm(\'Confirma Exclusao do Registro?\')">Excluir</a>
                                     </td>
                                  </tr>';
                    }
					
					foreach( $dados2 as $reg2){
						$ano =  substr($reg2['data'], 0, 4);
						$mes =  substr($reg2['data'], 5, -3);
						$dia =  substr($reg2['data'], 8, 9);
						
						@$diasemana = date("w", mktime(0,0,0,$mes,$dia,$ano) );
						
						switch($diasemana) {
							case"0": $diasemana = "Domingo";       break;
							case"1": $diasemana = "Segunda-Feira"; break;
							case"2": $diasemana = "Terça-Feira";   break;
							case"3": $diasemana = "Quarta-Feira";  break;
							case"4": $diasemana = "Quinta-Feira";  break;
							case"5": $diasemana = "Sexta-Feira";   break;
							case"6": $diasemana = "Sábado";        break;
						}
						
						switch($mes) {
							case"01": $mes = "Janeiro"; 	break;
							case"02": $mes = "Fevereiro";   break;
							case"03": $mes = "Março"; 		break;
							case"04": $mes = "Abril";  		break;
							case"05": $mes = "Maio";   		break;
							case"06": $mes = "Junho";       break;
							case"07": $mes = "Julho";       break;
							case"08": $mes = "Agosto";      break;
							case"09": $mes = "Setembro";    break;
							case"10": $mes = "Outubro";     break;
							case"11": $mes = "Novembro";    break;
							case"12": $mes = "Dezembro";    break;
					
						}

                        $tbody2 .= '
						
						<div id="myDetalhe'.$reg2['idagenda'].'" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h3 id="myModalLabel">Agenda - '.$reg2['nomeCliente'].'</h3>
						  </div>
						  <div class="modal-body">
								<div id="calendar">
									<div class="mes"><strong>'.$mes.' '.substr($reg2['data'], 0, 4).'</strong></div>
									<div class="numero"><strong>'.substr($reg2['data'], 8, 9).'</strong></div>
								</div>
								<div>
								'.$diasemana.' às '.$reg2['hora'].'<br>
								Acompanhamento com '.$reg2['nomeProfessor'].'<br>
								Descrição: '.$reg2['descricao'].'
								</div>
						  </div>
							  <div class="modal-footer">
								<button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
						  </div>
						</div>
						
						';
                    }
					
                    $html = str_replace('#TBODY#',$tbody,$html);
					$html = str_replace('#TBODYD#',$tbody2,$html);
                    
                    return $html;
                    break;

                case 'incluir':

                    $html_usuario = new Html();
                    $html = $html_usuario->load('view/agenda-form.html');
					
					$dados = Connection::select( "SELECT * FROM cliente" );
					$dados2 = Connection::select( "SELECT * FROM professor" );
					                    
					$html = str_replace( '#TITULO#','Incluir',$html);
                    $html = str_replace( '#ACTION#',URL.'Agenda/salvar',$html);
                    $html = str_replace( '#DATA#','',$html);
					$html = str_replace( '#HORA#','',$html);
                    $html = str_replace( '#DISCRICAO#','',$html);
					
					$cliente='';

                    foreach( $dados as $reg){
                        $cliente .= '<option value="'.$reg['idcliente'].'">'.$reg['nomeCliente'].'</option>';
                    }
					
					$html = str_replace( '#CLIENTEFK#','<option value=""></option>',$html);
					$html = str_replace( '#CLIENTE#',$cliente,$html);
					
					$professor='';

                    foreach( $dados2 as $reg){
                        $professor .= '<option value="'.$reg['idprofessor'].'">'.$reg['nomeProfessor'].'</option>';
                    }
					
					$html = str_replace( '#PROFESSORFK#','<option value=""></option>',$html);
					$html = str_replace( '#PROFESSOR#',$professor,$html);
					
                    return $html;
                    break;

                case 'editar':

                    $dados = Connection::select( "SELECT a.idagenda, a.data, a.hora, a.descricao, c.idcliente, c.nomeCliente, p.idprofessor, p.nomeProfessor FROM agenda a, professor p, cliente c where idagenda=".App::$key." and c.idcliente = a.cliente_idcliente and p.idprofessor = a.professor_idprofessor" );
                    $reg   = $dados->fetchObject();
                    
                    $html_usuario = new Html();
                    $html = $html_usuario->load('view/agenda-form.html');
                    
					$html = str_replace( '#TITULO#','Editar',$html);
                    $html = str_replace( '#ACTION#',URL.'Agenda/salvar/'.App::$key,$html);
                    $html = str_replace( '#DATA#',$reg->data,$html);
					$html = str_replace( '#HORA#',$reg->hora,$html);
                    $html = str_replace( '#DISCRICAO#',$reg->descricao,$html);
					
					$dados2 = Connection::select( "SELECT * FROM cliente" );
					$dados3 = Connection::select( "SELECT * FROM professor" );
					
					$cliente='';

                    foreach( $dados2 as $reg2){
                        $cliente .= '<option value="'.$reg2['idcliente'].'">'.$reg2['nomeCliente'].'</option>';
                    }
					
					$html = str_replace( '#CLIENTE#',$cliente,$html);
					$html = str_replace( '#CLIENTEFK#','<option value="'.$reg->idcliente.'">'.$reg->nomeCliente.'</option>',$html);
					
					$professor='';

                    foreach( $dados3 as $reg3){
                        $professor .= '<option value="'.$reg3['idprofessor'].'">'.$reg3['nomeProfessor'].'</option>';
                    }
					
					$html = str_replace( '#PROFESSORFK#','<option value="'.$reg->idprofessor.'">'.$reg->nomeProfessor.'</option>',$html);
                    $html = str_replace( '#PROFESSOR#',$professor,$html);
					
                    return $html;
                    break;

                case 'salvar':

                    if(App::$key){
                        $sql = "update agenda set data='".$_POST["data"]."',hora='".$_POST["hora"]."'
                                                   ,descricao='".$_POST["descricao"]."',professor_idprofessor='".$_POST["professor"]."',cliente_idcliente='".$_POST["cliente"]."' where idagenda=".App::$key  ;
                    }else{
                        $sql = "insert into agenda ( data,hora,descricao,data_now,professor_idprofessor,cliente_idcliente )
                                       values ( '".$_POST["data"]."','".$_POST["hora"]."','".$_POST["descricao"]."',now(),'".$_POST["professor"]."','".$_POST["cliente"]."' )";
                    }

                    $dados = Connection::exec( $sql );

                    header('Location: ' .URL.'Agenda/show');
                    break;

                case 'excluir':

                    $dados = Connection::exec( "delete from agenda where idagenda = ".App::$key );

                    header('Location: ' .URL.'Agenda/show');
                    break;

            }

    }
}

