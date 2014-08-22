<?php $this->load->view('header_content')?>

<style type="text/css">
.subscription-choices li {background:#e9fdb5; float:left; text-align:center; border:1px solid #ccc; border-radius:5px; -webkit-border-radius:5px; -moz-border-radius:5px; -ms-border-radius:5px; cursor:pointer; margin-right:5px; padding:20px;}
.subscription-choices li:hover {background:#d6fd75;}
.subscription-choices li.selected {background:#d6fd75;}
.subscription-choices li:last-child {margin:0;}
.subscription-choices li span {font-size:1.5em;}
.subscription-choices li input {display:none;}
</style>

<div class="register-wrapper m-center-content">
	<h4>Registration</h4>
	<p>Complete and submit your details below to create your account. Choose membership and begin carpooling.</p>
	<hr/>
	<div class="register span5">
		<form action="" method="post">
			<ul>
				<li>
					<label for="firstname"><?php echo $translate['firstname']?> <?php echo form_error('firstname', '<span class="error">', '</span>')?></label>
					<input type="text" name="firstname" id="" value="<?php echo (isset($_GET['firstname']) ? $_GET['firstname'] : set_value('firstname'))?>" class="form-control" autocomplete="off"/>
				</li>
				<li>
					<label for="lastname"><?php echo $translate['lastname']?> <?php echo form_error('lastname', '<span class="error">', '</span>')?></label>
					<input type="text" name="lastname" id="" value="<?php echo (isset($_GET['lastname']) ? $_GET['lastname'] : set_value('lastname'))?>" class="form-control" autocomplete="off"/>
				</li>
				<li>
					<label for="Gender" class="err-gender"><?php echo $translate['gender']?> <?php echo form_error('gender', '<span class="error">', '</span>')?></label>
					
					<div>
						<input type="radio" name="gender" value="Male" class="fl" id="" <?php echo (isset($_GET['gender']) == "male" ? 'checked="checked"' : (isset($_POST['gender'])) ? set_value('gender') : "")?>/>
						<span><?php echo $translate['male']?></span>
						
						<input type="radio" name="gender" value="Female" id="" <?php echo (isset($_GET['gender']) == "female" ? 'checked="checked"' : (isset($_POST['gender'])) ? set_value('gender') : "")?>/>
						<span><?php echo $translate['female']?></span>
						
						<div class="clr"></div>
					</div>
				</li>
				<li>
					<label for="email" class="err-mail"><?php echo $translate['email']?>: <?php echo form_error('email', '<span class="error">', '</span>')?></label>
					<input type="text" name="email" id="" value="<?php echo isset($_GET['email']) ? $_GET['email'] : set_value('email')?>" class="form-control" autocomplete="off"/>
				</li>
				<li>
					<label for="Password" class="err-pass"><?php echo $translate['password']?> <?php echo form_error('password', '<span class="error">', '</span>')?></label>
					<input type="password" name="password" id="" value="<?php echo set_value('password')?>" class="form-control" autocomplete="off"/>
				</li>
				<li>
					<label for="Confirm Password"><?php echo $translate['confirm_password']?> <?php echo form_error('cpassword', '<span class="error">', '</span>')?></label>
					<input type="password" name="cpassword" id="" value="<?php echo set_value('cpassword')?>" class="form-control" autocomplete="off"/>
				</li>
				<li>
					<br /><h4 class="err-type">Choose Membership Subscription Type <?php echo form_error('account_type', '<span class="error">', '</span>')?></h4>
					<hr/>
					<ul class="subscription-choices">
						<li <?php echo (array_key_exists('type', $_GET) && $_GET['type'] == '1') ? 'class="selected"' : '';?>>
							<input type="radio" name="account_type" value="1" id="" <?php echo (isset($_POST['account_type']) == 1 || array_key_exists('type', $_GET) && $_GET['type'] == '1') ? 'checked="checked"' : ''?>/>
							<span>Free Trial</span>
							
							<p>14 Days</p>
						</li>
						<li <?php echo (array_key_exists('type', $_GET) && $_GET['type'] == '2') ? 'class="selected"' : '';?>>
							<input type="radio" name="account_type" value="2" id="" <?php echo (isset($_POST['account_type']) == 2 || array_key_exists('type', $_GET) && $_GET['type'] == '2') ? 'checked="checked"' : ''?>/>
							<span>Monthly</span>
							
							<p>&euro; 3.99</p>
						</li>
						<li <?php echo (array_key_exists('type', $_GET) && $_GET['type'] == '3') ? 'class="selected"' : '';?>>
							<input type="radio" name="account_type" value="3" id="" <?php echo (isset($_POST['account_type']) == 3 || array_key_exists('type', $_GET) && $_GET['type'] == '3') ? 'checked="checked"' : ''?>/>
							<span>6 Months</span>
							
							<p>&euro; 12.99</p>
						</li>
						<li <?php echo (array_key_exists('type', $_GET) && $_GET['type'] == '4') ? 'class="selected"' : '';?>>
							<input type="radio" name="account_type" value="4" id="" <?php echo (isset($_POST['account_type']) == 4 || array_key_exists('type', $_GET) && $_GET['type'] == '1') ? 'checked="checked"' : ''?>/>
							<span>1 Year</span>
						
							<p>&euro; 18.99</p>
						</li>
					</ul>
					
					<div class="clr"></div>
				</li>
				<li>
					<span class="err-terms"></span>
					<?php echo form_error('terms_condition', '<span class="error">', '</span>')?>
						<div class="clr"></div>
					<input type="checkbox" name="terms_condition" id=""/>
					<label for="Terms and Condition"><a href="javascript:void(0)" data-toggle="modal" data-target="#terms-condition">I have read and agree to the Terms & Conditions.</a></label>
					
					<div class="clr"></div>
				</li>
				<li>
					<input type="submit" name="register_submit" value="<?php echo $translate['sign_up']?>" class="btn btn-default"/>
				</li>
			</ul>
		</form>	
	</div>
	
	<div class="clr"></div>
</div>

<div class="modal fade" id="terms-condition" tabindex="-1" role="dialog" aria-hidden="true" style="display:none;">
	<div class="modal-dialog" style="width:450px">
		<form action="" method="post">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4>Terms and Condition</h4>
				</div>
				<div class="modal-body">
					<p style="overflow-y:scroll; height:350px;">
					Lorem ipsum dolor sit amet, consectetuer adipiscing elit. 
					Aenean commodo ligula eget dolor. Aenean massa. 
					Cum sociis natoque penatibus et magnis dis parturient montes, 
					nascetur ridiculus mus. Donec quam felis, ultricies nec, 
					pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. 
					Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. 
					In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.<br /><br />
					
					Nullam dictum felis eu pede mollis pretium. Integer tincidunt. 
					Cras dapibus. Vivamus elementum semper nisi. 
					Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, 
					consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus 
					in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut 
					metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam 
					ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi.<br /><br />
					
					Nam eget dui. Etiam rhoncus. Maecenas tempus, 
					tellus eget condimentum rhoncus, sem quam semper 
					libero, sit amet adipiscing sem neque sed ipsum. 
					Nam quam nunc, blandit vel, luctus pulvinar, hendrerit 
					id, lorem. Maecenas nec odio et ante tincidunt 
					tempus. Donec vitae sapien ut libero venenatis faucibus. 
					Nullam quis ante. Etiam sit amet orci eget eros faucibus 
					tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. 
					Donec sodales sagittis magna. Sed consequat, leo eget 
					bibendum sodales, augue velit cursus nunc.
					</p>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-modal.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-modalmanager.js')?>"></script>
<script type="text/javascript">
function customRadio(radioName){
	var radioButton = $('input[name="'+ radioName +'"]');
	$(radioButton).each(function(){
		$(this).wrap( "<span class='custom-radio'></span>" );
		if($(this).is(':checked')){
			$(this).parent().addClass("selected");
		}
	});
	$(radioButton).click(function(){
		if($(this).is(':checked')){ $(this).parent().addClass("selected"); }
		$(radioButton).not(this).each(function(){ $(this).parent().removeClass("selected"); });
	});
}

$(function() {
	//customRadio("account_type[]");
	customRadio("gender");
	
	$('.subscription-choices li').click(function() {
		$('.subscription-choices li').removeClass('selected');
		$('.subscription-choices li span.custom-radio').removeClass('selected');
		$('.subscription-choices li input[name="account_type[]"]').attr('checked', false);
		
		if($('input[name="account_type"]', this).is(':checked')) {
			//$('.subscription-choices li span', this).addClass('selected');
		} else {
			$(this).addClass('selected');
			$('input[name="account_type"]', this).attr('checked', true);
		}
	});

	$('input[name="register_submit"]').click(function() {
		var firstname	= $('input[name="firstname"]'),
			lastname	= $('input[name="lastname"]'),
			gender		= $('input[name="gender"]'),
			email		= $('input[name="email"]'),
			password	= $('input[name="password"]'),
			cpassword	= $('input[name="cpassword"]'),
			acc_type	= $('input[name="account_type[]"]'),
			terms		= $('input[name="terms_condition"]');	
	
		$('*').removeClass('error error-bd');
		var error = 0;
		var regx = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		
		if(firstname.val() == "") {
			firstname.addClass('error-bd');
			error = 1;
		}
		
		if(lastname.val() == "") {
			lastname.addClass('error-bd');
			error = 1;
		}
		
		if(gender.is(':checked')){
			$('.err-gender').html('Gender');
		} else {
			$('.err-gender').html('Gender <span class="error">You need to choose your gender</span>');
			error = 1;
		}
		
		if(email.val() == '') {
			email.addClass('error-bd');
			error = 1;
		} else {
			if(!regx.test(email.val())) {
				$('.err-mail').html('Email: <span class="error">Please enter valid e-mail address</span>'); 
				error = 1;
			} else {
				$('.err-mail').html("Email:");
			}
		}
		
		if(password.val() == '') { 
			password.addClass('error-bd');
			error = 1; 
		}

		if(password.val().length < 6) {
			$('.err-pass').html('Password <span class="error">Please enter at least 6 characters</span>');
			password.addClass('error-bd');
			error = 1;
		}  else {
			$('.err-pass').html('Password');
		}
		
		if(cpassword.val() == '') {
			cpassword.addClass('error-bd');
			error = 1;
		} else {
			if(cpassword.val() != password.val()) {
				cpassword.addClass('error-bd');
				error = 1;
			}
		}
		
		if(acc_type.attr('checked', true)) {
			$('.err-type').html('Choose Membership Subscription Type');
		} else {
			$('.err-type').html('Choose Membership Subscription Type <small class="error">Membership type is required</small>');
			error = 1;
		}
		
		if(terms.is(':checked')) {
			$('.err-terms').html(' ');
		} else {
			$('.err-terms').html('<span class="error">You need to agree with Terms and Condition</span>');
			error = 1;
		}
		
		if(error == 0) {
			console.log('success');
			console.log(acc_type.val());
			$('.register-wrapper form').submit();
			$('input[name="register_submit"]').prop('disabled', true);
		} else {
			$('input[name="register_submit"]').prop('disabled', false);
			return false;
		}
	});
});
</script>