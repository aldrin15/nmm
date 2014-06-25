<?php $this->load->view('header_content')?>

<div class="m-center-content">
	<!--<center><h3>LOGIN FORM</h3></center>-->
	<div id="fb-root"></div>
	<form action="<?php echo base_url('login/process')?>" method="post" class="login-form span5">
		<center><?php if(!is_null($msg)) echo $msg;?></center><br />
		<ul>
			<li><a href="javascript:void(0)" class="login-fb">Login with Facebook</a></li>
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
	
	$('.login-fb').click(fbLogin);
	$('.login-fb').click(function(e) {
		e.preventDefault();
	});
});

var fbLogin = function () {
	FB.login(function (response) {
		// The response object is returned with a status field that lets the
		// app know the current login status of the person.
		// Full docs on the response object can be found in the documentation
		// for FB.getLoginStatus().
		if (response.status === 'connected') {
			// Logged into your app and Facebook.
			//loginAPI();
			
			console.log('Welcome!  Fetching your information.... ');
			
			FB.api('/me', function(response) {
				$.ajax({
					url 	: '<?php echo base_url('login/check_user')?>',
					type	: 'GET',
					data	: {email:response.email},
					success	: function(data) {
						console.log(data);
						if(data == 'Denied') {
							window.location.href = '<?php echo base_url('register')?>?email='+response.email+'&firstname='+response.first_name+'&lastname='+response.last_name+'&gender='+response.gender;
						} else {
							window.location.href = '<?php echo base_url('nmm')?>';
						}
					}
				});
			});
		} else if (response.status === 'not_authorized') {
			// The person is logged into Facebook, but not your app.
			document.getElementById('status').innerHTML = 'Please log ' + 'into this app.';
		} else {
			// The person is not logged into Facebook, so we're not sure if
			// they are logged into this app or not.
			document.getElementById('status').innerHTML = 'Please log ' + 'into Facebook.';
		}
	});
};

window.fbAsyncInit = function() {
	FB.init({
		appId      : '262187797300693',
		cookie     : true,  // enable cookies to allow the server to access 
		// the session
		xfbml      : true,  // parse social plugins on this page
		version    : 'v2.0' // use version 2.0
	});
};

// Load the SDK asynchronously
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "https://connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Here we run a very simple test of the Graph API after login is
// successful.  See statusChangeCallback() for when this call is made.
function loginAPI() {
	console.log('Welcome!  Fetching your information.... ');
	
	FB.api('/me', function(response) {
		console.log('Successful login for: ' + response.name);
		document.getElementById('status').innerHTML =
		'Thanks for logging in, ' + response.name + '!';
	});
}
</script>