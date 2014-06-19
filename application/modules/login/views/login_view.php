<?php $this->load->view('header_content')?>

<div class="m-center-content">
	<!--<center><h3>LOGIN FORM</h3></center>-->
	
	<form action="<?php echo base_url('login/process')?>" method="post" class="login-form span5">
		<center><?php if(!is_null($msg)) echo $msg;?></center><br />
		<ul>
			<li><button class="login-fb">Login with Facebook</button></li>
			<li class="signin-with"><span>Or Sign with your email address</span></li>
			<li><span class="username"><input type="text" name="username" value="<?php echo (isset($_POST['username'])) ? $_POST['username'] : 'Email Address'?>" id=""/><i></i></span></li>
			<li><span class="password"><input type="text" name="password" value="<?php echo (isset($_POST['password'])) ? $_POST['password'] : 'Password'?>" id=""/><i></i></span></li>
			<li><input type="submit" name="login_submit" value="LOGIN" /></li>
			<li><a href="<?php echo base_url('login/forgot_password')?>">Forgot Password</a></li>
		</ul>
	</form>
</div>

<script type="text/javascript">
$(function() {
	$('form ul li input[name="username"]').focus(function() {
		if($(this).val() == 'Email Address') {
			$(this).css({color:'#000'}).val('');
		}
	}).blur(function() {
		if($(this).val() == '') {
			$(this).css({color:'#9b9b9b'}).val('Email Address');
		}
	});
	
	$('form ul li input[name="password"]').focus(function() {
		if($(this).val() == 'Password') {
			$(this).attr('type', 'password').css({color:'#000'}).val('');
		}
	}).blur(function() {
		if($(this).val() == '') {
			$(this).attr('type', 'text').css({color:'#9b9b9b'}).val('Password');
		}
	});
});
</script>