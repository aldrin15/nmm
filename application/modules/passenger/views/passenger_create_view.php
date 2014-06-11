<?php $this->load->view('header_content')?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/mdp.css')?>">
<style type="text/css">
.error {color:#ff0000; margin-left:100px;}

.create-lift ul {list-style:none;}
.profile-search ul li {float:left;}

.create-lift-form h3 {padding:10px 0;}
.create-lift-form ul li {margin-bottom:10px;}
.create-lift-form ul li label {width:100px;}
.create-lift-form ul li label, .create-lift-form ul li input, .create-lift-form ul li select {float:left;}

.create-lift-form ul li div.fl {margin-right:10px;}
.create-lift-form ul li div input[type="checkbox"] {margin-top:3px;}
</style>

<div class="create-lift">
	<div class="profile-search">
		<form action="" method="post">
			<ul>
				<li>
					<?php echo form_error('from', '<div class="error">', '</div>')?>
						<div class="clr"></div>
					<label for="From">Search a lift From:</label>
					<input type="text" name="from" id="from-route" />
					
					<div class="from-suggestion">
						<ul>
						</ul>
					</div>
				</li>
				<li>
					<?php echo form_error('to', '<div class="error">', '</div>')?>
						<div class="clr"></div>
					<label for="To">To:</label>
					<input type="text" name="to" id="to-route"/>
				</li>
				<li>
					<input type="submit" name="ride_submit" value="Ride" class="chose fl"/>

					<div class="clr"></div>
				</li>
			</ul>
			
			<div class="clr"></div>
		</form>
	</div>
	
	<div class="create-lift-form">
		<form action="" method="post">
			<h3>Location: From and To</h3>
				<hr/><br />
			<ul>
				<li>
					<?php echo form_error('origin', '<div class="error">', '</div>')?>
						<div class="clr"></div>
					<label for="Departure">From: </label>
					<input type="text" name="origin" id=""/>
					
					<div class="clr"></div>
				</li>
				<li>
					<?php echo form_error('destination', '<div class="error">', '</div>')?>
						<div class="clr"></div>
					<label for="Departure">To: </label>
					<input type="text" name="destination" id=""/>
					
					<div class="clr"></div>
				</li>
				<li>
					<?php echo form_error('via', '<div class="error">', '</div>')?>
					<label for="Via">Via</label>
					<input type="text" name="via" id=""/>
					
					<div class="clr"></div>
				</li>
			</ul>
			
			<h3>Date and Time of Lift</h3>
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
					
					<span class="fl">Hour&nbsp;</span>
					<select name="hours" id="">
						<?php for($i = 1; $i < 25; $i++):?>
						<option value="<?php echo $i?>"><?php echo $i?></option>
						<?php endfor?>
					</select>
					<span class="fl">&nbsp;-&nbsp;Min&nbsp;</span>
					<select name="minute" id="">
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
			
			<h3>Car Preference</h3>
				<hr/><br />
			<ul>
				<li>
					<label for="Seat Available">Seat Available</label>
					<select name="seat_available" id="">
						<?php for($i = 1; $i < 12; $i++):?>
						<option value="<?php echo $i?>"><?php echo $i?></option>
						<?php endfor?>
					</select>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Storage">Storage</label>
					<select name="storage" id="">
						<option value="Small">Small</option>
						<option value="Medium">Medium</option>
						<option value="Large">Large</option>
					</select>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Preferences">Preferences:</label>
					
					<div class="fl">
						<input type="checkbox" name="preference[]" id="1"/>	
						<span for="" class="fl">Talk</span>
					</div>
					<div class="fl">
						<input type="checkbox" name="preference[]" id="2"/>					
						<span for="" class="fl">Music</span>
					</div>
					<div class="fl">
						<input type="checkbox" name="preference[]" id="3"/>
						<span for="" class="fl">Pet</span>
					</div>
					<div class="fl">
						<input type="checkbox" name="preference[]" id="4"/>					
						<span for="" class="fl">Smoke</span>
					</div>
					<div class="fl">
						<input type="checkbox" name="preference[]" id="5"/>					
						<span for="" class="fl">Baby</span>
					</div>
					<div class="fl">
						<input type="checkbox" name="preference[]" id="6"/>
						<span for="" class="fl">Only Women</span>
					</div>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Remarks">Remarks:</label>
					<small>example: enter your suggested amount per seat.</small>
						<div class="clr"></div>
					<textarea name="remarks" id="" cols="30" rows="10" style="margin-left:100px;"></textarea>
				</li>
			</ul>
			<h3>Payment</h3>
				<hr/><br />
			<ul>
				<li>
					<input type="checkbox" name="payment" value="1" id="" style="margin-top:3px;"/>
					<label for="" style="width:150px;">Pay Through Cash</label>
					
					<div class="clr"></div>
				</li>
			</ul>
			
			<h3>Other Options</h3>
				<hr/><br />
			<ul>
				<li style="float:none;">
					<input type="checkbox" name="re_route" value="1" id=""/>
					<label for="Allow Reroute">Allow Reroute</label>
					
					<div class="clr"></div>
				</li>
				<li>
					<input type="checkbox" name="offer_re_route" id=""/>
					<label for="Offer re-route">Return Trip</label>
					
					<div class="clr"></div>
				</li>
			</ul>
			
			<input type="hidden" name="user_car_id" value=""/>
			
			<input type="submit" name="wish_lift_submit" value="Wish Lift"/>
		</form>
	</div>
</div>

<div class="clr"></div>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.7.2.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.ui.core.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.ui.datepicker.js')?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.multidatespicker.js')?>"></script>
<script type="text/javascript">
$(function() {
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
});
</script>