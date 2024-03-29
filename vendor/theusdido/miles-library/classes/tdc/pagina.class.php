<?php	
include_once PATH_WIDGETS . 'html.class.php';
/*
    * Framework MILES
    * @license : Teia Tecnologia WEB
    * @link https:teia.tec.br
		
    * Classe Pagina
    * Data de Criacao: 31/08/2012
    * @author Edilson Valentim dos Santos Bitencourt (Theusdido)
*/	
class Pagina Extends Html {
	public $header;
	public $head;
	public $body;
	public $showJSMask 				= true;
	public $showJSMaskMoney 		= true;
	public $showJSBootBox 			= true;
	public $showJSGoogleMaps 		= false;
	public $showCSSTheme			= true;
	public $showJSParticularidades	= true;
	public $showJSJqueryUI			= true;
	public $showJSCKEditor			= true;
	public $showJSSumoSelect		= true;
	public $showJSLibSystem			= true;
	public $ligthbox 				= true;
	public $dropzone				= true;
	public $ishtml5					= true;
	public $popperjs				= true;
	public $priceformatjs			= true;
	private $config;
	public $showMultiSelect			= true;
	private $title					= '';
	private $favicon				= null;
	public $showChartJS				= true;
	private $script;
	/*  
		* Método construct 
	    * Data de Criacao: 31/08/2012
	    * @author Edilson Valentim dos Santos Bitencourt (Theusdido)
		
		Cria uma pagina/documento HTML
	*/		
	public function __construct(){		
		parent::__construct();
		
		$this->config 					= tdClass::Criar("persistent",array(CONFIG,1))->contexto;
		$this->lang 					= "pt-br";
		$this->header				 	= tdClass::Criar("header");
		$this->head 					=  tdClass::Criar("head");
		$this->body 					= tdClass::Criar("body");
		
		$bootstrap 						= tdClass::Criar("link");
		$bootstrap->href 				= URL_LIB . 'bootstrap/3.3.1/css/bootstrap.css';
		$bootstrap->rel 				= 'stylesheet';		
		
		$jquery 						= tdClass::Criar("script");
		$jquery->src 					= URL_LIB . "jquery/jquery.js";
		$jquery->language 				= "JavaScript";
		
		$bootstrap_js 					= tdClass::Criar("script");
		$bootstrap_js->src 				= URL_LIB . "bootstrap/3.3.1/js/bootstrap.js";
		$bootstrap_js->language 		= "JavaScript";
				
		$tdlib_css       = tdc::html('link');
		$tdlib_css->href = URL_LIB . 'tdlib/css/tdlib.css';
		$tdlib_css->rel 	= "stylesheet";

		$tdlib_js 					= tdClass::Criar("script");
		$tdlib_js->src 				= URL_LIB . "tdlib/js/tdlib.js";
		$tdlib_js->language 		= "JavaScript";
	
		$meta_charset = tdClass::Criar("meta");		
		if ($this->ishtml5){
			$meta_charset->charset 		= "utf-8";
		}else{	
			$meta_charset->http_equiv 	= "Content-Type";
			$meta_charset->content 		= "text/html; charset=utf-8";
		}	

		$meta_viewport 			= tdClass::Criar("meta");
		$meta_viewport->name 	= "viewport";
		$meta_viewport->content = "width=device-width, initial-scale=1";

		$meta_robots 			= tdClass::Criar("meta");
		$meta_robots->name	 	= "robots";
		$meta_robots->content 	= "noindex, nofollow";

		$this->setTitle();
		$this->head->add($meta_charset,$meta_viewport,$meta_robots,$bootstrap,$tdlib_css);
		$this->body->add($jquery,$bootstrap_js,$tdlib_js);
		
	}

	/*
		* Método mostrar 
	    * Data de Criacao: 05/09/2012
	    * @author Edilson Valentim dos Santos Bitencourt (Theusdido)

		Mostrar o conteúdo na página, sobreescreve o método da classe pai
	*/
	public function mostrar(){
		$this->addJQueryDependencias();

		if ($this->showJSGoogleMaps){
			$jsGoogleMaps 		= tdClass::Criar("script");
			$jsGoogleMaps->src 	= "https://maps.googleapis.com/maps/api/js?sensor=false&language=pt_BR";
			$this->head->add($jsGoogleMaps);
		}
		
		if ($this->showCSSTheme){
			$tema_project = NULL;
			if (file_exists(PATH_CURRENT_PROJECT_THEME)){
				$tema_project 			= tdClass::Criar("link");
				$tema_project->href 	= URL_CURRENT_PROJECT_THEME . 'geral.css';
				$tema_project->rel 		= 'stylesheet';				
			}

			$tema 			= tdClass::Criar("link");
			$tema->href 	= URL_SYSTEM_THEME . 'geral.css';
			$tema->rel 		= 'stylesheet';
	
			$gradededadosCSS 		= tdClass::Criar("link");
			$gradededadosCSS->href 	= URL_SYSTEM_THEME . 'gradesdedados.css';
			$gradededadosCSS->rel 	= 'stylesheet';

			$this->head->add($tema,$tema_project,$gradededadosCSS);
		}
		
		if ($this->showJSParticularidades){
			/*
			$particularidades_file = RAIZ."config/particularidades.js";
			if (file_exists($particularidades_file)){
				$particularidades_js = tdClass::Criar("script");
				$particularidades_js->src = "config/particularidades.js";
				$particularidades_js->language = "JavaScript";
				$this->body->add($particularidades_js);
			}else $particularidades_js = "";
			*/
		}


		
		if ($this->showJSCKEditor){
			$ckeditor 				= tdClass::Criar("script");
			$ckeditor->language 	= "JavaScript";
			$ckeditor->src 			= URL_LIB . "ckeditor/ckeditor.js";		
			
			$this->body->add($ckeditor);
		}


		
		if ($this->ligthbox){

			$lightboxCSS 			= tdClass::Criar("link");
			$lightboxCSS->href 		= URL_LIB . 'lightbox2-master/src/css/lightbox.css';
			$lightboxCSS->rel 		= 'stylesheet';
			
			$this->head->add($lightboxCSS);
			
			$lightboxJS 			= tdClass::Criar("script");
			$lightboxJS->src 		= URL_LIB . "lightbox2-master/src/js/lightbox.js";
			
			$this->body->add($lightboxJS);
		
		}
		
		if ($this->dropzone){

			$dropzoneCSS 			= tdClass::Criar("link");
			$dropzoneCSS->href 		= URL_LIB . 'dropzone/dropzone.css';
			$dropzoneCSS->rel 		= 'stylesheet';

			$this->head->add($dropzoneCSS);

			$dropzoneJS				= tdClass::Criar("script");
			$dropzoneJS->src 		= URL_LIB . "dropzone/dropzone.js";

			$this->body->add($dropzoneJS);

		}
		
		if ($this->popperjs){
			$popperjs 				= tdClass::Criar("script");
			$popperjs->src 			= "https://unpkg.com/@popperjs/core@2";			
			$this->body->add($popperjs);
		}

		if ($this->showChartJS){
			$chart_js = tdc::html('script');
			$chart_js->src = 'https://cdn.jsdelivr.net/npm/chart.js';
			$this->body->add($chart_js);
		}		

		// Javascript inicial da página
		$this->jsInicial();
		$this->addJSLbiSystem();
		$this->addBody($this->script);

		$title = tdClass::Criar("title");
		$title->add($this->getTitle());
		$this->head->add($title);

		if ($this->favicon == null) $this->setFavIcon();
		if ($this->ishtml5) echo "<!DOCTYPE html>";
		parent::add($this->head);	
		parent::add($this->body);
		parent::mostrar();	
	}

	private function jsInicial(){

		// Arquivo de Codificação/Decoficação em JS
		$jsDecode 		= tdClass::Criar("script");
		$jsDecode->src 	= URL_LIB . "phpjs-master/functions/xml/utf8_decode.js";

		$cf 			= getCurrentConfigFile();
		$jsSession 		= tdClass::Criar("script");
		$jsSession->add('
			function SystemSession(){
				this.autenticado 				= "'.(isset(Session::get()->autenticado)?Session::get()->autenticado:"").'";
				this.userid 					= "'.(isset(Session::get()->userid)?Session::get()->userid:"").'";
				this.username 					= "'.(isset(Session::get()->username)?Session::get()->username:"").'";
				this.usergroup 					= '.(isset(Session::get()->usergroup)?(is_numeric(Session::get()->usergroup)?Session::get()->usergroup:0):0).';
				this.empresa					= "'.(isset(Session::get()->empresa)?Session::get()->empresa:"").'";
				this.projeto					= '.CURRENT_PROJECT_ID.';
				this.permitirexclusao			= "'.(isset(Session::get()->permitirexclusao)?Session::get()->permitirexclusao:"").'";
				this.permitirtrocarempresa		= "'.(isset(Session::get()->permitirtrocarempresa)?Session::get()->permitirtrocarempresa:"").'";
				this.currentprojectregisterpath	= "'.PATH_PROJECT.'";
				this.objectID					= -1;
				this.PREFIXO					= "'.PREFIXO.'_";
				this.isonline                   = '.isOnline("string").';
				this.isproducao                 = '.isProducao("string").';
				this.urlroot					= "'.URL_ROOT.'";
				this.urlsystem					= "'.URL_SYSTEM.'";
				this.urlalias					= "'.URL_ALIAS.'";
				this.urlcurrenttheme			= "'.URL_CURRENT_PROJECT_THEME.'";
				this.urlloading					= "'.URL_LOADING.'";
				this.urlloading2				= "'.URL_LOADING2.'";
				this.urlmiles					= "'.URL_MILES.'index.php";
				this.folderprojectfiles 		= "'.URL_CURRENT_PROJECT.'";
				this.urlnodejs					= "'.URL_NODEJS.'";
				this.curdate					= "'.date('d/m/Y').'";
				this.urlcontrollerecommerce		= "'.URL_ECOMMERCE.'";
				this.urldata					= "'.URL_CURRENT_DATA.'";
				this.url_favicon				= "'.URL_FAVICON.'";
				this.project_id					= "'.PROJECT_ID.'";
				this.project_name				= "'.PROJECT_NAME.'";
				this._environment				= "'._ENVIROMMENT.'";
				this.url_files					= "'.URL_FILES.'";
				this.url_files_cadastro			= "'.URL_FILES_CADASTRO.'";
			}
			var session = new SystemSession();
			
			function SystemConfig(){
				this.urlrequisicoes 				= "'.getURLProject($this->config->urlrequisicoes).'";
				this.urlloadform					= "'.getURLProject($this->config->urlloadform).'";
				this.urluploadform					= "'.getURLProject($this->config->urluploadform).'";
				this.urlexcluirregistros			= "'.getURLProject($this->config->urlexcluirregistros).'";
				this.urlinicializacao				= "'.getURLProject($this->config->urlinicializacao).'";
				this.urlloadgradededados			= "'.getURLProject($this->config->urlloadgradededados).'";
				this.urlsaveform					= "'.getURLProject($this->config->urlsaveform).'";
				this.urlloading						= "'.getURLProject($this->config->urlloading).'";
				this.urlenderecofiltro				= "'.getURLProject($this->config->urlenderecofiltro).'";
				this.urlrelatorio					= "'.getURLProject($this->config->urlrelatorio).'";
				this.urlmenu						= "'.getURLProject($this->config->urlmenu).'";
				this.relogio						= "'.date("Y-m-d H:i:s").'";
				this.datahora						= "";
				this.pathfileupload					= "'.$this->config->pathfileupload.'";
				this.pathfileuploadtemp				= "'.$this->config->pathfileuploadtemp.'";
				this.casasdecimais					= "'.($this->config->casasdecimais==''?2:$this->config->casasdecimais).'";
				this.currenttheme					= "'.CURRENT_THEME.'";				
				this.upload_max_filesize			= "'.ini_get('upload_max_filesize').'";
			}
			var config = new SystemConfig();
		');

		// Intercepta as requisições AJAX
		$jsDefaultAJAX = tdc::o("script");
		$jsDefaultAJAX->add('
			// Requisições
			// Intercpta todas as requisições AJAX
			$.ajaxSetup({
				headers: { "CustomHeader": "myValue" },
				data: {
					project_name_identifify_params:"'.MILES_JSON_PROJECT.'",
					env:"'._ENVIROMMENT.'",
					nocahe:new Date().getTime()
				},
				complete:function(){
					scriptNoCache();
				}
			});

			$(document).ready(function(){
				scriptNoCache();
			});

			function scriptNoCache(){
				$("script").each(function(){
					let src		= $(this).attr("src");					
					if (src != undefined){
						let src_old = $(this).attr("src").replace(".js?",".js");
						if (src.indexOf(".js?") > 0){
							src_old = src.split(".js?")[0] + ".js";
						}
						let time	= new Date().getTime();
						let src_new = src_old + "?" + time;
						$(this).attr("src", src_new);
					}
				});				
			}

		');

		// Arquivo de Codificação/Decoficação em JS
		if (file_exists(Asset::path('FILE_MDM_JS_COMPILE'))){
			$jsMDM 		= tdClass::Criar("script");
			$jsMDM->src = Asset::url('FILE_MDM_JS_COMPILE') ;
		}else{
			$jsMDM = null;
		}

		// Adicionar JS na Página
		$this->body->add(
			$jsDecode,
			$jsSession,
			$jsDefaultAJAX,
			$jsMDM
		);
	}

	/*  
		* Método getTitle
	    * Data de Criacao: 28/10/2020
	    * @author Edilson Valentim dos Santos Bitencourt (Theusdido)
		
		Retorna o titulo da página
	*/
	public function getTitle(){
		return $this->title;
	}

	/*  
		* Método getTitle
	    * Data de Criacao: 20/11/2021
	    * @author Edilson Valentim dos Santos Bitencourt (Theusdido)

		Seta o titulo da página
	*/
	public function setTitle($title = ''){
		if ($title == ''){
			$title 				= 'Miles';
			$currentProjectName = PROJETO_DESC;
			if ($currentProjectName != '' && $currentProjectName != '0'){
				$title .=  " | " . $currentProjectName;
			}
			$this->title = $title;
		}else{
			$this->title = $title;
		}
	}

	/*  
		* Método addBody
	    * Data de Criacao: 03/11/2022
	    * Autor @theusdido

		Adiciona conteúdo no corpo da página
	*/
	public function addBody($conteudo){
		$this->body->add($conteudo);
	}

	/*  
		* Método addHead
	    * Data de Criacao: 03/11/2022
	    * Autor @theusdido

		Adiciona conteúdo no cabeçalho da página
	*/
	public function addHead($conteudo){
		$this->head->add($conteudo);
	}

	/*
		* Método getFavIcon
	    * Data de Criacao: 03/11/2022
	    * Autor @theusdido

		Retorna o elemento html do Favicon
	*/
	public function getFavIcon(){
		return $this->favicon;
	}

	/*
		* Método setFavIcon
	    * Data de Criacao: 03/11/2022
	    * Autor @theusdido

		Retorna o elemento html do Favicon
	*/
	public function setFavIcon($url = ''){
		$favicon 		= tdClass::Criar("link");
		$favicon->id 	= "favicon";
		$favicon->rel 	= "icon";
		$favicon->href 	= $url == '' ? URL_FAVICON : $url;
		$this->head->add($favicon);
		$this->favicon 	= $favicon;
	}

	/*
		* Método addJSLibSystem
	    * Data de Criacao: 13/02/2023
	    * Autor @theusdido

		Adiciona arquivos javascript do sistema
	*/	
	public function addJSLbiSystem(){
		if ($this->showJSLibSystem){

			// Adiciona o arquivo de funções em JS
			$jsFuncoes 			= tdClass::Criar("script");
			$jsFuncoes->src 	= URL_SYSTEM . "funcoes.js";

			// Adiciona a página padrão de validação dos campos do formulário
			$jsValidar 			= tdClass::Criar("script");
			$jsValidar->src	 	= URL_SYSTEM . "validar.js";

			// Adiciona a classe Grade de Dados em JavaScript
			$jsGradeDados 			= tdClass::Criar("script");
			$jsGradeDados->src	 	= URL_CLASS_TDC . "gradededados.class.js";

			// Adiciona a classe Grade de Dados em JavaScript
			$jsChecklist 			= tdClass::Criar("script");
			$jsChecklist->src	 	= URL_CLASS_TDC . "checklist.class.js";

			// Classe do formulário
			$jsFormularioClass 			= tdClass::Criar("script");
			$jsFormularioClass->src 	= URL_CLASS_TDC . "formulario.class.js";

			$jsGerarHtmlClass 			= tdClass::Criar("script");
			$jsGerarHtmlClass->src 		= URL_CLASS_TDC . "gerarhtml.class.js";

			$this->body->add($jsFuncoes,$jsValidar,$jsGradeDados,$jsChecklist,$jsFormularioClass,$jsGerarHtmlClass);
		}
	}

	/*
		* Método addJQueryLib
	    * Data de Criacao: 13/02/2023
	    * Autor @theusdido

		Adiciona arquivos javascript com dependencia da JQuery
	*/
	public function addJQueryDependencias(){
		if ($this->showJSMask){
			$jquery_mask 				= tdClass::Criar("script");
			$jquery_mask->src 			= URL_LIB . "jquery/jquery.mask.js";
			$jquery_mask->language 		= "JavaScript";
			$this->body->add($jquery_mask);
		}
		if ($this->showJSMaskMoney){
			$jquery_maskMoney 			= tdClass::Criar("script");
			$jquery_maskMoney->src 		= URL_LIB . "jquery/jquery.maskMoney.js";
			$jquery_maskMoney->language = "JavaScript";
			$this->body->add($jquery_maskMoney);
		}
		if ($this->showJSBootBox){
			$bootbox_js 			= tdClass::Criar("script");
			$bootbox_js->src 		= URL_LIB . "jquery/jquery-bootbox.js";
			$bootbox_js->language 	= "JavaScript";
			$this->body->add($bootbox_js);
		}	
		if ($this->showJSJqueryUI){
			$jsJQueryUI 			= tdClass::Criar("script");
			$jsJQueryUI->src 		= URL_LIB . "jquery/ui/jquery-ui.min.js";

			$cssJQueryUI 			= tdClass::Criar("link");
			$cssJQueryUI->href 		= URL_LIB . "jquery/ui/jquery-ui.css";
			$cssJQueryUI->rel 		= "stylesheet";

			$this->body->add($cssJQueryUI,$jsJQueryUI);
		}
				
		if ($this->showJSSumoSelect){
			$jsJQueryUI 			= tdClass::Criar("script");
			$jsJQueryUI->src 		= URL_LIB . "jquery/sumoselect/jquery.sumoselect.js";

			$cssJQueryUI 			= tdClass::Criar("link");
			$cssJQueryUI->href 		= URL_LIB . "jquery/sumoselect/sumoselect.css";
			$cssJQueryUI->rel 		= "stylesheet";

			$this->body->add($cssJQueryUI,$jsJQueryUI);
		}
				
		if ($this->priceformatjs){
			$priceFormatJS 			= tdClass::Criar("script");
			$priceFormatJS->src 	= URL_LIB . "jquery/Jquery-Price-Format-master/jquery.priceformat.js";
			$this->body->add($priceFormatJS);
		}

		$smallModal 				= tdClass::Criar("script");
		$smallModal->src 			= URL_LIB . "jquery/Small-Loading-Modal-Overlay-Plugin-With-jQuery-loadingBlock/assets/js/jquery.loading.block.js";
		$this->body->add($smallModal);
		
		#$fontAwesome 				= tdClass::Criar("script");
		#$fontAwesome->src 			= URL_LIB . "fontawesome/ea948eea7a.js";
		
		$fontAwesome 					= tdClass::Criar("link");
		$fontAwesome->href				= 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==';
		$fontAwesome->rel 				= 'stylesheet';
		$fontAwesome->crossorigin		= 'anonymous';
		$fontAwesome->referrerpolicy	= 'no-referrer';
		$this->head->add($fontAwesome);

		if ($this->showMultiSelect){
			$multiSelectCSS 		= tdClass::Criar("link");
			$multiSelectCSS->href 	= URL_LIB . "jquery/multiselect-master/styles/multiselect.css";
			$multiSelectCSS->rel 	= "stylesheet";
			$this->head->add($multiSelectCSS);

			$multiSelectJS 			= tdClass::Criar("script");
			$multiSelectJS->src 	= URL_LIB . "jquery/multiselect-master/multiselect.min.js";
			$this->head->add($multiSelectJS);
		}

		$toastifyCSS 			= tdClass::Criar("link");
		$toastifyCSS->href 		= URL_LIB . "toastify-js/src/toastify.css";
		$toastifyCSS->rel 		= "stylesheet";
		$this->head->add($toastifyCSS);

		$toastifyJS 			= tdClass::Criar("script");
		$toastifyJS->src 		= URL_LIB . "toastify-js/src/toastify.js";
		$this->body->add($toastifyJS);
	}

	/*  
		* Método addScript
	    * Data de Criacao: 20/04/2023
	    * Autor @theusdido

		Adiciona script personalizado
	*/
	public function addScript($script){
		$this->script = $script;
	}	
}