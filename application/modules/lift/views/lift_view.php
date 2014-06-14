<?php $this->load->view('header_content')?>

<div class="m-center lift-view">
	<?php echo modules::run('lift/search')?>
	
	<!--<p class="lift-text">Upcoming lift near you:</p>-->
	<h3>Upcoming lift near you:</h3><br />
	
	<div class="lift-listing fl">
		<?php if($ride_list == 0):?>
			<div style="font-size:1.2em; font-weight:bold; border:1px solid #000; text-align:center; margin-top:10px; padding:20px; width:850px;"><p>There are no route that match your criteria. Try some different places</p></div>
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
<?php echo modules::run('lift/auto_suggest_city')?>
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
	equalHeight($(".column")); //Equal Height
});
</script>