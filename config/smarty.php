<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//DEFAULT-THEME
$default = 'default';
$theme_folder = 'themes';
///////////////////////////////////////////////

if(defined('ROOTPATH') && is_dir(ROOTPATH.'../.'.$theme_folder.'/') )
	$theme = ROOTPATH.'../.'.$theme_folder.'/';
else if(defined('ROOTPATH') && is_dir(ROOTPATH.$theme_folder.'/') )
	$theme = ROOTPATH.$theme_folder.'/';
	
else if(is_dir(APPPATH.'../../'.$theme_folder.'/') )
	$theme = APPPATH.'../../'.$theme_folder.'/';	
else
	$theme = APPPATH.'themes/';

//////////////////////////////////////////////	
$config['smarty.cache_status'] = FALSE;
$config['smarty.theme_path'] = $theme;
$config['smarty.theme_name'] = $default;
$config['smarty.cache_lifetime'] = 3600;
$config['smarty.compile_directory'] = SRCPATH.".cache/".APPNAME."/compiled/";
$config['smarty.cache_directory'] =  SRCPATH.".cache/".APPNAME."/cached/";
$config['smarty.config_directory'] = APPPATH."config/";
$config['smarty.template_ext'] = 'tpl';
$config['smarty.template_error_reporting'] = E_ALL & ~E_NOTICE;
$config['smarty.smarty_debug'] = FALSE;
