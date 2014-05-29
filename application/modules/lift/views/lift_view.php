<?php $this->load->view('header_content')?>
<br /><br /><br />

<style type="text/css">
.error {color:#ff0000;}

.lift-view ul {list-style:none;}
.lift-search ul li, .lift-listing ul li {float:left;}

.lift-listing ul li {border:1px solid #000;}
.lift-listing ul li:hover {border:1px solid #ff0000;}
.lift-listing ul li a {color:#000;}
.lift-listing ul li span {display:block;}
.lift-listing ul li span, .lift-listing ul li label {float:left}

.quick-book-popup {display:none;}

.popup-overlay {display:none; background:url('assets/images/overlay.png') repeat; position:absolute; top:0; left:0; width:100%; height:100%;}
.popup-wrapper {position:relative;}
.quick-book-popup {background:#fff; position:absolute; left:50%; margin-left:-250px; padding:20px; width:500px;}

.quick-book {background:#ff0000;}
.quick-book-popup ul {list-style:none;}
.quick-book-popup ul li {margin-bottom:10px;}

.success-overlay {display:none; background:url('assets/images/overlay.png') repeat; position:absolute; top:0; left:0; width:100%; height:100%;}
.booking-success-popup {background:#fff; position:absolute; text-align:center; left:50%; margin-top:10%; margin-left:-250px; padding:20px; width:500px;}
</style>

<div class="lift-view">
	<div class="lift-search">
		<form action="" method="post">
			<ul>
				<li>
					<?php echo form_error('from', '<div class="error">', '</div>')?>
					<label for="From">From: </label>
					<input type="text" name="from" id=""/>
				</li>
				<li>
					<?php echo form_error('to', '<div class="error">', '</div>')?>
					<label for="To">To: </label>
					<input type="text" name="to" id=""/>
				</li>
				<!-- 
				<li>
					<input type="text" name="date" id="datepicker"/>
				</li>
				-->
				<li>
					<input type="submit" name="ride_submit" value="Search"/>
				</li>
			</ul>
			
			<div class="clr"></div>
		</form>
	</div>
	
	<div class="lift-listing">
		<?php if($ride_list == 0):?>
			<div style="font-size:26px; font-weight:bold; border:1px solid #000; text-align:center; margin-top:10px; padding:20px; width:1024px;">No records found</div>
		<?php else:?>
			<ul>
				<?php 
				foreach($ride_list as $row):?>
				<li>
					<a href="<?php echo base_url().'lift/detail/'.$row['id']?>">
						<div><img src="<?php echo base_url('assets/images/car.jpg')?>" width="180" height="120" alt="Car"/></div>
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
							<label for="Date"><strong>On &nbsp;</strong></label>
							<span><?php echo date('M d', strtotime($row['date']))?></span>
							<label for="at">&nbsp;<strong>at</strong>&nbsp;</label>
							<span><?php echo date('g A', strtotime($row['start_time']))?></span>
							
							<div class="clr"></div>
						</div>
						<div>
							<label for="Available Seats"><strong>Available Seat/s:</strong>&nbsp;</label>
							<span><?php echo $row['available']?></span>
							
							<div class="clr"></div>
						</div>
						<div>
							<label for="">&#128; </label>
							<span><?php echo $row['amount']?></span>
							
							<div class="clr"></div>
						</div>					
					</a>
					
					<div class="clr"></div><br />
					<?php if($row['quick_book'] == 1):?>
					<a href="#" class="quick-book" data-id="<?php echo $row['id']?>" data-car="<?php echo $row['car']?>" data-plate="<?php echo $row['plate']?>" data-stime="<?php echo $row['start_time']?>">Quick Book</a>
					<?php endif?>
				</li>
				<?php endforeach?>
			</ul>	
		<?php endif?>
	</div>
</div>

<div class="popup-overlay">
	<div class="popup-wrapper">
		<div class="quick-book-popup">
			<a href="#" class="popup-close">Close</a>
			<form action="" method="post">
				<ul>
					<li>
						<label for="Available Seats">Available Seats</label>
						
						<div>
							<span>Seat 1<input type="checkbox" name="seat[]" value="1" id=""/></span>
							<span>Seat 2<input type="checkbox" name="seat[]" value="1" id=""/></span>
							<span>Seat 3<input type="checkbox" name="seat[]" value="1" id=""/></span>
							<span>Seat 4<input type="checkbox" name="seat[]" value="1" id=""/></span>
							<span>Seat 5<input type="checkbox" name="seat[]" value="1" id=""/></span>
						</div>
					</li>
					<li>
						<label for="Message">Message</label>
						<textarea name="message" id="" cols="30" rows="10"></textarea>
					</li>
					<li>
						<label for="Request">Request Route</label>
						<textarea name="request" id="" cols="30" rows="10"></textarea>
					</li>
					<li><input type="submit" name="book_submit" value="Proceed"/></li>
				</ul>
				
				<div class="lift-view-data">
				</div>
				<input type="hidden" name="user_id" value=""/>
				<input type="hidden" name="seat" value=""/>
				<input type="hidden" name="car_model" value=""/>
				<input type="hidden" name="license_plate" value=""/>
				<input type="hidden" name="start_time" value=""/>
				<input type="hidden" name="end_time" value=""/>
			</form>
		</div>	
	</div>
</div>

<div class="success-overlay">
	<div class="popup-wrapper">
		<div class="booking-success-popup"><a href="#" class="success-close">Close</a> You have successfully booked. Please wait for the driver confirmation within 24 hours.</div>
	</div>
</div>


<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
<script type="text/javascript">
$(function() {
	$('#datepicker').datepicker({ dateFormat: 'yy-mm-dd' });
	
	$('.quick-book').click(function(e) {
		var user_id 	= $(this).attr('data-id'),
			car_model 	= $(this).attr('data-car'),
			plate 		= $(this).attr('data-plate'),
			start_time	= $(this).attr('data-stime'),
			end_time	= $(this).attr('data-etime');
			
		$('.lift-view-data').empty();
		$('textarea').val(' ');
		$('input[name="seat[]"]').removeAttr('checked');
		
		$('.popup-overlay').fadeIn().show();
		$('.quick-book-popup').fadeIn().show();
		$('input[name="user_id"]').attr('value', user_id);
		$('input[name="car_model"]').attr('value', car_model);
		$('input[name="license_plate"]').attr('value', plate);
		$('input[name="start_time"]').attr('value', start_time);
		$('input[name="end_time"]').attr('value', end_time);
		
		$(this).closest('li').find('span').each(function(index, value) {
			$('.lift-view-data').append('<input type="hidden" value="'+$(value).text()+'" class="lift-info'+index+'"/>');
		});
		
		e.preventDefault();
	});
	
	/*
	 * Close Popup
	 */
	$('.popup-close').click(function() { $('.popup-overlay').hide(); });
	$('.success-close').on('click', function(e) { 
		$('.success-overlay').hide();
		
		e.preventDefault();
	});
	
	$('input[name="book_submit"]').click(function(e) {
		var	user_id 	= $('input[name="user_id"]').attr('value'),
			from 		= $('.lift-info0').val(),
			to			= $('.lift-info1').val(),
			car_model	= $('input[name="car_model"]').attr('value'),
			plate 		= $('input[name="license_plate"]').attr('value'),
			seat_taken 	= 0,
			amount		= $('.lift-info5').val(),
			message		= $('textarea[name="message"]').val(),
			request		= $('textarea[name="request"]').val(),
			start_time	= $('input[name="start_time"]').val(),
			end_time	= $('input[name="end_time"]').val(),
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
					from		: from,
					to			: to,
					car_model	: car_model,
					plate		: plate,
					message		: message,
					request		: request,
					amount		: amount,
					seat_taken	: seat_taken,
					start_time	: start_time,
					end_time	: end_time,
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