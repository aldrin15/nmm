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
					<li class="column">
						<p>Ace Doe</p>
						<a href="#">
							<img src="<?php echo base_url('assets/images/car.jpg')?>" width="250" height="169" alt="Car"/>
						</a>
						<div>
							<label for="From"><strong>From: </strong></label>
							<span>Makati</span>
							
							<div class="clr"></div>
						</div>
						<div>
							<label for="To"><strong>To: </strong></label>
							<span>Pasay</span>
							
							<div class="clr"></div>
						</div>
						<div>
							<label for="Date"><strong>On</strong></label>
							<span>May 31</span>
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
								<span style="font-size: 1.5em;">10.00</span>
							</div>
							
							<div class="clr"></div>
						</div>
						
						<div class="clr"></div>

						<a href="#" class="quick-book fr">Quick Book</a>
					</li>
				</ul>
				
				<div class="clr"></div>
			</div>
		</div>
		
		<div id="passenger" style="display:none;">
			<ul>
				<li>
					
				</li>
			</ul>
		</div>
	</div>
	<?php endforeach?>
</div>

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