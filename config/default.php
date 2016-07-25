<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * PROJECT CONFIG;
 */

$config['static_assets'] = 'assets';
$config['theme_engine']  = 'smarty';
$config['theme_name']    = 'default';
$config['theme_uploads'] = 'uploads';
$config['db_engine']     = false;	


/**
 * Database SQL or NoDB
 * */
$config['db_engine']    = true; 
if(is_file(__DIR__.'/database.php') && $config['db_engine']==true)
	$config['db_engine']    = true;
else
	$config['db_engine']    = false;



