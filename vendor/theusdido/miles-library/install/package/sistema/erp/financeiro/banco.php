<?php
	// Setando variáveis
	$entidadeNome 		= "erp_financeiro_banco";
	$entidadeDescricao 	= "Banco";

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
	$descricao 	= criarAtributo($conn,$entidadeID,"descricao","Descrição","varchar",50,0,3,1);
	$codigo 	= criarAtributo($conn,$entidadeID,"codigo","Código ( FEBRABAN )","char",3,1,3,1);
	$sigla 		= criarAtributo($conn,$entidadeID,"sigla","Sigla","varchar",5,1,3,1);
	Entity::setDescriptionField($conn,$entidadeID,$descricao,true);

	// Criando Acesso
	$menu_webiste = addMenu($conn,'Financeiro','#','',0,0,'financeiro');

	// Adicionando Menu
	addMenu($conn,$entidadeDescricao,"files/cadastro/".$entidadeID."/".getSystemPREFIXO().$entidadeNome.".html",'',$menu_webiste,8,'financeiro-' . $entidadeNome,$entidadeID, 'cadastro');