<?php $this->load->view('header_content')?>
<br /><br /><br />
<div class="profile-sidebar fl">
	<ul>
		<li><a href="<?php echo base_url('members/index')?>">Dashboard</a></li>
		<li><a href="<?php echo base_url('members/edit')?>">Edit Profile</a></li>
		<li><a href="#">Manage Cars</a></li>
		<li><a href="#">Balance</a></li>
		<li><a href="#">Transactions</a></li>
		<li><a href="#">Messages</a></li>
		<li><a href="#">Overview</a></li>
	</ul>
</div>

<style type="text/css">
.error {color:#ff0000;}

.profile-details {margin-left:100px;}
.profile-details ul {list-style:none;}
.profile-details ul li label, .profile-details ul li p {display:block; float:left;}
.profile-detail-information ul li label {width:100px;}

#user-map { margin: 20px auto; border: 1px dashed #C0C0C0; width: 800px; height: 450px; }

.profile-search ul li {float:left;}
.profile-search ul li {float:left;}

.from-suggestion {position:relative;}
.from-suggestion ul {display:none; position:absolute; background:#fff; top:0; left:100px; border:1px solid #000; z-index:2; overflow-y: scroll; height:100px;}
.from-suggestion ul li {float:none; border:1px solid #000;}

.choice-dropdown {position:relative;}
.choice-dropdown ul {display:none; position:absolute;}
.choice-dropdown:hover ul {display:block;}
.choice-dropdown ul li {float:none;}
</style>

<div class="profile-details fl">
	<div class="profile-search">
		<form action="" method="post">
			<ul>
				<li>
					<?php echo form_error('from', '<div class="error">', '</div>')?>
						<div class="clr"></div>
					<label for="From">Search a lift From:</label>
					<input type="text" name="from" id="from-route" />
					
					<div class="from-suggestion">
						<ul>
						</ul>
					</div>
				</li>
				<li>
					<?php echo form_error('to', '<div class="error">', '</div>')?>
						<div class="clr"></div>
					<label for="To">To:</label>
					<input type="text" name="to" id="to-route"/>
				</li>
				<li>
					<label for="Choose">Date:</label>
					
					<input type="text" name="" id="datepicker" />
				</li>
				<li>
					<!--<a href="#" class="chose fl"></a>-->
					<input type="submit" name="ride_submit" value="Ride" class="chose fl"/>
					<!-- 
					<div class="choice-dropdown fl">
						<img src="<?php //echo base_url('assets/images/dropdown.png')?>" width="16" height="16" alt="" />
						
						<ul>
							<li><a href="#">Ride</a></li>
							<li><a href="#">Passenger</a></li>
						</ul>
					</div>
					-->
					
					<div class="clr"></div>
				</li>
			</ul>
			
			<div class="clr"></div>
		</form>
	</div>

	<?php foreach($members_data as $row):?>	
	<div class="profile-detail-information">
		<ul>
			<li>
				<label for="Picture">Picture:</label>
				<p></p>
				
				<div class="clr"></div>
			</li>
			<li>
				<label for="Picture">Profile Text:</label>
				<p></p>
				
				<div class="clr"></div>
			</li>
			<li>
				<?php ?>
				<label for="Name">Name:</label>
				<p><?php echo $row['firstname'].' '.$row['lastname'];?></p>
				
				<div class="clr"></div>
			</li>
			<li>
				<label for="Job">Job:</label>
				<p></p>
				
				<div class="clr"></div>
			</li>
			<li>
				<label for="Address">Address:</label>
				<p><?php echo $row['address_no'].' '.$row['street'].' '.$row['city'].' City, '.$row['country']?></p>
				
				<div class="clr"></div>
			</li>
			<li>
				<label for="Address">Postal Code:</label>
				<p><?php echo $row['postal']?></p>
				
				<div class="clr"></div>
			</li>
			<li>
				<label for="Address">Mobile number:</label>
				<p><?php echo $row['number']?></p>
				
				<div class="clr"></div>
			</li>
		</ul>

		<div id="user-map"></div>
		
		<script type="text/javascript">
		$(function(){
			/*
			 * Google Map
			 */
			$('#user-map').gmap3({
				marker:{
					// address: "Haltern am See, Weseler Str. 151"
					address: "<?php echo 'Tirana '.$row['city'].' City, '.$row['country']?>"
				}, map:{
					options:{
						zoom: 14
					}
				}
			});
			
			/*
			 * Get Route
			 */
			var from_route = $('#from-route'),
				to_route = $('#to-route');
			
			$(from_route).keyup(function(e) {
				e.preventDefault();
				
				if($(from_route).val().length < 4) {
					$('.from-suggestion ul').hide().empty();
				} else {
					$.ajax({
						'url'		: '<?php echo base_url('members/test')?>',
						'type'		: 'GET',
						'data'		: {city: from_route.val()},
						'success'	: function(data) {
							$('.from-suggestion ul').empty();
							$('.from-suggestion ul').show().append(data);
											
							/*
							 * Get Value from Anchor 
							 * and Pass it to input
							 */
							$('.from-suggestion ul li a').click(function() {
								$('#from-route').val($(this).attr('data-city')).keyup();
							});
						}
					});	
				}
			});
			
			$(to_route).keyup(function(e) {
				e.preventDefault();
				
				if($(to_route).val().length < 4) {
					$('.from-suggestion ul').hide().empty();
				} else {
					$.ajax({
						'url'		: '<?php echo base_url('members/test')?>',
						'type'		: 'GET',
						'data'		: {city: to_route.val()},
						'success'	: function(data) {
							$('.from-suggestion ul').empty();
							$('.from-suggestion ul').show().append(data);
											
							/*
							 * Get Value from Anchor 
							 * and Pass it to input
							 */
							$('.from-suggestion ul li a').click(function() {
								$('#to-route').val($(this).attr('data-city')).keyup();
							});
						}
					});	
				}
			});
			
			/* Datepicker */
			$("#datepicker").datepicker();
			
			/* Search Dropdown */
			$('.choice-dropdown ul li a').click(function() {
				var chose = $(this).text();
				// $('.chose').html(chose);
				$('.chose').val(chose);
				
				if(chose === "Ride") {
					$('.chose').attr('name', 'ride_submit');
				} else {
					$('.chose').attr('name', 'passenger_submit');
				}
			});
		});
		</script>
	</div>
	<?php endforeach?>
</div>

<div class="clr"></div>



<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/gmap3.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>