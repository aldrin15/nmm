<?php $this->load->view('header_content')?>

<script type="text/javascript">
window.fbAsyncInit = function() {
    FB.init({
      appId      : '262187797300693', // App ID
      channelUrl : 'http://nmm-nmm.de/nmm', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    });

    // Additional initialization code here
};

// Load the SDK Asynchronously
(function(d){
 var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
 if (d.getElementById(id)) {return;}
 js = d.createElement('script'); js.id = id; js.async = true;
 js.src = "https://connect.facebook.net/en_US/all.js";
 ref.parentNode.insertBefore(js, ref);
}(document));
</script>

<style type="text/css">
.event-posted-image {border-radius:5px; -webkit-border-radius:5px; -moz-border-radius:5px; -ms-border-radius:5px; border:1px solid #bbbaba; padding:10px}
.event-posted-image img {margin-right:10px;}
.event-posted-remarks {padding-top:10px;}

.event-posted-details p {margin-bottom:10px;}
</style>

<div class="m-center-content">
	<?php foreach($event_details_data as $row):?>
	<div class="event-posted">
		<div class="event-posted-image">
			<img src="<?php echo ($row['image'] != '') ? base_url('assets/media_uploads/events').'/'.$row['image'] : base_url('assets/images/page_template/no_event.jpg')?>" width="220" height="135" alt="" class="fl"/>
			
			<div class="event-posted-details fl">
				<p style="font-size: 1.5em; font-weight: bold;">On <?php echo date('F d, H:i A', strtotime($row['date']))?></p>
				<p><?php echo $row['title']?> <i>in</i> <strong><?php echo $row['city_country']?></strong></p>
				<p><?php echo $row['address']?></p>
				<p>Posted by: <?php echo $row['firstname'].' '.$row['lastname']?></p>
			</div>
			
			<div id="shareBtn" class="fr btn btn-success clearfix"><i class="fa fa-share"></i> Share with Facebook</div>
			<script type="text/javascript">
			document.getElementById('shareBtn').onclick = function() {
				FB.ui({method: 'feed',
					picture		: 'http://nmm-nmm.de/assets/images/page_template/logo.png',
					link		: "http://nmm-nmm.de/",
					caption		: "<?php echo $row['title']?> at <?php echo $row['address']?>",
					description	: "<?php echo preg_replace( "/\r|\n/", "", $row['remarks'])?>",
				}, function(response){});
			}
			</script>
			
			<div class="clr"></div>
		</div>
		
		<div class="event-posted-remarks">
			<h4>Event Description:</h4>
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
				<?php if($event_details_lift_data == null):?>
					<div style="font-size:1.2em; font-weight:bold; border:1px solid #000; text-align:center; margin-top:10px; padding:20px;"><p>There are no route that matches in this event area</p></div>
				<?php else:?>
				<ul>
					<?php foreach($event_details_lift_data as $row): ?>
					<li class="column">
						<p><?php echo $row['firstname'].' '.$row['lastname']?></p>
						<a href="#">
							<img src="<?php echo base_url('assets/images/page_template/no_car.jpg')?>" alt="Car"/>
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
							<span><?php echo date('H:m A', strtotime($row['start_time']))?></span>
							
							<div class="clr"></div>
						</div>
						<div>
							<div class="fl" style="margin:0;">
								<label for="Available Seats"><strong>Available Seat/s:</strong></label>
								<span><?php echo $row['available']?></span>
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
					$event_details_passenger = array_keys( $event_details_passenger_data, true);
					
					if($event_details_passenger_data == null):
				?>
					<div style="font-size:1.2em; font-weight:bold; border:1px solid #000; text-align:center; margin-top:10px; padding:20px;"><p>There are no route that matches in this event area</p></div>
				<?php
				else:
					foreach($event_details_passenger_data as $wish_lift):
				?>
				<ul>
					<li>
						<a href="<?php echo base_url('passenger/detail/'.$wish_lift['id'])?>">
							<img src="<?php echo ($wish_lift['image'] != '') ? base_url('assets/media_uploads').'/'.$wish_lift['image'] : base_url('assets/images/page_template/blank_profile_large.jpg')?>" alt="User"/>
							<span><strong>From</strong> <?php echo $wish_lift['origin']?></span>
							<span><strong>To</strong> <?php echo $wish_lift['destination']?></span>
							<span><strong>Via</strong> <?php echo $wish_lift['via']?></span>
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
				</ul>
				<?php 
					endforeach;
				endif;
				?>
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