<?php $this->load->view('header_content')?>
<br /><br /><br />

<style type="text/css">
.error {color:#ff0000;}
</style>

<div class="contact">
	<h1>Contact Us Page</h1>
	
	<form action="" method="post">
		<ul>
			<li>
				<?php echo form_error('name', '<div class="error">', '</div>')?>
				<label for="Name">Name:</label>
				<input type="text" name="name" id=""/>
			</li>
			<li>
				<?php echo form_error('email', '<div class="error">', '</div>')?>
				<label for="Email">Email:</label>
				<input type="text" name="email" id=""/>
			</li>
			<li>
				<?php echo form_error('message', '<div class="error">', '</div>')?>
				<label for="Message">Message</label>
				<textarea name="message" id="" cols="30" rows="10"></textarea>
			</li>
			<li>
				<input type="submit" name="contact_submit" value="Submit"/>
			</li>
		</ul>
	</form>
</div>