<?php $this->load->view('header_content')?>

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
					<span>Last login: <?php echo date('M d, Y H:i', strtotime($row['last_login']))?></span>
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
		
		<div class="lift-seat-available">
			<?php 
			$seat_taken = explode(',', $row['seats']);
			
			if($seat_taken == 0):
				$available = $row['available'];
			else:
				$available = $row['available'] - array_sum($seat_taken);
			endif;
			?>
			<center><h4><?php echo $available?> more seat(s) available</h4></center>
			
			<ul>
				<?php
				$seat_explode = explode(',', $row['seats']);
				$seat_implode = implode(',', $seat_explode);
				$seat_explode2 = explode(',', $seat_implode);
				
				$image_explode = explode(',', $row['image']);
				$image_implode = implode(',', $image_explode);
				$image_explode2 = explode(',', $image_implode);
				
				if($seat_explode2[0] == 0):
					// echo 'Data is 0';
				else:
					for($i = 0; $i < count($seat_explode2); $i++):
						echo '<li><img src="'.base_url('assets/media_uploads').'/'.$image_explode2[$i].'" width="65" height="66" alt=""/></li>';
					endfor;
				endif;
				
				for($i = 0; $i < $available; $i++):
					echo '<li><img src="'.base_url('assets/images/page_template/blank_image.png').'" width="65" height="66" alt=""/></li>';
				endfor;
				?>
			</ul>
			
			<div class="clr"></div>
		</div>
		<div class="lift-price">
			<p>&#128;<?php echo $row['amount']?> / seat</p>
		</div>
		<div class="btn-book-now">
			<?php
			if($available !== 0):
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
			<a href="#" class="quick-book btn-gray" data-toggle="modal" data-target="#booking" data-hash="<?php echo $hash?>">Start Booking</a>
			<?php endif?>
		</div>
		<div class="lift-map-location">
			<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
			<style type="text/css">#map_canvas {margin-top:30px; width:370px; height:280px;}</style>
			<script type="text/javascript">
			$(window).load(function() {
				initialize();
			});
			
			var directionDisplay;
			var directionsService = new google.maps.DirectionsService();
			var map;

			function initialize() {
				directionsDisplay = new google.maps.DirectionsRenderer();
				
				var myOptions = {
					zoom: 6,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				}
				map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
				directionsDisplay.setMap(map);
				
				calcRoute();
			}

			function calcRoute() {
				var request = {
					// origin: "Pasay, Philippines", //from
					origin: "<?php echo $row['origin']?>", //from
					destination: "<?php echo $row['destination']?>",//to
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
						alert("directions response "+status);
					}
				});
			}
			</script>
			<div id="map_canvas" > </div>
		</div>
	</div>
	
	<div class="clr"></div>
	<?php endforeach?>
</div>

<!-- Quick Booking -->
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
							<label for="Available Seats" style="width:300px">Available seat(s) : <span class="a-error"></span></label>
								
							<div class="seat-taken clr"></div>
							<div class="seat-available"></div>
							
							<div class="clr"></div>
						</li>
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
					
					<input type="hidden" name="post_id" value=""/>
					<input type="hidden" name="user_id" value=""/>
					<input type="hidden" name="amount" value=""/>
					<input type="hidden" name="car_model" value=""/>
					<input type="hidden" name="license_plate" value=""/>
					<input type="hidden" name="start_time" value=""/>
				</div>
				<div class="modal-footer">
					<!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
					<input type="submit" name="book_submit" value="Proceed" class="btn-gray"/>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.rateit.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-modal.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-modalmanager.js')?>"></script>
<script type="text/javascript" language="javascript">
function taken_by(checkboxName, image_array){
	var checkBox 	= $('input[name="'+ checkboxName +'"]'),	
		test 		= image_array;
	
	$(checkBox).each(function(i, val){
		$(this).wrap( "<span class='lift-available' style='background: url(\"<?php echo base_url()?>assets/media_uploads/"+$.trim(test[i])+"\")'></span>" );
		if($(this).is(':checked')){
			$(this).parent().addClass("selected");
		} 
	});

	$(checkBox).click(function(){ $(this).parent().toggleClass("selected"); });
}

function check_available(checkboxName){
	var checkBox = $('input[name="'+ checkboxName +'"]');
	$(checkBox).each(function(){
		$(this).wrap( "<span class='lift-available'></span>" );
		if($(this).is(':checked')){
			$(this).parent().addClass("selected");
		}
	});
	$(checkBox).click(function(){
		$(this).parent().toggleClass("selected");
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
		var token = $(this).attr('data-hash');
		
		$('.seat-available, .seat-taken').empty();
		
		$.ajax({
			url		: '<?php echo base_url('lift/quick_book_details')?>',
			type	: 'GET',
			data	: {token : token},
			success	: function(data) {
				$.each($.parseJSON(data), function(index, value) {
					$('input[name="post_id"]').attr('value', value.id);
					$('input[name="user_id"]').attr('value', value.user_id);
					// $('input[name="amount"]').attr('value', value.amount);
					$('input[name="car_model"]').attr('value', value.car);
					$('input[name="license_plate"]').attr('value', value.plate);
					$('input[name="start_time"]').attr('value', value.start_time);
					
					if(value.seats == null) {
						var seat_taken_array = 0;
					} else {
						var seat_taken_array = value.seats.split(",");
					}
					
					if(value.image == null) {
						var image_array = 0;
					} else {
						var	image_array = value.image.split(",");
					}
					
					//To make result array again
					var seat_taken = 0;
					for (var i = 0; i < seat_taken_array.length; i++) {
						seat_taken += seat_taken_array[i] << 0;
					}
					
					var availability = value.available - seat_taken;
					
					//Append base on array total
					for(var i = 0; i < seat_taken; i++) {
						$('.seat-taken').prepend('<label><input type="checkbox" name="taken[]" value="" checked="checked" disabled/></label>');
					}
					
					for(var j = 0; j < availability; j++) {
						$('.seat-available').prepend('<label><input type="checkbox" name="seat[]" value="1" /></label>');
					}
					
					taken_by("taken[]", image_array);
					check_available("seat[]");
					route("request_form");
					
 					/* ====================================
					 * Auto Calculate the amount per seat
					 =================================== */
					var seat_amount = 0;
					
					$('input[name="seat[]"]').click(function() {
						if($(this).is(':checked')) {
							seat_amount += parseInt($(this).val());
						} else {
							seat_amount -= parseInt($(this).val());
						}
						
						$('.total-amount').html('<strong>&euro; '+seat_amount+'</strong>');
						$('input[name="amount"]').attr('value', seat_amount);
					});
					
					/* ======================
					 * Request re-route form
					 ===================== */
					$('input[name="request_form"]').click(function() {
						if($(this).is(':checked')) {
							$('.request_form').slideDown();
						} else {
							$('.request_form').slideUp();
						}
					});
				});
			}
		});
	});
	
	$('input[name="book_submit"]').click(function(e) {
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
			// console.log('You need to check the checkbox');
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
					console.log('success');
					$('#booking').modal('hide');
				}
			});
		} else {
			return false;
		}
		
		e.preventDefault();
	});

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