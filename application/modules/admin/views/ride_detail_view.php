	<?php $this->load->view('includes/header_content')?>

	<?php $this->load->view('includes/sidebar_view')?>
	
	<style type="text/css">
	.info-detail ul li {margin-bottom:10px;}
	.info-detail ul li label {width:150px;}
	
	.fl {float:left;}
	.fr {float:right;}
	.clr {clear:both;}
	
	.ride-passengers {padding-right:40px;}
	.ride-passengers ul li {display:inline-block; margin-right:10px;}
	</style>
	
	<section id="main-content">
		<section class="wrapper">	
			<?php foreach($details as $detail):?>
			<section class="panel">
				<div class="bio-graph-heading"><?php echo $detail['route_from']?> &#10137; <?php echo $detail['route_to']?></div>
				<div class="panel-body bio-graph-info">					
					<div class="row">							
						<div class="info-detail">
							<ul class="fl">
								<li>
									<label for="Driver Name">Driver Name:</label>
									<span><?php echo $detail['firstname'].' '.$detail['lastname']?></span>
								</li>
								<li>
									<label for="Storage">Storage:</label>
									<span><?php echo $detail['storage']?></span>
								</li>
								<li>
									<label for="Available seat(s)">Available seat(s):</label>
									<span><?php echo $detail['available']?></span>
								</li>
								<li>
									<label for="Price/seat">Price/seat:</label>
									<span><?php echo $detail['amount']?></span>
								</li>
								<li>
									<label for="Date & Time">Date & Time:</label>
									<span><?php echo date('F d - H:i A', strtotime($detail['start_time']))?></span>
								</li>
								<li>
									<label for="Remarks">Remarks:</label>
									<span><?php echo ($detail['remarks'] != '') ? $detail['remarks'] : 'No Remarks'?></span>
								</li>
								<li>
									<label for="Mobile">Mobile:</label>
									<span><?php echo ($detail['number'] != '') ? $detail['number'] : 'Not yet added'?></span>
								</li>
								<li>
									<label for="Mobile">Phone:</label>
									<span><?php echo ($detail['phone'] != '') ? $detail['phone'] : 'Not yet added'?></span>
								</li>
							</ul>
							
							<div class="fr ride-passengers">
								<?php $book_by_number = array()?>
								<h4>Passengers:</h4>
								<ul>
									<?php 
									if($passenger_information != ''):
										foreach($passenger_information as $row):?>
										<?php
										$book_by_number[] = $row['user_id'];
										if($row['image'] != ''):?>
										<li><a href="<?php echo base_url('members/profile_view').'/'.$row['user_id']?>"><i></i> <img src="<?php echo base_url('assets/media_uploads').'/'.$row['image']?>" width="80" height="80" alt=""/></a></li>
										<?php else:?>
										<li><a href="<?php echo base_url('members/profile_view').'/'.$row['user_id']?>"><i></i> <img src="<?php echo base_url('assets/images/page_template/blank_profile_large.jpg')?>" width="80" height="80" alt=""/></a></li>
										<?php endif?>
									<?php 
									endforeach;
									endif?>
								</ul>
								
								<?php 
								foreach($lift_information as $row):
									$number_of_seat = $row['available'];
									$number_booked_by = count($book_by_number);
									$result = $number_of_seat - $number_booked_by;
								?>
									<ul>
									<?php for($i = 0; $i < $result; $i++): ?>
										<li><a href="javascript:void(0)" title="Available Seat"><i></i> <img src="<?php echo base_url('assets/images/page_template/blank_image.png')?>" width="80" height="80" alt=""/></a></li>
									<?php endfor?>
									</ul>
								<?php endforeach?>
								
								<div class="clr"></div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<div class="lift-map-location">
				<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
				<style type="text/css">#ride-location {width:100%; height:280px;}</style>
				<script type="text/javascript">
				var directionDisplay, 
					directionsService = new google.maps.DirectionsService(),
					map,
					meter,
					km,
					co2,
					emission = 126.6;

				function initialize() {
					directionsDisplay = new google.maps.DirectionsRenderer({
						suppressMarkers: false
					});
					var myOptions = {
						zoom: 6,
						mapTypeId: google.maps.MapTypeId.ROADMAP,
					}
					map = new google.maps.Map(document.getElementById("ride-location"), myOptions);
					directionsDisplay.setMap(map);
					calcRoute();
				}
			  
				function calcRoute() {
					var request = {
						origin: "<?php echo $detail['route_from']?>", //from
						destination:"<?php echo $detail['route_to']?>", //to
						optimizeWaypoints: true,
						travelMode: google.maps.DirectionsTravelMode.DRIVING
					};
					
					directionsService.route(request, function(response, status) {
						if (status == google.maps.DirectionsStatus.OK) {
							createMarker(response.routes[0].legs[0].via_waypoints[0]);  
							directionsDisplay.setDirections(response);
							meter = response.routes[0].legs[0].distance['value']; 
							calculate_co2();
						} else {
							document.getElementById("ride-location").innerHTML = "Google map cant find your input city.";
						}
					});
				}
				
				function createMarker(latlng) {
				
					var marker = new google.maps.Marker({
						icon:'http://maps.google.com/mapfiles/ms/icons/yellow-dot.png',
						title: '', //you can put the via city
						position: latlng,
						map: map
					});
				}
				
				function calculate_co2(){
					km 	= meter / 1000;
					km 	= roundToTwo(km);
					co2 = km*emission;
					console.log(co2+" = co2 per passenger")
					document.getElementById("save_co2").value = co2;
				}

				function roundToTwo(num) {    
					return Math.ceil(num * 100)/100;
				}
				
				google.maps.event.addDomListener(window, 'load', initialize);
				</script>
				<div id="ride-location"> </div>
			</div>
			<?php endforeach?>
		</section>
	</section>