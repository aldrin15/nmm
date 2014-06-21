<?php $this->load->view('header_content')?>

<div class="m-center-content">
	<?php echo modules::run('lift/search')?>
	
	<?php $this->load->view('member_sidebar_view')?>

	<div class="profile-edit span5 fl">
		<?php if($this->session->flashdata('error')){echo $this->session->flashdata('error');}?>
		<?php if($this->session->flashdata('error2')){echo $this->session->flashdata('error2');}?>
		
		<form action="" method="post" enctype="multipart/form-data">
			<?php foreach($members_information as $info):?>
			<ul>
				<li>
					<div class="profile-upload fl">
						<?php if($info['image'] == NULL):?>
							<img src="<?php echo base_url('assets/image/page_template/blank_profile_large.jpg')?>" alt=""/>
						<?php else:?>
							<img src="<?php echo base_url('assets/media_uploads/').'/'.$info['image']?>" width="150" height="150" alt="" />
						<?php endif?><br />
						<button class="btn-success">Change Picture</button>
						<input type="file" name="file" id="" />
					</div>
					<textarea name="about_me" id="" cols="30" rows="10" class="fl"><?php echo $info['about_me']?></textarea>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Firstname">Firstname <?php echo form_error('firstname', '<span class="error">', '</span>')?></label>
					<span class="form-control"><input type="text" name="firstname" value="<?php echo (isset($_POST['firstname'])) ? $_POST['firstname'] : $info['firstname']?>" id=""/></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="lastname">Lastname <?php echo form_error('lastname', '<span class="error">', '</span>')?></label>
					<span class="form-control"><input type="text" name="lastname" value="<?php echo (isset($_POST['lastname'])) ? $_POST['lastname'] : $info['lastname']?>" id=""/></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="My Birthday">My Birthday</label>
						<div class="clr"></div>
					<select name="" id="" class="birth-date select-width-auto">
						<option value="1" <?php echo (date('F', strtotime($info['birthdate'])) == 'January') ? 'selected' : ''?>>January</option>
						<option value="2" <?php echo (date('F', strtotime($info['birthdate'])) == 'February') ? 'selected' : ''?>>February</option>
						<option value="3" <?php echo (date('F', strtotime($info['birthdate'])) == 'March') ? 'selected' : ''?>>March</option>
						<option value="4" <?php echo (date('F', strtotime($info['birthdate'])) == 'April') ? 'selected' : ''?>>April</option>
						<option value="5" <?php echo (date('F', strtotime($info['birthdate'])) == 'May') ? 'selected' : ''?>>May</option>
						<option value="6" <?php echo (date('F', strtotime($info['birthdate'])) == 'June') ? 'selected' : ''?>>June</option>
						<option value="7" <?php echo (date('F', strtotime($info['birthdate'])) == 'July') ? 'selected' : ''?>>July</option>
						<option value="8" <?php echo (date('F', strtotime($info['birthdate'])) == 'August') ? 'selected' : ''?>>August</option>
						<option value="9" <?php echo (date('F', strtotime($info['birthdate'])) == 'September') ? 'selected' : ''?>>September</option>
						<option value="10" <?php echo (date('F', strtotime($info['birthdate'])) == 'October') ? 'selected' : ''?>>October</option>
						<option value="11" <?php echo (date('F', strtotime($info['birthdate'])) == 'November') ? 'selected' : ''?>>November</option>
						<option value="12" <?php echo (date('F', strtotime($info['birthdate'])) == 'December') ? 'selected' : ''?>>December</option>
					</select>
					
					<select name="" id="" class="birth-date select-width-auto">
						<?php for($i = 1; $i < 32; $i++):?>
						<option value="<?php echo $i?>" <?php echo (date('d', strtotime($info['birthdate'])) == $i) ? 'selected' : ''?>><?php echo $i?></option>
						<?php endfor?>
					</select>
					
					<select name="" id="" class="birth-date select-width-auto">
						<?php
							$current_year 	= date("Y");
							$past_year 		= date("Y") - 49;
							$years 			= range ($current_year, $past_year);
							$year_selected 	= date('Y', strtotime($info['birthdate']));
							
							
							foreach($years as $year):
							?>
								<option value="<?php echo $year?>" <?php echo ($year_selected == $year) ? 'selected' : ''?>><?php echo $year?></option>
							<?php endforeach?>
					</select>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Street">Street <?php echo form_error('street', '<span class="error">', '</span>')?></label>
					
					<span class="form-control"><input type="text" name="street" value="<?php echo isset($_POST['street']) ? $_POST['street'] : $info['street']?>" id=""/></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="City and Country">City and Country <?php echo form_error('city_country', '<span class="error">', '</span>')?></label>
						<div class="clr"></div>
						
					<div class="profile-place">
						<p>- Choose your location -</p>
						
						<div class="place-search">
							<input type="text" name="location_list" id="place-search" />
							<input type="hidden" name="city_country" value="<?php echo $info['city'].', '.$info['country']?>" id="" />
							
							<a href="#" class="p-s-done">Done</a>
							
							<div class="clr"></div>
						</div>
					</div>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Postal">Postal Code: <?php echo form_error('postal', '<span class="error">', '</span>')?></label>
					<span class="form-control"><input type="text" name="postal" value="<?php echo (isset($_POST['postal'])) ? $_POST['postal'] : $info['postal']?>" id=""/></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Work">Work:</label>
					<span class="form-control"><input type="text" name="work" value="<?php echo (isset($_POST['work'])) ? $_POST['work'] : $info['job']?>" id=""/></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Mobile">Mobile:</label>
					<span class="form-control"><input type="text" name="mobile" value="<?php echo (isset($_POST['mobile'])) ? $_POST['mobile'] : $info['number']?>" id=""/></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Mobile">Phone:</label>
					<span class="form-control"><input type="text" name="phone" value="<?php echo (isset($_POST['phone'])) ? $_POST['phone'] : $info['phone']?>" id=""/></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<input type="submit" name="update_submit" value="Update"/>
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
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-select.js')?>"></script>
<script type="text/javascript">
$(function() {
	$('.birth-date').selectpicker();

	$('.profile-upload button').bind('click', function(e) {
		$('input[type="file"]').trigger('click');
		
		e.preventDefault();
	});
	
	$('.profile-place p').click(function() { $('.place-search').slideToggle(); });
	
	$('.place-search input').keyup(function() {
		var text = $(this).val();
		
		$.ajax({
			url		: '<?php echo base_url('members/get_location')?>',
			type	: 'GET',
			data	: {city:text},
			success	: function(data) {
				var cities_countries = [];
				
				$.each($.parseJSON(data), function(index, value) {
					cities_countries.push(value);
				});
				
				var location = [],
					location = cities_countries;
				
				// console.log(location);
				
				$("#place-search").autocomplete({
					source: location,
					select: function(event, ui) { 
						$('.profile-place p').html(ui.item.value)
						$('input[name="city_country"]').val(ui.item.value);
					}
				});
			}
		});
	});
	
	$('.p-s-done').click(function(e) { $('.place-search').slideToggle(); e.preventDefault(); });
	
	$(".profile-nav ul li a").click(function(e){
		if(false == $(this).next().is(':visible')) { $('.profile-nav ul li ul').slideUp(300); }
		
		$(this).next().slideToggle(300);
		
		// e.preventDefault();
	});	
	
	var count = 0;
	
	$('.profile-status ul li').each(function() {
		var percent = $(this).attr('data-val');
		
		count += Number(percent);
	});
	
	$( ".profile-progress" ).progressbar({ value: count });
})
</script>