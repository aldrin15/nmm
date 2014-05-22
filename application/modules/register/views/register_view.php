<form action="" method="post">
	<ul>
		<li>
			<?php echo form_error('firstname')?>
			<label for="firstname">Firstname</label>
			<input type="text" name="firstname" id=""/>
		</li>
		<li>
			<?php echo form_error('lastname')?>
			<label for="lastname">Lastname</label>
			<input type="text" name="lastname" id=""/>
		</li>
		<li>
			<?php echo form_error('email')?>
			<label for="email">Email:</label>
			<input type="text" name="email" id=""/>
		</li>
		<li>
			<?php echo form_error('password')?>
			<label for="Password">Password</label>
			<input type="password" name="password" id=""/>
		</li>
		<li>
			<?php echo form_error('cpassword')?>
			<label for="Confirm Password">Confirm Password</label>
			<input type="password" name="cpassword" id=""/>
		</li>
		<li>
			<?php echo form_error('terms_condition')?>
			<input type="checkbox" name="terms_condition" id=""/>
			<label for="Terms and Condition">Terms and Condition</label>
		</li>
		<li>
			<input type="submit" name="register_submit" value="Submit"/>
		</li>
	</ul>
</form>