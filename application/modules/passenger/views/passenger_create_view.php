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
</style>

<div class="create-lift m-center-content">
	<h3>Create Your Wish Lift</h3>
	
	<hr/>
	
	<form action="" method="post">
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
				<select name="seat_available" id="" class="bt-dropdown" data-width="50px">
					<?php for($i = 1; $i < 12; $i++):?>
					<option value="<?php echo $i?>"><?php echo $i?></option>
					<?php endfor?>
				</select>
				
				<div class="clr"></div>
			</li>
			<li>
				<label for="Storage">Storage</label>
				<select name="storage" id="" class="storage-choice" data-width="100px">
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
		
		<input type="submit" name="create_wish_lift_submit" value="Post Your Wish Lift" class="btn btn-default"/>
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

var from, destination, via;

function initialize() {
	from = new google.maps.places.Autocomplete((document.getElementById('from')), { types: ['geocode'] });
	destination = new google.maps.places.Autocomplete((document.getElementById('destination')), { types: ['geocode'] });
	via = new google.maps.places.Autocomplete((document.getElementById('via')), { types: ['geocode'] });
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
	
	$('input[name="create_wish_lift_submit"]').click(function(e) {
		e.preventDefault();
		var origin		= $('input[name="origin"]'),
			destination = $('input[name="destination"]'),
			via 		= $('input[name="via"]'),
			dates		= $('input[name="dates"]'),
			hours		= $('select[name="hours"]'),
			minute		= $('select[name="minute"]'),
			seat		= $('select[name="seat_available"]'),
			storage		= $('select[name="storage"]'),
			preference	= $('input[name="preference[]"]'),
			remarks		= $('textarea[name="remarks"]'),
			error		= 0;
		
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
		
		if(error == 0) {
			var preference_array = []
				re_preference_array = [];
			
			$('input[name="preference[]"]:checkbox:checked').each(function(i){ preference_array[i] = $(this).val(); });
			$('input[name="re_preference[]"]:checkbox:checked').each(function(i){ re_preference_array[i] = $(this).val(); });
			
			$.ajax({
				url 	: '<?php echo base_url('passenger/insert_create')?>',
				type	: 'POST',
				data	: {
					origin:origin.val(),
					destination:destination.val(),
					via:via.val(),
					dates:dates.val(),
					hours:hours.val(),
					minute:minute.val(),
					seat:seat.val(),
					storage:storage.val(),
					preference:preference_array,
					remarks:remarks.val()
				},
				success	: function(data) {
					console.log(data);
					// window.location.href = '<?php echo base_url('passenger/wish_lift_success')?>';
				}
			});
		} else {
			return false;
		}
	});
	
	$('#calendar').click(function() {
		var getDates		= $(this).multiDatesPicker('getDates'),
			getDates_array	= [];
		
		$.each(getDates, function(index, value) { getDates_array.push(value); });
		
		$('input[name="dates"]').val(getDates_array);
	});
	
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
	
	$('#calendar').multiDatesPicker({dateFormat	: "yy-mm-dd" });
	$('.lift-preference div').mouseover(function() { $('p', this).stop(true, true).fadeIn().css({display:'block'}); });
	$('.lift-preference div').mouseleave(function() { $('p', this).fadeOut(); });
});
</script>