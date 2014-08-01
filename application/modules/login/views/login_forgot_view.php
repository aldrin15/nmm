<?php $this->load->view('header_content')?>

<div class="m-center-content">
	<form action="" method="post" class="forgot-form">
		<?php echo form_error('email', '<div style="background:#ff553c; color:#fff; text-align:center; border:1px solid #ff0000; padding:10px 0; margin-bottom:10px;">','</div>')?>
		<ul>
			<li>
				<label for=""><span>Please enter your email and we will send it to you</span></label>
				<input type="text" name="email" id="" /><br />
			</li>
			<li>
				<input type="submit" name="forgot_submit" value="Continue" />
			</li>
		</ul>
	</form>
</div>