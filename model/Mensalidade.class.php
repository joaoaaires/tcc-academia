<?php

class Mensalidade {
	
	public function run(){
		
		switch (App::$action):
				
				case 'incluir':
				
					$html_aluno = new Html();
					$html = $html_aluno->load( 'view/detalhe-form-mensalidade.html' );
					
					$dados = Connection::select( "SELECT * FROM cliente WHERE idcliente=".App::$key  );
					$reg   = $dados->fetchObject();
					
					$html = str_replace('#CLIENTE#',$reg->nomeCliente,$html);
					$html = str_replace('#TITULO#','Incluir Mensalidade',$html);	
					$html = str_replace('#ACTION#',URL.'Mensalidade/salvar',$html);					
					$html = str_replace('#MES#','',$html);
					$html = str_replace('#STATUS#','',$html);
					$html = str_replace('#VALOR#','',$html);
					$html = str_replace('#ID#',App::$key,$html);
					$html = str_replace('#IDFK#','<input type="hidden" value="'.App::$key.'" name="id">',$html);
					
					return $html;
					break;
					
				case 'editar':
				
					$dados = Connection::select( "SELECT * FROM mensalidade where idmensalidade=".App::$key );
					$reg   = $dados->fetchObject();
					
					$dados2 = Connection::select( "SELECT * FROM cliente WHERE idcliente=".$reg->cliente_idcliente  );
					$reg2   = $dados2->fetchObject();
				
					$html_aluno = new Html();
					$html = $html_aluno->load( 'view/detalhe-form-mensalidade.html' );
					
					$html = str_replace('#CLIENTE#',$reg2->nomeCliente,$html);
					$html = str_replace('#ID#',$reg2->idcliente,$html);
					$html = str_replace('#ACTION#',URL.'Mensalidade/salvar/'.App::$key,$html);
					$html = str_replace('#TITULO#','Editar Mensalidade',$html);					
					$html = str_replace('#MES#',$reg->mes,$html);
					$html = str_replace('#STATUS#',$reg->status,$html);
					$html = str_replace('#VALOR#',$reg->valor,$html);
					$html = str_replace('#IDFK#','<input type="hidden" value="'.$reg2->idcliente.'" name="id">',$html);
					
					return $html;
					break;
					
				case 'salvar':
				
					if(App::$key){
						$sql = "update mensalidade set 
						mes='".$_POST["mes"]."',
						status='".$_POST["status"]."',
						valor='".$_POST["valor"]."' WHERE idmensalidade=".App::$key;
					} else {
						$sql = "insert into mensalidade ( mes,status,valor,data_pg,cliente_idcliente ) values ( '".$_POST["mes"]."','".$_POST["status"]."','".$_POST["valor"]."',now(),'".$_POST["id"]."')";
					}
					
					header('Location: '.URL.'Detalhe/show/'.$_POST["id"]);

					$dados = Connection::exec( $sql );
					break;
					
				case 'excluir':
				
					$delete = Connection::select("SELECT * FROM mensalidade WHERE idmensalidade = ".App::$key);
					$reg   = $delete->fetchObject();
					
					$dados = Connection::exec( "delete from mensalidade where idmensalidade =".App::$key );
					
					header('Location: '.URL.'Detalhe/show/'.$reg->cliente_idcliente);
					break;			
					
		endswitch;
	}
}
?>