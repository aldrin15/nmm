<?php $this->load->view('header_content')?>

<div class="m-center">
	<center><h3>LOGIN FORM</h3></center>
	
	<form action="<?php echo base_url('login/process')?>" method="post" class="login-form">
		<center><?php if(!is_null($msg)) echo $msg;?></center><br />
		<ul>
			<li>
				<!--<label for="Username">Username</label>-->
				<span class="username"><input type="text" name="username" value="<?php echo set_value('username')?>" id=""/></span>
			</li>
			<li>
				<!--<label for="Password">Password</label>-->
				<span class="password"><input type="password" name="password" value="<?php echo set_value('password')?>" id=""/></span>
				<br />
				<a href="<?php echo base_url('login/forgot_password')?>">Forgot Password</a>
			</li>
			<li>
				<input type="submit" name="login_submit" value="LOGIN" class="fr button-gray"/>
			</li>
		</ul>
	</form>
</div>