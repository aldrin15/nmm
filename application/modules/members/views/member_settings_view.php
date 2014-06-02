<?php $this->load->view('header_content')?>
<br /><br /><br />

<div class="profile-sidebar fl">
	<ul>
		<li><a href="<?php echo base_url('members/index')?>">Dashboard</a></li>
		<li><a href="<?php echo base_url('members/edit')?>">Edit Profile</a></li>
		<li><a href="#">Manage Cars</a></li>
		<li><a href="<?php echo base_url('lift/create')?>">Create a lift</a></li>
		<li><a href="#">Balance</a></li>
		<li><a href="#">Transactions</a></li>
		<li><a href="#">Messages</a></li>
		<li><a href="#">Overview</a></li>
		<li><a href="<?php echo base_url('members/settings')?>">Settings</a></li>
	</ul>
</div>

<style type="text/css">
.profile-settings {margin-left:100px;}
.profile-settings ul {list-style:none;}
.profile-settings ul li {margin-bottom:10px;}
.profile-settings ul li label, .profile-edit ul li p {display:block; float:left;}
.profile-settings ul li label {width:120px;}

.error {color:#ff0000; margin-left:120px;}
.profile-settings ul li div .error {margin-left:0;}
</style>

<div class="profile-settings fl">
	<form action="" method="post">
		<?php foreach($members_id as $member):?>
		<ul>
			<li>
				<?php echo form_error('email', '<div class="error">','</div>')?>
				<label for="Email">Email: </label>
				<input type="text" name="email" value="<?php echo $member['email']?>" id=""/>
			</li>
			<li>
				<?php echo form_error('password', '<div class="error">','</div>')?>
				<label for="Password">New Password: </label>
				<input type="password" name="password" value="<?php echo set_value('password')?>" id=""/>
			</li>
			<li>
				<?php echo form_error('cpassword', '<div class="error">','</div>')?>
				<label for="Password">Confirm Password: </label>
				<input type="password" name="cpassword" id=""/>
			</li>
			<li>
				<input type="submit" name="settings_submit" value="Change Settings"/>
			</li>
		</ul>
		<?php endforeach?>
	</form>
</div>