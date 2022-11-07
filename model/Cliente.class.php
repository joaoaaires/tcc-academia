<?php

class Cliente {
	
	public function run(){
		
		switch (App::$action):
			case 'show':
				$dados = Connection::select( "SELECT * FROM cliente ORDER BY nomeCliente" );
				
				$html_cliente = new Html();
				$html = $html_cliente->load( 'view/cliente-show.html' );
				
				$tbody='';
				
				foreach ( $dados as  $reg ){
					$tbody .='
<tr>
	<td align="center">'.$reg['idcliente'].'</td>
	<td>'.$reg['nomeCliente'].'</a></td>
	<td align="center">'.$reg['email'].'</td>
	<td align="center">'.$reg['fone'].'</td>
	<td align="center"><a class="btn btn-small" href="'.URL.'Detalhe/show/'.$reg['idcliente'].'">Detalhes</a> 
	</td>
</tr>';
				}
				
				$html = str_replace('#TBODY#',$tbody,$html);
				
				return $html;
				break;
				
				case 'incluir':
				
					$html_cliente = new Html();
					$html = $html_cliente->load( 'view/cliente-form.html' );
					
					$html = str_replace('#ACTION#',URL.'cliente/salvar',$html);
					$html = str_replace('#TITULO#','Incluir',$html);
					$html = str_replace('#NOME#','',$html);
					$html = str_replace('#CPF#','',$html);
					$html = str_replace('#NASC#','',$html);
					$html = str_replace('#SEXO#','',$html);
					$html = str_replace('#FONE#','',$html);
					$html = str_replace('#EMAIL#','',$html);
					
					$html = str_replace('#CEP#','',$html);
					$html = str_replace('#RUA#','',$html);
					$html = str_replace('#BAIRRO#','',$html);
					$html = str_replace('#NUMERO#','',$html);
					$html = str_replace('#COMPLEMENTO#','',$html);
					$html = str_replace('#CIDADE#','',$html);
					
					$html = str_replace('#ACOMPANHAMENTO#','',$html);
					
					return $html;
					break;
					
				case 'editar':
				
					$dados = Connection::select( "SELECT * FROM cliente where idcliente=".App::$key );
					$reg   = $dados->fetchObject();
					
					$html_cliente = new Html();
					$html = $html_cliente->load( 'view/cliente-form.html' );
					
					$html = str_replace('#ACTION#',URL.'cliente/salvar/'.App::$key,$html);
					$html = str_replace('#TITULO#','Editar',$html);
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
					
					return $html;
					break;
					
				case 'salvar':
				
					if(App::$key){
						$sql = "update cliente set nomeCliente='".$_POST["nome"]."',cpf='".$_POST["cpf"]."',nasc='".$_POST["nasc"]."',sexo='".$_POST["sexo"]."',fone='".$_POST["fone"]."',cep='".$_POST["cep"]."',rua='".$_POST["rua"]."',bairro='".$_POST["bairro"]."',numero='".$_POST["numero"]."',complemento='".$_POST["complemento"]."',cidade='".$_POST["cidade"]."',acompanhamento='".$_POST["acompanhamento"]."',email='".$_POST["email"]."' where idcliente=".App::$key;
					} else {
						$sql = "INSERT INTO cliente VALUES ('','".$_POST["nome"]."', '".$_POST["cpf"]."','".$_POST["nasc"]."','".$_POST["sexo"]."','".$_POST["fone"]."','".$_POST["cep"]."','".$_POST["rua"]."','".$_POST["bairro"]."','".$_POST["numero"]."','".$_POST["complemento"]."','".$_POST["cidade"]."','".$_POST["acompanhamento"]."','".$_POST["email"]."',now())";					}					
					
					$dados = Connection::exec( $sql);
					
					header('Location: '.URL.'Cliente/show');
					break;
					
				case 'excluir':
				
					$dados = Connection::exec( "delete from cliente where idcliente = ".App::$key );
					
					header('Location: '.URL.'Cliente/show');
					break;				
					
		endswitch;
	}
}
?>