<?php $this->load->view('header_content')?>

<style type="text/css">
#calendar {width:360px;}
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
</style>

<div class="m-center-content">
	<h3>Create Your Wish Lift</h3>
	
	<hr/>
	
	<div class="create-lift">
		<div class="create-lift-form">
			<form action="" method="post">
				<h4>Location: From and To</h4><br />
				
				<ul class="span5">
					<li>
						<?php echo form_error('origin', '<div class="error">', '</div>')?>
							<div class="clr"></div>
						<label for="Departure">From: </label>
						<input type="text" name="origin" id="" class="form-control"/>
						
						<div class="clr"></div>
					</li>
					<li>
						<?php echo form_error('destination', '<div class="error">', '</div>')?>
							<div class="clr"></div>
						<label for="Departure">To: </label>
						<input type="text" name="destination" id=""  class="form-control"/>
						
						<div class="clr"></div>
					</li>
					<li>
						<?php echo form_error('via', '<div class="error">', '</div>')?>
						<label for="Via">Via</label>
						<input type="text" name="via" id="" class="form-control"/>
						
						<div class="clr"></div>
					</li>
				</ul>
				
				<h4>Date and Time of Lift</h4><br />
				
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
						
						<select name="hours" id="" class="dropdown select-width-auto">
							<?php for($i = 1; $i < 25; $i++):?>
							<option value="<?php echo $i?>"><?php echo $i?></option>
							<?php endfor?>
						</select>
						<select name="minute" id="" class="dropdown select-width-auto">
							<?php for($i = 1; $i < 10; $i++):?>
							<option value="<?php echo '0'.$i?>"><?php echo '0'.$i?></option>
							<?php endfor?>
							<?php for($i = 10; $i < 60; $i++):?>
							<option value="<?php echo $i?>"><?php echo $i?></option>
							<?php endfor?>
						</select>
						
						<div class="clr"></div>
					</li>
				</ul>
				
				<h4>Car Preference</h4><br />
				<ul class="span5">
					<li>
						<label for="Seat Available">Seat Available</label>
						<select name="seat_available" id="" class="dropdown select-width-auto">
							<?php for($i = 1; $i < 12; $i++):?>
							<option value="<?php echo $i?>"><?php echo $i?></option>
							<?php endfor?>
						</select>
						
						<div class="clr"></div>
					</li>
					<li>
						<label for="Storage">Storage</label>
						<select name="storage" id="" class="dropdown select-width-auto">
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
					<li>
						<label for="Remarks">Remarks:</label>
						<small>example: enter your suggested amount per seat.</small>
							<div class="clr"></div>
						<textarea name="remarks" id="" cols="30" rows="10" class="form-control"></textarea>
					</li>
				</ul>
				
				<h4>Other Options</h4><br />
				<ul>
					<li style="float:none;">
						<label style="margin-top:-8px; width:50px;"><input type="checkbox" name="re_route" value="1" id=""/></label>
						<label for="Allow Reroute">Allow Reroute</label>
						
						<div class="clr"></div>
					</li>
					<li>
						<label style="margin-top:-8px; width:50px;"><input type="checkbox" name="offer_re_route" id=""/></label>
						<label for="Offer re-route">Return Trip</label>
						
						<div class="clr"></div>
					</li>
				</ul>
				
				<input type="hidden" name="user_car_id" value=""/>
				
				<input type="submit" name="wish_lift_submit" value="Create Wish Lift" class="btn btn-default"/>
			</form>
		</div>
	</div>
</div>

<div class="clr"></div>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.7.2.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.ui.core.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.ui.datepicker.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.multidatespicker.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-select.js')?>"></script>
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
	$('.dropdown').selectpicker();
	
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
		<?php endif?>
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
	
	checkbox("re_route");
	checkbox("offer_re_route");
});
</script>