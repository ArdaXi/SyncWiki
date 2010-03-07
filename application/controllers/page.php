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
		$page = urldecode($page);
		
		$tabs = array(
			array(
				'selected' => true,
				'img' => 'img/view.png',
				'link' => site_url($page),
				'name' => 'Read'
			),
			array(
				'selected' => false,
				'img' => 'img/edit.png',
				'link' => site_url($page.'/edit'),
				'name' => 'Edit'
			)
		);
		
		$vars = array(
			'tabs' => $tabs,
			'title' => $page,
			'page_title' => $page
		);
		$this->load->vars($vars);
		$this->load->view('sw/page_view');
	}
	
	function edit($page, $section = '')
	{
		$page = urldecode($page);
		
		$tabs = array(
			array(
				'selected' => false,
				'img' => 'img/view.png',
				'link' => site_url($page),
				'name' => 'Read'
			),
			array(
				'selected' => true,
				'img' => 'img/edit.png',
				'link' => site_url($page.'/edit'),
				'name' => 'Edit'
			)
		);
		
		$vars = array(
			'tabs' => $tabs,
			'title' => $page,
			'page_title' => $page,
			'headinclude' => $this->load->view('sw/page_edit_headinclude', '', TRUE),
			'bottom_script' => $this->load->view('sw/page_edit_bottom_script', '', TRUE)
		);
		$this->load->vars($vars);
		$this->load->view('sw/page_edit');
	}
}