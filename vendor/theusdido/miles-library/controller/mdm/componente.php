<?php

	$entidade 		= tdc::e(tdc::r('entidade'));
	$descricao_doc 	= $entidade->id . " - " . $entidade->descricao . "[ ".$entidade->nome." ]";
	$_reset_files	= tdc::r('reset',false);

	switch(tdc::r('op')){
		case 'criarcadastro':
			$path 			= PATH_FILES_CADASTRO . $entidade->id . "/";
			$_conceito		= 'cadastro';
		break;
		case 'criarconsulta':
			$path 			= PATH_FILES_CONSULTA . tdc::r('id') . "/";
			$_conceito		= 'consulta';
		break;
		case 'criarmovimentacao':
			$path 			= PATH_FILES_MOVIMENTACAO . tdc::r('id') . '/';
			$_conceito		= 'movimentacao';
		break;
		case 'criarrelatorio':
			$path 			= PATH_FILES_RELATORIO . tdc::r('id') . '/';
			$_conceito		= 'relatorio';
		break;
		default:
			$path = PATH_FILES_CADASTRO . $entidade->id . "/";
			$_conceito		= 'cadastro';
	}

	// Documentação
	$datacriacaodoc = "* @Data de Criacao: ".date("d/m/Y H:i:s");
	$authordoc 		= "* @Criado por: ".$_SESSION["username"].", @id: ".$_SESSION["userid"];
	$paginadoc 		= "* @Página: {$descricao_doc}";
	
	// Cria o diretório do registro caso não exista
	if (!file_exists($path)){
		mkdir($path,0777,true);
	}
	
	// Nome do arquivo HTML principal
	$_filename_html 	= tdc::r('filename'		,$entidade->nome . '.html');
	$_filename_htm 		= tdc::r('filenamehtm'	,$entidade->nome . '.htm');
	$_filename_css 		= tdc::r('filenamecss'	,$entidade->nome . '.css');
	$_filename_js 		= tdc::r('filenamejs'	,$entidade->nome . '.js');

	$_full_filename_html	= $path . $_filename_html;
	$_full_filename_htm		= $path . $_filename_htm;
	$_full_filename_css		= $path . $_filename_css;
	$_full_filename_js		= $path . $_filename_js;
	
	// Arquivo HTML sempre é regerado
	if (file_exists($_full_filename_html)) 	unlink($_full_filename_html);

	// Cria o arquivo HTML
	$fp = fopen($_full_filename_html ,'w');
	fwrite($fp,htmlespecialcaracteres(isset($_POST["html"])?$_POST["html"]:'',1));
	fclose($fp);

	// Testa se os arquivos devem ser excluídos
	if (json_decode($_reset_files)){

		if (file_exists($_full_filename_htm)) 	unlink($_full_filename_htm);
		if (file_exists($_full_filename_css))	unlink($_full_filename_css);
		if (file_exists($_full_filename_js)) 	unlink($_full_filename_js);

		// Cria o arquivo HTML Embutido Dinâmico	
		if (!file_exists($_full_filename_htm)){
			$fp = fopen($_full_filename_htm,'w');
			fwrite($fp,"<!--\n * HTML Personalizado \n {$datacriacaodoc} \n {$authordoc} \n {$paginadoc} \n\n Escreve seu código HTML personalizado aqui! \n-->\n");
			fclose($fp);
		}	

		// Cria o arquivo CSS
		if (!file_exists($_full_filename_css)){
			$fp = fopen($_full_filename_css ,'w');
			fwrite($fp,"/*\n * CSS Personalizado \n {$datacriacaodoc} \n {$authordoc} \n {$paginadoc} \n\n Escreve seu código CSS personalizado aqui! \n*/\n");
			fclose($fp);
		}

		// Cria o arquivo JS
		if (!file_exists($_full_filename_js)){
			$fp = fopen($_full_filename_js ,'w');
			fwrite($fp,"/*\n * JS Personalizado \n {$datacriacaodoc} \n {$authordoc} \n {$paginadoc} \n */\n\n");
			fwrite($fp,"// Invocado ao clicar no botão Novo");
			fwrite($fp,"\n");
			fwrite($fp,"function beforeNew(){");
			fwrite($fp,"\n\t var btnnew = arguments[0];");
			fwrite($fp,"\n");
			fwrite($fp,"}");
			fwrite($fp,"\n");
			fwrite($fp,"// Executa após o carregamento padrão de uma novo registro");
			fwrite($fp,"\n");
			fwrite($fp,"function afterNew(){");					
			fwrite($fp,"\n\t var contexto = arguments[0];");
			fwrite($fp,"\n");					
			fwrite($fp,"}");
			fwrite($fp,"\n");
			fwrite($fp,"// Invocado ao clicar no botão Salvar");
			fwrite($fp,"\n");
			fwrite($fp,"function beforeSave(){");
			fwrite($fp,"\n\t var btnsave = arguments[0];");
			fwrite($fp,"\n");
			fwrite($fp,"}");
			fwrite($fp,"\n");
			fwrite($fp,"// Executa após o salvamento padrão de um registro");
			fwrite($fp,"\n");
			fwrite($fp,"function afterSave(){");
			fwrite($fp,"\n\t var fp = arguments[0];");
			fwrite($fp,"\n\t var btnsave = arguments[1];");
			fwrite($fp,"\n");
			fwrite($fp,"}");
			fwrite($fp,"\n");
			fwrite($fp,"// Invocado ao clicar no botão Editar ");
			fwrite($fp,"\n");
			fwrite($fp,"function beforeEdit(){");
			fwrite($fp,"\n\t var entidade = arguments[0];");
			fwrite($fp,"\n\t var registro = arguments[1];");
			fwrite($fp,"\n");
			fwrite($fp,"}");
			fwrite($fp,"\n");
			fwrite($fp,"// Executa após o carregamento padrão da edição de registro");
			fwrite($fp,"\n");
			fwrite($fp,"function afterEdit(){");
			fwrite($fp,"\n\t var entidade = arguments[0];");
			fwrite($fp,"\n\t var registro = arguments[1];");					
			fwrite($fp,"\n");
			fwrite($fp,"}");
			fwrite($fp,"\n");
			fwrite($fp,"// Invocado ao clicar no botão Voltar");
			fwrite($fp,"\n");
			fwrite($fp,"function beforeBack(){");
			fwrite($fp,"\n\t var btnback = arguments[0];");
			fwrite($fp,"\n");
			fwrite($fp,"}");
			fwrite($fp,"\n");
			fwrite($fp,"// Executa após a ação de voltar a tela anterior");
			fwrite($fp,"\n");
			fwrite($fp,"function afterBack(){");
			fwrite($fp,"\n\t var btnback = arguments[0];");
			fwrite($fp,"\n");
			fwrite($fp,"}");
			fwrite($fp,"\n");
			fwrite($fp,"// Invocado ao clicar no botão Deletar");
			fwrite($fp,"\n");
			fwrite($fp,"function beforeDelete(){");
			fwrite($fp,"\n");
			fwrite($fp,"}");
			fwrite($fp,"\n");
			fwrite($fp,"// Executa após a exclusão de um registro");
			fwrite($fp,"\n");
			fwrite($fp,"function afterDelete(){");
			fwrite($fp,"\n");
			fwrite($fp,"}");
			fwrite($fp,"\n");
			fwrite($fp,"if (typeof funcionalidade === 'undefined') var funcionalidade = '$_conceito';");
			fwrite($fp,"\n\n/* \n ### Escreva seu código JavaScript abaixo dessa linha ou dentro das funções acima ### \n*/\n");
			fclose($fp);
		}

		// Seta permissão total para escrita no arquivo
		chmod($path, 				0777);
		chmod($_full_filename_html,	0777);
		chmod($_full_filename_htm, 	0777);
		chmod($_full_filename_css, 	0777);
		chmod($_full_filename_js, 	0777);
	}

	// Cria o MDM File JavaScript Compile
	include 'javascriptfile.php';