<?php $this->load->view('header_content')?>

<div class="detail m-center">
	<?php foreach($wish_lift_detail as $row):?>
	<div class="fl">
		<h4>From: <span><?php echo $row['origin']?></span></h4>
		<h4>To: <span><?php echo $row['destination']?></span></h4>
		<h5>Via <span>Road</span></h4>

		<div class="user-information">
			<p>Passenger:</p>
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
					$result 		= number_format($rating_data, 2);
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
				<div class="user-send-message">
					<a href="#" class="btn-gray">Send message</a>
					
					<select class="selectpicker select-width-auto">
						<option>Invite Me</option>
						<option>Create Lift</option>
					</select>
				</div>
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
					
					<div>
						<span>:</span>
						<ul>
							<?php 
							$p_id 	= $row['p_id'];
							
							if($p_id == 0):
								echo '<li>: None</li>';
							else:						
								$p_data = explode(', ', $p_id);
								
								for($i = 0; $i < count($p_data); $i++):
									echo '<li class="fl preference'.$p_data[$i].'">'.$p_data[$i].'</li>';
								endfor;
							endif;
							?>
						</ul>
					</div>
					
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
	
	<div class="fr">
		<div id="passenger-calendar">
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
		function get_data(events, month_today) {
			$.each(events, function(index, value) {
				var get_month = value.substring(5, 7);
				
				console.log(get_month);
				
				if(month_today == get_month) {
					$('.pcal-body ul').append('<li>'+value+'</li>');
				}
			});
		}
		$(window).load(function() {
			var months 	= {1:'January', 2:'February', 3:'March', 4:'April', 5:'May', 6:'June', 7:'July', 8:'August', 9:'September', 10:'October', 11:'November', 12:'December'},
				prev	= 0,
				date	= new Date(),
				next	= date.getMonth();
			
			// var events = ["05-30-14 - From Heidelberg To Berlin", "05-31-14 - From Munich To Berlin", "06-30-14 - From Munich To Berlin",];
			var events = [<?php for($i = 0; $i < count($other_dates_array); $i++):
				echo '"'.$other_dates_array[$i].' from '.$other_origin_array[$i].' to '.$other_destination_array[$i].'",';
			endfor;?>];
		
			$('.pcal-month').html(months[next]);
			
			get_data(events, next);  //Get Data
			
			$('.next').click(function() {
				if(next < 11) {
					next++ + 1;
					
					$('.pcal-month').html(months[next]);
					
					$('.pcal-body ul').empty()
					
					get_data(events, next); //Get Data
				} else {
					next = 0;
					
					$('.pcal-month').html(months[next]);
				}
			});
			
			$('.prev').click(function() {
				next--;
				
				$('.pcal-month').html(months[next]);
				
				$('.pcal-body ul').empty();
				
				get_data(events, next);
				
				if(next < 1) {
					next = 12;
					
					$('.pcal-month').html(months[next]);
				}
				
			});
		});
		</script>
	</div>
	<?php endforeach?>
	
	<div class="clr"></div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.rateit.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-select.js')?>"></script>
<script type="text/javascript">
$(function() {
	//For Customize Select option
	$('.selectpicker').selectpicker();
});
</script>