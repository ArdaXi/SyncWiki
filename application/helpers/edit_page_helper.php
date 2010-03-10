<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if( ! function_exists('edit_page_locked') )
{
	function edit_page_locked($lock_status)
	{
		$CI =& get_instance();
		if($lock_status == 0)
			return '';
		$who = ($lock_status == 1) ? 'unregisted users' : 'non-admins';
		$CI->load->vars('locked_who', $who);
		return $CI->load->view('sw/page_edit_locked', '', TRUE);
	}
}