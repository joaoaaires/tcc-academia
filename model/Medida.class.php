<?php

class Medida {
	
	public function run(){
		
		switch (App::$action):
				
				case 'incluir':
				
					$html_aluno = new Html();
					$html = $html_aluno->load( 'view/detalhe-form-medida.html' );
					
					$dados = Connection::select( "SELECT * FROM cliente WHERE idcliente=".App::$key  );
					$reg   = $dados->fetchObject();
					
					$html = str_replace('#CLIENTE#',$reg->nomeCliente,$html);
					$html = str_replace('#TITULO#','Incluir Medidas',$html);	
					$html = str_replace('#ACTION#',URL.'Medida/salvar',$html);					
					$html = str_replace('#ALTURA#','',$html);
					$html = str_replace('#PESO#','',$html);
					$html = str_replace('#BRC_DIR#','',$html);
					$html = str_replace('#BRC_ESQ#','',$html);
					$html = str_replace('#PEITORAL#','',$html);
					$html = str_replace('#BARRIGA#','',$html);
					$html = str_replace('#QUADRIL#','',$html);
					$html = str_replace('#CX_DIR#','',$html);
					$html = str_replace('#CX_ESQ#','',$html);
					$html = str_replace('#PNT_DIR#','',$html);
					$html = str_replace('#PNT_ESQ#','',$html);
					$html = str_replace('#ID#',App::$key,$html);
					$html = str_replace('#IDFK#','<input type="hidden" value="'.App::$key.'" name="id">',$html);
					
					return $html;
					break;
					
				case 'editar':
				
					$dados = Connection::select( "SELECT * FROM medidas where idmedidas=".App::$key );
					$reg   = $dados->fetchObject();
					
					$dados2 = Connection::select( "SELECT * FROM cliente WHERE idcliente=".$reg->cliente_idcliente  );
					$reg2   = $dados2->fetchObject();
				
					$html_aluno = new Html();
					$html = $html_aluno->load( 'view/detalhe-form-medida.html' );
					
					$html = str_replace('#CLIENTE#',$reg2->nomeCliente,$html);
					$html = str_replace('#ID#',$reg2->idcliente,$html);
					$html = str_replace('#ACTION#',URL.'Medida/salvar/'.App::$key,$html);
					$html = str_replace('#TITULO#','Editar Medida',$html);					
					$html = str_replace('#ALTURA#',$reg->altura,$html);
					$html = str_replace('#PESO#',$reg->peso,$html);
					$html = str_replace('#BRC_DIR#',$reg->brc_dir,$html);
					$html = str_replace('#BRC_ESQ#',$reg->brc_esq,$html);
					$html = str_replace('#PEITORAL#',$reg->peitoral,$html);
					$html = str_replace('#BARRIGA#',$reg->barriga,$html);
					$html = str_replace('#QUADRIL#',$reg->quadril,$html);
					$html = str_replace('#CX_DIR#',$reg->cx_dir,$html);
					$html = str_replace('#CX_ESQ#',$reg->cx_esq,$html);
					$html = str_replace('#PNT_DIR#',$reg->pnt_dir,$html);
					$html = str_replace('#PNT_ESQ#',$reg->pnt_esq,$html);
					$html = str_replace('#IDFK#','<input type="hidden" value="'.$reg2->idcliente.'" name="id">',$html);
					
					return $html;
					break;
					
				case 'salvar':
				
					if(App::$key){
						$sql = "update medidas set 
						altura='".$_POST["altura"]."',
						peso='".$_POST["peso"]."',
						brc_dir='".$_POST["brc_dir"]."',
						brc_esq='".$_POST["brc_esq"]."',
						peitoral='".$_POST["peitoral"]."',
						barriga='".$_POST["barriga"]."',
						quadril='".$_POST["quadril"]."',
						cx_dir='".$_POST["cx_dir"]."',
						cx_esq='".$_POST["cx_esq"]."',
						pnt_dir='".$_POST["pnt_dir"]."',
						pnt_esq='".$_POST["pnt_esq"]."' WHERE idmedidas=".App::$key;
					} else {
						$sql = "insert into medidas ( altura,peso,brc_dir,brc_esq,peitoral,barriga,quadril,cx_dir,cx_esq,pnt_dir,pnt_esq,data_cad,cliente_idcliente ) values ( '".$_POST["altura"]."','".$_POST["peso"]."','".$_POST["brc_dir"]."','".$_POST["brc_esq"]."','".$_POST["peitoral"]."','".$_POST["barriga"]."','".$_POST["quadril"]."','".$_POST["cx_dir"]."','".$_POST["cx_esq"]."','".$_POST["pnt_dir"]."','".$_POST["pnt_esq"]."',now(),'".$_POST["id"]."')";
					}
					
					header('Location: '.URL.'Detalhe/show/'.$_POST["id"]);

					$dados = Connection::exec( $sql );
					break;
					
				case 'excluir':
				
					$delete = Connection::select("SELECT * FROM medidas WHERE idmedidas = ".App::$key);
					$reg   = $delete->fetchObject();
					
					$dados = Connection::exec( "delete from medidas where idmedidas =".App::$key );
					
					header('Location: '.URL.'Detalhe/show/'.$reg->cliente_idcliente);
					break;			
					
		endswitch;
	}
}
?>