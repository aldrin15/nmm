<?php $this->load->view('header_content')?>

<div class="m-center-content">
	<?php foreach($event_details_data as $row):?>
	<div class="event-posted">
		<div class="event-posted-image">
			<img src="<?php echo base_url('assets/media_uploads/events'.'/'.$row['image'])?>" width="220" height="135" alt="" class="fl"/>
			
			<div class="event-posted-details fl">
				<p><?php echo date('F d Y', strtotime($row['date']))?></p>
				<p><?php echo $row['title']?></p>
				<p><?php echo $row['address']?></p>
				<p>Posted by: <?php echo $row['firstname'].' '.$row['lastname']?></p>
			</div>
			
			<div class="clr"></div>
		</div>
		
		<div class="event-posted-remarks">
			<?php echo $row['remarks']?>
		</div>
	</div>
	
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
				<ul>
					<?php foreach($event_details_lift_data as $row): ?>
					<li class="column">
						<p>Ace Doe</p>
						<a href="#">
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
						
						<div class="clr"></div>

						<a href="#" class="quick-book fr">Quick Book</a>
					</li>
					<?php endforeach?>
				</ul>
				
				<div class="clr"></div>
			</div>
		</div>
		
		<div id="passenger" style="display:none;">
			<div class="passenger-listing">
				<ul>
					<?php foreach($event_details_passenger_data as $wish_lift):?>
					<li>
						<a href="<?php echo base_url('passenger/detail/'.$wish_lift['id'])?>">
							<img src="<?php echo base_url('assets/images/user.jpg')?>" width="150" height="150" alt="User"/>
							<span><strong>From</strong> <?php echo $wish_lift['origin']?></span>
							<span><strong>To</strong> <?php echo $wish_lift['destination']?></span>
							<span><strong>Via</strong> <?php //echo $wish_lift['via']?></span>
							<span><strong>Posted</strong> <?php echo $wish_lift['posted']?></span>
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
					<?php endforeach?>
				</ul>
				
				<div class="clr"></div>
			</div>
		</div>
	</div>
	<?php endforeach?>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.rateit.js')?>"></script>
<script type="text/javascript">
$(function() {
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