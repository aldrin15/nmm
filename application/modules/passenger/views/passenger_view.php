<?php $this->load->view('header_content')?>

<div class="passenger-view m-center">
	<div class="passenger-search">
		<form action="" method="post">
			<ul>
				<li>
					<?php echo form_error('from', '<div class="error">', '</div>')?>
					<span><input type="text" name="from" id=""/></span>
				</li>
				<li>
					<?php echo form_error('to', '<div class="error">', '</div>')?>
					<span><input type="text" name="to" id=""/></span>
				</li>
				<li>
					<input type="submit" name="ride_submit" value="Search" class="btn-gray"/>
				</li>
			</ul>
			
			<div class="clr"></div>
		</form>
	</div>

	<div class="passenger-listing fl">
		<ul>
			<?php foreach($wish_lift_data as $wish_lift):?>
			<li>
				<a href="<?php echo base_url('passenger/detail/'.$wish_lift['id'])?>">
					<img src="<?php echo base_url('assets/images/user.jpg')?>" width="150" height="150" alt="User"/>
					<span><strong>From</strong> <?php echo $wish_lift['origin']?></span>
					<span><strong>To</strong> <?php echo $wish_lift['destination']?></span>
					<span><strong>Via</strong> <?php //echo $wish_lift['via']?></span>
					<span><strong>Posted</strong> <?php echo $wish_lift['posted']?></span>
					<span><strong>Requested seat(s)</strong> <?php echo $wish_lift['available']?></span>
					<span><strong>Requested by</strong> <?php echo $wish_lift['firstname']." ".$wish_lift['lastname']?></span>
					<div class="user-rating">
						<?php
						$rating			= explode(', ', $wish_lift['rating']);
						$rating_sum		= array_sum($rating);
						$rating_count 	= count($rating);
						$rating_data	= $rating_sum / $rating_count;
						$result 		= number_format($rating_data, 2);
						?>
						<div class="rateit" data-rateit-value="<?php echo $result?>" data-rateit-readonly="true"></div>
						<div class="clr"></div>	
					</div>
				</a>
			</li>
			<?php endforeach?>
		</ul>
		
		<div class="clr"></div>
	</div>
	
	<div class="ads fr">
		<img src="<?php echo base_url('assets/images/page_template/ads.jpg')?>" width="120" height="240" alt=""/>
	</div>
	
	<div class="clr"></div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.rateit.js')?>"></script>
<script type="text/javascript">
$(function() {
	$('#datepicker').datepicker();
});
</script>