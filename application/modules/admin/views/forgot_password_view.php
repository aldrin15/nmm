<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
	
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

	.btn-forgot {background:#f67a6e; color:#fff; font-weight:300; font-family:'Open Sans', sans-serif; box-shadow: 0 4px #e56b60; text-transform:uppercase; margin-bottom:20px;}
	.btn-forgot:hover {color:#fff;}
	.error {border:1px solid #ff0000 !important;}
	</style>
</head>
<body>
<form action="" method="post">
	<h2>Forgot your password?</h2>
	<ul>
		<li><span class="error-email"></span></li>
		<li>Please enter your email and give you new one</li>
		<li><input type="text" name="email" value="" id="" class="form-control" /></li>
		<li><input type="submit" name="submit" value="Forgot Password" class="btn btn-lg btn-block btn-forgot"/></li>
	</ul>
</form>
<script type="text/javascript" src="<?php echo base_url('assets/admin/js/jquery.js')?>"></script>
<script type="text/javascript">
$(function() {
	$('input[name="submit"]').click(function() {
		var email 	= $('input[name="email"]'),
			regx 	= /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/,
			error 	= 0;
		
		$('*').removeClass('error');
		
		if(email.val() == '') {
			email.addClass('error');
			error = 1;
		} else {
			if(!regx.test(email.val())) {
				$('.error-email').html("Please enter valid email address").css('color','#ff0000');
				error = 1;
			}
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