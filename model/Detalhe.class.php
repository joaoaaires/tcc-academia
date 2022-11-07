<?php

class Detalhe {
	
	public function run(){
		
		switch (App::$action):
			case 'show':
		
					$dados = Connection::select( "SELECT * FROM cliente where idcliente=".App::$key );
					$dados2 = Connection::select( "SELECT * FROM medidas WHERE cliente_idcliente=".App::$key." ORDER BY data_cad DESC"  );
					$dados3 = Connection::select( "SELECT * FROM mensalidade WHERE cliente_idcliente=".App::$key." ORDER BY data_pg DESC"  );
					$reg   = $dados->fetchObject();
										
					$html_detalhe = new Html();
					$html = $html_detalhe->load( 'view/detalhe-show.html' );
					
					@$idade = (date ('Y')) - (substr($reg->nasc, 6, 9));
					
					$html = str_replace('#TITULO#','Detalhes',$html);
					$html = str_replace('#ID#',$reg->idcliente,$html);
					$html = str_replace('#DATAMATRI#',implode("/",array_reverse(explode("-",$reg->datamatri))),$html);
					$html = str_replace('#NOME#',$reg->nomeCliente,$html);
					$html = str_replace('#CPF#',$reg->cpf,$html);
					$html = str_replace('#NASC#',$reg->nasc,$html);
					$html = str_replace('#IDADE#',$idade,$html);
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
								<td>'.$reg2['altura'].' cm</td>
								<td>'.$reg2['peso'].' cm</td>
								<td>'.$reg2['brc_dir'].' cm</td>
								<td>'.$reg2['brc_esq'].' cm</td>
								<td>'.$reg2['peitoral'].' cm</td>
								<td>'.$reg2['barriga'].' cm</td>
								<td>'.$reg2['quadril'].' cm</td>
								<td>'.$reg2['cx_dir'].' cm</td>
								<td>'.$reg2['cx_esq'].' cm</td>
								<td>'.$reg2['pnt_dir'].' cm</td>
								<td>'.$reg2['pnt_esq'].' cm</td>
								<td>'.implode("/",array_reverse(explode("-",$reg2['data_cad']))).'
								<div class="btn-group">
								  <button class="btn btn-primary btn-mini dropdown-toggle" data-toggle="dropdown">
									<span class="caret"></span>
								  </button>
								  <ul class="dropdown-menu">
									<li><a href='.URL.'Medida/editar/'.$reg2['idmedidas'].'>Editar</a></li>
									<li><a href="'.URL.'Medida/excluir/'.$reg2['idmedidas'].'" onclick="return confirm(\'Confirma Exclusao do Registro?\')">Excluir</a></li>
								  </ul>
								</div>
								</td>
							</tr>';
						}
					$html = str_replace('#MEDIDAS#',$medida,$html);
					
					$mensalidade = '';
					
						foreach ( $dados3 as  $reg3 ){
							switch($reg3['status']) {
								case"Pago": 	$menu = '
								
								<div class="btn-group">
								  <button class="btn btn-primary btn-mini dropdown-toggle" data-toggle="dropdown">
									<span class="caret"></span>
								  </button>
								  <ul class="dropdown-menu">
									<li><a href='.URL.'Mensalidade/editar/'.$reg3['idmensalidade'].'>Editar</a></li>
									<li><a href="'.URL.'Mensalidade/excluir/'.$reg3['idmensalidade'].'" onclick="return confirm(\'Confirma Exclusao do Registro?\')">Excluir</a></li>
									<li><a href='.URL.'Imprimir/recibo/'.$reg3['idmensalidade'].'>Gerar Recibo</a></li>
								  </ul>
								</div>
								
								';       break;
								case"Não Pago": $menu = '
								
								<div class="btn-group">
								  <button class="btn btn-primary btn-mini dropdown-toggle" data-toggle="dropdown">
									<span class="caret"></span>
								  </button>
								  <ul class="dropdown-menu">
									<li><a href='.URL.'Mensalidade/editar/'.$reg3['idmensalidade'].'>Editar</a></li>
									<li><a href="'.URL.'Mensalidade/excluir/'.$reg3['idmensalidade'].'" onclick="return confirm(\'Confirma Exclusao do Registro?\')">Excluir</a></li>
								  </ul>
								</div>
								
								'; break;
							}
							
						@$mensalidade .='
							<tr class="my-div">
								<td>'.$reg3['mes'].'</td>
								<td id="status"><strong>'.$reg3['status'].'</strong></td>
								<td>R$ '.$reg3['valor'].'.00</td>
								<td>'.implode("/",array_reverse(explode("-",$reg3['data_pg']))).' '.$menu.'
								</td>
							</tr>
							';
						}
					$html = str_replace('#MENSALIDADE#',$mensalidade,$html);
					
					$tbody='';
							
					return $html;
					break;
					
		endswitch;
	}
}
?>