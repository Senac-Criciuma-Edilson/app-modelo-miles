<?php

	// Setando variáveis
	$entidadeNome 		= "erp_escola_aula";
	$entidadeDescricao 	= "Aula";

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
		$criarprojeto = 0,
		$criarempresa = 0,
		$criarauth = 0,
		$registrounico = 0
	);

	// Criando Atributos
	$descricao          			= criarAtributo($conn,$entidadeID,"descricao","Descrição","text",0,1,21,1);
	$unidadecurricular  			= criarAtributo($conn,$entidadeID,"unidadecurricular","Unidade Curricular","int",0,1,22,1,installDependencia("erp_escola_unidadecurricular",'package/negocio/itinerarioinformativo/unidadecurricular'));
	$conteudo  						= criarAtributo($conn,$entidadeID,"conteudo","Conteúdo","int",0,1,4,0,installDependencia("erp_escola_conteudo","package/sistema"));
	$atividadeestudoorientada       = criarAtributo($conn,$entidadeID,"atividadeestudoorientada","AEO","text",0,1,21,0);
    $quantidade_aula    			= criarAtributo($conn,$entidadeID,"quantidade_aula","Quantidade de Aulas","int",0,0,25,0);

	// Criando Acesso
	$menu = addMenu($conn,'Escola','#','',0,0,'escola');

	// Adicionando Menu
	addMenu($conn,$entidadeDescricao,"files/cadastro/".$entidadeID."/".getSystemPREFIXO().$entidadeNome.".html",'',$menu,1,'escola-' . $entidadeNome,$entidadeID,'cadastro');

	// Turma - Relacionamento
	criarRelacionamento($conn,11,$entidadeID,installDependencia("erp_escola_turma"),"Turmas");

	// Professor - Relacionamento
	criarRelacionamento($conn,11,$entidadeID,installDependencia("erp_escola_professor",'package/negocio/escola/rh/professor'),"Professores");

	// Assunto - Relacionamento
	criarRelacionamento($conn,11,$entidadeID,installDependencia("erp_escola_assunto"),"Assuntos");

	// Atividade - Relacionamento
	criarRelacionamento($conn,11,$entidadeID,installDependencia("erp_escola_atividade"),"Atividades");