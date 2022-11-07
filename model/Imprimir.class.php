<?php

class Imprimir {

    public function run(){

            switch(App::$action){
                case 'recibo':

                    $dados = Connection::select( "SELECT * FROM mensalidade, cliente WHERE idcliente=cliente_idcliente AND idmensalidade=".App::$key );
					$reg   = $dados->fetchObject();
					
					$html_imprimir = new Html();
					$html = $html_imprimir->load( 'view/recibo-show.html' );
					
					$html = str_replace('#TITULO#','Detalhes',$html);
					$html = str_replace('#ID#',$reg->idcliente,$html);
					$html = str_replace('#DATAMATRI#',implode("/",array_reverse(explode("-",$reg->datamatri))),$html);
					$html = str_replace('#NOME#',$reg->nomeCliente,$html);
					$html = str_replace('#CPF#',$reg->cpf,$html);
					$html = str_replace('#MES#',$reg->mes,$html);
					$html = str_replace('#VALOR#',$reg->valor,$html);
                    
                    return $html;
                    break;
				
				case 'ata':
		
					$dados = Connection::select( "SELECT * FROM cliente where idcliente=".App::$key );
					$dados2 = Connection::select( "SELECT * FROM medidas WHERE cliente_idcliente=".App::$key." ORDER BY data_cad DESC"  );
					$dados3 = Connection::select( "SELECT * FROM mensalidade WHERE cliente_idcliente=".App::$key." ORDER BY data_pg DESC"  );
					$reg   = $dados->fetchObject();
										
					$html_detalhe = new Html();
					$html = $html_detalhe->load( 'view/ata-show.html' );
					
					$html = str_replace('#TITULO#','Detalhes',$html);
					$html = str_replace('#ID#',$reg->idcliente,$html);
					$html = str_replace('#DATAMATRI#',implode("/",array_reverse(explode("-",$reg->datamatri))),$html);
					$html = str_replace('#NOME#',$reg->nomeCliente,$html);
					$html = str_replace('#CPF#',$reg->cpf,$html);
					$html = str_replace('#NASC#',$reg->nasc,$html);
					$html = str_replace('#SEXO#',$reg->sexo,$html);
					$html = str_replace('#FONE#',$reg->fone,$html);
					$html = str_replace('#EMAIL#',$reg->email,$html);
					
					$html = str_replace('#CEP#',$reg->cep,$html);
					$html = str_replace('#RUA#',$reg->rua,$html);
					$html = str_replace('#BAIRRO#',$reg->bairro,$html);
					$html = str_replace('#NUMERO#',$reg->numero,$html);
					$html = str_replace('#COMPLEMENTO#',$reg->complemento,$html);
					$html = str_replace('#CIDADE#',$reg->cidade,$html);
					
					$html = str_replace('#ACOMPANHAMENTO#',$reg->acompanhamento,$html);
					
					$html = str_replace('#INCLUIR_MEDIDA#','<a class="btn" href='.URL.'Medida/incluir/'.$reg->idcliente.'>Incluir Medida</a>',$html);
					$html = str_replace('#INCLUIR#','<a class="btn" href='.URL.'Mensalidade/incluir/'.$reg->idcliente.'>Incluir Mensalidade</a>',$html);
					
					$medida = '';	
						foreach ( $dados2 as  $reg2 ){
						@$medida .='
							<tr>
								<td>'.$reg2['altura'].'</td>
								<td>'.$reg2['peso'].'</td>
								<td>'.$reg2['brc_dir'].'</td>
								<td>'.$reg2['brc_esq'].'</td>
								<td>'.$reg2['peitoral'].'</td>
								<td>'.$reg2['barriga'].'</td>
								<td>'.$reg2['quadril'].'</td>
								<td>'.$reg2['cx_dir'].'</td>
								<td>'.$reg2['cx_esq'].'</td>
								<td>'.$reg2['pnt_dir'].'</td>
								<td>'.$reg2['pnt_esq'].'</td>
								<td>'.implode("/",array_reverse(explode("-",$reg2['data_cad']))).'</td>
							</tr>';
						}
					$html = str_replace('#MEDIDAS#',$medida,$html);
					
					$mensalidade = '';
					
						foreach ( $dados3 as  $reg3 ){							
						@$mensalidade .='
							<tr class="my-div">
								<td>'.$reg3['mes'].'</td>
								<td id="status"><strong>'.$reg3['status'].'</strong></td>
								<td>R$ '.$reg3['valor'].'.00</td>
								<td>'.implode("/",array_reverse(explode("-",$reg3['data_pg']))).'</td>
							</tr>
							';
						}
					$html = str_replace('#MENSALIDADE#',$mensalidade,$html);
					
					$tbody='';
							
					return $html;
					break;

            }
    }
}

