<?php $this->load->view('header_content')?>
<br /><br /><br />

<style type="text/css">
.profile-sidebar ul {list-style:none;}

.profile-details {margin-left:100px; width:800px;}
.profile-details ul {list-style:none;}
.profile-details ul li {margin-bottom:10px;}
.profile-details ul li label, .profile-details ul li p {display:block; float:left;}

.profile-detail-information ul li label {width:100px;}
</style>

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

<div class="profile-details fl">
	<?php echo modules::run('lift/search')?>
	<?php foreach($members_data as $row):?>	
	<div class="profile-detail-information">
		<ul>
			<li>
				<label for="Picture">Picture:</label>
				<p></p>
				
				<div class="clr"></div>
			</li>
			<li>
				<label for="Picture">Profile Text:</label>
				<p></p>
				
				<div class="clr"></div>
			</li>
			<li>
				<?php ?>
				<label for="Name">Name:</label>
				<p><?php echo $row['firstname'].' '.$row['lastname'];?></p>
				
				<div class="clr"></div>
			</li>
			<li>
				<label for="Job">Job:</label>
				<p></p>
				
				<div class="clr"></div>
			</li>
			<li>
				<label for="Address">Address:</label>
				<p><?php echo $row['address_no'].' '.$row['street'].' '.$row['city'].' City, '.$row['country']?></p>
				
				<div class="clr"></div>
			</li>
			<li>
				<label for="Address">Postal Code:</label>
				<p><?php echo $row['postal']?></p>
				
				<div class="clr"></div>
			</li>
			<li>
				<label for="Address">Mobile number:</label>
				<p><?php echo $row['number']?></p>
				
				<div class="clr"></div>
			</li>
		</ul>
	</div>
	<?php endforeach?>
</div>

<div class="clr"></div>


<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/gmap3.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>