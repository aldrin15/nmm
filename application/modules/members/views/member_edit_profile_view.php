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
.profile-edit {margin-left:100px;}
.profile-edit ul li {margin-bottom:10px;}
.profile-edit ul li label, .profile-edit ul li p {display:block; float:left;}
.profile-edit ul li label {width:100px;}

.error {color:#ff0000; margin-left:100px;}
.profile-edit ul li div .error {margin-left:0;}
</style>

<div class="profile-edit fl">
	<?php if($this->session->flashdata('error')){echo $this->session->flashdata('error');}?>
	<?php if($this->session->flashdata('error2')){echo $this->session->flashdata('error2');}?>
	
	<form action="" method="post" enctype="multipart/form-data">
		<?php foreach($members_information as $info):?>
		<ul style="list-style:none;">
			<li>
				<?php echo form_error('userfile')?>
				<label for="Picture">Picture:</label>
				<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
				<input type="file" name="userfile" />
				
				<div class="clr"></div>
			</li>
			<li>
				<?php echo form_error('about_me', '<div class="error">','</div>')?>
				<label for="About Me">About Me</label>
				<textarea name="about_me" id="" cols="30" rows="10"><?php echo (isset($_POST['about_me'])) ? $_POST['about'] : $info['about_me']?></textarea>
				
				<div class="clr"></div>
			</li>
			<li>
				<label for="Fullname">Fullname: </label>
				<div class="fl">
					<?php echo form_error('firstname', '<div class="error">','</div>')?>
					<label for="Firstname">Firstname:</label>
					<input type="text" name="firstname" id="" value="<?php echo (isset($_POST['firstname'])) ? $_POST['firstname'] : $info['firstname']?>"/>
					
					<div class="clr"></div>
				</div>
				<div class="fl">
					<?php echo form_error('lastname', '<div class="error">','</div>')?>
					<label for="Lastname">Lastname:</label>
					<input type="text" name="lastname" id="" value="<?php echo (isset($_POST['lastname'])) ? $_POST['lastname'] : $info['lastname']?>"/>
					
					<div class="clr"></div>			
				</div>
				
				<div class="clr"></div>
			</li>
			<li>
				<?php echo form_error('job', '<div class="error">','</div>')?>
				<label for="Job">Job:</label>
				<input type="text" name="job" id="" value="<?php echo (isset($_POST['job'])) ? $_POST['job'] : $info['job']?>"/>
				
				<div class="clr"></div>
			</li>
			<li>
				<?php echo form_error('address_no', '<div class="error">','</div>')?>
				<?php echo form_error('street', '<div class="error">','</div>')?>
				<label for="Address:">Address:</label>
				<div class="fl">
					<p>Home No: </p>
					<input type="text" name="address_no" id="" value="<?php echo (isset($_POST['address_no'])) ? $_POST['address_no'] : $info['address_no']?>"/>
					
					<div class="clr"></div>
				</div>
				<div class="fl">
					<p>street: </p>
					<input type="text" name="street" id="" value="<?php echo (isset($_POST['street'])) ? $_POST['street'] : $info['street']?>"/>
					
					<div class="clr"></div>
				</div>
				
				<div class="clr"></div>
			</li>
			<li>
				<?php echo form_error('postal', '<div class="error">','</div>')?>
				<label for="Postal Code">Postal Code:</label>
				<input type="text" name="postal" id="" value="<?php echo (isset($_POST['postal'])) ? $_POST['postal'] : $info['postal']?>"/>
				
				<div class="clr"></div>
			</li>
			<li>
				<div>
					<?php echo form_error('city', '<div class="error">','</div>')?>
					<label for="Address">City:</label>
					
					<select name="country" id="country">
						<?php foreach($countries_list as $country):?>
							<option value="<?php echo $country->name?>" title="<?php echo $country->code?>"><?php echo $country->name?></option>
						<?php endforeach?>
					</select>
					
					<select name="city" id="state">

					</select>
					
					<div class="query-message">Fetching Data....</div>
				</div>
			</li>
			<li>
				<?php echo form_error('mobile', '<div class="error">','</div>')?>
				<label for="Address">Mobile number:</label>
				<input type="text" name="mobile" id="" value="<?php echo (isset($_POST['mobile'])) ? $_POST['mobile'] : $info['number']?>"/>
				
				<div class="clr"></div>
			</li>
			<li>
				<input type="submit" name="submit_edit" value="Edit Details"/>
			</li>
		</ul>
		<?php endforeach?>
	</form>
</div>

<script type="text/javascript">
$(function() {
	$('.query-message').hide();
	
	$('#country').change(function() {
		var value = $('option:selected', this).attr('title');
		
		$('.query-message').show();
	
		$.ajax({
			url	: '<?php echo base_url('members/get_city')?>',
			dataType: 'html',
			data: {country : value},
			success: function(data) {
				$('#state').html(data);
				
				$('.query-message').hide();
			}, error: function() {
				console.log('Not Found');
			}
		});
	});
})
</script>