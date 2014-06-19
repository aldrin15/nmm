<?php $this->load->view('header_content')?>

<style type="text/css">
.success-message {background: #8aff73; border:1px solid #368714; padding:10px; width:100%;}
.success-message p {background: url('<?php echo base_url('assets/images/page_template')?>/icon_check_success.png') no-repeat; color:#378b15; font-size:1.3em; padding: 15px 0 0 70px; height:50px;}
</style>

<div class="m-center-content">
	<?php echo modules::run('lift/search')?>
	
	<?php $this->load->view('member_sidebar_view')?>

	<div class="profile-edit span5 fl">
		<div class="success-message"><p>You have successfully edited your profile!</p></div>
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