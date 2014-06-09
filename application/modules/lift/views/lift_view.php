<?php $this->load->view('header_content')?>

<div class="m-center lift-view">
	<?php echo modules::run('lift/search')?>
	
	<p class="lift-text">Upcoming lift near you:</p>
	
	<div class="lift-listing fl">
		<?php if($ride_list == 0):?>
			<div style="font-size:26px; font-weight:bold; border:1px solid #000; text-align:center; margin-top:10px; padding:20px; width:1024px;">No records found</div>
		<?php else:?>
			<ul>
				<?php 
				foreach($ride_list as $row):?>
				<li class="column">
					<p><?php echo $row['firstname'].' '.$row['lastname']?></p>
					<a href="<?php echo base_url().'lift/detail/'.$row['id']?>">
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
						<span><?php echo date('g A', strtotime($row['start_time']))?></span>
						
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
					
					<div class="clr"></div>
					<?php $available = $row['available'] - $row['seat']?>
					<?php if($row['quick_book'] == 1 && $available !== 0):
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
					<a href="#" class="quick-book fr" data-toggle="modal" data-target="#quick_booking" data-hash="<?php echo $hash?>">Quick Book</a>
					<?php endif?>
				</li>
				<?php endforeach?>
			</ul>	
		<?php endif?>
		
		<div class="clr"></div>
	</div>
	
	<div class="ads fr">
		<img src="<?php echo base_url('assets/images/page_template/ads.jpg')?>" width="120" height="240" alt=""/>
	</div>
	
	<div class="clr"></div>
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


<!-- 
<div class="success-overlay">
	<div class="popup-wrapper">
		<div class="booking-success-popup"><a href="#" class="success-close">Close</a> You have successfully booked. Please wait for the driver confirmation within 24 hours.</div>
	</div>
</div>
-->


<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-modal.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-modalmanager.js')?>"></script>
<script type="text/javascript">
function equalHeight(group) {
   tallest = 0;
   group.each(function() {
      thisHeight = $(this).height();
      if(thisHeight > tallest) {
         tallest = thisHeight;
      }
   });
   group.height(tallest);
}

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

$(function() {
	equalHeight($(".column")); //Equal Height
	
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
	
	
	/*
	 * Auto Calculate the amount per seat
	 */
	var seat_amount = 0;
	
	$('input[name="seat[]"]').click(function() {
		seat_amount += parseInt($(this).val());
		
		$('.total-amount').html('<strong>&euro; '+seat_amount+'</strong>');
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
			console.log('You need to check the checkbox');
			error = 1;
		}
		
		$("input[name='seat[]']:checked").each(function (index, number) {
			seat_taken = seat_taken + parseFloat($(number).val());
		});
		
		$('input[name="seat"]').attr('value', seat_taken);
		
		if(error === 0) {
			$.ajax({
				url : '<?php echo base_url('lift/quick_book')?>',
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
					$('.popup-overlay').hide();
					$('.success-overlay').show();
				}
			});
		} else {
			return false;
		}
		
		e.preventDefault();
	});
});
</script>