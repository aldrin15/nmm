<?php $this->load->view('header_content')?>

<!--<link rel="stylesheet" type="text/css" href="<?php //echo base_url('assets/css/mdp.css')?>"/>-->
<style type="text/css">
.ui-state-highlight, .ui-widget-content .ui-state-highlight, .ui-widget-header .ui-state-highlight {background:#00ff00;}
.ui-datepicker {width:100%;}
.ui-widget-content {background:none;}
.ui-datepicker-calendar td {border:none;}
.ui-datepicker td span, .ui-datepicker td a {padding:10px 5px;}
.ui-widget-header .ui-state-highlight {border:none;}
.ui-state-highlight {border:none}
.ui-widget-header {background:#fff;}
.ui-datepicker .ui-datepicker-header {padding:.5em 0;}
</style>
<div class="detail m-center-content">
	<?php foreach($lift_information as $row):?>
	<div class="fl span5">
		<h4>From: <span><?php echo $row['origin']?></span></h4>
		<h4>To: <span><?php echo $row['destination']?></span></h4>
		<h5>Via <span>Road</span></h4>

		<div class="user-information">
			<p>Lift Offered by:</p>
			<div class="profile-image fl"><img src="<?php echo base_url('assets/images/user.jpg')?>" width="160" height="160" alt="Car"/></div>
			<div class="user-info fl">
				<p><?php echo $row['firstname'].' '.$row['lastname']?></p>
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
						$preference_array = array();
						$preference_type_array = array();

						foreach($preference_data as $preference):
							$preference_array[] 		= $preference['preference'];
							$preference_type_array[]	= $preference['type'];
						endforeach;
						
						$implode = implode(',', $preference_array);
						$explode = explode(',', $implode);
						
						$implode2 = implode(',', $preference_type_array);
						$explode2 = explode(',', $implode2);
						
						if($explode !== 0):
							for($i = 0; $i < count($explode); $i++):
								$num = $i + 1;
								echo '<div class="fl checkbox-'.$num.' selected"><p>'.$explode2[$i].'<i></i></p></div>';
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
			$other_dates_array = explode(',', $row['other_post_dates']);
			$other_origin_array = explode(',', $row['other_post_origins']);
			$other_destination_array = explode(',', $row['other_post_destinations']);
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
				
				var events = [<?php for($i = 0; $i < count($other_dates_array); $i++):
					echo '"'.$other_dates_array[$i].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; from '.$other_origin_array[$i].' to '.$other_destination_array[$i].'",';
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
		
		<!-- 
		<div class="lift-seat-available">
			<?php 
			/* $seat_taken = explode(',', $row['seats']);
			
			if($seat_taken == 0):
				$available = $row['available'];
			else:
				$available = $row['available'] - array_sum($seat_taken);
			endif; */
			?>
			<center><h4><?php //echo $available?> more seat(s) available</h4></center>
			
			<ul>
				<?php
				/* $seat_explode = explode(',', $row['seats']);
				$seat_implode = implode(',', $seat_explode);
				$seat_explode2 = explode(',', $seat_implode);
				
				$image_explode = explode(',', $row['image']);
				$image_implode = implode(',', $image_explode);
				$image_explode2 = explode(',', $image_implode);
				
				if($seat_explode2[0] == 0):
					// echo 'Data is 0';
				else:
					for($i = 0; $i < count($seat_explode2); $i++):
						echo '<li><span></span><img src="'.base_url('assets/media_uploads').'/'.$image_explode2[$i].'" width="65" height="66" alt=""/></li>';
					endfor;
				endif;
				
				for($i = 0; $i < $available; $i++):
					echo '<li><span></span><img src="'.base_url('assets/images/page_template/blank_image.png').'" width="65" height="66" alt=""/></li>';
				endfor; */
				?>
			</ul>
			
			<div class="clr"></div>
		</div>
		
		<div class="lift-price">
			<p>&#128;<?php //echo $row['amount']?> / seat</p>
		</div>
		-->
		
		<div class="btn-book-now">
			<?php
			if($this->session->userdata('user_id') == true):
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
			<a href="#" class="quick-book btn-gray" data-toggle="modal" data-target="#choose-date" data-hash="<?php echo $hash?>">Start Booking</a>
			<?php endif?>
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
				waypoints: [{
					location: "Makati, Philippines",//via
					stopover:false
				}],
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
							<div class="err-msg-cal"></div>
							<label for="Calendar">Choose date to see available seats</label>
							<div id="choose-date-cal"></div>
							<input type="hidden" name="chose_dates" name=""/>	
						</li>
						<li>
							<label for="Available Seats" style="width:300px">Available seat(s) : <span class="a-error"></span></label>
									<div class="clr"></div>
							<div class="seat-taken fl"></div>
							<div class="seat-available"></div>
							
							<div class="clr"></div>
						</li>
						<li>
							<label for="Price Per Seat">Price Per Seat:</label>
							<span class="lift-price-per-seat"></span>
							
							<div class="clr"></div>
						</li>
						<li>
							<label for="Total Price">Total Price</label>
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
<script type="text/javascript" language="javascript">
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
			// $(this).parent().css({background:"<?php echo base_url('assets/images')?>/\"+image+\""});
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
		var id = $(this).attr('data-hash');
		$.ajax({
			url		: '<?php echo base_url('lift/get_lift_post')?>',
			data	: {id:id},
			success	: function(data) {
				// console.log(data);
				var date_array 	= [],
					seat_array  = [],
					// image_array	= [],
					amount_array= [];
				
				$.each($.parseJSON(data), function(i, val) {
					date_array.push(val.date);
					seat_array.push(val.available);
					// image_array.push(val.image);
					amount_array.push(val.amount);
				});
					
				function date(date) {
					var month 		= date.getMonth()+1;
						real_month 	= (month < 9 ? "0"+month:month)
						day			= date.getDate(),
						year		= date.getFullYear(),
						fullyear	= year+'-'+real_month+'-'+day;
					
					return ($.inArray(fullyear, date_array) > -1 ? [true, ''] : [false, '']);
				}
				
				$('#choose-date-cal').datepicker({
					minDate : 0,
					dateFormat: 'mm/dd/yy',
					beforeShowDay : date,
					onSelect: function(dateText, inst) {
						var getDates = $('#choose-date-cal').datepicker().val(),
							on_off = $('input[name="chose_dates"]').val(getDates);
							$('.total-amount').empty();
						
						if(on_off.val() != '') {
							$('.seat-taken, .seat-available').empty();
							$('.lift-price-per-seat').empty();
							$('.lift-price-per-seat').html(amount_array[0]);
							$('input[name="date"]').val(getDates)
							
							$.ajax({
								url		: '<?php echo base_url('lift/get_lift_booked')?>',
								data	: {id:id, date:getDates},
								success	: function(data) {
									// console.log(data);
									// console.log(seat_array);
									// console.log(image_array[0]);
									var user_image_array	= [],
										user_image_length 	= [],
										seat_taken			= 0;
									
									$.each($.parseJSON(data), function(index, value) {
										seat_taken += value.seats << 0;
									
										if(value.image == null) {
											user_image_array = 0;
										} else {
											user_image_array.push(value.image);
										}
									});
									
									var image_length	= user_image_array.length;
									var user_image		= [];
									var availability	= seat_array[0] - seat_taken;
									
									for(var i = 0; i < image_length; i++) {
										$('.seat-taken').append("<span style='display:inline-block; background: url(\"<?php echo base_url('assets/media_uploads')?>/"+user_image_array[i]+"\") no-repeat; margin-right:16px; width:65px; height:66px;'></span>");
									}
									
									for(var j = 0; j < availability; j++) {
										$('.seat-available').prepend('<label><input type="checkbox" name="seat[]" value="'+amount_array[0]+'" /></label>');
									}
									
									<?php if($get_user_image == null):?>
										var image = '0';
									<?php else:
										foreach($get_user_image as $image):?>
											var image = '<?php echo $image['image']?>';
									<?php endforeach;
									endif?>
									
									check_available("seat[]", image);
									
									/* ====================================
									 * Auto Calculate the amount per seat
									 =================================== */
									var seat_amount = 0
										seat_numer	= 0;
									
									$('input[name="seat[]"]').click(function() {
										if($(this).is(':checked')) {
											seat_amount += parseInt($(this).val());
											seat_numer += parseInt(1);
										} else {
											seat_amount -= parseInt($(this).val());
											seat_numer -= parseInt(1);
										}
										
										$('.total-amount').html('<strong>&euro; '+seat_amount+'</strong>');
										$('input[name="amount"]').attr('value', seat_amount);
										$('input[name="get_seat"]').attr('value', seat_numer);
									});
								}
							});
						} else {
							$('.seat-taken, .seat-available').empty();
						}
					}
				});
				
				
				$('.step-next').click(function() {
					var get_seat	= $('input[name="get_seat"]').val(),
						amount		= $('input[name="amount"]').val(),
						error		= 0;
					
					$('.err-msg-cal').empty();
					
					if($('input[name="chose_dates"]').val() == '') {
						$('.err-msg-cal').html('You need to choose at least one of the dates available').css({background:'#FF1B43', color:'#fff', fontSize:'1.2em', fontWeight:'bold', textAlign:'center', border:'1px solid #ff0000', padding:'5px 0'});
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
	
	/* $('input[name="book_submit"]').click(function(e) {
		var	user_id 	= $('input[name="user_id"]').attr('value'),
			post_id 	= $('input[name="post_id"]').attr('value'),
			seat_taken 	= 0,
			amount		= $('input[name="amount"]').val(),
			message		= $('textarea[name="message"]').val(),
			request		= $('textarea[name="request"]').val(),
			start_time	= $('input[name="start_time"]').val(),
			date		= $('.lift-info2').val(),
			error 		= 0;
		
		if(!$('input[name="seat[]"]').is(':checked')) {
			$('.a-error').addClass('error').html('You need to choose seats');
			error = 1;
		}
		
		$("input[name='seat[]']:checked").each(function (index, number) {
			seat_taken = seat_taken + parseFloat($(number).val());
		});
		
		$('input[name="seat"]').attr('value', seat_taken);
		
		if(error === 0) {
			$.ajax({
				url : '<?php echo base_url('lift/booked')?>',
				data: {
					user_id 	: user_id,
					post_id 	: post_id,
					message		: message,
					request		: request,
					amount		: amount,
					seat_taken	: seat_taken,
					start_time	: start_time,
					date		: date,
				},
				type: 'GET',
				success: function() {
					$('#booking').modal('hide');
				}
			});
		} else {
			return false;
		}
		
		e.preventDefault();
	}); */

	$('input[name="rate_submit"]').click(function() {
		var rating_number = [];
		
		$('#rating-form input[type="radio"]').each(function() {
			if(this.checked) {
				rating_number.push(this.value);
			}
		});
		
		$.ajax({
			url : '<?php echo base_url('lift/insert_rating')?>',
			type : 'GET',
			data : {user_id : '<?php echo $this->session->userdata('user_id')?>', rating_number: rating_number.toString()},
			success : function(data) {
				console.log('Successfully voted');
			}
		});
		
		return false;
	});
});
</script>