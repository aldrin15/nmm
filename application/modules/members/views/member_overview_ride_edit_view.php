<?php $this->load->view('header_content')?>

<div class="profile-wrapper m-center-content">
	<?php echo modules::run('lift/search')?>
	
	<?php $this->load->view('member_sidebar_view')?>
	
	<div class="fl overview-detail">
		<?php foreach($ride_details_data as $row):?>
		<form action="" method="post">
			<ul>
				<li>
					<label for="From">From: </label>
					<span><?php echo $row['origins']?></span>
				</li>
				<li>
					<label for="From">To: </label>
					<span><?php echo $row['destination']?></span>
				</li>
				<li>
					<label for="From">Via: </label>
					<span><?php echo $row['via']?></span>
				</li>
				<li>
					<label for="Time">Time</label>
					<?php
					$hour = date('H', strtotime($row['start_time']));
					$minute = date('i', strtotime($row['start_time']));
					?>
					<select name="hour" id="" class="bt-dropdown select-width-auto">
						<?php for($x = 1; $x < 25; $x++):?>
						<option value="<?php echo $x?>" <?php echo ($hour == $x) ? 'selected' : ''?>><?php echo $x?></option>
						<?php endfor?>
					</select>
					<select name="minute" id="" class="bt-dropdown select-width-auto">
						<?php for($x = 1; $x < 60; $x++):?>
						<option value="<?php echo ($x > 10) ? '0'.$x : $x?>" <?php echo ($minute == $x) ? 'selected' : ''?>><?php echo ($x < 10) ? '0'.$x : $x?></option>
						<?php endfor?>
					</select>
				</li>
				<li>
					<label for="Storage">Storage</label>
					<select name="storage" id="" class="bt-dropdown select-width-auto">
						<option value="small" <?php echo ($row['storage'] == 'small') ? 'selected' : ''?>>Small</option>
						<option value="medium" <?php echo ($row['storage'] == 'medium') ? 'selected' : ''?>>Medium</option>
						<option value="large" <?php echo ($row['storage'] == 'large') ? 'selected' : ''?>>Large</option>
					</select>
				</li>
				<li>
					<label for="Available">Available</label>
					<select name="available" id="" class="bt-dropdown select-width-auto">
						<?php for($x=1; $x<12; $x++):?>
						<option <?php echo ($row['available'] == $x) ? 'selected' : ''?>><?php echo $x?></option>
						<?php endfor?>
					</select>
				</li>
				<li>
					<label for="Preference">Preference</label>
					
					<div class="lift-preference">
						<?php 
						$preference = explode(',', $row['preference']);
					
						if($preference !== 0):
						?>
						<div class="fl checkbox-1 <?php echo (in_array(1, $preference)) ? 'selected' : ''?>">
							<input type="checkbox" name="preference[]" value="1" <?php echo (in_array(1, $preference)) ? 'checked="checked"' : ''?>/>
							<p>Talk <i></i></p>
						</div>
						<div class="fl checkbox-2 <?php echo (in_array(2, $preference)) ? 'selected' : ''?>">
							<input type="checkbox" name="preference[]" value="2" <?php echo (in_array(1, $preference)) ? 'checked="checked"' : ''?>/>
							<p>Music <i></i></p>
						</div>
						<div class="fl checkbox-3 <?php echo (in_array(3, $preference)) ? 'selected' : ''?>">
							<input type="checkbox" name="preference[]" value="3" <?php echo (in_array(3, $preference)) ? 'checked="checked"' : ''?>/>
							<p>Pet <i></i></p>
						</div>
						<div class="fl checkbox-4 <?php echo (in_array(4, $preference)) ? 'selected' : ''?>">
							<input type="checkbox" name="preference[]" value="4" <?php echo (in_array(4, $preference)) ? 'checked="checked"' : ''?>/>
							<p>Smoke <i></i></p>
						</div>
						<div class="fl checkbox-5 <?php echo (in_array(5, $preference)) ? 'selected' : ''?>">
							<input type="checkbox" name="preference[]" value="5" <?php echo (in_array(5, $preference)) ? 'checked="checked"' : ''?>/>
							<p>Baby <i></i></p>
						</div>
						<div class="fl checkbox-6 <?php echo (in_array(6, $preference)) ? 'selected' : ''?>">
							<input type="checkbox" name="preference[]" value="6" <?php echo (in_array(6, $preference)) ? 'checked="checked"' : ''?>/>
							<p>Women Only <i></i></p>
						</div>
						<?php
						else:
							echo '<div>: None</div>';
						endif;
						?>
					</div>
					
					<div class="clr"></div>
				</li>
				<li>
					<span><input type="submit" name="submit" value="Edit Post"/></span>
				</li>
			</ul>
		</form>
		<?php endforeach?>
	</div>
	
	<div class="clr"></div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-select.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.ui.core.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.ui.datepicker.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.multidatespicker.js')?>"></script>
<script type="text/javascript">
$('.bt-dropdown').selectpicker();
$('.lift-preference div').click(function(){var input=$('input',this);if(input.attr('checked')){input.attr('checked',false);$(this).removeClass('selected')}else{input.attr('checked',true);$(this).addClass('selected')}});
$('.lift-preference div').mouseover(function() { $('p', this).stop(true, true).fadeIn().css({display:'block'}); });
$('.lift-preference div').mouseleave(function() { $('p', this).fadeOut(); });
</script>
<?php echo modules::run('lift/auto_suggest_city')?>