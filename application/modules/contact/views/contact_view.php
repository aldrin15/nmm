<?php $this->load->view('header_content')?>

<div class="contact m-center-content">
	<h1>Contact Us Page</h1>
	
	<form action="" method="post" class="span5">
		<ul>
			<li>
				<label for="Name">Name: <?php echo form_error('name', '<span class="error">', '</span>')?></label>
				<input type="text" name="name" id="" class="form-control"/>
				
				<div class="clr"></div>
			</li>
			<li>
				<label for="Email" class="err-email">Email: <?php echo form_error('email', '<span class="error">', '</span>')?></label>
				<input type="text" name="email" id="" class="form-control"/>
				
				<div class="clr"></div>
			</li>
			<li>
				<label for="Message">Message <?php echo form_error('message', '<span class="error">', '</span>')?></label>
				<textarea name="message" id="" cols="30" rows="10" class="form-control"></textarea>
				
				<div class="clr"></div>
			</li>
			<li>
				<input type="submit" name="contact_submit" value="Submit" class="btn btn-default"/>
			</li>
		</ul>
	</form>
	
	<div class="clr"></div>
</div>

<script type="text/javascript">
$(function() {
	$('input[name="contact_submit"]').click(function() {
		var name	= $('input[name="name"]'),
			email	= $('input[name="email"]'),
			message	= $('textarea[name="message"]'),
			error 	= 0;

		$('.err-email').html('Email: ');
		$('*').removeClass('error-bd');
		var regx = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		
		if(name.val() == '') {
			name.addClass('error-bd');
			error = 1;
		}
		
		if(email.val() == '') {
			email.addClass('error-bd');
			error = 1;
		} else {
			if(!regx.test(email.val())) {
				email.addClass('error-bd');
				$('.err-email').html('Email: <span class="error">Please enter valid email address</span>');
				error = 1;
			}
		}
		
		if(message.val() == '') {
			message.addClass('error-bd');
			error = 1;
		}
		
		if(error == 0) {
			$(this).submit();
		} else {
			return false;
		}
	});
});
</script>