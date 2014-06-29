<?php $this->load->view('header_content')?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/mdp.css')?>">

<div class="create-lift m-center-content">
	<?php //echo modules::run('lift/search')?>
	<h2>Create your own lift</h2><br /><br />
	
	<div class="create-lift-form">

	</div>
	
	<form action="" method="post">
		<h4>Location: From and To</h4>
			<hr/><br />
		<ul>
			<li class="span5">
				<label for="Departure">From: </label>
				<?php echo form_error('origin', '<div class="fl error">', '</div>')?>
				
				<div class="clr"></div>
				
				<div class="lift-place">
					<p>- Choose your location -</p>
					
					<div class="lift-search">
						<span><input type="text" name="from" id="lift-route" autocomplete="off"/></span>
						
						<input type="hidden" name="origin" value="" id="" />
						
						<a href="#" class="l-s-done">Done</a>
						
						<div class="clr"></div>
					</div>
				</div>
				
				<div class="clr"></div>
			</li>
			<li class="span5">
				<label for="Departure">To: </label>
				<?php echo form_error('destination', '<div class="error">', '</div>')?>
				
					<div class="clr"></div>
				
				<div class="lift-place">
					<p>- Choose your location -</p>
					
					<div class="lift-search">
						<span><input type="text" name="to" id="to-route" autocomplete="off"/></span>
						
						<input type="hidden" name="destination" value="" id="" />
						
						<a href="#" class="l-s-done">Done</a>
						
						<div class="clr"></div>
					</div>
				</div>
				
				<div class="clr"></div>
			</li>
			<li class="span5">
				<label for="Via">Via</label>
				<?php echo form_error('via', '<div class="error">', '</div>')?>
				
				<div class="clr"></div>
				
				<input type="text" name="via" id="" class="form-control"/>
				
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
				<input type="hidden" name="dates" value="<?php echo set_value('dates')?>" class="calendar-data"/>
				
				<div class="clr"></div>
			</li>
			<li>
				<label for="Time">Time:</label>
				
				<span>Hour</span>
				<select name="hours" id="" class="time-dropdown select-width-auto">
					<?php for($i = 1; $i < 25; $i++):?>
					<option value="<?php echo $i?>"><?php echo $i?></option>
					<?php endfor?>
				</select>
				
				<span>Minute</span>
				
				<select name="minute" id="" class="time-dropdown select-width-auto">
					<?php for($i = 1; $i < 10; $i++):?>
					<option value="<?php echo '0'.$i?>"><?php echo '0'.$i?></option>
					<?php endfor?>
					<?php for($i = 10; $i < 51; $i++):?>
					<option value="<?php echo $i?>"><?php echo $i?></option>
					<?php endfor?>
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
		
		<h4>Payment</h4>
			<hr/><br />
		<ul>
			<li class="span5">
				<label for="Price Per Seat">Seat Amount:</label>
				<?php echo form_error('seat_amount', '<div class="fl error">', '</div>')?>
				
				<div class="clr"></div>
				
				<input type="text" name="seat_amount" id="" value="<?php echo set_value('seat_amount')?>" class="form-control"/>
				
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
		
		<input type="hidden" name="user_car_id" value=""/>
		
		<input type="submit" name="create_lift_submit" value="Create Lift" class="btn-gray"/>
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
<script type="text/javascript">
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
	$('.time-dropdown, .seat-available-choice, .storage-choice').selectpicker();
	
	$('ul li div.lift-place p').click(function() { $(this).parent().children('.lift-search').slideToggle(); });
	$('ul li div.lift-place .lift-search a.l-s-done').click(function(e) { $(this).parent().slideToggle(); e.preventDefault(); });
	
	$('.lift-place input').keyup(function(e) {
		if($(this).attr('name') == 'from') {
			$.ajax({
				'url'		: '<?php echo base_url('lift/auto_suggest')?>',
				'type'		: 'GET',
				'data'		: {city: $('.lift-place input[name="from"]').val()},
				'success'	: function(data) {
					var city_array = [];
				
					$.each($.parseJSON(data), function(index, value) {
						city_array.push(value.combined);
					});
					
					var city = city_array;
					
					$('#lift-route').autocomplete({
						source:city,
						select: function(event, ui) { 
							$(this).parent().parent().parent().children('p').html(ui.item.value);
							$('input[name="origin"]').val(ui.item.value);
						}
					});
				}
			});	
		} else {
			$.ajax({
				'url'		: '<?php echo base_url('lift/auto_suggest')?>',
				'type'		: 'GET',
				'data'		: {city: $('.lift-place input[name="to"]').val()},
				'success'	: function(data) {
					var city_array = [];
				
					$.each($.parseJSON(data), function(index, value) {
						city_array.push(value.combined);
					});
					
					var city = city_array;
					
					$('#to-route').autocomplete({
						source:city,
						select: function(event, ui) { 
							$(this).parent().parent().parent().children('p').html(ui.item.value);
							$('input[name="destination"]').val(ui.item.value);
						}
					});
				}
			});	
		}

	});
	
	checkbox("re_route");
	checkbox("offer_re_route");

	$('#calendar').click(function() {
		var getDates		= $(this).multiDatesPicker('getDates'),
			getDates_array	= [];
		
		// $(hidden_dates).empty(); //This empty the hidden field
		
		$.each(getDates, function(index, value) {
			getDates_array.push('<?php echo htmlentities('"', ENT_QUOTES, "UTF-8");?>' + value + '<?php echo htmlentities('"', ENT_QUOTES, "UTF-8");?>');
		});
		
		$('input[name="dates"]').val(getDates_array);
	});
		
	//Run Calendar
	$('#calendar').multiDatesPicker({
		dateFormat	: "yy-mm-dd",
		minDate :  0,
		<?php
		if(isset($_POST['dates']) && $_POST['dates'] !== ''):
			$dates = str_replace("&quot;", "\"", $_POST['dates']);
		?>
		addDates : [<?php echo $dates?>]
		<?php 
		endif;?>
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
	
	$('.lift-preference div').mouseover(function() { $('p', this).stop(true, true).fadeIn().css({display:block}); });
	$('.lift-preference div').mouseleave(function() { $('p', this).fadeOut(); });
});
</script>