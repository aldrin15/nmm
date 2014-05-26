<?php $this->load->view('header_content')?>
<br /><br /><br />

<style type="text/css">
.error {color:#ff0000;}

.lift-view ul {list-style:none;}
.lift-search ul li, .lift-listing ul li {float:left;}

.lift-listing ul li {border:1px solid #000;}
.lift-listing ul li:hover {border:1px solid #ff0000;}
.lift-listing ul li a {color:#000;}
.lift-listing ul li span {display:block; width:200px;}

.quick-book-popup {display:none;}

.popup-overlay {display:none; background:url('assets/images/overlay.png') repeat; position:absolute; top:0; left:0; width:100%; height:100%;}
.popup-wrapper {position:relative;}
.quick-book-popup {background:#fff; position:absolute; left:50%; margin-left:-250px; width:500px;}

.quick-book-popup {padding:20px;}
.quick-book-popup ul {list-style:none;}
.quick-book-popup ul li {margin-bottom:10px;}
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
				<li>
					<input type="text" name="" id="datepicker"/>
				</li>
				<li>
					<input type="submit" name="ride_submit" value="Search"/>
				</li>
			</ul>
			
			<div class="clr"></div>
		</form>
	</div>
	
	<div class="lift-listing">
		<ul>
			<?php 
			foreach($ride_list as $row):?>
			<li>
				<a href="<?php echo base_url().'lift/detail/'.$row['user_id']?>">
					<div><img src="<?php echo base_url('assets/images/car.jpg')?>" width="180" height="120" alt="Car"/></div>
					<div>
						<label for="From">From</label>
						<span><?php echo $row['route_from']?></span>
					</div>
					<div>
						<label for="To">To</label>
						<span><?php echo $row['route_to']?></span>
					</div>
					<div>
						<label for="Date">Date:</label>
						<span><?php echo date('M d, Y', strtotime($row['date']))?></span>
					</div>
					<div>
						<label for="Amount">Amount:</label>
						<span>&#128;<?php echo $row['amount']?></span>
					</div>
					
<!-- 
					<span><img src="<?php //echo base_url('assets/images/car.jpg')?>" width="180" height="120" alt="Car"/></span>
					<span><strong>From: </strong><?php //echo $row['route_from']?></span>
					<span><strong>To: </strong> <?php //echo $row['route_to']?></span>
					<span><strong>Date: </strong> <?php //echo date('M d, Y', strtotime($row['date']))?></span>
					<span><strong>Amount: </strong> &#128;<?php //echo $row['amount']?></span>
-->
				</a>
				
				<div class="clr"></div><br />
				
				<a href="#" class="quick-book" data-id="<?php echo $row['user_id']?>">Quick Book</a>
			</li>
			<?php endforeach?>
		</ul>	
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
				
				<input type="hidden" name="user_id" value=""/>
				<input type="hidden" name="seat" value=""/>
			</form>
		</div>	
	</div>
</div>


<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
<script type="text/javascript">
$(function() {
	$('#datepicker').datepicker();
	
	$('.quick-book').click(function(e) {
		var user_id = $(this).attr('data-id');
		
		$('.popup-overlay').fadeIn().show();
		$('.quick-book-popup').fadeIn().show();
		$('input[name="user_id"]').attr('value', user_id);
		
		// $(this).closest('li').find('span').text()
		$(this).closest('li').find('span').each(function(index, value) {
			console.log($(value).text());
		});
		
		// console.log($(this).closest('li').find('span').text());
		
		e.preventDefault();
	});
	
	$('.popup-close').click(function() { $('.popup-overlay').hide(); });
	
	$('input[name="book_submit"]').click(function(e) {
		var	user_id = $('input[name="user_id"]').attr('value'),
			seat_taken = 0,
			error = 0;
		
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
				url : '<?php base_url('lift/quick_book')?>',
				data: {
					user_id : user_id,
					seat_taken	: seat_taken
				},
				type: 'POST',
				success: function() {
					console.log('success');
				}
			});
		} else {
			return false;
		}
		
		e.preventDefault();
	});
});
</script>