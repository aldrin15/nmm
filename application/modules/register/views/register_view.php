<?php $this->load->view('header_content')?>
<br />
<br />
<br />

<style type="text/css">
.error {color:#ff0000;}

.register ul {list-style:none;}
</style>

<div class="register">
	<form action="" method="post">
		<ul>
			<li>
				<?php echo form_error('firstname', '<div class="error">', '</div>')?>
				<label for="firstname">Firstname</label>
				<input type="text" name="firstname" id="" value="<?php echo set_value('firstname')?>"/>
			</li>
			<li>
				<?php echo form_error('lastname', '<div class="error">', '</div>')?>
				<label for="lastname">Lastname</label>
				<input type="text" name="lastname" id="" value="<?php echo set_value('lastname')?>"/>
			</li>
			<li>
				<?php echo form_error('email', '<div class="error">', '</div>')?>
				<label for="email">Email:</label>
				<input type="text" name="email" id="" <?php echo set_value('email')?>/>
			</li>
			<li>
				<?php echo form_error('password', '<div class="error">', '</div>')?>
				<label for="Password">Password</label>
				<input type="password" name="password" id="" value="<?php echo set_value('password')?>"/>
			</li>
			<li>
				<?php echo form_error('cpassword', '<div class="error">', '</div>')?>
				<label for="Confirm Password">Confirm Password</label>
				<input type="password" name="cpassword" id="" value="<?php echo set_value('cpassword')?>"/>
			</li>
			<li>
				<?php echo form_error('terms_condition', '<div class="error">', '</div>')?>
				<input type="checkbox" name="terms_condition" id=""/>
				<label for="Terms and Condition">Terms and Condition</label>
			</li>
			<li>
				<input type="submit" name="register_submit" value="Submit"/>
			</li>
		</ul>
	</form>
</div>