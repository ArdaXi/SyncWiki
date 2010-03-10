<?php $this->load->view('sw/global_header'); ?>
				<?php echo build_tabs($tabs, $page_title); ?>
				<div class="content">
					<?php echo $text; ?>
				</div>
<?php $this->load->view('sw/global_footer'); ?>