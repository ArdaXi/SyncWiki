<?php

class SW_Model extends Model {
	
	public $changed = array();
	
	function SW_Model()
	{
		parent::Model();
		
		$this->load->database();
	}
	
	function set($var, $val, $escape = true)
	{
		if(isset($this->$var))
		{
			if(!in_array($var, $this->changed))
			{
				$this->changed[] = $var;
			}
			
			$this->$var = ($escape) ? $this->db->escape_str($val) : $val ;
		}
	}
	
	function save()
	{
		die("No save method defined");
	}
}