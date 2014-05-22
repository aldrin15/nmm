<form action="<?php echo base_url('login/process')?>" method="post">
	<?php if(!is_null($msg)) echo $msg;?>
	<ul>
		<li>
			<label for="Username">Username</label>
			<input type="text" name="username" value="<?php echo set_value('username')?>" id=""/>
		</li>
		<li>
			<label for="Password">Password</label>
			<input type="password" name="password" value="<?php echo set_value('password')?>" id=""/><br />
			<a href="<?php echo base_url('login/forgot_password')?>">Forgot Password</a>
		</li>
		<li>
			<input type="submit" name="login_submit" value="Submit"/>
		</li>
	</ul>
</form>