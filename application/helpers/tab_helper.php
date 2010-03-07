<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*******

				<div id="tabs-container">
					<div id="title">
						Main Page
					</div>
					<ul id="tabs">
						<li class="tab selected">
							<a href="layout.html">
								<img src="img/view.png" alt="View" />
								Read
							</a>
						</li>
						<li class="tab">
							<a href="layoutEdit.html">
								<img src="img/edit.png" alt="Edit" />
								Edit
							</a>
						</li>
					</ul>
				</div>

******/


if( ! function_exists('buid_tabs') )
{
	/**
	 * Builds the tabs you see on the top right of your page.
	 * 
	 * @access public
	 * @param array $tabs
	 * @return tabs in HTML
	 */
	function build_tabs($tabs, $title = '')
	{
		if( ! is_array($tabs) )
		{
			die('Argument passed to build_tabs is not an array!');
		}
		
		$tabs_html = "<div id=\"tabs-container\">";
		
		if( $title != '' )
		{
			$tabs_html .= "<div id=\"title\">$title</div>";
		}
		
		if( count($tabs) > 0 )
		{
			$tabs_html .= "<ul id=\"tabs\">";
			
			foreach( $tabs as $id => $tab )
			{
				$selected = ($tab['selected']) ? ' selected' : '';
				$img = ($tab['img'] != '') ? "<img src=\"".base_url().$tab['img']."\" alt=\"{$tab['name']}\" />" : '';
				$tabs_html .= "<li class=\"tab$selected\"><a href=\"{$tab['link']}\">$img {$tab['name']}</a></li>";
			}
			
			$tabs_html .= "</ul>";
		}
		$tabs_html .= "</div>";
		
		return $tabs_html;
	}
}