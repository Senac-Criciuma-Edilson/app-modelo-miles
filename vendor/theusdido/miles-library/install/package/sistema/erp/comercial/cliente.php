<?php
	// Setando variáveis
	$entidadeNome 		= "erp_geral_cliente";
	$entidadeDescricao 	= "Cliente";

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
		$registrounico = 0
	);
	
	// Criando Atributos
	$nome 		= criarAtributo($conn,$entidadeID,"nome","Nome","varchar","200",1,3,1,0,0,"");
	$contato 	= criarAtributo($conn,$entidadeID,"contato","Contato","varchar","200",1,3,1,0,0,"");
	Entity::setDescriptionField($conn,$entidadeID,$nome,true);

	// Criando Acesso
	$menu_webiste 	= addMenu($conn,'Geral','#','',0,0,'geral');

	// Adicionando Menu
	addMenu($conn,$entidadeDescricao,"files/cadastro/".$entidadeID."/".getSystemPREFIXO().$entidadeNome.".html",'',$menu_webiste,8,'financeiro-' . $entidadeNome,$entidadeID,'cadastro');