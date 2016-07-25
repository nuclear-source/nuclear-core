<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NUCLEAR_Controller extends MX_Controller  
{	
	public static $instance;
	public $themename = '';
	public $data=array();
	public $theme_folder='';/// FROM OLD_VERSION
	public $global=array();
	
	function __construct() {
		parent::__construct();
		self::$instance = $this;
		$this->load->helper(array('url','functions','cookie'));
		$this->__init();
		$this->myprepare();
		
	}
	public function myprepare(){
		
		if($this->config->item('theme_engine') == 'smarty')
		{	
			$this->load->config('smarty');
				if(!is_dir($this->config->item('smarty.theme_path')))
				{
					$this->config->set_item('smarty.theme_path', $this->config->item('smarty.default'));	
				}
			$this->config->set_item('smarty.theme_name', $this->config->item('theme_name'));
				if(!is_dir($this->config->item('smarty.theme_path').$this->config->item('theme_name')))
				{
					$this->config->set_item('smarty.theme_path', $this->config->item('smarty.default'));
				}
			$this->config->set_item('partials', $this->config->item('smarty.theme_path').$this->config->item('smarty.theme_name').'/partials/');
			$this->load->library(array('parser','parser/parse'));
    			
    			
		}
	}
	public function __render($slug='')
    	{
		
		
		
		$this->global['partial']=$this->global['content']->pagesTPL;
		$this->_common();
		$this->parse->parse("index.tpl", $this->global);
    	}
	public function _render($layout)
    	{
	    	foreach($layout as $key=>$val)
	    		$this->global[$val]=true;
	    	
	    	if(isset($this->partial))
	    		$this->global['partial']=$this->partial;
	    		
    		$this->parse->parse("layouts/index.tpl", $this->global);
    	}
	
	
    
	static public function get_instance(){
		$ci = self::$instance;
		return $ci;
	}
	
	private function __init()
    	{
    	//ALIAS**falta	
    		define('PUBLICPATH', base_url());
    		define('MODULECALL', NUCLEARCORE);
	    	if(defined('PRIVATENAME') && PRIVATENAME!='')
	    		$prive = PRIVATENAME.'/';
	    	else
	    		$prive='';
    	//Variables	
	    	$uriString = $this->uri->uri_string();
	    	$nameClass = $this->router->fetch_class();
	    	$control   = $this->uri->segment(0);
	    	$newuri    = uri_rerange($uriString,$nameClass,$control);
	    	$uri_str   = implode('/',$newuri).'/';
	    	$this->theme_folder =  $this->config->item('FolderTemplate');
    	/*CONFIGS /*/
	    	$this->global['config']['assets']      = base_url().$this->config->item('static_assets').'/';
	    	$this->global['config']['static']      = base_url().$prive.$this->config->item('static_theme').'/'; 
	    	$this->global['config']['uploads']     = base_url().$this->config->item('theme_uploads').'/'; 
	    	
    	/*LANGUAGE //*/
	    	$this->global['lang']['language']   = $this->config->item('language');
	    	$this->global['lang']['key']     = $this->config->item('language_abbr');
	    	$this->global['lang']['langs']       = $this->config->item('lang_uri_abbr');
	    	
	/*ROUTER//*/    
	
		$this->global['router']['array']       = $this->uri->segment_array();
	    	$this->global['router']['nameClass']   = $this->router->fetch_class();
	    	$this->global['router']['uri']         = $this->uri->uri_string();
	    	$this->global['router']['uri_range']   = $newuri;
	    	$this->global['router']['baseurl']     = base_url().$prive;
	    	$this->global['router']['uri_folders']       = $uri_str;
	    	$this->global['router']['uri_folders_array'] = $uri_str;
	    	if(isset($newuri[0]))
	    		$this->global['router']['uri_alias']   =$newuri[0];
    	
	/*SEGMENTS//*/       	
	    	$this->global['segment']['ncontrol']  = $control;
	    	$this->global['segment']['nmethod']   = $this->uri->segment(1);
	    	$this->global['segment']['naction']     = $this->uri->segment(2);
	    	$this->global['segment']['naction2']    = $this->uri->segment(3);
    	
    	/*PAGE//*/
	    	$this->global['page']['active']      = getactive($uri_str,$control);
	    	$this->global['page']['breadcrumb']  = array('Home'=>'');    	
	    	$this->global['page']['this_base']   = base_url();
	/*RERANGE THISBASE */    	
    		if($uri_str!='/'){
    		$this->global['page']['this_base'].=$uri_str;
	    		foreach($newuri as $ki=>$val)
	    		{
	    			if($val.'/' !=$prive)
	    				$this->global['page']['breadcrumb'][$val]=base_url().$val;
	    		}	
    		}
	    	
	    	$this->global['page']['breadcrumb'][$control] = $this->global['page']['this_base'];
	    	if($control!='' && $control!=$nameClass && $nameClass!='' && $nameClass!='/'){
	    		$this->global['page']['this_base'].=$nameClass.'/';
	    		$this->global['page']['breadcrumb'][$nameClass]=$this->global['page']['this_base'];  
	    		
	    	}
	    	if($this->global['segment']['nmethod']!='')
	    		$this->global['page']['breadcrumb'][$this->global['segment']['nmethod']]=$this->global['page']['this_base'].$this->global['segment']['nmethod'];
    	
    	}
    	
    	
}