<?php $this->load->view('header_content')?>

<div class="slideshow-search" style="position:relative;">
	<div class="slideshow">			
		<ul class="rslides" id="slider1">
			<li><img src="<?php echo base_url('assets/images/passenger/1.jpg')?>" alt=""></li>
			<li><img src="<?php echo base_url('assets/images/passenger/2.jpg')?>" alt=""></li>
			<li><img src="<?php echo base_url('assets/images/passenger/3.jpg')?>" alt=""></li>
		</ul>
		
		<div class="clr"></div>
	</div>
</div>

<div class="passenger-view m-center">
	<div class="search">
		<form action="" method="post">
			<ul>
				<li>
					<?php echo form_error('from', '<div class="error">', '</div>')?>
						<div class="clr"></div>
					<span><input type="text" name="from" id="from-route" autocomplete="off"/></span>
				</li>
				<li>
					<?php echo form_error('to', '<div class="error">', '</div>')?>
						<div class="clr"></div>
					<span><input type="text" name="to" id="to-route" autocomplete="off" /></span>
				</li>
				<li>
					<input type="submit" name="ride_submit" value="    Search" class="btn-search"/>

					<div class="clr"></div>
				</li>
				<li>
					<input type="submit" name="option" value="Advance Option" class="btn-advance" style="margin-left:5px;"/>
					
					<div class="clr"></div>
				</li>
			</ul>
			
			<div class="clr"></div>
		</form>
	</div>
	
	<h3 class="fl">Wish rides by user:</h3>
	
	<?php 
	if($this->session->userdata('validated') == true):
		echo '<a href="'.base_url('passenger/create').'" class="btn-create-lift fr btn-advance">Wish a Lift</a>';
	endif;
	?>
	
	<div class="clr"></div>

	<div class="passenger-listing">
		<?php if($wish_lift_data == null):?>
			<div style="font-size:1.2em; font-weight:bold; border:1px solid #000; text-align:center; margin-top:10px; padding:20px;"><p>There are no post of passengers at the moment</p></div>
		<?php else:?>
			<ul>
				<?php foreach($wish_lift_data as $wish_lift):?>
				<li>
					<a href="<?php echo base_url('passenger/detail/'.$wish_lift['id'])?>">
						<img src="<?php echo ($wish_lift['image'] != '') ? base_url('assets/media_uploads').'/'.$wish_lift['image'] : base_url('assets/images/page_template/blank_profile_large.jpg')?>" width="150" height="150" alt="User"/>
						<span><strong>From</strong> <?php echo $wish_lift['origin']?></span>
						<span><strong>To</strong> <?php echo $wish_lift['destination']?></span>
						<span><strong>Via</strong> <?php echo $wish_lift['via']?></span>
						<span><strong>Posted</strong> <?php echo date('F d', strtotime($wish_lift['date']))?></span>
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
		<?php endif?>
		<div class="clr"></div>
	</div>
	
	<div class="clr"></div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.rateit.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/responsiveslides.js')?>"></script>
<script type="text/javascript">$(function() { $('#datepicker').datepicker(); $("#slider1").responsiveSlides({ maxwidth: "none", speed: 800 }); });</script>