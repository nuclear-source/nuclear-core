<?php 
function push_array($array,$array2)
{
	foreach($array2 as $key=>$val)
	{		
		array_push($array, $val);
	}
	return $array;
}
function get_dir_size($directory) {
	$directory=str_replace('nuclear-system/','',$directory);
	$size = 20000000;
	foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)) as $file) {
		$size += $file->getSize();
	}
	return $size;
}
function load_xml($path='')
{
	if(is_file($path))
	{
		$myXMLData = file_get_contents($path, true);
		if($xml=simplexml_load_string($myXMLData)){
			return $xml;
		}
	    else{return false;}
	}
}
function push_js()
{
	
	$CI = & get_instance();
	$CI->testiu->scripts;
}

function layout()
{
	return $this->data['layout'];
}

function generate_pass()
{	
	$seed = str_split('abcdefghijklmnopqrstuvwxyz_ABCDEFGHIJKLMNOPQRSTUVWXYZ-0123456789'); 
	shuffle($seed);$rand = '';foreach (array_rand($seed, 12) as $k) $rand .= $seed[$k];	
	return $rand;
}

function debug($array)
{
	echo '<pre>DEBUG:<br/>';
	print_r($array);
	echo '</pre>';
	exit();
}

function show($var='')
{
	if(!is_array($var)){
		echo $var;
	}
	else
	{
		echo '<pre>DEBUG:<br/>';
		print_r($var);
		echo '</pre>';
	}
	
}

function show_css($show)
{
	echo '<link rel="stylesheet"	href="'.base_url().'assets/css/'.$show.'">';
}
function show_js($show)
{
	echo '<script type="text/javascript"	src="'.base_url().'assets/js/'.$show.'"></script>';
}
function show_css_array($scripts)
{
	
	foreach ($scripts as $key=>$script)
	{
		$show='';
		if($script=='text'){$show='dist/summernote.css';}
		echo '<link rel="stylesheet"	href="'.base_url().'assets/'.$show.'">';
		
	}
}
function show_scripts($scripts)
{

	foreach ($scripts as $key=>$script)
	{
		$show='';
		if($script=='text'){$show='dist/summernote.min.js';}
		if($script=='ui'){$show='js/jquery-ui.min.js';}
		if($script=='nested'){$show='js/jquery.mjs.nestedSortable.js';}
		if($script=='graphs'){$show='js/morris.js';}
		if($script=='graphs2'){$show='js/raphael.js';}
		echo '<script type="text/javascript"	src="'.base_url().'assets/'.$show.'"></script>';
	}
}

// JavaScript Minifier
function minify_js($input) {	
	if(trim($input) === "") return $input;
	return str_replace(array("\r", "\n"), '', $input);
}


function get_css($input='')
{	
	$CI = & get_instance();
	
	if(is_file($CI->config->item('smarty.theme_path').$CI->config->item('smarty.theme_name').'/_css/'.$input.'.css'))
		return minify_css(file_get_contents($CI->config->item('smarty.theme_path').$CI->config->item('smarty.theme_name').'/_css/'.$input.'.css'));
	
	
}
function minify_css($input) {
	if(trim($input) === "") return $input;
	return preg_replace(
			array(
					// Remove comment(s)
					'#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')|\/\*(?!\!)(?>.*?\*\/)|^\s*|\s*$#s',
					// Remove unused white-space(s)
					'#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/))|\s*+;\s*+(})\s*+|\s*+([*$~^|]?+=|[{};,>~+]|\s*+-(?![0-9\.])|!important\b)\s*+|([[(:])\s++|\s++([])])|\s++(:)\s*+(?!(?>[^{}"\']++|"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')*+{)|^\s++|\s++\z|(\s)\s+#si',
					// Replace `0(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)` with `0`
					'#(?<=[\s:])(0)(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)#si',
					// Replace `:0 0 0 0` with `:0`
					'#:(0\s+0|0\s+0\s+0\s+0)(?=[;\}]|\!important)#i',
					// Replace `background-position:0` with `background-position:0 0`
					'#(background-position):0(?=[;\}])#si',
					// Replace `0.6` with `.6`, but only when preceded by `:`, `,`, `-` or a white-space
					'#(?<=[\s:,\-])0+\.(\d+)#s',
					// Minify string value
					'#(\/\*(?>.*?\*\/))|(?<!content\:)([\'"])([a-z_][a-z0-9\-_]*?)\2(?=[\s\{\}\];,])#si',
					'#(\/\*(?>.*?\*\/))|(\burl\()([\'"])([^\s]+?)\3(\))#si',
					// Minify HEX color code
					'#(?<=[\s:,\-]\#)([a-f0-6]+)\1([a-f0-6]+)\2([a-f0-6]+)\3#i',
					// Replace `(border|outline):none` with `(border|outline):0`
					'#(?<=[\{;])(border|outline):none(?=[;\}\!])#',
					// Remove empty selector(s)
					'#(\/\*(?>.*?\*\/))|(^|[\{\}])(?:[^\s\{\}]+)\{\}#s'
			),
			array(
					'$1',
					'$1$2$3$4$5$6$7',
					'$1',
					':0',
					'$1:0 0',
					'.$1',
					'$1$3',
					'$1$2$4$5',
					'$1$2$3',
					'$1:0',
					'$1$2'
			),
			$input);
}
function link_css($css)
{
	return '<link rel="stylesheet" href="'.$css.'">';
}

function rendejson($array)
{
	
	foreach($array as $key=>$value){
		if(isJson($value))
		{
			
			$array->$key=json_decode($value);
		}	
	}	
	return $array;
}

function isJson($string) {
   return is_string($string) && is_object(json_decode($string)) ? true : false;

}

function json($array)
{
	if(is_array($array))
	{
		return json_encode($array);

	}
}
