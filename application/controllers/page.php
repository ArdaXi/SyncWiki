<?php

class Page extends Controller {
	
	function __construct()
	{	
		parent::__construct();
		
		$this->load->helper('tab');
		$this->load->helper('url'); 
	}
	
	function index()
	{
		// Return the index page
		$this->view('Main Page');
	}
	
	function view($page)
	{
		$this->load->model('Page_model', 'page');
		$this->load->library('parser');
		$page = urldecode($page);
		$page_title = str_replace(array(' '), array('_'), $page);
		$page = str_replace(array('_'), array(' '), $page);
		
		$this->page->load_page($page_title);
		
		$aText = $this->parser->parse($this->page->text);
		
		$tabs = array(
			array(
				'selected' => true,
				'img' => 'img/view.png',
				'link' => site_url($page_title),
				'name' => 'Read'
			),
			array(
				'selected' => false,
				'img' => 'img/edit.png',
				'link' => site_url($page_title.'/edit'),
				'name' => 'Edit'
			)
		);
		
		$vars = array(
			'tabs' => $tabs,
			'title' => $page,
			'page_title' => $page,
			'text' => $aText
		);
		$this->load->vars($vars);
		$this->load->view('sw/page_view');
	}
	
	function edit($page, $section = '')
	{
		$this->load->model('Page_model', 'page');
		$this->load->helper('edit_page');
		$this->load->helper('form');
		$page = urldecode($page);
		$page_title = str_replace(array(' '), array('_'), $page);
		$page = str_replace(array('_'), array(' '), $page);
		
		$this->page->load_page($page_title);
		
		$tabs = array(
			array(
				'selected' => false,
				'img' => 'img/view.png',
				'link' => site_url($page_title),
				'name' => 'Read'
			),
			array(
				'selected' => true,
				'img' => 'img/edit.png',
				'link' => site_url($page_title.'/edit'),
				'name' => 'Edit'
			)
		);
		
		$vars = array(
			'tabs' => $tabs,
			'title' => $page,
			'page_title' => $page,		// This is confusing
			'page_link' => $page_title, // :p
			'headinclude' => $this->load->view('sw/page_edit_headinclude', '', TRUE),
			'bottom_script' => $this->load->view('sw/page_edit_bottom_script', '', TRUE),
			'editText' => $this->page->text,
			'locked_status' => $this->page->locked,
			'pageid' => $this->page->id,
			'lock_link' => site_url('ajax/page/update_lock')
		);
		$this->load->vars($vars);
		$this->load->view('sw/page_edit');
	}
	
	function edit_submit($page)
	{
		if(!$this->input->post('pageid'))
		{
			redirect($this->_make_link($page).'/edit');
			return;
		}
		$this->load->model('Page_model', 'page');
		$this->page->load_id($this->input->post('pageid'));
		$this->page->set('text', $this->input->post('editbox'), false);
		$this->page->save();
		redirect($this->_make_link($page));
	}
	
	function ajax_update_lock()
	{
		if(!$this->input->post('pageid') || $this->input->post('newlevel') === FALSE)
		{
			print json_encode(array('error' => 'Missing pageid/newlevel'));
			return;
		}
		$this->load->model('Page_model', 'page');
		$this->page->load_id($this->input->post('pageid'));
		$this->page->set('locked', $this->input->post('newlevel'));
		$this->page->save();
		print json_encode(array('success' => 'Protection level changed'));
		return;
	}
	
	function _make_link($page)
	{
		return str_replace(array(' '), array('_'), $page);
	}
}