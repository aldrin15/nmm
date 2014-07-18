<?php $this->load->view('header_content')?>

<div class="slideshow-search" style="position:relative;">
	<div class="slideshow">			
		<ul class="rslides" id="slider1">
			<li><img src="<?php echo base_url('assets/images/abroad/1.jpg')?>" width="100%" height="" alt=""></li>
			<li><img src="<?php echo base_url('assets/images/abroad/2.jpg')?>" width="100%" height="" alt=""></li>
			<li><img src="<?php echo base_url('assets/images/abroad/3.jpg')?>" width="100%" height="" alt=""></li>
		</ul>

		<div class="clr"></div>
	</div>
</div>

<div class="m-center-content">
	<?php echo modules::run('lift/search')?>

	<select name="" id="" class="category">
		<?php foreach($countries_data as $country):?>
		<option><?php echo $country['name']?></option>
		<?php endforeach?>
	</select>
	
	<div class="event-lift-passenger">
		<div class="event-lift-passenger-nav">
			<ul>
				<li><a href="#" class="current" data="lift">Lift</a></li>
				<li><a href="#" data="passenger">Passenger</a></li>
			</ul>
			
			<div class="clr"></div>
		</div>
		
		<div id="lift">
			<div class="lift-listing">
				<?php if($ride_default_data == null):?>
					<div style="font-size:1.2em; font-weight:bold; border:1px solid #000; text-align:center; margin-top:10px; padding:20px;"><p>There are no route that matches in this event area</p></div>
				<?php else:?>
				<ul>
					<?php foreach($ride_default_data as $row): ?>
					<li class="column">
						<p>Ace Doe</p>
						<a href="<?php echo base_url('rides/detail').'/'.$row['id']?>">
							<img src="<?php echo base_url('assets/images/car.jpg')?>" width="250" height="169" alt="Car"/>
						</a>
						<div>
							<label for="From"><strong>From: </strong></label>
							<span><?php echo $row['origin']?></span>
							
							<div class="clr"></div>
						</div>
						<div>
							<label for="To"><strong>To: </strong></label>
							<span><?php echo $row['destination']?></span>
							
							<div class="clr"></div>
						</div>
						<div>
							<label for="Date"><strong>On</strong></label>
							<span><?php echo date('M d', strtotime($row['date']))?></span>
							<label for="at">&nbsp;<strong>at</strong></label>
							<span>8:30 AM</span>
							
							<div class="clr"></div>
						</div>
						<div>
							<div class="fl" style="margin:0;">
								<label for="Available Seats"><strong>Available Seat/s:</strong></label>
								<span>5</span>
							</div>
							<div class="fr" style="color:#678222; margin:-6px 0 0 0;">
								<label for="" style="font-size:1.5em;">&#128; </label>
								<span style="font-size: 1.5em;"><?php echo $row['amount']?></span>
							</div>
							
							<div class="clr"></div>
						</div>
					</li>
					<?php endforeach?>
				</ul>	
				<?php endif?>
				
				<div class="clr"></div>
			</div>
		</div>
		
		<div id="passenger" style="display:none;">
			<div class="passenger-listing">
				<?php	
				if($wish_ride_default_data != ''):
				?>
					<div style="font-size:1.2em; font-weight:bold; border:1px solid #000; text-align:center; margin-top:10px; padding:20px;"><p>There are no route that matches in this event area</p></div>
				<?php
				else:
					foreach($wish_ride_default_data as $wish_lift):
				?>
				<ul>
					<li>
						<a href="<?php echo base_url('passenger/detail/'.$wish_lift['id'])?>">
							<img src="<?php echo base_url('assets/images/user.jpg')?>" width="150" height="150" alt="User"/>
							<span><strong>From</strong> <?php echo $wish_lift['origin']?></span>
							<span><strong>To</strong> <?php echo $wish_lift['destination']?></span>
							<span><strong>Via</strong> <?php echo $wish_lift['via']?></span>
							<span><strong>Posted</strong> <?php echo $wish_lift['date']?></span>
							<span><strong>Requested seat(s)</strong> <?php echo $wish_lift['available']?></span>
							<span><strong>Requested by</strong> <?php echo $wish_lift['firstname']." ".$wish_lift['lastname']?></span>
							<div class="user-rating">
								<?php
								$rating			= explode(', ', $wish_lift['rating']);
								$rating_sum		= array_sum($rating);
								$rating_count 	= count($rating);
								$rating_data	= $rating_sum / $rating_count;
								$result 		= number_format($rating_data, 2);
								?>
								<div class="rateit" data-rateit-value="<?php echo $result?>" data-rateit-readonly="true"></div>
								<div class="clr"></div>	
							</div>
						</a>
					</li>
				</ul>
				<?php 
					endforeach;
				endif;
				?>
				<div class="clr"></div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/responsiveslides.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-select.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.rateit.js')?>"></script>
<script type="text/javascript">
$(function() { 
	$('.category').selectpicker(); 
	$("#slider1").responsiveSlides({ maxwidth: "none", speed: 800 });
	
	$('.category').change(function() {
		var country = $(this).val();
		
		/* $.ajax({
			url	: '<?php echo base_url('abroad/search_by_country')?>',
		}); */
	});
	
	$('.event-lift-passenger-nav ul li a').click(function(e) {
		$('.event-lift-passenger-nav ul li a').removeClass('current');
		$(this).addClass('current');
		
		var content = $(this).attr('data');
		
		if(content == 'lift') {
			$('#lift').show();
			$('#passenger').hide();
		} else {
			$('#passenger').show();
			$('#lift').hide();
		}
		
		e.preventDefault();
	});
});
</script>
<?php echo modules::run('lift/auto_suggest_city')?>