<?php
	// Setando variáveis
	$entidadeNome 		= "ecommerce_tipooperacaoestoque";
	$entidadeDescricao 	= "Tipo de Operação de Estoque";

	// Criando Entidade
	$entidadeID = criarEntidade(
		$conn,
		$entidadeNome,
		$entidadeDescricao,
		$ncolunas=3,
		$exibirmenuadministracao = 0,
		$exibircabecalho = 1,
		$campodescchave = 0,
		$atributogeneralizacao = 0,
		$exibirlegenda = 1,
		$criarprojeto = 1,
		$criarempresa = 1,
		$criarauth = 0,
		$registrounico = 0,
		$carregarlibjavascript = 1,
		$criarinativo = false		
	);
	
	// Criando Atributos
	$descricao 	= criarAtributo($conn,$entidadeID,"descricao","Descrição","varchar","200",1,3,1,0,0,"");
	$tipo		= criarAtributo($conn,$entidadeID,"tipo",array("Tipo","Entrada","Saída"),"boolean",0,0,7);
	Entity::setDescriptionField($conn,$entidadeID,$descricao,true);

	// Criando Acesso
	$menu_webiste = addMenu($conn,'Material','#','',0,0,'material');

	// Adicionando Menu
	addMenu($conn,$entidadeDescricao,"files/cadastro/".$entidadeID."/".getSystemPREFIXO().$entidadeNome.".html",'',$menu_webiste,8,'material-' . $entidadeNome,$entidadeID,'cadastro');