<?php $this->load->view('header_content')?>
<br /><br /><br />

<div class="profile-sidebar fl">
	<ul>
		<li><a href="<?php echo base_url('members/index')?>">Dashboard</a></li>
		<li><a href="<?php echo base_url('members/edit')?>">Edit Profile</a></li>
		<li><a href="#">Manage Cars</a></li>
		<li><a href="#">Balance</a></li>
		<li><a href="#">Transactions</a></li>
		<li><a href="#">Messages</a></li>
		<li><a href="#">Overview</a></li>
	</ul>
</div>

<style type="text/css">
.profile-edit {margin-left:100px;}
</style>

<div class="profile-edit fl">
	<p>You have successfully edited your profile!</p>
</div>