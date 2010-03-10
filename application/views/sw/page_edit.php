<?php $this->load->view('sw/global_header'); ?>
				<?php echo build_tabs($tabs, $page_title); ?>
				<div class="content" id="editor">
					<?php echo edit_page_locked($locked_status); ?>
					<?php echo form_open($page_link.'/edit/submit'); ?>
						<?php 
							$data = array(
								'name' => 'editbox',
								'id' => 'editbox',
								'cols' => '30',
								'rows' => '20',
								'tabindex' => '1'
							);
							echo form_textarea($data, $editText);
						 ?>
						<br />
						
						<div id="afterArea">
							<div id="reason">
								<label for="reason" style="margin-right: 6px;">Reason:
								<?php 
									$data = array(
										'name' => 'reason',
										'maxlength' => '200',
										'size' => '55',
										'tabindex' => '2'
									);
									echo form_input($data);
								 ?>
								</label>
							</div>
							<div id="buttons">
								<?php 
									$data = array('name' => 'save', 'tabindex' => '3');
									echo form_submit($data, 'Save'); 
								?>
								<?php
									$data = array('name' => 'preview', 'tabindex' => '4');
									echo form_submit($data, 'Preview');
								?>
							</div>
						</div>
					<?php echo form_hidden('pageid', $pageid); ?>
					<?php echo form_close(); ?>
					<hr />
					<div id="editorTools">
						<ul>
							<li><a href="layoutHistory.html"><img src="<?php echo base_url(); ?>img/history.png" alt="History" />History</a></li>
							<li><a href="#report"><img src="<?php echo base_url(); ?>img/report.png" alt="Report" />Report</a></li>
							<li><a href="#protect"><img src="<?php echo base_url(); ?>img/protection.png" alt="Protection" />Protection</a></li>
							<li><a href="#delete"><img src="<?php echo base_url(); ?>img/delete.png" alt="Delete" />Delete</a></li>
						</ul>
					</div>
					<div class="panels">
						<div id="protect" class="protection panel">
							<h2>Protection Options</h2>
							<?php 
								$extra = array('id' => 'protect_form');
								echo form_open($page_link.'/edit/lock', $extra); ?>
								<p>Protection level</p>
								<div class="options" id="protect_options">
									<label for="level"><?php echo form_radio('level', '0', ($locked_status == 0)); ?> None</label>
									<label for="level"><?php echo form_radio('level', '1', ($locked_status == 1)); ?> Logged in users only</label>
									<label for="level"><?php echo form_radio('level', '2', ($locked_status == 2)); ?> Admins only</label>
								</div>
								<?php echo form_submit('update_lock', 'Save'); ?>
							</form>
						</div>
						<div id="report" class="report panel">
							<h2>Report this page</h2>
							<p>If you feel that this page is in vilation of the rules, you should report it.</p>
							<br />
							<form action="#" id="report_form">
								<p>I feel that this page is:</p>
								<div class="options">
									<label for="reason"><input id="reason_radio" type="radio" name="reason" value="1" /> Spam/Advertising</label>
									<label for="reason"><input id="reason_radio" type="radio" name="reason" value="2" /> Hateful</label>
									<label for="reason"><input id="reason_radio" type="radio" name="reason" value="3" /> Vandalism</label>
									<label for="reason"><input id="reason_radio" type="radio" name="reason" value="9999" /> Other:</label>
									<input type="text" id="other_box" name="other" size="30" style="margin-left: 15px;" />
								</div>
								<input type="submit" value="Report" />
							</form>
						</div>
						<div id="delete" class="delete panel">
							<h2>Delete this page</h2>
							<p>If this page is breaking rules, remove it!</p>
							<br />
							<form action="#" id="delete_form">
								<div class="options">
									<label for="delete_reason"><strong>Reason:</strong> <br />
										<input type="text" name="reason" id="delete_reason" size="30" /></label>
								</div><br /><br />
								<input type="submit" value="Delete" />
							</form>
						</div>
					</div>
				</div>
				<script type="text/javascript"> var locked_status = <?php echo $locked_status; ?>; var lock_link = '<?php echo $lock_link; ?>'; var pageid = <?php echo $pageid; ?>; </script>
<?php $this->load->view('sw/global_footer'); ?>