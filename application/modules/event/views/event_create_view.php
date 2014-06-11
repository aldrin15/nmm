<?php $this->load->view('header_content')?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/mdp.css')?>">
<div class="m-center-content event">
	<h1>Post an Event!</h1><br />
	<form action="" method="post">
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
		
		<div class="span5">
			<ul>
				<li>
					<label for="Title">Title</label> <?php echo form_error('title', '<span class="error">', '</span>')?>
					<input type="text" name="title" id="" class="form-control"/>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Title">Address</label> <?php echo form_error('address', '<span class="error">', '</span>')?>
					<input type="text" name="address" id="" class="form-control"/>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Date">Date</label> <?php echo form_error('dates', '<span class="error">', '</span>')?>
					<input type="hidden" name="dates" id="" value="<?php echo set_value('dates')?>"/>
					<div id="calendar" class="fl"></div>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Time">Time</label>
					
					<div>
						<select name="hour" class="selectpicker select-width-auto">
							<?php for($i = 1; $i < 25; $i++):?>
							<option><?php echo $i?></option>
							<?php endfor?>
						</select> -
						<select name="minutes" class="selectpicker select-width-auto">
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
			  <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="image"></span>
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

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.7.2.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.ui.core.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.ui.datepicker.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.multidatespicker.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-select.js')?>"></script>
<script type="text/javascript" src="http://jasny.github.io/bootstrap/dist/js/jasny-bootstrap.min.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-input.js')?>"></script>-->
<script type="text/javascript">
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
	
	$('#calendar').multiDatesPicker({
		minDate: -0,
		<?php
		if(isset($_POST['dates']) && $_POST['dates'] !== ''):
			$dates = str_replace("&quot;", "\"", $_POST['dates']);
		?>
		addDates : [<?php echo $dates?>]
		<?php 
		endif;?>		
	});
	
	$('#calendar').click(function() {
		var getDates		= $(this).multiDatesPicker('getDates'),
			getDates_array	= [];
		
		// $(hidden_dates).empty(); //This empty the hidden field		
		$.each(getDates, function(index, value) {
			getDates_array.push('<?php echo htmlentities('"', ENT_QUOTES, "UTF-8");?>' + value + '<?php echo htmlentities('"', ENT_QUOTES, "UTF-8");?>');
		});
		
		$('input[name="dates"]').val(getDates_array);
	});
	
	$('.selectpicker').selectpicker(); //For Customize Select option
});
</script>