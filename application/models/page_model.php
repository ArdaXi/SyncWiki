<?php

require_once('sw_model.php');

class Page_model extends SW_Model {
	
	var $title = '';
	var $id = 0;
	var $views = 0;
	var $locked = 0;
	var $rev_id = 0;
	var $text = '';
	
	/**
	 * Loads the page by title from the database
	 * 
	 * @access public
	 * @param str $page_title
	 * @return query
	 */
	function load_page($page_title)
	{
		$page_title = $this->db->escape_str($page_title);
		$this->db->from('page');
		$this->db->join('page_text', 'page.page_latest = page_text.pagetext_id', 'left');
		$this->db->where('page_title', $page_title);
		$this->db->limit(1);
		$query = $this->db->get();
		$this->load($query, $page_title);
	}
	
	function load_id($page_id)
	{
		$this->db->from('page');
		$this->db->join('page_text', 'page.page_latest = page_text.pagetext_id', 'left');
		$this->db->where('page_id', $page_id);
		$this->db->limit(1);
		$query = $this->db->get();
		$this->load($query);
	}
	
	function load(&$query, $title = '')
	{
		if( $query->num_rows() == 0 )
		{
			$this->title 	= str_replace("_", " ", $title);
			$this->text		= "This page is still empty.";
			return $query;
		}
		
		$row = $query->row();
		$this->title	= $row->page_title;
		$this->id		= $row->page_id;
		$this->views	= $row->page_views;
		$this->locked	= $row->page_locked;
		$this->rev_id	= $row->pagetext_id;
		$this->text		= $row->pagetext_text;
		
		return $query;
	}
	
	function save()
	{
		//print_r($this->changed); die;
		if(count($this->changed) == 0)
		{
			return;
		}
		
		$p_data = array();
		$pt_data = array();
		foreach($this->changed as $change)
		{
			switch($change)
			{
				case 'title':
				case 'views':
				case 'locked':
					$p_data['page_'.$change] = $this->$change;
					break;
				case 'text':
					$pt_data['pagetext_text'] = $this->text;
					break;
			}
		}
		
		//print_r($pt_data); die;
		
		if($this->id == 0)
		{
			// This is a new page
			if(count($p_data) > 0)
				$this->db->insert('page', $p_data);
			if(count($pt_data) > 0)
				$this->db->insert('page_text', $pt_data);
		}
		else
		{
			if(count($p_data) > 0)
			{
				$this->db->where('page_id', $this->id);
				$this->db->update('page', $p_data);
			}
			if(count($pt_data) > 0)
			{
				$this->db->where('pagetext_id', $this->rev_id);
				$this->db->update('page_text', $pt_data);
			}
		}
	}
}