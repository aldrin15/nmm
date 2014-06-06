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
					<?php if($row['quick_book'] == 1):?>
					<a href="#" class="quick-book fr" data-id="<?php echo $row['id']?>" data-car="<?php echo $row['car']?>" data-plate="<?php echo $row['plate']?>" data-stime="<?php echo $row['start_time']?>">Quick Book</a>
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

$(function() {
	equalHeight($(".column"));
	
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