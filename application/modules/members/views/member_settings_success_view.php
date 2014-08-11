<?php $this->load->view('header_content')?>

<style type="text/css">.profile-settings {margin-left:100px;} .profile-settings ul {list-style:none;} .profile-settings ul li {margin-bottom:10px;} .profile-settings ul li label, .profile-edit ul li p {display:block; float:left;} .profile-settings ul li label {width:120px;} .error {color:#ff0000; margin-left:120px;} .profile-settings ul li div .error {margin-left:0;}</style>

<div class="m-center-content">
	<?php echo modules::run('lift/search')?>
	
	<?php $this->load->view('member_sidebar_view')?>

	<div class="profile-settings fl">
		<div>You have successfully change your settings</div>
	</div>
	
	<div class="clr"></div>
</div>
<?php echo modules::run('lift/auto_suggest_city')?>