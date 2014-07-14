<?php $this->load->view('header_content')?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/mdp.css')?>"/>
<style type="text/css">
/* .ui-state-highlight, .ui-widget-content .ui-state-highlight, .ui-widget-header .ui-state-highlight {background:#00ff00;} */
.ui-datepicker {width:100%;}
.ui-widget-content {background:none;}
.ui-datepicker-calendar td {border:none;}
.ui-datepicker td span, .ui-datepicker td a {padding:10px 5px;}
.ui-widget-header .ui-state-highlight {border:none;}
.ui-state-highlight {border:none}
.ui-widget-header {background:#fff;}
.ui-datepicker .ui-datepicker-header {padding:.5em 0;}

.user-info .name {font-size:1.3em;}
.user-information {border:1px solid #dbdada; border-radius:7px; -webkit-border-radius:7px; -moz-border-radius:7px; -ms-border-radius:7px; padding:10px;}
.profile-image {margin-right:10px;}
.profile-image img {border-radius:7px; -webkit-border-radius:7px; -moz-border-radius:7px; -ms-border-radius:7px;}
</style>
<div class="detail m-center-content">
	<?php foreach($lift_information as $row):?>
	<div class="fl span5">
		<h4>From: <span><?php echo $row['origin']?></span></h4>
		<h4>To: <span><?php echo $row['destination']?></span></h4>
		<h5>Via <span>Road</span></h4>

		<div class="user-information">
			<p>Lift Offered by:</p>
			<div class="profile-image fl"><img src="<?php echo base_url('assets/media_uploads').'/'.$row['image']?>" width="160" height="160" alt="Car"/></div>
			<div class="user-info fl">
				<p class="name"><strong><a href="<?php echo base_url('members/profile_view/').'/'.$row['user_id']?>"><?php echo $row['firstname'].' '.$row['lastname']?></a></strong></p><br />
				<div class="user-rating">
					<?php
					$rating_id 		= $row['rating_id'];
					$rating 		= explode(', ', $row['rating']);
					$rating_sum 	= array_sum($rating);
					$rating_count 	= count($rating);
					$rating_data 	= $rating_sum / $rating_count;
					$result 	= number_format($rating_data, 2);
					?>
					<div class="rateit" data-rateit-value="<?php echo $result?>" data-rateit-readonly="true"></div>
					
					<div class="clr"></div>	
				</div>
				<div class="user-last-login">
					<span>Last login: <?php echo date('M d, Y H:i A', strtotime($row['last_login']))?></span>
				</div>
				<div class="user-contacts">
					<p>Email phone shown after booking confirmed</p>
				</div>
				<div class="send-message"></div>
				<div class="report-user"></div>
			</div>
			
			<div class="clr"></div>
		</div>
		
		<div class="lift-information">
			<ul>
				<li>
					<label for="Date">Date:</label>
					<span>: <?php echo date('M d', strtotime($row['date']))?> | <?php echo date('H:m A', strtotime($row['start_time']))?></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="From">From</label>
					<span>: <?php echo $row['origin']?></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="To">To</label>
					<span>: <?php echo $row['destination']?></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Car model">Car Model</label>
					<span>: <?php echo ($row['car'] == 0) ? 'No Details' : $row['car']?></span>
					<span class="car-image"><img src="" alt=""/></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="License">License Plate</label>
					<span>: <?php echo ($row['plate'] == 0) ? 'No Details' : $row['plate']?></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Storage">Storage</label>
					<span>: <?php echo $row['storage']?></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Preference">Preference</label>
					
					<div class="lift-preference">
						<?php 
						$preference = explode(',', $row['preference']);
						$preference_type = array();
						
						foreach($preference_data as $type):
							$preference_type[] = $type;
						endforeach;
						
						if($preference !== 0):
							for($i = 0; $i < count($preference); $i++):
								$num = $i + 1;
								echo '<div class="fl checkbox-'.$num.' selected"><p>'.$preference_type[$i]['type'].'<i></i></p></div>';
							endfor;
						else:
							echo '<div>: None</div>';
						endif;
						?>
					</div>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Remarks">Remarks</label>
					<span>: <?php echo ($row['remarks'] == NULL) ? 'No Details' : $row['remarks']?></span>
					
					<div class="clr"></div>
				</li>
			</ul>
		
		</div>
	</div>
		
	<div class="other-info span4 fr">
		<div class="social-share"></div>
		
		<div class="lift-calendar">
			<div id="passenger-calendar" style="margin-top:15px;">
				<div class="pcal-header">
					<a href="#" class="prev fl"></a>
					<div class="pcal-month fl"></div>
					<a href="#" class="next fr"></a>
					
					<div class="clr"></div>
				</div>
				
				<div class="clr"></div>
				
				<div class="pcal-body">
					<ul>
					</ul>
				</div>
			</div>
			<?php
			$other_dates_array			= array();
			$other_origin_array 		= array();
			$other_destination_array 	= array();
			
			foreach($get_user_lift_dates as $val):
				$other_origin_array[] 		= explode('-', $val['origins']);
				$other_destination_array[] 	= explode('-', $val['destination']);
				$other_dates_array[] 		= explode(',', $val['dates']);
			endforeach;
			?>
			<script type="text/javascript">
			function get_data(events, month_today, year) {
				$.each(events, function(index, value) {
					var get_month = value.substring(5, 7);
					var get_year = value.substring(0, 4);
					var this_month = (month_today < 9 ? "0"+month_today:month_today);
					
					if(this_month == get_month && get_year == year) {
						$('.pcal-body ul').append('<li>'+value+'</li>');
					}
				});
			}
			
			$(window).load(function() {
				var months 	= {1:'January', 2:'February', 3:'March', 4:'April', 5:'May', 6:'June', 7:'July', 8:'August', 9:'September', 10:'October', 11:'November', 12:'December'},
					prev	= 0,
					date	= new Date(),
					month 	= date.getMonth()+1,
					year	= date.getFullYear();
				
				var events = [<?php for($i = 0; $i < count($other_dates_array[0]); $i++):
					echo '"'.$other_dates_array[0][$i].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; from '.$other_origin_array[0][$i].' to '.$other_destination_array[0][$i].'",';
				endfor;?>];
			
				$('.pcal-month').html(months[month] +' '+ year);
				
				get_data(events, month, year);  //Get Data
				
				$('.next').click(function() {
					if(month < 12) {
						month++ + 1;
						
						$('.pcal-month').html(months[month] +' '+ year);
						
						$('.pcal-body ul').empty()
						
						get_data(events, month, year); //Get Data
					} else {
						month = 0;
						year	= year + 1;
					}
				});
				
				$('.prev').click(function() {
					month--;
					
					$('.pcal-month').html(months[month] +' '+ year);
					
					$('.pcal-body ul').empty();
					
					get_data(events, month, year);
					
					if(month < 1) {
						month = 12;
						year	= year - 1;
						
						$('.pcal-month').html(months[month] +' '+ year);
					}
					
				});
			});
			</script>
		</div>
		
		<div class="btn-book-now">
			<br />
			<?php
			if($this->session->userdata('user_id') == true):
				if($row['user_id'] != $this->session->userdata('user_id')):
					function encrypt($action, $string) {
					   $output = false;

					   $key = 'My strong random secret key';

					   // initialization vector 
					   $iv = md5(md5($key));

					   if( $action == 'encrypt' ) {
						   $output = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, $iv);
						   $output = base64_encode($output);
					   }
					   return $output;
					}
					
					$hash = encrypt('encrypt', $row['id']);	
			?>
			<a href="#" class="quick-book btn btn-default" data-toggle="modal" data-target="#choose-date" data-hash="<?php echo $hash?>">Start Booking</a>
			<?php endif;
			endif?>
		</div>
	</div>
	
	<div class="clr"></div>
	
	<div class="lift-map-location">
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<style type="text/css">
		#ride-location {width:100%; height:280px;}
		#ride-location div {margin-top:90px;}
		#ride-location p, #ride-location i {display:inline-block; font-size:3em; vertical-align:text-bottom;}
		#ride-location i {background:url('<?php echo base_url('assets/images/gmap_marker.png')?>') no-repeat; width:49px; height:77px;}
		</style>
		<script type="text/javascript">
		$(window).load(function() { initialize(); });
		
		var directionDisplay;
		var directionsService = new google.maps.DirectionsService();
		var map;

		function initialize() {
			directionsDisplay = new google.maps.DirectionsRenderer();
			
			var myOptions = {
				zoom: 6,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			}
			map = new google.maps.Map(document.getElementById("ride-location"), myOptions);
			directionsDisplay.setMap(map);
			
			calcRoute();
		}

		function calcRoute() {
			var request = {
				origin: "<?php echo $row['origin']?>",
				destination: "<?php echo $row['destination']?>",
				<?php 
				/* waypoints: [{
					location: "Makati, Philippines",//via
					stopover:false
				}], */
				?>
				optimizeWaypoints: true,
				travelMode: google.maps.DirectionsTravelMode.DRIVING
			};
			directionsService.route(request, function(response, status) {
				if (status == google.maps.DirectionsStatus.OK) {
					directionsDisplay.setDirections(response);
				} else {
					// alert("directions response "+status);
					console.log('Google cannot locate this address');
					$('#ride-location').empty();
					$('#ride-location').html("<div><p>Google cannot locate this address!</p> <i></i> <div class='clr'></div></div>").css({border:'3px solid #088132', textAlign:'center', marginTop:'30px'});
				}
			});
		}
		</script>
		<div id="ride-location" > </div>
	</div>
	<?php endforeach?>
</div>

<div class="modal fade" id="choose-date" tabindex="-1" role="dialog" aria-hidden="true" style="display:none;">
	<div class="modal-dialog" style="width:450px">
		<form action="" method="post">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					&nbsp;
				</div>
				<div class="modal-body">
					<ul>
						<li>
							<label for="Available Seats" style="width:300px">Available seat(s) : <span class="a-error"></span></label>
									<div class="clr"></div>
							<div class="seat-taken fl"></div>
							<div class="seat-available"></div>
							
							<div class="clr"></div>
						</li>
						<li>
							<label for="Price Per Seat" style="font-size:1.5em"><strong>Price Per Seat:</strong></label>
							<span class="lift-price-per-seat"></span>
							
							<div class="clr"></div>
						</li>
						<li>
							<label for="Total Price" style="font-size:1.5em"><strong>Total Price:</strong></label>
							<span class="total-amount"></span>
							
							<div class="clr"></div>
						</li>
					</ul>
				</div>
				<div class="modal-footer">
					<a href="javascript:void(0)" class="btn btn-default step-next">Next</a>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="booking" tabindex="-1" role="dialog" aria-hidden="true" style="display:none;">
	<div class="modal-dialog" style="width:450px">
		<form action="" method="post">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					&nbsp;
				</div>
				<div class="modal-body">
					<ul>
						<li>
							<label for="Total Price">Total Price</label>
							<span class="total-amount"></span>
							
							<div class="clr"></div>
						</li>
						<li>
							<label for="Message">Message:</label>
								<div class="clr"></div>
							<textarea name="message" id="" cols="30" rows="10" class="form-control"></textarea>
						</li>
						<li>
							<label for="Request">Request re-route:</label>
							<label style="margin-top:-10px;"><input type="checkbox" name="request_form" value="1" id=""/></label>
							
							<div class="clr"></div>
						</li>
						<li class="request_form" style="display:none;">
							<label for="From">From</label>
							<input type="text" name="re_origin" id="from-route" class="form-control" />
								
								<div class="clr"></div>
							
							<label for="To">To</label>
							<input type="text" name="re_destination" id="to-route" class="form-control"/>
							
							<div class="clr"></div>
						</li>
					</ul>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="get_seat"/>
					<input type="hidden" name="amount" value=""/>
					<input type="hidden" name="date" value=""/>
					<a href="#" class="btn btn-default fl step-back">Go Back</a>
					<input type="submit" name="book_submit" value="Proceed" class="btn btn-default"/>

					<div class="clr"></div>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="successful" tabindex="-1" role="dialog" aria-hidden="true" style="display:none;">
	<div class="modal-dialog" style="width:450px">
		<form action="" method="post">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					&nbsp;
				</div>
				<div class="modal-body">
					<p>You have successfully booked</p>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.rateit.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-modal.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-modalmanager.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.ui.core.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.multidatespicker.js')?>"></script>
<script type="text/javascript">
function check_available(checkboxName, image){
	var checkBox = $('input[name="'+ checkboxName +'"]');
	
	$(checkBox).each(function(){
		$(this).wrap( "<span class='lift-available'></span>" );
		if($(this).is(':checked')){
			$(this).parent().addClass("selected");
		}
	});
	$(checkBox).click(function(){
		$(this).parent().toggleClass("selected");
		if($(this).is(':checked')){
			$(this).parent().css({background:"url(<?php echo base_url('assets/media_uploads')?>/"+image+")", top:'0'});
		} else {
			$(this).parent().css({background:'<?php echo base_url('assets/images')?>/blank_image.png'});
		}
	});
}

function route(checkboxName){
	var checkBox = $('input[name="'+ checkboxName +'"]');
	$(checkBox).each(function(){
		$(this).wrap( "<span class='create-lift-checkbox'></span>" );
		if($(this).is(':checked')){
			$(this).parent().addClass("selected");
		}
	});
	$(checkBox).click(function(){ $(this).parent().toggleClass("selected"); });
}

$(function() {
	$('.lift-preference div').mouseover(function() { $('p', this).stop(true, true).fadeIn().css({display:'block'}); });
	$('.lift-preference div').mouseleave(function() { $('p', this).fadeOut(); });
	
	$('.quick-book').click(function(e) {
		$('.seat-taken, .seat-available').empty();
		
		var id = $(this).attr('data-hash');
		
		$.ajax({
			url		: '<?php echo base_url('lift/get_lift_post')?>',
			data	: {id:id},
			success	: function(data) {
				var date_array 		= [],
					seat_array  	= [],
					amount_array	= [],
					seat_taken 		= 0,
					seat_amount		= 0,
					seat_number		= 0,
					seat_taken_array;	
				
				$.each($.parseJSON(data), function(i, val) {
					date_array.push(val.date);
					seat_array.push(val.available);
					amount_array.push(val.amount);
					
					if(val.seat == null){
						seat_taken = 0;
					} else {
						// seat_taken.push(val.seat);
						// seat_taken += val.seat << 0;
						// seat_taken.push(val.seat);
						// seat_taken_array.push(val.seat);
						seat_taken_array = val.seat.split(',')
						seat_taken = seat_taken_array.length;
					}
				});
				
				var availability	= seat_array - seat_taken;
				
				for(var j = 0; j < availability; j++) {
					$('.seat-available').prepend('<label><input type="checkbox" name="seat[]" value="'+amount_array[0]+'" /></label>');
				}
				
				var user_image;
				<?php if($get_user_image == null):?>
					var image = '0';
				<?php else:
					foreach($get_user_image as $image):?>
						var image = '<?php echo $image['image']?>';
						var user_image = '<?php echo $image['image']?>';
				<?php endforeach;
				endif?>
				
				for(var i = 0; i < seat_taken; i++) {
					$('.seat-taken').append("<span style='display:inline-block; background: url(\"<?php echo base_url('assets/media_uploads')?>/"+user_image+"\") no-repeat; margin-right:16px; width:65px; height:66px;'></span>");
				}
				
				check_available("seat[]", image);
				
				$('.lift-price-per-seat').html(amount_array);
				
				/* ====================================
				 * Auto Calculate the amount per seat
				 =================================== */
				$('input[name="seat[]"]').click(function() {
					if($(this).is(':checked')) {
						seat_amount += parseInt($(this).val());
						seat_number += parseInt(1);
					} else {
						seat_amount -= parseInt($(this).val());
						seat_number -= parseInt(1);
					}
					
					$('.total-amount').html('<strong>&euro; '+seat_amount+'</strong>');
					$('input[name="amount"]').attr('value', seat_amount);
					$('input[name="get_seat"]').attr('value', seat_number);
				});
				
				
				$('.step-next').click(function() {
					var get_seat	= $('input[name="get_seat"]').val(),
						amount		= $('input[name="amount"]').val(),
						error		= 0;
						
						
					route("request_form");
					$('.err-msg-cal').empty();
					
					if(!$('input[name="seat[]"]').is(':checked')) {
						$('.a-error').addClass('error').html('You need to choose seats');
						error = 1;
					}
					
					/* Request re-route form */
					$('input[name="request_form"]').click(function() {
						if($(this).is(':checked')) {
							$('.request_form').slideDown();
						} else {
							$('.request_form').slideUp();
						}
					});
					
					if(error == 0) {
						$('#choose-date').modal('hide');
						$('#booking').modal({dynamic:true});
						
						$('.step-back').click(function() {
							$('#booking').modal('hide');
							$('#choose-date').modal({dynamic:true});
						});
						
						$('input[name="book_submit"]').click(function(e) {
							e.preventDefault();
							
							$.ajax({
								url		: '<?php echo base_url('lift/insert_ride')?>',
								type	: 'POST',
								data	: {
									id			:'<?php echo $this->uri->segment(3)?>', 
									get_seat	:get_seat,
									date		:$('input[name="date"]').val(), 
									reroute_from:$('input[name="re_origin"]').val(), 
									reroute_to	:$('input[name="re_destination"]').val()
								},
								success	: function() {
									$('#booking').modal('hide');
									$('#successful').modal({dynamic:true});
									
									$('#successful').on('hidden', function () {
										location.reload();
									})
								}
							}); 
						});
					} else {
						return false;
					}
				});
			}
		});
	});
})
</script>