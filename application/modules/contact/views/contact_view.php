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
				<label for="Email">Email: <?php echo form_error('email', '<span class="error">', '</span>')?></label>
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