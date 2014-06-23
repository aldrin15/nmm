<?php $this->load->view('header_content')?>

<div class="m-center-content">
	<form action="" method="post" class="forgot-form">
		<?php echo form_error('email')?>
		<ul>
			<li>
				<label for="">Please enter your email and we will send it to you</label>
				<input type="text" name="email" id="" class="form-control"/><br />
			</li>
			<li>
				<input type="submit" name="forgot_submit" value="Continue" class="btn btn-default"/>
			</li>
		</ul>
	</form>
</div>