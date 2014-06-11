<?php $this->load->view('header_content')?>

<div class="detail m-center">
	<?php foreach($lift_information as $row):?>
	<div class="fl">
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
					<span>: <?php echo $row['car']?></span>
					<span class="car-image"><img src="" alt=""/></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="License">License Plate</label>
					<span>: ABC 1234</span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Storage">Storage</label>
					<span>: <?php echo $row['storage']?></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Preference">Preference</label>
					<ul>
						<?php 
						$p_id 	= $row['p_id'];
						
						if($p_id == 0):
							echo '<li>: None</li>';
						else:						
							$p_data = explode(', ', $p_id);
							
							for($i = 0; $i < count($p_data); $i++):
								echo '<li>'.$p_data[$i].'</li>';
							endfor;
						endif;
						?>
					</ul>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Remarks">Remarks</label>
					<span>: Come ride with me and lets have a fun trip.</span>
					
					<div class="clr"></div>
				</li>
			</ul>
		
		</div>
	</div>
		
	<div class="other-info fr">
		<div class="social-share"></div>
		<div class="lift-seat-available">
			<?php 
			$seat_taken = explode(',', $row['seats']);
			$available = $row['available'] - array_sum($seat_taken);
			?>
			<p><?php echo $available?> more seat(s) available</p>
			
			<ul>
				<?php 
				$seat_taken_array = explode(', ', $row['seats']);
				
				for($i = 0; $i < count($seat_taken_array); $i++):
					echo '<li><img src="'.base_url('assets/images/user_image.jpg').'" width="65" height="66" alt=""/></li>';
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
			<a href="#" class="btn-gray" data-toggle="modal" data-target="#quick_booking" data-hash="<?php echo $hash?>">Start Booking</a>
			<?php endif?>
		</div>
		<div class="lift-map-location"></div>
	</div>
	
	<div class="clr"></div>
	<?php endforeach?>
</div>

<!-- Quick Booking -->
<div class="modal fade" id="quick_booking" tabindex="-1" role="dialog" aria-hidden="true" style="display:none;" data-width="430">
	<div class="modal-dialog">
		<form action="" method="post">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					&nbsp;
				</div>
				<div class="modal-body">
					<ul>
						<li>
							<label for="Available Seats">Available seat(s) :</label>
								
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
							<textarea name="message" id="" cols="30" rows="10"></textarea>
						</li>
						<li>
							<label for="Request">Request reroute:</label>
							<input type="checkbox" name="request_form" id=""/>
						</li>
						<li class="request_form" style="display:none;">
							<label for="From">From</label>
							<input type="text" name="re_origin" id="from-route"/>
								
								<div class="clr"></div>
							
							<label for="To">To</label>
							<input type="text" name="re_destination" id="to-route"/>
							
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
		$(this).wrap( "<span class='custom-checkbox' style='background: url(\"<?php echo base_url()?>assets/media_uploads/"+$.trim(test[i])+"\")'></span>" );
		if($(this).is(':checked')){
			$(this).parent().addClass("selected");
		} 
	});

	$(checkBox).click(function(){ $(this).parent().toggleClass("selected"); });
}

function check_available(checkboxName){
	var checkBox = $('input[name="'+ checkboxName +'"]');
	$(checkBox).each(function(){
		$(this).wrap( "<span class='custom-checkbox'></span>" );
		if($(this).is(':checked')){
			$(this).parent().addClass("selected");
		}
	});
	$(checkBox).click(function(){
		$(this).parent().toggleClass("selected");
	});
}

$(function(){ 
	$('#user-rating :radio.star').rating();
	
	$('.book-now').click(function() {
		var token = $(this).attr('data-hash');

		$.ajax({
			url		: '<?php echo base_url('lift/quick_book_details')?>',
			type	: 'GET',
			data	: {token : token},
			success	: function(data) {
				$.each($.parseJSON(data), function(index, value) {
					$('input[name="post_id"]').attr('value', value.id);
					$('input[name="user_id"]').attr('value', value.user_id);
					$('input[name="amount"]').attr('value', value.amount);
					$('input[name="car_model"]').attr('value', value.car);
					$('input[name="license_plate"]').attr('value', value.plate);
					$('input[name="start_time"]').attr('value', value.start_time);
					
					var seat_taken_array 		= value.seats.split(","),
						image_array 			= value.image.split(",");
					
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
				});			
			}
		});
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
	
	/*
	 * Request re-route form
	 */
	$('input[name="request_form"]').click(function() {
		if($(this).is(':checked')) {
			$('.request_form').slideDown();
		} else {
			$('.request_form').slideUp();
		}
	});
});
</script>