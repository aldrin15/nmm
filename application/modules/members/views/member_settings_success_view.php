<?php $this->load->view('header_content')?>
<br /><br /><br />

<div class="profile-sidebar fl">
	<ul>
		<li><a href="<?php echo base_url('members/index')?>">Dashboard</a></li>
		<li><a href="<?php echo base_url('members/edit')?>">Edit Profile</a></li>
		<li><a href="#">Manage Cars</a></li>
		<li><a href="<?php echo base_url('members/create_lift')?>">Create a lift</a></li>
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
	<div>You have successfully change your settings</div>
</div>