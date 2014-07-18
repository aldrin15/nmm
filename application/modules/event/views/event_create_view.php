<?php $this->load->view('header_content')?>

<div class="m-center-content event">
	<h1>Post an Event!</h1><br />
	<form action="" method="post" enctype="multipart/form-data">
		<p>Type of event <?php echo form_error('event_type', '<span class="error">','</span>')?></p>
		
		<hr/>
		
		<div class="span5">
			<ul>
				<li>
					<input type="radio" name="event_type" value="concert" id=""/>
					<label for="Concert">Concert</label>
					
					<div class="clr"></div>
				</li>
				<li>
					<input type="radio" name="event_type" value="Sport" id=""/>
					<label for="Concert">Sport</label>
				
					<div class="clr"></div>
				</li>
				<li>
					<input type="radio" name="event_type" value="Theater" id=""/>
					<label for="Concert">Theater</label>
				
					<div class="clr"></div>
				</li>
				<li>
					<input type="radio" name="event_type" value="Family" id=""/>
					<label for="Concert">Family</label>
				
					<div class="clr"></div>
				</li>
				<li>
					<input type="radio" name="event_type" value="Others" id=""/>
					<label for="Concert">Others</label>
				
					<div class="clr"></div>
				</li>
			</ul>
		</div>
		
		<p>Event Details</p>
		
		<hr/>
		
		<div class="span6">
			<ul>
				<li>
					<label for="Title">Event Title</label> <?php echo form_error('title', '<span class="error">', '</span>')?>
					<input type="text" name="title" id="" class="form-control"/>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Event City and Country">Event City and Country</label> <?php echo form_error('address', '<span class="error">', '</span>')?>
					<input type="text" name="city_country" value="" class="form-control" id="city-country" />
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Event Place">Event Place</label>
					<input type="text" name="address" value="" id="" class="form-control"/>
					
					<div class="clr"></div>
				</li>
				<li style="position:relative; z-index:2;">
					<label for="Date">Date</label> <?php echo form_error('date', '<span class="error">', '</span>')?>
					<input type="hidden" name="date" value="<?php echo set_value('date')?>" id="date"/>
					<div id="datepicker" class="fl"></div>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Time">Time</label>
					
					<div>
						<select name="hour" class="selectpicker select-width-auto">
							<?php for($i = 1; $i < 25; $i++):?>
							<option value="<?php echo $i?>"><?php echo $i?></option>
							<?php endfor?>
						</select> -
						<select name="minute" class="selectpicker select-width-auto">
							<?php for($i = 1; $i < 10; $i++):?>
							<option value="<?php echo '0'.$i?>"><?php echo '0'.$i?></option>
							<?php endfor?>
							<?php for($i = 10; $i < 51; $i++):?>
							<option value="<?php echo $i?>"><?php echo $i?></option>
							<?php endfor?>
						</select>				
					</div>
				</li>
			</ul>
			
			<div class="clr"></div>
		</div>
		
		<p>Upload Event Banner</p>
		
		<hr/>
		
		<div class="span5">
			<small>Note: Please upload .jpg and .png only.</small>
			<div class="fileinput fileinput-new input-group" data-provides="fileinput">
			  <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
			  <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="userfile" /></span>
			  <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
			</div>
		</div>
		
		<p>Other Information</p>
		
		
		<hr/>
		
		<div class="span5">
			<label for="Remarks">Remarks</label>
				<div class="clr"></div>
			<textarea name="remarks" id="" cols="30" rows="10" class="form-control input-sm"></textarea>
		</div>
		
		<div class="span5"><input type="submit" name="create_event_submit" value="Post Event" class="btn-gray"/></div>
		
		<div class="clr"></div>
	</form>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-select.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-input.js')?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&region=DE&libraries=places&language=de"></script>  
<script type="text/javascript">
$(window).load(function() {initialize();});

var city_country;

function initialize() {
	city_country = new google.maps.places.Autocomplete((document.getElementById('city-country')), { types: ['geocode'] });
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

function customRadio(radioName){
	var radioButton = $('input[name="'+ radioName +'"]');
	$(radioButton).each(function(){
		$(this).wrap( "<span class='custom-radio'></span>" );
		if($(this).is(':checked')){
			$(this).parent().addClass("selected");
		}
	});
	$(radioButton).click(function(){
		if($(this).is(':checked')){
			$(this).parent().addClass("selected");
		}
		$(radioButton).not(this).each(function(){
			$(this).parent().removeClass("selected");
		});
	});
}

// Calling customRadio function
$(function() {
	customRadio("event_type");
	
	var default_date = {date : '<?php echo set_value('date')?>'};
	
	$('#datepicker').datepicker({
		dateFormat:'yy-mm-dd',
		altField: '#date',
		<?php if(isset($_POST['date'])):?>
		defaultDate: default_date.date
		<?php endif;?>
	});
	
	$('.selectpicker').selectpicker(); //For Customize Select option
	
	$('.event-search-location-nav').click(function() { $('.event-search-location').slideToggle(); });
	
	$('.event-search-location a').click(function(e) {
		$('.event-search-location').slideToggle();
		
		e.preventDefault();
	});	
	
	$('#city_country').keyup(function(e) {
		e.preventDefault();
		
		$.ajax({
			url	: '<?php echo base_url('event/get_city')?>',
			dataType: 'html',
			data: {country : $(this).val()},
			success: function(data) {
				var city_country_array 	= [];
				
				$.each($.parseJSON(data), function(index, value) {
					city_country_array.push(value);
				});
				
				var city_country = city_country_array;
				
				$('#city_country').autocomplete({
					source: city_country,
					select: function(event, ui) { 
						$(".event-search-location-nav").html(ui.item.value);
						$('input[name="city_country"]').val(ui.item.value);
					}
				});
			}
		});
	});
});
</script>