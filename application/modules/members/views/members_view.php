<?php $this->load->view('header_content')?>
<br /><br /><br />

<style type="text/css">
.profile-sidebar ul {list-style:none;}

.profile-details {margin-left:100px; width:800px;}
</style>

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

<div class="profile-details fl">
	<?php echo modules::run('lift/search')?>
	
	<?php foreach($members_data as $row):?>	
	<div class="profile-detail-information">
		
	</div>
	<?php endforeach?>
</div>

<div class="clr"></div>


<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/gmap3.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>