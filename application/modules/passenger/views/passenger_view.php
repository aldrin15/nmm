<?php $this->load->view('header_content')?>

<style type="text/css">.slideshow ul {margin:0 auto; width:1024px; height:360px;}</style>

<div class="slideshow-search" style="position:relative;">
	<div class="slideshow">			
		<ul class="rslides" id="slider1">
			<li><img src="<?php echo base_url('assets/images/passenger/1.jpg')?>" width="100%" alt=""></li>
			<li><img src="<?php echo base_url('assets/images/passenger/2.jpg')?>" width="100%" alt=""></li>
			<li><img src="<?php echo base_url('assets/images/passenger/3.jpg')?>" width="100%" alt=""></li>
		</ul>
		
		<div class="clr"></div>
	</div>
</div>

<div class="passenger-view m-center">
	<div class="search">
		<form action="" method="post">
			<ul>
				<li>
					<?php echo form_error('from', '<div class="error">', '</div>')?>
						<div class="clr"></div>
					<span><input type="text" name="from" onfocus="if(this.value==this.defaultValue) this.value = ''" onblur="if (this.value=='') this.value = this.defaultValue" value="From" id="from" autocomplete="off"/></span>
				</li>
				<li>
					<?php echo form_error('to', '<div class="error">', '</div>')?>
						<div class="clr"></div>
					<span><input type="text" name="to" onfocus="if(this.value==this.defaultValue) this.value = ''" onblur="if (this.value=='') this.value = this.defaultValue" value="Destination" id="destination" autocomplete="off" /></span>
				</li>
				<li>
					<input type="submit" name="passenger_submit" value="    Search" class="btn-search"/>

					<div class="clr"></div>
				</li>
				<li>
					<input type="submit" name="option" value="Advance Option" class="btn-advance" style="margin-left:5px;"/>
					
					<div class="clr"></div>
				</li>
			</ul>
			
			<div class="clr"></div>
		</form>
	</div>
	
	<h3 class="fl">Wish lift by user:</h3>
	
	<?php 
	if($this->session->userdata('validated') == true):
		echo '<a href="'.base_url('passenger/create').'" class="btn-create-lift fr btn-advance">Wish a Lift</a>';
	endif;
	?>
	
	<div class="clr"></div>

	<div class="passenger-listing">
		<?php if($wish_lift_data == null):?>
			<div style="font-size:1.2em; font-weight:bold; border:1px solid #000; text-align:center; margin-top:10px; padding:20px;"><p>There are no post of passengers at the moment</p></div>
		<?php else:?>
			<ul>
				<?php foreach($wish_lift_data as $wish_lift):?>
				<li>
					<a href="<?php echo base_url('passenger/detail/'.$wish_lift['id'])?>">
						<div class="p-profile-image"><img src="<?php echo ($wish_lift['image'] != '') ? base_url('assets/media_uploads').'/'.$wish_lift['image'] : base_url('assets/images/page_template/blank_profile_large.jpg')?>" alt="User"/></div>
						<span><strong>From</strong> <?php echo $wish_lift['origin']?></span>
						<span><strong>To</strong> <?php echo $wish_lift['destination']?></span>
						<span><strong>Via</strong> <?php echo $wish_lift['via']?></span>
						<span><strong>Posted</strong> <?php echo date('F d', strtotime($wish_lift['date']))?></span>
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
		<?php endif?>
		<div class="clr"></div>
	</div>
	
	<div class="clr"></div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.rateit.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/responsiveslides.js')?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&region=DE&libraries=places&language=de"></script>  
<script type="text/javascript">
$(window).load(function() {initialize();});

var destination, from;

function initialize() {
	from = new google.maps.places.Autocomplete((document.getElementById('from')), { types: ['geocode'] });
	destination = new google.maps.places.Autocomplete((document.getElementById('destination')), { types: ['geocode'] });
}

function geolocate() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
			var geolocation = new google.maps.LatLng(
			
			position.coords.latitude, position.coords.longitude);
			destination.setBounds(new google.maps.LatLngBounds(geolocation, geolocation));
		});
	}
}

$(function() { 
	$('#datepicker').datepicker(); $("#slider1").responsiveSlides({ maxwidth: "none", speed: 800 }); 
	
	$('input[name="passenger_submit"]').click(function() {
		var from 	= $('input[name="from"]'),
			to		= $('input[name="to"]'),
			date	= $('input[name="date"]'),
			price	= $('input[name="price"]'),
			error	= 0;
		
		if(from.val() == '' || from.val() == 'From') {
			from.parent().css({border:'2px solid #ff0000'});
			error = 1;
		}
		
		if(to.val() == '' || to.val() == 'Destination') {
			to.parent().css({border:'2px solid #ff0000'});
			error = 1;
		}
		
		if(error == 0) {
			$(this).submit();
		} else {
			return false;
		}
	});	
});</script>