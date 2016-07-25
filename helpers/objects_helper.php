<?php 
function _restring($select,$prefix='')
{
	if($select!='*'){
		$select = explode(',',$select);		
		if(is_array($select) && count($select)>0)
		{
			$return=array();
			foreach($select as $val)
			{
				$return[]=$prefix.$val;
				
			}
			
			return implode(',',$return);
		}
		else
			return '*';		
	}
	else
		return '*';
	
}
function _rearray($where=array(),$prefix='')
{
	if(is_array($where) && count($where)>0){
		foreach($where as $key=>$val)
			{
				$return[$prefix.$key]=$val;

			}
			return $return;
	}
	
	else	
		array();
	
}

function slice_array($array=array())
{
	if(count($array)==1)
	{
		foreach($array as $val)
		{
			return $val;
		}
	}
}

function replace($key,$prefix='')
{
	if($prefix!='')
	{
		return strtolower(str_replace($prefix,'',$key));
	}

	if (strpos($key, 'ID')       !== false) {return 'id';}
	else if (strpos($key, 'SUBTITLE') !== false) {return 'subtitle';}
	else if (strpos($key, 'TITLE')    !== false) {return 'title';}
	else if (strpos($key, 'SLUG')     !== false) {return 'slug';}
	else if (strpos($key, 'IMG')      !== false) {return 'img';}
	else if (strpos($key, 'ORDER')    !== false) {return 'order';}
	else if (strpos($key, 'TEXT')     !== false) {return 'text';}
	else {return $key;}

}

function dbrange ($objs='',$prefix='')
{
	$return=(object)array();
	if(count($objs)>1){
		foreach($objs as $key=>$value)
			$return->$key=dbnames($value,$prefix);
	}
	else if(count($objs)==1 && is_array($objs) && isset($objs[0]))
	{
		$array[0]=dbnames($objs[0],$prefix);
		$return=$array;
	}
	else if(count($objs)==1)
		$return=dbnames($objs,$prefix);

		return $return;
}

function dbnames ($objs=array(),$prefix)
{

	$new=(object)array();
	foreach($objs as $key=>$value)
	{
		if(!is_array($value)){
			$newkey=replace($key,$prefix);
			$new->$newkey=str_replace('src="uploads/','src="'.PUBLICPATH.'uploads/',$value);
				
		}
			
		else if($key=='galery'){$n=0;
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