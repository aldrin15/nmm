<?php $this->load->view('header_content')?>

<style type="text/css">
.profile-settings {margin-left:10px;}

.profile-settings ul {list-style:none;}
.profile-settings ul li {margin-bottom:10px;}
.profile-settings ul li input[type="text"], .profile-settings ul li input[type="password"] { border:none; outline:none; width:100%;}
.profile-settings ul li input[type="submit"] {background:#47a447; color:#fff; text-transform:uppercase; font-size:14px; font-weight:bold; border:none; padding:5px 20px;}
</style>

<div class="m-center-content">
	<?php echo modules::run('lift/search')?>
	
	<?php $this->load->view('member_sidebar_view')?>

	<div class="profile-settings span5 fl">
		<form action="" method="post">
			<?php foreach($members_id as $member):?>
			<ul>
				<li>
					<label for="">Email: </label>
					<span><?php echo $member['email']?></span>
				</li>
				<li>
					<label for="Password">New Password: <?php echo form_error('password', '<span class="error">','</span>')?></label>
					<span class="form-control"><input type="password" name="password" value="<?php echo set_value('password')?>" id="" autocomplete="off"/></span>
				</li>
				<li>
					<label for="Password">Confirm Password: <?php echo form_error('cpassword', '<span class="error">','</span>')?></label>
					<span class="form-control"><input type="password" name="cpassword" id=""/></span>
				</li>
				<li>
					<input type="submit" name="settings_submit" value="Change Settings"/>
					
					<div class="clr"></div>
				</li>
			</ul>
			<?php endforeach?>
		</form>
	</div>
	
	<div class="profile-status span3 fl">
		<p>Profile Status</p>
		
		<div class="profile-progress"></div>
		
		<ul>
			<li class="p-checked" data-val="14"><p>Name</p></li>
			<li class="p-checked" data-val="14"><p>Profile picture</p></li>
			<li class="p-checked" data-val="14"><p>Email</p></li>
			<li class="p-checked" data-val="14"><p>Work</p></li>
			<li class="p-checked" data-val="14"><p>Address</p></li>
			<li data-val="0"><p>Profile text</p></li>
			<li data-val="0"><p>Mobile Number</p></li>
		</ul>
	</div>
	
	<div class="clr"></div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
<script type="text/javascript">
$(function() {
	var count = 0;
	
	$('.profile-status ul li').each(function() {
		var percent = $(this).attr('data-val');
		
		count += Number(percent);
	});
	
	$( ".profile-progress" ).progressbar({ value: count });
});
</script>