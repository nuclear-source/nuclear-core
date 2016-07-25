<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Tracker
{
	
/**
 * REGISTE VISITOR
 *************/
     function registe($engine='')
    {
	if($engine=='db')
	{
		//**falta test table exist
		$this->db->where('infoKEY', 'totalusers');
	    	$anterior=$this->db->get('nc-contents_project')->row();
	    	$n=$anterior->infoVALUE+1;
	    	$data = array('infoVALUE' => $n);
	    	$this->db->where('infoKEY', 'totalusers');
	    	$this->db->update('nc-contents_project', $data);
	}
	else
    	{
    		//Track user by File
    	}
    }
}