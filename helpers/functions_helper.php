<?php 
function uri_rerange($uri_string='',$class='',$control='')
{
	$uris = explode('/',$uri_string);
    	$uris=array_filter($uris);
    	$a=0;
    	foreach ($uris as $key=>$val){
    		if($class==$val)
    			$a=1;
    		if($a==1)
    			unset($uris[$key]);
    		if($control==$val)
    			$a=-1;
    		if($a==-1)
    			unset($uris[$key]);
    	}
    	$n=0;$new_uris=array();
    	foreach ($uris as $key=>$val){
    		$new_uris[$n]=$val;
    		$n+=1;}
    	return $new_uris;	
}

function getactive($uri_folders='',$class)
{
	
	if(count($uri_folders)==1 && $uri_folders=='/')
    	{
    		$active=$class;    	
    	}else
    	{
    		$active=$uri_folders.$class;
    	}
    	return $active;
}