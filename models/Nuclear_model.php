<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Nuclear_model extends CI_Model
{
	function _gallery($query='')
	{
		foreach($query as $key=>$value)
			{
				
				if(isset($value->img))
				{
					$gallery=explode(',',$value->img);
					if(count($gallery)>1)
					{
						$value->img=$gallery[0];
						unset($gallery[0]);
						$value->gallery=$gallery;
					}
					else{
						
					}
				}
				
			}
		
		return $query;
	}
	
	function dbrange ($objs='')
	{
	
		$return=(object)array();		
		if(count($objs)>1){			
			foreach($objs as $key=>$value)
				$return->$key=$this->dbnames($value);
		}
		else if(count($objs)==1 && is_array($objs) && isset($objs[0]))
		{
			$array[0]=$this->dbnames($objs[0]);
			$return=$array;			
		}
		else if(count($objs)==1)
			$return=$this->dbnames($objs);
	
		return $return;
	}
	
	function dbnames ($objs=array())
	{
		$new=(object)array();
		foreach($objs as $key=>$value)
		{	
		
			if(!is_array($value) ){
				
			$newkey=$this->replace($key);
			
			if(is_string($value))
				$new->$newkey=str_replace('src="uploads/','src="'.PUBLICPATH.'uploads/',$value);
			else
			   	$new->$newkey=$value;
			}
			
			else if($key=='galery' || $key=='pagesGALERY'){
				$n=0;
				$return =array();
				foreach($value as $key=>$val)
				{
					$return[$n] =$val;
					$n+=1;
				}
				$new->galery=$return;
			}
		}
		return $new;
	
	}
	function replace($key)
	{
		
		if (strpos($key, 'ID')       !== false) {return 'id';}
		else if (strpos($key, 'SUBTITLE') !== false) {return 'subtitle';}
		else if (strpos($key, 'TITLE')    !== false) {return 'title';}
		else if (strpos($key, 'SLUG')     !== false) {return 'slug';}
		else if (strpos($key, 'IMG')      !== false) {return 'img';	}
		else if (strpos($key, 'ORDER')    !== false) {return 'order';}
		else if (strpos($key, 'TEXT')     !== false) {return 'text';}
		else if (strpos($key, 'KEYWORDS')     !== false) {return 'keywords';}
		else if (strpos($key, 'PRIX')     !== false) {return 'prix';}
		else if (strpos($key, 'GROUP')     !== false) {return 'group';}
		else if (strpos($key, 'TPL')     !== false) {return 'tpl';}
		else {return $key;}
		
	}	
	
	 function _urlx($str='')
	{
		$data= strtolower(url_title(
				str_replace('º','',
				str_replace('ã','a',
					str_replace('À','a',
						str_replace('á','a',
								str_replace('é','e',
										str_replace('í','i',
												str_replace('ó','o',
														str_replace('õ','o',
																str_replace('ç','c',
																		str_replace('ú','u',$str))))))))))
				,'-',true));
		return $data;
	}
}