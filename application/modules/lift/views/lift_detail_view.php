<?php $this->load->view('header_content')?>

<div class="lift-detail-view m-center">
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
					<form action="" method="post" id="rating-form">
						<?php
						$rating_id 		= $row['rating_id'];
						$rating 		= explode(', ', $row['rating']);
						$rating_sum 	= array_sum($rating);
						$rating_count 	= count($rating);
						$rating_data 	= $rating_sum / $rating_count;
						$result 	= number_format($rating_data, 2);
						?>
						<?php if($this->session->userdata('user_id') && $rating_id == NULL):?>
						<div class="Clear">
							<input class="star" type="radio" name="rating" value="1" />
							<input class="star" type="radio" name="rating" value="2" />
							<input class="star" type="radio" name="rating" value="3" />
							<input class="star" type="radio" name="rating" value="4" />
							<input class="star" type="radio" name="rating" value="5" />
							
							<input type="submit" name="rate_submit" value="Rate!"/>
						</div>
						<?php elseif($this->session->userdata('user_id') && $rating_id == 1):?>
						<div>
							<input class="star" type="radio" name="rating" value="1" disabled="disabled" <?php echo ($result==1) ? 'checked="checked"' : ''?>/>
							<input class="star" type="radio" name="rating" value="2" disabled="disabled" <?php echo ($result==2) ? 'checked="checked"' : ''?>/>
							<input class="star" type="radio" name="rating" value="3" disabled="disabled" <?php echo ($result==3) ? 'checked="checked"' : ''?>/>
							<input class="star" type="radio" name="rating" value="4" disabled="disabled" <?php echo ($result==4) ? 'checked="checked"' : ''?>/>
							<input class="star" type="radio" name="rating" value="5" disabled="disabled" <?php echo ($result==5) ? 'checked="checked"' : ''?>/>
						</div>
						<?php else:?>
						<div>
							<input class="star" type="radio" name="rating" value="1" disabled="disabled" <?php echo ($result==1) ? 'checked="checked"' : ''?>/>
							<input class="star" type="radio" name="rating" value="2" disabled="disabled" <?php echo ($result==2) ? 'checked="checked"' : ''?>/>
							<input class="star" type="radio" name="rating" value="3" disabled="disabled" <?php echo ($result==3) ? 'checked="checked"' : ''?>/>
							<input class="star" type="radio" name="rating" value="4" disabled="disabled" <?php echo ($result==4) ? 'checked="checked"' : ''?>/>
							<input class="star" type="radio" name="rating" value="5" disabled="disabled" <?php echo ($result==5) ? 'checked="checked"' : ''?>/>
						</div>					
						<?php endif;?>
						
						<div class="clr"></div>					
					</form>
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
					<label for="Price">Price</label>
					<span>: &#128;<?php echo $row['amount']?></span>
				
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
						$p_data = explode(', ', $p_id);
						
						for($i = 0; $i < count($p_data); $i++):
							echo '<li>'.$p_data[$i].'</li>';
						endfor;
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
			<p>more seat(s) available</p>
		</div>
		<div class="lift-price"></div>
		<div class="lift-book-btn"></div>
		<div class="lift-map-location"></div>
	</div>
	
	<div class="clr"></div>
	<?php endforeach?>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/rating.js')?>"></script>
<script type="text/javascript" language="javascript">
$(function(){ 
	$('#rating-form :radio.star').rating(); 
	
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