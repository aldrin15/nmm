<?php $this->load->view('header_content')?>

<div class="profile-wrapper m-center-content">
	<?php echo modules::run('lift/search')?>
	
	<?php $this->load->view('member_sidebar_view')?>
	
	<div class="fl overview-detail">
		<?php foreach($ride_detail_data as $row):?>
			<h4><?php echo $row['origins']?> to <?php echo $row['destination']?></h4>
			<h5><strong>Via:</strong> <?php echo $row['via']?></h5>
			<hr/>
			<ul>
				<li>
					<label for="Date and Time">Date and Time:</label> 
					<span><?php echo date('H:i A', strtotime($row['start_time']))?></span>
				</li>
				<li>
					<label for="Storage">Storage: </label>
					<span><?php echo $row['storage']?></span>
				</li>
				<li>
					<label for="Available">Available: </label>
					<span><?php echo $row['available']?></span>
				</li>
				<li>
					<label for="Amount">Amount: </label>
					<span><?php echo $row['amount']?></span>
				</li>
				<li>
					<label for="Remarks">Remarks: </label>
					<span><?php echo $row['remarks']?></span>
				</li>
				<li>
					<label for="Offer re-route">Offer re-route: </label>
					<span><?php echo ($row['re_route'] != 0) ? "Yes" : "No"?></span>
				</li>
			</ul>
			<?php echo modules::run('lift/auto_suggest_city')?>
			<div class="lift-map-location">
				<style type="text/css">#ride-location {width:100%; height:280px;}</style>
				<script type="text/javascript">
				var directionDisplay;
				var directionsService = new google.maps.DirectionsService();
				var map;

				function initialize_map() {
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
						origin: "<?php echo $row['origins']?>", //from
						destination:"<?php echo $row['destination']?>", //to
						optimizeWaypoints: true,
						travelMode: google.maps.DirectionsTravelMode.DRIVING
					};
					
					directionsService.route(request, function(response, status) {
						if (status == google.maps.DirectionsStatus.OK) {
							createMarker(response.routes[0].legs[0].via_waypoints[0]);  
							directionsDisplay.setDirections(response);
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
				
				google.maps.event.addDomListener(window, 'load', initialize_map);
				</script>
				<div id="ride-location"> </div>
			</div>
		<?php endforeach?>	
	</div>
	
	<div class="clr"></div>
</div>