<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(isset($config['db_engine']) && $config['db_engine']==true && is_file(__DIR__.'/database.php') )
	$config['db_engine']    = true;
else
	$config['db_engine']    = false;