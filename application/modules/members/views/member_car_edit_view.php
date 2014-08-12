<?php $this->load->view('header_content')?>

<div class="profile-wrapper m-center-content">
	<?php echo modules::run('lift/search')?>
	
	<?php $this->load->view('member_sidebar_view')?>
	
	<?php foreach($car_data as $row):?>	
	<div class="span5 profile-car fl">
		<form action="" method="post">
			<div class="p-frame-car">
				<img src="<?php echo base_url('assets/images/dummy_car.jpg')?>" width="448" height="230" alt=""/>
				<!-- 
				<?php //if($row['image'] == NULL):?>
					<img src="<?php //echo base_url('assets/images/page_template/no_photo.jpg')?>" width="150" height="150" alt=""/>
				<?php //else:?>
					<img src="<?php //echo base_url('assets/media_uploads/').'/'.$info['image']?>" width="150" height="150" alt="" />
				<?php //endif?>
				-->
				<button class="btn-success">Change Picture</button>
				<input type="file" name="file" id="" />	
			</div>
			
			<div>
				<ul>
					<li>
						<label for="Car Model">Car Model <?php echo form_error('model', '<span class="error">','</span>')?></label>
						<input type="text" name="model" value="<?php echo (isset($_POST['model'])) ? set_value('model') : $row['car']?>" id="" class="form-control" />
						
						<div class="clr"></div>
					</li>
					<li>
						<label for="License Plate">License Plate <?php echo form_error('plate', '<span class="error">','</span>')?></label>
						<input type="text" name="plate" value="<?php echo (isset($_POST['plate'])) ? set_value('plate') : $row['plate']?>" id="" class="form-control"/>
						
						<div class="clr"></div>
					</li>
					<li>
						<label for="Year">Year <?php echo form_error('year', '<span class="error">','</span>')?></label>
						<select name="year" id="" class="choice form-control">
							<?php 
							$currentYear = date("Y");
							$years = range ($currentYear, 1960); 
							
							foreach($years as $date):
								if($row['year'] == $date):
							?>
								<option selected><?php echo $row['year']?></option>
							<?php else:?>
								<option><?php echo $date?></option>
							<?php 
								endif;
							endforeach?>
						</select>
						
						<div class="clr"></div>
					</li>
					<li>
						<label for="Fuel">Fuel <?php echo form_error('fuel', '<span class="error">','</span>')?></label>
						<select name="fuel" id="" class="choice form-control">
							<option <?php echo ($row['fuel'] == 'Petron') ? 'selected' : ''?>>Petrol</option>
							<option <?php echo ($row['fuel'] == 'Diesel') ? 'selected' : ''?>>Diesel</option>
							<option <?php echo ($row['fuel'] == 'Biodiesel') ? 'selected' : ''?>>Biodiesel</option>
							<option <?php echo ($row['fuel'] == 'Autogas') ? 'selected' : ''?>>Autogas</option>
							<option <?php echo ($row['fuel'] == 'Ethanol Blend') ? 'selected' : ''?>>Ethanol Blend</option>
							<option <?php echo ($row['fuel'] == 'Hybrid') ? 'selected' : ''?>>Hybrid</option>
						</select>
						
						<div class="clr"></div>
					</li>
					<li>
						<label for="Fuel">Doors <?php echo form_error('doors', '<span class="error">','</span>')?></label>
						<select name="door" id="" class="choice form-control">
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
						</select>
						
						<div class="clr"></div>
					</li>
					<li>
						<label for="Fuel">Seats <?php echo form_error('seats', '<span class="error">','</span>')?></label>
						<select name="seat" id="" class="choice form-control">
							<?php for($i = 1; $i < 12; $i++):?>
							<option><?php echo $i?></option>
							<?php endfor?>
						</select>
						
						<div class="clr"></div>
					</li>
					<li>
						<label for="Fuel">Transmission <?php echo form_error('Transmission', '<span class="error">','</span>')?></label>
						<select name="transmission" id="" class="choice form-control">
							<option <?php echo ($row['transmission'] == "Manual") ? 'selected' : ''?>>Manual</option>
							<option <?php echo ($row['transmission'] == "Automatic") ? 'selected' : ''?>>Automatic</option>
							<option <?php echo ($row['transmission'] == "CVT (Continuous Variable Transmission)") ? 'selected' : ''?>>CVT (Continuous Variable Transmission)</option>
							<option <?php echo ($row['transmission'] == "Semi Automatic") ? 'selected' : ''?>>Semi Automatic</option>
							<option <?php echo ($row['transmission'] == "TipTronic® gearbox") ? 'selected' : ''?>>TipTronic® gearbox</option>
							<option <?php echo ($row['transmission'] == "DSG (Direct shift gearbox)") ? 'selected' : ''?>>DSG (Direct shift gearbox)</option>
						</select>
						
						<div class="clr"></div>
					</li>
					<li>
						<label for="Fuel">Air Condition <?php echo form_error('air_con', '<span class="error">','</span>')?></label>
						<select name="air_con" id="" class="choice form-control">
							<option <?php echo ($row['air_condition'] == 'Yes') ? 'selected' : ''?>>Yes</option>
							<option <?php echo ($row['air_condition'] == 'No') ? 'selected' : ''?>>No</option>
						</select>
						
						<div class="clr"></div>
					</li>
					<li>
						<input type="submit" name="car_submit" value="UPDATE" class=""/>
					</li>
				</ul>
			</div>
		</form>
	</div>
	
	<?php echo modules::run('members/status')?>
	
	<?php endforeach?>	

	<div class="clr"></div>
</div>


<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-select.js')?>"></script>
<script type="text/javascript">
$(function() {
	$('.choice').selectpicker();
	
	$('.p-frame-car button').bind('click', function(e) {
		$('input[type="file"]').trigger('click');
		
		e.preventDefault();
	});	
	
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