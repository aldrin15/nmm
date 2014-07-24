<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Nimm Mich Mit | Login</title>
	
	<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css')?>"/>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/admin/css/style-responsive.css')?>"/>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/admin/css/style.css')?>"/>
	<style type="text/css">
	body {background:#f1f2f7; color:#797979;}
	
	form {max-width:330px; margin:100px auto 0;}
	form ul {background:#fff; border-radius:5px; padding:20px;}
	form ul li {margin-bottom:10px;}
	form h2 {margin:0; padding:20px 15px; text-align:center; background: #41cac0; border-radius: 5px 5px 0 0; color:#fff; font-size:18px; text-transform:uppercase; font-weight:300; font-family: 'Open Sans', sans-serif;}
	
	.fr {float:right;}
	.clr {clear:both; float:none;}

	.btn-login {background:#f67a6e; color:#fff; font-weight:300; font-family:'Open Sans', sans-serif; box-shadow: 0 4px #e56b60; text-transform:uppercase; margin-bottom:20px;}
	.btn-login:hover {color:#fff;}
	.error {border:1px solid #ff0000 !important;}
	</style>
</head>
<body>
<form action="<?php echo base_url('admin/login/validate')?>" method="post">
	<h2>Sign in now</h2>
	<ul>
		<li>
			<input type="text" name="username" value="" id="" placeholder="Username" class="form-control" />
		</li>
		<li>
			<input type="password" name="password" value="" id="" placeholder="Password" class="form-control" />
		</li>
		<li>
			<a href="<?php echo base_url('admin/login/forgot_password')?>" class="fr">Forgot Password?</a>
				<div class="clr"></div><br />
			<input type="submit" name="submit" value="Sign in" class="btn btn-lg btn-login btn-block"/>
		</li>
	</ul>
</form>
<script type="text/javascript" src="<?php echo base_url('assets/admin/js/jquery.js')?>"></script>
<script type="text/javascript">
$(function() {
	$('input[name="submit"]').click(function() {
		var username 	= $('input[name="username"]'),
			password 	= $('input[name="password"]'),
			error 		= 0;
		
		$('*').removeClass('error');
		
		if(username.val() == '') {
			username.addClass('error');
			error = 1;
		}
		
		if(password.val() == '') {
			password.addClass('error');
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
</body>
</html>