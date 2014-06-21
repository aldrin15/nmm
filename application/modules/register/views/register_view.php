<?php $this->load->view('header_content')?>

<div class="m-center-content">
	<h4>Registration</h4>
	<p>Complete and submit your details below to create your account. Choose membership and begin carpooling.</p>
	<hr/>
	<div class="register span5">
		<form action="" method="post">
			<ul>
				<li>
					<label for="firstname">Firstname <?php echo form_error('firstname', '<span class="error">', '</span>')?></label>
					<input type="text" name="firstname" id="" value="<?php echo set_value('firstname')?>" class="form-control"/>
				</li>
				<li>
					<label for="lastname">Lastname <?php echo form_error('lastname', '<span class="error">', '</span>')?></label>
					<input type="text" name="lastname" id="" value="<?php echo set_value('lastname')?>" class="form-control"/>
				</li>
				<li>
					<label for="Gender">Gender <?php echo form_error('gender', '<span class="error">', '</span>')?></label>
					
					<div>
						<input type="radio" name="gender" value="Male" id=""/>
						<label for="Male">Male</label>
						
						<input type="radio" name="gender" value="Female" id=""/>
						<label for="Female">Female</label>
						
						<div class="clr"></div>
					</div>
				</li>
				<li>
					<label for="email">Email: <?php echo form_error('email', '<span class="error">', '</span>')?></label>
					<input type="text" name="email" id="" <?php echo set_value('email')?> class="form-control"/>
				</li>
				<li>
					<label for="Password">Password <?php echo form_error('password', '<span class="error">', '</span>')?></label>
					<input type="password" name="password" id="" value="<?php echo set_value('password')?>" class="form-control"/>
				</li>
				<li>
					<label for="Confirm Password">Confirm Password <?php echo form_error('cpassword', '<span class="error">', '</span>')?></label>
					<input type="password" name="cpassword" id="" value="<?php echo set_value('cpassword')?>" class="form-control"/>
				</li>
				<li>
					<?php echo form_error('terms_condition', '<span class="error">', '</span>')?><br />
					<input type="checkbox" name="terms_condition" id=""/>
					<label for="Terms and Condition">Terms and Condition</label>
					
					<div class="clr"></div>
				</li>
				<li>
					<input type="submit" name="register_submit" value="SIGN UP" class="btn btn-default"/>
				</li>
			</ul>
		</form>	
	</div>
</div>