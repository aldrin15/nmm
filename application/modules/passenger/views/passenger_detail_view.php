<?php $this->load->view('header_content')?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/mdp.css')?>"/>
<style type="text/css">
.s-l-header span {display:block; float:left; padding:5px 0;}
.s-l-body span {display:block; float:left; padding:5px 0;}
.s-l-body div:nth-child(even) {background:#f5f5f5;}
.s-l-body div span:first-child {text-align:center;}

.pcal-body ul li a {color:#000;}
.pcal-body ul li a:hover {text-decoration:none;}
</style>

<?php foreach($wish_lift_detail as $row):?>
<div class="passenger-detail-information m-center-content">
	<div class="span6 fl">
		<h3>From: <span><?php echo $row['origin']?></span></h3>
		<h3>To: <span><?php echo $row['destination']?></span></h3>

		<div class="passenger-user">
			<p class="p-u-heading">Passenger:</p>
			
			<div class="passenger-profile-img fl"><img src="<?php echo ($row['image'] != '') ? base_url('assets/media_uploads').'/'.$row['image'] : base_url('assets/images/page_template/blank_profile_large.jpg')?>" width="160" height="160" alt="Car"/></div>
			
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
						<?php if($row['user_id'] != $this->session->userdata('user_id')):?>
						<select name="passenger-action" class="selectpicker select-width-auto">
							<option>- Invite Me / Create Lift -</option>
							<option data-id="<?php echo $row['id']?>">Invite Me</option>
							<option data-id="<?php echo $row['id']?>">Create Lift</option>
						</select>
						<?php endif?>
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
					<span><?php echo date('H:i A', strtotime($row['start_time']))?></span>
					
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
					
					<div class="lift-preference">
						<?php 
						$preference = explode(',', $row['preference']);
						$preference_type = array();
						
						foreach($preference_data as $type):
							$preference_type[] = $type;
						endforeach;
						
						if($preference !== 0):
							for($i = 0; $i < count($preference); $i++):
								$num = $i + 1;
								echo '<div class="fl checkbox-'.$num.' selected"><p>'.$preference_type[$i]['type'].'<i></i></p></div>';
							endfor;
						else:
							echo '<div>: None</div>';
						endif;
						?>
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
					<!--<li>No Posted Date</li>-->
				</ul>
			</div>
		</div>
		<?php
		$id_array					= array();
		$other_dates_array			= array();
		$other_origin_array 		= array();
		$other_destination_array 	= array();
		
		foreach($get_user_wish_dates as $val):
			$id_array[] 				= explode(',', $val['id']);
			$other_origin_array[] 		= explode('-', $val['origins']);
			$other_destination_array[] 	= explode('-', $val['destination']);
			$other_dates_array[] 		= explode(',', $val['dates']);
		endforeach;
		?>
		<script type="text/javascript">
		function get_data(events, month_today, year) {
			$.each(events, function(index, value) {
				var get_month = value.substring(55, 57);
				var get_year = value.substring(50, 54);
				var this_month = (month_today < 9 ? "0"+month_today:month_today);

				console.log(get_month);
			
				if(this_month == get_month && get_year == year) {
					$('.pcal-body ul').append('<li>'+value+'</li>');
				}
			});
		}
		
		$(window).load(function() {
			var months 	= {1:'January', 2:'February', 3:'March', 4:'April', 5:'May', 6:'June', 7:'July', 8:'August', 9:'September', 10:'October', 11:'November', 12:'December'},
				prev	= 0,
				date	= new Date(),
				month 	= date.getMonth()+1,
				year	= date.getFullYear();
			
			var events = [<?php for($i = 0; $i < count($other_dates_array[0]); $i++):
				// echo '"'.$other_dates_array[0][$i].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; from '.$other_origin_array[0][$i].' to '.$other_destination_array[0][$i].'",';
				echo '"<a href=\''.base_url('passenger/detail').'/'.$id_array[0][$i].'\'>'.$other_dates_array[0][$i].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; from '.$other_origin_array[0][$i].' to '.$other_destination_array[0][$i].'</a>",';
			endfor;?>];
		
			$('.pcal-month').html(months[month] +' '+ year);
			
			get_data(events, month, year);  //Get Data
			
			$('.next').click(function() {
				if(month < 12) {
					month++ + 1;
					
					$('.pcal-month').html(months[month] +' '+ year);
					
					$('.pcal-body ul').empty()
					
					get_data(events, month, year); //Get Data
				} else {
					month = 0;
					year	= year + 1;
				}
			});
			
			$('.prev').click(function() {
				month--;
				
				$('.pcal-month').html(months[month] +' '+ year);
				
				$('.pcal-body ul').empty();
				
				get_data(events, month, year);
				
				if(month < 1) {
					month = 12;
					year	= year - 1;
					
					$('.pcal-month').html(months[month] +' '+ year);
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
						// alert("directions response "+status);
						console.log("Google can't find the map");
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

<div class="modal fade" id="select-lift" tabindex="-1" role="dialog" aria-hidden="true" style="display:none;">
	<div class="modal-dialog">
		<form action="" method="post">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4>Select one of the lift that you created</h4>
				</div>
				<div class="modal-body">
					<div class="err-msg"></div>
					<form action="" method="post">						
						<ul>
							<li class="s-l-header">
								<span class="span1">&nbsp;</span>
								<span class="span3"><strong>Routes</strong></span>
								<span class="span2"><strong>Dates</strong></span>
								
								<div class="clr"></div>
								
								<hr style="margin:5px 0;"/>
							</li>
							<li class="s-l-body">
							</li>
							<li>
								<br />
								<input type="submit" name="choose_lift" value="Choose" class="fr btn btn-default"/>
								<div class="clr"></div>
							</li>
						</ul>
					</form>
				</div>
			</div>
		</form>
	</div>
</div>

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
							<label for="Pick a date">Pick a Date <span class="date-error"></span></label>
							<div id="available-dates"></div>
							<input type="hidden" name="dates" value=""/>
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
			</div>
		</form>
	</div>
</div>

<div class="modal fade" id="invite_lift_success" tabindex="-1" role="dialog" aria-hidden="true" style="display:none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				&nbsp;
			</div>
			<div class="modal-body">
				<p style="text-align:center; font-size:1.5em;">You have success fully sent your invite</p>
			</div>
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
		var id = $('option:selected', this).attr('data-id');
		
		if(choices == 'Invite Me') {
			var authenticated = '<?php echo $this->session->userdata('validated')?>';
			
			if(authenticated == 1) {
				$('#select-lift').modal({dynamic:true});
				
				$('#select-lift ul li.s-l-body').empty();
				
				$.ajax({
					url 	: '<?php echo base_url('passenger/get_user_lift_post')?>',
					data	: {id:id},
					success : function(data) {
						if($.parseJSON(data) == 'empty') {
							<?php foreach($wish_lift_detail as $row):?>
							$('#select-lift ul li.s-l-body').append('<div><p style="font-size:1.5em; text-align:center; padding:20px 0;">No date matched on your lift post</p> <a href="<?php echo base_url('lift/create')?>/<?php echo $row['id']?>" class="btn-create-lift btn-advance" style="display:block; margin:0 auto;">Create Lift</a></div>');
							<?php endforeach?>
							$('#select-lift input[name="choose_lift"], .s-l-header').remove();
						} else {
							$.each($.parseJSON(data), function(i, val) {
								$('#select-lift ul li.s-l-body').append('<div><span class="span1"><input type="radio" name="lift_created[]" value="'+val.user_id+'" data-id="<?php echo $this->uri->segment(3)?>" id="" value=""/></span> <span class="span3">'+val.origins+' from '+val.destination+'</span><span class="span2">'+val.dates+'</span><div class="clr"></div></div>');
								console.log(val.dates);
							});
						}
						
						$('input[name="choose_lift"]').click(function(e) {
							e.preventDefault();
							var error = 0;
							
							if($('input[name="lift_created[]"]').is(":checked") != true) {
								$('.err-msg').html('You need to choose one of your lift created').css({background:'#FF1B43', color:'#fff', fontSize:'1.3em', fontWeight:'bold', textAlign:'center', border:'1px solid #ff0000', padding:'5px 0'});
								error = 1;
							}
							
							if(error == 0) {
								$('#select-lift').modal('hide');
								$('#invite_lift').modal({dynamic:true});
								
								$.ajax({
									url		: '<?php echo base_url('passenger/get_selected_lift_data')?>',
									data	: { id:$('input[name="lift_created[]"]:checked').val(), post:$('input[name="lift_created[]"]:checked').attr('data-id') },
									success : function(data) {
										var dateArray = [];
										
										$.each($.parseJSON(data), function(i, val) {
											dateArray.push(val);
										});
										
										$('#available-dates').multiDatesPicker({ beforeShowDay : dates });
										
										$('#available-dates').click(function() {
											var getDates		= $(this).multiDatesPicker('getDates'),
												getDates_array	= [];
											
											$.each(getDates, function(index, value) {
												getDates_array.push('<?php echo htmlentities('"', ENT_QUOTES, "UTF-8");?>' + value + '<?php echo htmlentities('"', ENT_QUOTES, "UTF-8");?>');
											});
											
											$('input[name="dates"]').val(getDates_array);
										});
										
										function dates(date) {				
											var fullyear = date.getFullYear() + "-" +
												("0" + (date.getMonth() + 1)).slice(-2) + "-" +
												("0" + date.getDate()).slice(-2);
												
											return ($.inArray(fullyear, dateArray) > -1 ? [true, ''] : [false, '']);
										}
										
										$('input[name="book_submit"]').click(function(e) {
											e.preventDefault();
											var dates	= $('input[name="dates"]'),
												price 	= $('input[name="price"]'),
												remarks	= $('textarea[name="remarks"]'),
												error = 0;
												
											$('*').removeClass('error-field');
											$('.date-error').html(' ')
											
											if(dates.val() == '') {
												dates.addClass('error-field');
												$('.date-error').html('Please choose date(s)').css({color:'#ff0000'});
												error = 1;
											}
											
											if(price.val() == '') {
												price.addClass('error-field');
												error = 1;
											}
											
											if(remarks.val() == '') {
												remarks.addClass('error-field');
												error = 1;
											}
											
											if(error == 0) {
												$.ajax({
													url		: '<?php echo base_url('passenger/invite_me')?>',
													type	: 'POST',
													data	: {
														post_id : id,
														dates	: dates.val(),
														price	: price.val(),
														remarks	: remarks.val()
													},
													success	: function(data) {
														$('#invite_lift').modal('hide');
														$('#invite_lift_success').modal({dynamic:true});
													}
												});
											} else {
												return false;
											}
										});
									}
								});
							} else {
								return false;
							}
						});
					}
				});
			} else {
				window.location.href = "<?php echo base_url('login')?>";
			}
		}
		
		if(choices == 'Create Lift') {
			window.location.href = '<?php echo base_url('lift/create')?>/'+id;
		}
	});
});
</script>