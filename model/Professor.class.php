<?php

class Professor {

    public function run(){

            switch(App::$action){
                case 'show':
                
                    $dados = Connection::select( "SELECT * FROM professor ORDER BY nomeProfessor" );
					$dados2 = Connection::select( "SELECT * FROM professor ORDER BY nomeProfessor" );

                    $html_professor = new Html();
                    $html = $html_professor->load('view/professor-show.html');
                    
                    $tbody='';
					$tbody2='';

                    foreach( $dados as $reg){
                        $tbody .= '<tr>
                                     <td align="center"><strong>'.$reg['idprofessor'].'</strong></td>
                                     <td>'.$reg['nomeProfessor'].'</td>
                                     <td align="center">
									 <a href="#myDetalhe'.$reg['idprofessor'].'" role="button" class="btn btn-mini btn-primary" data-toggle="modal">Informações</a> | <a class="btn btn-mini btn-primary" href="'.URL.'Professor/editar/'.$reg['idprofessor'].'">Editar</a> | <a class="btn btn-mini  btn-danger" href="'.URL.'Professor/excluir/'.$reg['idprofessor'].'" onclick="return confirm(\'Confirma Exclusao do Registro?\')">Excluir</a>
									 </td>
                                  </tr>
								 
								 ';
                    }
					
					foreach ($dados2 as $reg2) {
						$tbody2 .= '
						
						<div id="myDetalhe'.$reg2['idprofessor'].'" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">'.$reg2['nomeProfessor'].'r</h3>
  </div>
  <div class="modal-body">
      <div class="control-group">
        <strong>CPF:</strong>
        <div class="controls">
          '.$reg2['cpf'].'
        </div>
      </div>
      <div class="control-group">
        <strong>Data de Nascimento:</strong>
        <div class="controls">
          '.implode("/",array_reverse(explode("-",$reg2['nasc']))).'
        </div>
      </div>
      <div class="control-group">
        <strong>Sexo:</strong>
        <div class="controls">
          '.$reg2['sexo'].'
        </div>
      </div>
      <div class="control-group">
        <strong>Telefone:</strong>
        <div class="controls">
          '.$reg2['fone'].'
        </div>
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

                    $html_professor = new Html();
                    $html = $html_professor->load('view/professor-form.html');
                    
					$html = str_replace( '#TITULO#','Incluir',$html);
                    $html = str_replace( '#ACTION#',URL.'Professor/salvar',$html);
                    $html = str_replace( '#NOME#','',$html);
					$html = str_replace( '#CPF#','',$html);
                    $html = str_replace( '#NASC#','',$html);
					$html = str_replace( '#SEXO#','',$html);
					$html = str_replace( '#FONE#','',$html);

                    return $html;
                    break;

                case 'editar':

                    $dados = Connection::select( "SELECT * FROM professor where idprofessor=".App::$key );
                    $reg   = $dados->fetchObject();
                    
                    $html_professor = new Html();
                    $html = $html_professor->load('view/professor-form.html');
                    
					$html = str_replace( '#TITULO#','Editar',$html);
                    $html = str_replace( '#ACTION#',URL.'Professor/salvar/'.App::$key,$html);
                    $html = str_replace( '#NOME#',$reg->nomeProfessor,$html);
					$html = str_replace( '#CPF#',$reg->cpf,$html);
                    $html = str_replace( '#NASC#',$reg->nasc,$html);
					$html = str_replace( '#SEXO#',$reg->sexo,$html);
					$html = str_replace( '#FONE#',$reg->fone,$html);
                    
                    return $html;
                    break;

                case 'salvar':

                    if(App::$key){
                        $sql = "update professor set nomeProfessor='".$_POST["nome"]."',cpf='".$_POST["cpf"]."'
                                                   ,nasc='".$_POST["nasc"]."',sexo='".$_POST["sexo"]."',fone='".$_POST["fone"]."' where idprofessor=".App::$key  ;
                    }else{
                        $sql = "insert into professor ( nomeProfessor,cpf,nasc,sexo,fone )
                                       values ( '".$_POST["nome"]."','".$_POST["cpf"]."','".$_POST["nasc"]."','".$_POST["sexo"]."','".$_POST["fone"]."' )";
                    }

                    $dados = Connection::exec( $sql );

                    header('Location: ' .URL.'Professor/show');
                    break;

                case 'excluir':

                    $dados = Connection::exec( "delete from professor where idprofessor = ".App::$key );

                    header('Location: ' .URL.'Professor/show');
                    break;

            }

    }
}

