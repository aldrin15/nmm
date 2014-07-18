<?php $this->load->view('header_content')?>

<style type="text/css">
.overview-detail {margin-left:10px; width:80%;}
.overview-detail ul li label {font-weight:bold; width:100px;}
</style>

<div class="m-center-content">
	<?php echo modules::run('lift/search')?>
	
	<?php $this->load->view('member_sidebar_view')?>
	
	<div class="fl overview-detail">
		<?php foreach($ride_detail_data as $row):?>
			<h4><?php echo $row['origins']?> to <?php echo $row['destination']?></h4>
			<h5><?php echo $row['via']?></h5>
		
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
			
			<div class="lift-map-location">
				<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
				<style type="text/css">
				#ride-location {width:100%; height:280px;}
				
				/*#ride-location p, #ride-location i {display:inline-block; font-size:3em; vertical-align:text-bottom;}*/
				/*#ride-location i {background:url('<?php echo base_url('assets/images/gmap_marker.png')?>') no-repeat; width:49px; height:77px;}*/
				</style>
				<script type="text/javascript">
				var directionDisplay;
				var directionsService = new google.maps.DirectionsService();
				var map;

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
				google.maps.event.addDomListener(window, 'load', initialize);
				</script>
				<div id="ride-location"> </div>
			</div>
		<?php endforeach?>	
	</div>
	
	<div class="clr"></div>
</div>