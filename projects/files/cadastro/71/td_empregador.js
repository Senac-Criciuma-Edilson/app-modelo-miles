/*
 * JS Personalizado 
 * @Data de Criacao: 25/09/2023 11:14:57 
 * @Criado por: ROOT, @id: 1 
 * @Página: 71 - Empregador[ td_empregador ] 
 */

// Invocado ao clicar no botão Novo
function beforeNew(){
	 var btnnew = arguments[0];
}
// Executa após o carregamento padrão de uma novo registro
function afterNew(){
	 var contexto = arguments[0];
}
// Invocado ao clicar no botão Salvar
function beforeSave(){
	 var btnsave = arguments[0];
}
// Executa após o salvamento padrão de um registro
function afterSave(){
	 var fp = arguments[0];
	 var btnsave = arguments[1];
}
// Invocado ao clicar no botão Editar 
function beforeEdit(){
	 var entidade = arguments[0];
	 var registro = arguments[1];
}
// Executa após o carregamento padrão da edição de registro
function afterEdit(){
	 var entidade = arguments[0];
	 var registro = arguments[1];
}
// Invocado ao clicar no botão Voltar
function beforeBack(){
	 var btnback = arguments[0];
}
// Executa após a ação de voltar a tela anterior
function afterBack(){
	 var btnback = arguments[0];
}
// Invocado ao clicar no botão Deletar
function beforeDelete(){
}
// Executa após a exclusão de um registro
function afterDelete(){
}
if (typeof funcionalidade === 'undefined') var funcionalidade = 'cadastro';

/* 
 ### Escreva seu código JavaScript abaixo dessa linha ou dentro das funções acima ### 
*/
