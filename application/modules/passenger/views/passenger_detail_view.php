<?php $this->load->view('header_content')?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/mdp.css')?>"/>
<style type="text/css">
.passenger-detail-information .fl h3 span {color:#678222;}
.passenger-detail-information .fl h3 {line-height: .5em;}

.passenger-user {border:1px solid #dfdede; border-radius:5px; -webkit-border-radius:5px; -moz-border-radius:5px; -ms-border-radius:5px; padding:10px;}
.p-u-heading {margin-bottom:10px;}
.passenger-profile-img {margin-right:10px;}
.passenger-profile-img img {border-radius: 7px;}

.passenger-info {font-size:1.4em;}
.passenger-info ul li {margin-bottom:5px;}

.send-message-to {
	float:left;
	display:block;
	background-image: -ms-linear-gradient(top, #FFFFFF 0%, #E0E0E0 100%); /* IE10 Consumer Preview */
	background-image: -moz-linear-gradient(top, #FFFFFF 0%, #E0E0E0 100%); /* Mozilla Firefox */
	background-image: -o-linear-gradient(top, #FFFFFF 0%, #E0E0E0 100%); /* Opera */
	background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #FFFFFF), color-stop(1, #E0E0E0)); /* Webkit (Safari/Chrome 10) */ 
	background-image: -webkit-linear-gradient(top, #FFFFFF 0%, #E0E0E0 100%); /* Webkit (Chrome 11+) */ 
	background-image: linear-gradient(to bottom, #FFFFFF 0%, #E0E0E0 100%); /* W3C Markup, IE10 Release Preview */ 
	color:#333;
	border:1px solid #ccc;
	border-radius:4px;
	-webkit-border-radius:4px;
	-moz-border-radius:4px;
	-ms-border-radius:4px;
	margin-right:10px;
	padding:4px 12px;
	width:135px;
}
.send-message-to:hover {border:1px solid #adadad; text-decoration:none;}

.passenger-message textarea {resize:none;}
</style>

<?php foreach($wish_lift_detail as $row):?>
<div class="passenger-detail-information m-center-content">
	<div class="span6 fl">
		<h3>From: <span><?php echo $row['origin']?></span></h3>
		<h3>To: <span><?php echo $row['destination']?></span></h3>

		<div class="passenger-user">
			<p class="p-u-heading">Passenger:</p>
			
			<div class="passenger-profile-img fl"><img src="<?php echo base_url('assets/media_uploads').'/'.$row['image']?>" width="160" height="160" alt="Car"/></div>
			
			<div class="passenger-info fl">
				<ul>
					<li class="passenger-name"><?php echo $row['firstname'].' '.$row['lastname']?></li>
					<li>
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
					</li>
					<li class="passenger-last-login">
						<span>Last login: <?php echo date('M d, Y H:i', strtotime($row['last_login']))?></span>
					</li>
					<li class="user-contacts">
						<p>Email phone shown after booking confirmed</p>
					</li>
					<li class="passenger-message">
						<a href="#" class="send-message-to" data-toggle="modal" data-target="#message" data-id="<?php echo $row['user_id']?>">Send message</a>
						
						<select name="passenger-action" class="selectpicker select-width-auto">
							<option>- Invite Me / Create Lift -</option>
							<option data-id="<?php echo $row['id']?>">Invite Me</option>
							<option>Create Lift</option>
						</select>
					</li>
				</ul>
				
				<div class="report-user"></div>
			</div>
			
			<div class="clr"></div>
		</div>
		
		<div class="lift-information">
			<ul>
				<li>
					<label for="">What Time:</label>
					<span><?php echo date('H:i', strtotime($row['time']))?></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Seat">Seat(s) needed</label>
					<span><?php echo $row['available']?></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Storage">Storage</label>
					<span><?php echo $row['storage']?></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Preference">Preference</label>
					
					<div>
						<div class="lift-preference">
							<?php 
							$preference_array = array();
							$preference_type_array = array();

							foreach($preference_data as $preference):
								$preference_array[] 		= $preference['preference'];
								$preference_type_array[]	= $preference['type'];
							endforeach;
							
							$implode = implode(',', $preference_array);
							$explode = explode(',', $implode);
							
							$implode2 = implode(',', $preference_type_array);
							$explode2 = explode(',', $implode2);
							
							if($explode !== 0):
								for($i = 0; $i < count($explode); $i++):
									$num = $i + 1;
									echo '<div class="fl checkbox-'.$num.' selected"><p>'.$explode2[$i].'<i></i></p></div>';
								endfor;
							else:
								echo '<div>: None</div>';
							endif;
							?>
						</div>
					</div>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Remarks">Remarks</label>
					<span><?php echo $row['remarks']?></span>
					
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
					<li>No Posted Date</li>
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
				
				if(month_today != get_month) {
					$('.pcal-body ul').html('<li style="text-align:center;">No Posted Date</li>');
				} else if(month_today == get_month) {
					$('.pcal-body ul').append('<li>'+value+'</li>');
				}
			});
		}
		$(window).load(function() {
			var months 	= {1:'January', 2:'February', 3:'March', 4:'April', 5:'May', 6:'June', 7:'July', 8:'August', 9:'September', 10:'October', 11:'November', 12:'December'},
				prev	= 0,
				date	= new Date(),
				next	= date.getMonth();
				
			var events = [<?php for($i = 0; $i < count($other_dates_array); $i++):
				echo '"'.$other_dates_array[$i].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; from '.$other_origin_array[$i].' to '.$other_destination_array[$i].'",';
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
		<div class="passenger-map-location">
			<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
			<style type="text/css">#map_canvas {margin-top:30px; width:370px; height:280px;}</style>
			<script type="text/javascript">
			$(window).load(function() {
				initialize();
			});
			
			var directionDisplay;
			var directionsService = new google.maps.DirectionsService();
			var map;

			function initialize() {
				directionsDisplay = new google.maps.DirectionsRenderer();
				
				var myOptions = {
					zoom: 6,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				}
				map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
				directionsDisplay.setMap(map);
				
				calcRoute();
			}

			function calcRoute() {
				var request = {
					// origin: "Pasay, Philippines", //from
					origin: "<?php echo $row['origin']?>", //from
					destination: "<?php echo $row['destination']?>",//to
					waypoints: [{
						location: "Makati, Philippines",//via
						stopover:false
					}],
					optimizeWaypoints: true,
					travelMode: google.maps.DirectionsTravelMode.DRIVING
				};
				directionsService.route(request, function(response, status) {
					if (status == google.maps.DirectionsStatus.OK) {
						directionsDisplay.setDirections(response);
					} else {
						alert("directions response "+status);
					}
				});
			}
			</script>
			<div id="map_canvas" > </div>
		</div>
	</div>
	
	<div class="clr"></div>
</div>

<div class="modal fade passenger-message" id="message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="" method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">To: <span id="passenger-name"></span></h4>
				</div>
				<div class="modal-body">
					<ul>
						<li>
							<label for="Subject">Subject</label>
							<input type="text" name="subject" id="" class="form-control"/>
						</li>
						<li>
							<label for="Message">Message</label>
							<textarea name="message" id="" cols="30" rows="10" class="form-control"></textarea>
						</li>
					</ul>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="user_id" value=""/>
					<input type="hidden" name="email" value=""/>
					<input type="submit" name="submit_message" value="Send Message" class="btn btn-default"/>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Quick Booking -->
<div class="modal fade" id="invite_lift" tabindex="-1" role="dialog" aria-hidden="true" style="display:none;">
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
							<div id="available-dates"></div>
						</li>
						<li>
							<label for="Price">Price of per seat(s)</label>
							<input type="text" name="price" id="" class="form-control"/>
						</li>
						<li>
							<label for="Remarks">Remarks</label>
							<textarea name="remarks" id="" cols="30" rows="10" class="form-control" style="resize:none;"></textarea>
						</li>
					</ul>
				</div>
				<div class="modal-footer">
					<input type="submit" name="book_submit" value="Invite Lift" class="btn btn-default"/>
				</div>
			</form>
		</div>
	</div>
</div>

<?php endforeach?>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.7.2.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.rateit.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-select.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-modal.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-modalmanager.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.ui.core.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.ui.datepicker.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.multidatespicker.js')?>"></script>
<script type="text/javascript">
$(function() {
	$('.lift-preference div').mouseover(function() { $('p', this).stop(true, true).fadeIn().css({display:'block'}); });
	$('.lift-preference div').mouseleave(function() { $('p', this).fadeOut(); });	

	//For Customize Select option
	$('.selectpicker').selectpicker();
	
	$('.send-message-to').click(function() {
		var id = $(this).attr('data-id');
		
		$.ajax({
			url		: '<?php echo base_url('passenger/detail_user')?>',
			type	: 'GET',
			data	: {id:id},
			success: function(data) {
				var passenger = $.parseJSON(data);
				
				$('#passenger-name').html(passenger[0]['firstname'] +' '+ passenger[0]['lastname']);
				$('input[name="user_id"]').attr('value', passenger[0]['user_id']);
				$('input[name="email"]').attr('value', passenger[0]['email']);
			}
		});
	});
	
	$('input[name="submit_message"]').click(function(e) {
		e.preventDefault();
		var id 		= $('input[name="user_id"]').val();
			email 	= $('input[name="email"]').val(),
			subject = $('input[name="subject"]').val(),
			message = $('textarea[name="message"]').val();
		
		$.ajax({
			url		: '<?php echo base_url('passenger/send')?>',
			type	: 'POST',
			data	: {user_id:id, subject:subject, message:message},
			success	: function(data) {
				$('.modal-content').html('<div class="success-message"><p>You have successfully sent your message</p></div>');
			}
		});
	});
	
	$('select[name="passenger-action"]').change(function() {
		var choices = $(this).val();
		
		// console.log($(this).val());
		
		if(choices == 'Invite Me') {
			var authenticated = '<?php echo $this->session->userdata('validated')?>';
			
			if(authenticated == 1) {
				$('#invite_lift').modal({dynamic:true});
			} else {
				window.location.href = "<?php echo base_url('login')?>";
			}
			
			// var test = $(this).find('option:selected').attr('data-id')
			
			$.ajax({
				url 	: '<?php echo base_url('login/is_logged_in')?>',
				success : function(data) {
					// console.log(data);
				}
			});
		}
		
		if(choices == 'Create Lift') {
			//Data
		}
	});
	
	var dateArray = ["2014-6-21", "2014-6-23", "2014-6-24"];
	
	function date_array(date) {
		var fulldate = date.getFullYear()+'-'+(date.getMonth()+1)+'-'+date.getDate();
		
		return ($.inArray(fulldate, dateArray) > -1 ? [true, ''] : [false, '']);
	}
	
	$('#available-dates').multiDatesPicker({
		minDate: '0',
		beforeShowDay : date_array
	});
});
</script>