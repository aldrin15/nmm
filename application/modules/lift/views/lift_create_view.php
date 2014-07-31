<?php $this->load->view('header_content')?>

<style type="text/css">
#calendar, #return-trip-calendar {width:360px;}
.ui-state-highlight, .ui-widget-content .ui-state-highlight, .ui-widget-header .ui-state-highlight {background:#00ff00;}
.ui-datepicker {width:100%;}
.ui-widget-content {background:none;}
.ui-datepicker-calendar td {border:none;}
.ui-datepicker td span, .ui-datepicker td a {padding:10px 5px;}
.ui-widget-header .ui-state-highlight {border:none;}
.ui-state-highlight {border:none}
.ui-widget-header {background:#fff;}
.ui-datepicker .ui-datepicker-header {padding:.5em 0;}
.ui-menu .ui-menu-item {background:#fff;}

.label-width label {display:block; width:100px;}

@media (max-width:920px) {
	.span5 {width:100%;}
}
</style>
<div class="create-lift m-center-content">
	<h2>Create your own lift</h2><br /><br />
	
	<form action="" method="post">
		<h4>Location: From and To</h4>
			<hr/><br />
			
		<?php 
		$row = array();
		
		foreach((array)$get_wish_data as $value):
			$row[] = $value;
		endforeach;
		?>
			
		<?php if($get_wish_data != ''):?>
		<ul>
			<li class="span5">
				<label for="Departure">From: </label>
				<input type="text" name="origin" value="<?php echo (isset($_POST['origin'])) ? set_value('origin') : $row[0]['origin']?>" />
					
				<div class="clr"></div>
			</li>
			<li class="span5">
				<label for="Departure">To: </label>
				<input type="text" name="destination" value="<?php echo (isset($_POST['origin'])) ? set_value('origin') : $row[0]['origin']?>" />
				
				<div class="clr"></div>
			</li>
			<li class="span5">
				<label for="Via">Via</label>
				<input type="text" name="via" id="" value="<?php echo (isset($_POST['via'])) ? set_value('via') : $row[0]['via']?>" class="form-control" readonly/>
				
				<div class="clr"></div>
			</li>
		</ul>
		
		<h4>Date and Time of Lift</h4>
			<hr/><br />
		<ul>
			<li>
				<?php echo form_error('dates', '<div class="error">', '</div>');?>
					<div class="clr"></div>
				<label for="Date">Date:</label>
				<div id="calendar" class="fl"></div>
				<input type="hidden" name="dates" value="<?php set_value('dates')?>" class="calendar-data"/>
				
				<div class="clr"></div>
			</li>
			<li>
				<label for="Time">Time:</label>
				
				<select name="hours" class="bt-dropdown select-width-auto">
					<option value="<?php echo date('H', strtotime($row[0]['time']))?>"><?php echo date('H', strtotime($row[0]['time']))?></option>
				</select>
				
				<select name="minute" class="bt-dropdown select-width-auto">
					<option value="<?php echo date('i', strtotime($row[0]['time']))?>"><?php echo date('i', strtotime($row[0]['time']))?></option>
				</select>
				
				<div class="clr"></div>
			</li>
		</ul>
		
		<h4>Car Preference</h4>
			<hr/><br />
		<ul>
			<li>
				<label for="Seat Available">Seat Available</label>
				<select name="seat_available" id="" class="seat-available-choice" data-width="50px">
					<?php for($i = 1; $i < 12; $i++):?>
					<option value="<?php echo $i?>"><?php echo $i?></option>
					<?php endfor?>
				</select>
				
				<div class="clr"></div>
			</li>
			<li>
				<label for="Storage">Storage</label>
				<select name="storage" id="" class="bt-dropdown" data-width="100px">
					<option value="Small">Small</option>
					<option value="Medium">Medium</option>
					<option value="Large">Large</option>
				</select>
				
				<div class="clr"></div>
			</li>
			<li>
				<label for="Preferences">Preferences:</label>
				
				<div class="lift-preference">
					<?php 
					$p_id = explode(',', $row[0]['preference_id']);
					$p_type = explode(',', $row[0]['type']);
					array_unshift($p_type, null);
					unset($p_type[0]);
					
					for($i = 1; $i < count($p_id)+1; $i++):
					?>
					<div class="fl checkbox-<?php echo $i?> selected">
						<input type="checkbox" name="preference[]" value="<?php echo $i?>" checked="checked"/>
						<p><?php echo $p_type[$i]?> <i></i></p>
					</div>
					<?php endfor?>
				</div>
				
				<div class="clr"></div>
			</li>
			<li class="span5">
				<label for="Remarks">Remarks:</label>
				<textarea name="remarks" id="" cols="30" rows="10" class="form-control"><?php echo (isset($_POST['remarks'])) ? set_value('remarks') : ''?></textarea>
			</li>
		</ul>
		
		<h4>Payment</h4>
			<hr/><br />
		<ul>
			<li class="span5">
				<label for="Price Per Seat">Seat Amount:</label>
				<?php echo form_error('seat_amount', '<div class="fl error">', '</div>')?>
				
				<div class="clr"></div>
				
				<input type="text" name="seat_amount" id="" value="<?php echo (isset($_POST['seat_amount'])) ? set_value('seat_amount') : ''?>" class="form-control"/>
				
				<div class="clr"></div>
			</li>
		</ul>
		
		<h3>Other Options</h3>
			<hr/><br />
		<ul>
			<li style="float:none;">
				<label for="Offer Return Ride">Allow Re-route</label>
				<label style="margin-top:-10px;"><input type="checkbox" name="re_route" value="1" id=""/></label>
				
				<div class="clr"></div>
			</li>
			<li>
				<label for="Offer re-route">Offer Return Ride</label>
				<label><input type="checkbox" name="offer_re_route" id=""/></label>
				
				<div class="clr"></div>
			</li>
		</ul>	
		
		<?php else:?>
		
		<ul class="ride-trip">
			<li class="span5">
				<label for="Departure">From: <?php echo form_error('origin', '<span class="error">', '</span>')?></label>
				<span><input type="text" name="origin" value="<?php echo (isset($_POST['origin'])) ? set_value('origin') : ''?>" id="from" class="form-control" autocomplete="off"/></span>
				
				<div class="clr"></div>
			</li>
			<li class="span5">
				<label for="Departure">To: <?php echo form_error('destination', '<span class="error">', '</span>')?></label>
				<span><input type="text" name="destination" value="<?php echo (isset($_POST['destination'])) ? set_value('destination') : ''?>" id="destination" class="form-control" autocomplete="off"/></span>
				
				<div class="clr"></div>
			</li>
			<li class="span5">
				<label for="Via">Via </label>
				<input type="text" name="via" id="via" autocomplete="off" class="form-control"/>
				
				<div class="clr"></div>
			</li>
		</ul>
		
		<h4>Date and Time of Lift</h4>
			<hr/><br />
		<ul class="label-width">
			<li>
				<?php echo form_error('dates', '<div class="error">', '</div>');?>
				<span class="dates-req"></span>
					<div class="clr"></div>
				<label for="Date">Date: </label>
				<div id="calendar" class="fl"></div>
				<input type="hidden" name="dates" value="<?php echo set_value('dates')?>" class="calendar-data"/>
				
				<div class="clr"></div>
			</li>
			<li>
				<label for="Time">Time:</label>
				
				<span>Hour</span>
				<select name="hours" id="" class="bt-dropdown select-width-auto">
					<?php for($i = 1; $i < 25; $i++):?>
					<option value="<?php echo $i?>"><?php echo $i?></option>
					<?php endfor?>
				</select>
				
				<span>Minute</span>
				
				<select name="minute" id="" class="bt-dropdown select-width-auto">
					<?php for($i = 0; $i < 10; $i++):?>
					<option value="<?php echo '0'.$i?>"><?php echo '0'.$i?></option>
					<?php endfor?>
					<?php for($i = 10; $i < 60; $i++):?>
					<option value="<?php echo $i?>"><?php echo $i?></option>
					<?php endfor?>
				</select>
				
				<div class="clr"></div>
			</li>
		</ul>
		
		<h4>Car Preference</h4>
			<hr/><br />
		<ul class="label-width">
			<li>
				<label for="Seat Available">Seat Available</label>
				<select name="seat_available" id="" class="bt-dropdown select-width-auto">
					<?php for($i = 1; $i < 12; $i++):?>
					<option value="<?php echo $i?>"><?php echo $i?></option>
					<?php endfor?>
				</select>
				
				<div class="clr"></div>
			</li>
			<li>
				<label for="Storage">Storage</label>
				<select name="storage" id="" class="bt-dropdown select-width-auto">
					<option value="Small">Small</option>
					<option value="Medium">Medium</option>
					<option value="Large">Large</option>
				</select>
				
				<div class="clr"></div>
			</li>
			<li>
				<label for="Preferences">Preferences:</label>
				
				<div class="lift-preference">
					<div class="fl checkbox-1">
						<input type="checkbox" name="preference[]" value="1"/>
						<p>Talk <i></i></p>
					</div>
					<div class="fl checkbox-2">
						<input type="checkbox" name="preference[]" value="2"/>
						<p>Music <i></i></p>
					</div>
					<div class="fl checkbox-3">
						<input type="checkbox" name="preference[]" value="3"/>
						<p>Pet <i></i></p>
					</div>
					<div class="fl checkbox-4">
						<input type="checkbox" name="preference[]" value="4"/>
						<p>Smoke <i></i></p>
					</div>
					<div class="fl checkbox-5">
						<input type="checkbox" name="preference[]" value="5"/>
						<p>Baby <i></i></p>
					</div>
					<div class="fl checkbox-6">
						<input type="checkbox" name="preference[]" value="6"/>
						<p>Women Only <i></i></p>
					</div>
				</div>
				
				<div class="clr"></div>
			</li>
			<li class="span5">
				<label for="Remarks">Remarks:</label>
				<textarea name="remarks" id="" cols="30" rows="10" class="form-control"></textarea>
			</li>
		</ul>
		
		<h4>Payment</h4>
			<hr/><br />
		<ul>
			<li class="span5">
				<label for="Price Per Seat">Seat Amount: <?php echo form_error('seat_amount', '<span class="error">', '</span>')?></label>
				<input type="text" name="seat_amount" id="" value="<?php echo set_value('seat_amount')?>" class="form-control"/>
				
				<div class="clr"></div>
			</li>
		</ul>
		
		<h3>Other Options</h3>
			<hr/><br />
		<ul class="label-width">
			<li style="float:none;">
				<label for="Offer Return Ride">Allow Re-route</label>
				<label style="margin-top:-10px;"><input type="checkbox" name="re_route" value="1" id=""/></label>
				
				<div class="clr"></div>
			</li>
			<li>
				<label for="Offer re-route">Offer Return Ride</label>
				<label><input type="checkbox" name="offer_re_route" id=""/></label>
				
				<div class="clr"></div>
			</li>
		</ul>
		
		<div id="return-trip" style="display:none;">
			<h4>Return Ride</h4>
				<hr/>
			<ul class="return-trip">
				<li class="span5">
					<label for="Departure">From: </label>
					<span><input type="text" name="re_origin" value="<?php echo (isset($_POST['origin'])) ? set_value('origin') : ''?>" id="re_from" class="form-control" autocomplete="off"/></span>
									
					<div class="clr"></div>
				</li>
				<li class="span5">
					<label for="Departure">To: </label>
					<span><input type="text" name="re_destination" value="<?php echo (isset($_POST['origin'])) ? set_value('origin') : ''?>" id="re_destination" class="form-control" autocomplete="off"/></span>
										
					<div class="clr"></div>
				</li>
				<li class="span5">
					<label for="Via">Via</label>
					
					<input type="text" name="via" id="re_via" class="form-control"/>
					
					<div class="clr"></div>
				</li>
			</ul>
			
			<h4>Date and Time of Lift</h4>
			<hr/><br />
			
			<ul class="label-width">
				<li>
					<label for="Date">Date:</label>
					<div id="return-trip-calendar" class="fl"></div>
					<input type="hidden" name="re_dates" value="<?php echo set_value('re_dates')?>" class="calendar-data"/>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Time">Time:</label>
					
					<span>Hour</span>
					<select name="re_hours" id="" class="bt-dropdown select-width-auto">
						<?php for($i = 1; $i < 25; $i++):?>
						<option value="<?php echo $i?>"><?php echo $i?></option>
						<?php endfor?>
					</select>
					
					<span>Minute</span>
					
					<select name="re_minute" id="" class="bt-dropdown select-width-auto">
						<?php for($i = 1; $i < 10; $i++):?>
						<option value="<?php echo '0'.$i?>"><?php echo '0'.$i?></option>
						<?php endfor?>
						<?php for($i = 10; $i < 61; $i++):?>
						<option value="<?php echo $i?>"><?php echo $i?></option>
						<?php endfor?>
					</select>
					
					<div class="clr"></div>
				</li>
			</ul>
			
			<h4>Car Preference</h4>
				<hr/><br />
			<ul class="label-width">
				<li>
					<label for="Seat Available">Seat Available</label>
					<select name="re_seat_available" id="" class="bt-dropdown" data-width="50px">
						<?php for($i = 1; $i < 12; $i++):?>
						<option value="<?php echo $i?>"><?php echo $i?></option>
						<?php endfor?>
					</select>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Storage">Storage</label>
					<select name="re_storage" id="" class="bt-dropdown" data-width="100px">
						<option value="Small">Small</option>
						<option value="Medium">Medium</option>
						<option value="Large">Large</option>
					</select>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Preferences">Preferences:</label>
					
					<div class="lift-preference">
						<div class="fl checkbox-1">
							<input type="checkbox" name="re_preference[]" value="1"/>
							<p>Talk <i></i></p>
						</div>
						<div class="fl checkbox-2">
							<input type="checkbox" name="re_preference[]" value="2"/>
							<p>Music <i></i></p>
						</div>
						<div class="fl checkbox-3">
							<input type="checkbox" name="re_preference[]" value="3"/>
							<p>Pet <i></i></p>
						</div>
						<div class="fl checkbox-4">
							<input type="checkbox" name="re_preference[]" value="4"/>
							<p>Smoke <i></i></p>
						</div>
						<div class="fl checkbox-5">
							<input type="checkbox" name="re_preference[]" value="5"/>
							<p>Baby <i></i></p>
						</div>
						<div class="fl checkbox-6">
							<input type="checkbox" name="re_preference[]" value="6"/>
							<p>Women Only <i></i></p>
						</div>
					</div>
					
					<div class="clr"></div>
				</li>
				<li class="span5">
					<label for="Remarks">Remarks:</label>
					<textarea name="re_remarks" id="" cols="30" rows="10" class="form-control"></textarea>
				</li>
			</ul>
			
			<h4>Payment</h4>
				<hr/><br />
			<ul>
				<li class="span5">
					<label for="Price Per Seat">Seat Amount: <?php echo form_error('seat_amount', '<span class="error">', '</span>')?></label>
					<input type="text" name="re_amount" id="" value="<?php echo set_value('seat_amount')?>" class="form-control"/>
					
					<div class="clr"></div>
				</li>
			</ul>
		</div>
		<?php endif?>
		
		
		<input type="hidden" name="user_car_id" value=""/>
		
		<input type="submit" name="create_lift_submit" value="Create Lift" class="btn btn-default"/>
	</form>
</div>

<div class="clr"></div>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.7.2.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-select.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.ui.core.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.ui.datepicker.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.multidatespicker.js')?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&region=DE&libraries=places&language=de"></script>  
<script type="text/javascript">
$(window).load(function() {initialize();});

var from, re_from, destination, re_destination, via, re_via;

function initialize() {
	from = new google.maps.places.Autocomplete((document.getElementById('from')), { types: ['geocode'] });
	re_from = new google.maps.places.Autocomplete((document.getElementById('re_from')), { types: ['geocode'] });
	destination = new google.maps.places.Autocomplete((document.getElementById('destination')), { types: ['geocode'] });
	re_destination = new google.maps.places.Autocomplete((document.getElementById('re_destination')), { types: ['geocode'] });
	via = new google.maps.places.Autocomplete((document.getElementById('via')), { types: ['geocode'] });
	re_via = new google.maps.places.Autocomplete((document.getElementById('re_via')), { types: ['geocode'] });
	// google.maps.event.addListener(destination, 'place_changed', function() { fillInAddress(); });
}

function geolocate() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
			var geolocation = new google.maps.LatLng(
			
			position.coords.latitude, position.coords.longitude);
			destination.setBounds(new google.maps.LatLngBounds(geolocation, geolocation));
		});
	}
}

function checkbox(checkboxName){
	var checkBox = $('input[name="'+ checkboxName +'"]');
	$(checkBox).each(function(){
		$(this).wrap( "<span class='create-lift-checkbox'></span>" );
		if($(this).is(':checked')){
			$(this).parent().addClass("selected");
		}
	});
	$(checkBox).click(function(){ $(this).parent().toggleClass("selected"); });
}

$(function() {
	$('.bt-dropdown').selectpicker();
	checkbox("re_route");
	checkbox("offer_re_route");
	
	$('input[name="create_lift_submit"]').click(function(e) {
		e.preventDefault();
		var origin		= $('input[name="origin"]'),
			destination = $('input[name="destination"]'),
			via 		= $('input[name="via"]'),
			dates		= $('input[name="dates"]'),
			seat_amount	= $('input[name="seat_amount"]'),
			hours		= $('select[name="hours"]'),
			minute		= $('select[name="minute"]'),
			seat		= $('select[name="seat_available"]'),
			storage		= $('select[name="storage"]'),
			preference	= $('input[name="preference[]"]'),
			remarks		= $('textarea[name="remarks"]'),
			error		= 0;
		var re_origin		= $('input[name="re_origin"]'),
			re_destination 	= $('input[name="re_destination"]'),
			re_via 			= $('input[name="re_via"]'),
			re_dates		= $('input[name="re_dates"]'),
			re_amount		= $('input[name="re_amount"]'),
			re_hours		= $('select[name="re_hours"]'),
			re_minute		= $('select[name="re_minute"]'),
			re_seat			= $('select[name="re_seat_available"]'),
			re_storage		= $('select[name="re_storage"]'),
			re_preference	= $('input[name="re_preference[]"]'),
			re_remarks		= $('textarea[name="re_remarks"]'),
			re_error		= 0;
		
		$('*').removeClass('error-bd');
		$('.dates-req').html("");
		
		if(origin.val() == '') {
			origin.addClass('error-bd');
			error = 1;
		}
		
		if(destination.val() == '') {
			destination.addClass('error-bd');
			error = 1;
		}
		
		if(dates.val() == '') {
			$('.dates-req').html('The Date is required.').addClass('error').css({marginLeft:'100px'});
			error = 1;
		}
		
		if(seat_amount.val() == '') {
			seat_amount.addClass('error-bd');
			error = 1;
		}
		
		if($('input[name="offer_re_route"]').is(':checked')) {


			$('*').removeClass('re_error_bd');	
				
			if(re_origin.val() == '') {
				re_origin.addClass('re_error_bd');
				re_error = 1;
			}
			
			if(re_destination.val() == '') {
				re_destination.addClass('re_error_bd');
				re_error = 1;
			}
			
			if(re_dates.val() == '') {
				re_dates.addClass('re_error_bd');
				re_error = 1;
			}
			
			if(re_amount.val() == '') {
				re_amount.addClass('re_error_bd');
				re_error = 1;
			}
			
			if(re_error == 0) {
				console.log('Success');
			} else {
				return false;
			}
		}
		
		if(error == 0) {
			var preference_array = []
				re_preference_array = [];
			
			$('input[name="preference[]"]:checkbox:checked').each(function(i){ preference_array[i] = $(this).val(); });
			$('input[name="re_preference[]"]:checkbox:checked').each(function(i){ re_preference_array[i] = $(this).val(); });
			
			$.ajax({
				url 	: '<?php echo base_url('lift/insert_create')?>',
				type	: 'POST',
				data	: {
					origin:origin.val(),
					destination:destination.val(),
					via:via.val(),
					dates:dates.val(),
					seat_amount:seat_amount.val(),
					hours:hours.val(),
					minute:minute.val(),
					seat:seat.val(),
					storage:storage.val(),
					preference:preference_array,
					remarks:remarks.val(),
					re_origin:re_origin.val(),
					re_destination:re_destination.val(),
					re_via:re_via.val(),
					re_destination:re_destination.val(),
					re_dates:re_dates.val(),
					re_amount:re_amount.val(),
					re_hours:re_hours.val(),
					re_minute:re_minute.val(),
					re_seat:re_seat.val(),
					re_storage:re_storage.val(),
					re_preference:re_preference_array,
					re_remarks:re_remarks.val()
				},
				success	: function(data) {
					window.location.href = '<?php echo base_url('lift/create_success')?>';
				}
			});
		} else {
			return false;
		}
	});
	
	$('input[name="offer_re_route"]').click(function() {
		if($(this).is(':checked')) {
			$('#return-trip').slideDown().show();
		} else {
			$('#return-trip').slideUp();
		}
	});
	
	$('#calendar').click(function() {
		var getDates		= $(this).multiDatesPicker('getDates'),
			getDates_array	= [];
		
		$.each(getDates, function(index, value) { getDates_array.push(value); });
		
		$('input[name="dates"]').val(getDates_array);
	});

	$('#return-trip-calendar').click(function() {
		var getDates		= $(this).multiDatesPicker('getDates'),
			getDates_array	= [];
		
		$.each(getDates, function(index, value) { getDates_array.push(value); });
		
		$('input[name="re_dates"]').val(getDates_array);
	});
	
	<?php
	if($get_wish_date != ''):
		$dates_array = array();
		
		foreach((array)$get_wish_date as $row):
			$dates_array[] = '"'.$row['date'].'"';
		endforeach;
	?>
	var passenger_date = [<?php echo implode(',', $dates_array)?>];
	
	function choices(date) {
		var month 		= date.getMonth()+1;
			real_month 	= (month < 9 ? "0"+month:month)
			day			= date.getDate(),
			year		= date.getFullYear(),
			fullyear	= year+'-'+real_month+'-'+day;
	
		return ($.inArray(fullyear, passenger_date) > -1) ? [true, ''] : [false, '']
	}
	<?php else:?>
	$('.lift-preference div').click(function() {
		var input = $('input', this);
		
		if(input.attr('checked')){
		   input.attr('checked', false);
		   $(this).removeClass('selected');
		} else{
		   input.attr('checked', true);
		   $(this).addClass('selected');
		}
	});
	<?php endif?>
	$('#calendar').multiDatesPicker({dateFormat	: "yy-mm-dd", minDate:0, <?php echo ($get_wish_date != '') ? 'beforeShowDay:choices' : '' ?>});
	$('#return-trip-calendar').multiDatesPicker({dateFormat	: "yy-mm-dd"});
	$('.lift-preference div').mouseover(function() { $('p', this).stop(true, true).fadeIn().css({display:'block'}); });
	$('.lift-preference div').mouseleave(function() { $('p', this).fadeOut(); });
});
</script>