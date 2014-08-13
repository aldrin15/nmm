<?php $this->load->view('header_content')?>

<div class="profile-wrapper m-center-content">
	<?php echo modules::run('lift/search')?>
	
	<?php $this->load->view('member_sidebar_view')?>
	
	<?php if($car_data[0]['car'] == ''):?>
	<div class="profile-car">
		<p class="profile-no-car">You didn't add your car details yet. Please fill the fields below.</p>
		
		<hr/>
		
		<form action="" method="post">
			<ul>
				<li>
					<label for="Car Model">Car Model <?php echo form_error('car_model', '<span class="error">', '</span>')?></label>
					<input type="text" name="model" id="" class="form-control"/>
				</li>
				<li>
					<label for="License Plate">License Plate <?php echo form_error('license_plate', '<span class="error">', '</span>')?></label>
					<input type="text" name="plate" id="" class="form-control"/>
				</li>
				<li>
					<label for="Year">Year</label>
					<select name="year" id="" class="form-control">
						<?php 
							$years = range(date("Y"), date("Y", strtotime("now - 50 years")));
							foreach($years as $year):
						?>
						<option value="<?php echo $year?>"><?php echo $year?></option>
						<?php endforeach?>
					</select>
				</li>
				<li>
					<label for="Door">Door</label>
					<select name="door" id="" class="form-control">
						<?php for($x = 2; $x < 6; $x++):?>
						<option value="<?php echo $x?>"><?php echo $x?></option>
						<?php endfor?>
					</select>
				</li>
				<li>
					<label for="Seat">Seat</label>
					<select name="seat" id="" class="form-control">
						<?php for($x = 1; $x < 12; $x++):?>
						<option value="<?php echo $x?>"><?php echo $x?></option>
						<?php endfor?>
					</select>
				</li>
				<li>
					<label for="Transmission">Transmission</label>
					<select name="transmission" id="" class="choice form-control">
						<option <?php echo (isset($_POST['transmission']) == 'Manual') ? 'selected' : ''?>>Manual</option>
						<option <?php echo (isset($_POST['transmission']) == 'Automatic') ? 'selected' : ''?>>Automatic</option>
						<option <?php echo (isset($_POST['transmission']) == 'CVT (Continuous Variable Transmission)') ? 'selected' : ''?>>CVT (Continuous Variable Transmission)</option>
						<option <?php echo (isset($_POST['transmission']) == 'Semi Automatic') ? 'selected' : ''?>>Semi Automatic</option>
						<option <?php echo (isset($_POST['transmission']) == 'TipTronic&reg; gearbox') ? 'selected' : ''?>>TipTronic&reg; gearbox</option>
						<option <?php echo (isset($_POST['transmission']) == 'DSG (Direct shift gearbox)') ? 'selected' : ''?>>DSG (Direct shift gearbox)</option>
					</select>
				</li>
				<li>
					<label for="Air Condition">Air Condition</label>
					<select name="air_condition" id="" class="form-control">
						<option value="Yes">Yes</option>
						<option value="No">No</option>
					</select>
				</li>
				<li>
					<label for="Fuel">Fuel</label>
					<select name="fuel" id="" class="choice form-control">
						<option <?php echo (isset($_POST['fuel']) == 'Petron') ? 'selected' : ''?>>Petrol</option>
						<option <?php echo (isset($_POST['fuel']) == 'Diesel') ? 'selected' : ''?>>Diesel</option>
						<option <?php echo (isset($_POST['fuel']) == 'Biodiesel') ? 'selected' : ''?>>Biodiesel</option>
						<option <?php echo (isset($_POST['fuel']) == 'Autogas') ? 'selected' : ''?>>Autogas</option>
						<option <?php echo (isset($_POST['fuel']) == 'Ethanol Blend') ? 'selected' : ''?>>Ethanol Blend</option>
						<option <?php echo (isset($_POST['fuel']) == 'Hybrid') ? 'selected' : ''?>>Hybrid</option>
					</select>
				</li>
				<li>
					<input type="submit" name="submit" value="ADD CAR"/>
				</li>
			</ul>
		</form>
	</div>
	<?php else:
		foreach($car_data as $row):
	?>
	<div class="span5 profile-car fl">
		<div class="p-frame-car">
			<img src="<?php echo ($row['image'] != '') ? base_url('assets/media_uploads/').'/'.$row['image'] : base_url('assets/images/page_template/no_car.jpg')?>" width="450" height="230" alt=""/>
		</div>
		
		<div class="p-car-info">
			<p class="p-car-heading">Car Specifications</p>
			<ul>
				<li>
					<label for="Car Model">Car Model</label>
					<span><?php echo $row['car']?></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="License Plate">License Plate</label>
					<span><?php echo $row['plate']?></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Year">Year</label>
					<span><?php echo $row['year']?></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Fuel">Fuel</label>
					<span><?php echo $row['fuel']?></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Fuel">Doors</label>
					<span><?php echo $row['door']?></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Fuel">Seats</label>
					<span><?php echo $row['seat']?></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Fuel">Transmission</label>
					<span><?php echo ($row['transmission'] != '') ? $row['transmission'] : ''?></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Fuel">Air Condition</label>
					<span><?php echo ($row['air_condition'] != '') ? $row['air_condition'] : ''?></span>
					
					<div class="clr"></div>
				</li>
			</ul>
		</div>
	</div>
	<?php 
		endforeach;
	endif?>
	
	<?php echo modules::run('members/status')?>

	<div class="clr"></div>
</div>


<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
<script type="text/javascript">
$(function() {
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
});
</script>