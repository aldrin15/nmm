<?php $this->load->view('header_content')?>

<style type="text/css">.slideshow ul {margin:0 auto; width:1024px; height:360px;} @media (max-width: 920px) { .slideshow ul {width:100%;} } @media (max-width: 480px) { .slideshow ul {height:270px;} } @media (max-width: 320px) { .slideshow ul {height:175px;} }</style>

<div class="slideshow">			
	<ul class="rslides" id="slider1">
		<li><img src="<?php echo base_url('assets/images/rides/1.jpg')?>" width="100%" alt=""></li>
		<li><img src="<?php echo base_url('assets/images/rides/2.jpg')?>" width="100%" alt=""></li>
		<li><img src="<?php echo base_url('assets/images/rides/3.jpg')?>" width="100%" alt=""></li>
	</ul>
	
	<div class="clr"></div>
</div>

<div class="m-center lift-view">
	<?php echo modules::run('lift/search')?>
	
	<h3 class="fl">Upcoming lift near you:</h3>
	<?php 
	if($this->session->userdata('validated') == true):
		echo '<a href="'.base_url('rides/create').'" class="btn-create-lift fr btn-advance">Create Lift</a>';
	endif;
	?>
	
	<div class="clr"></div>
	
	<div class="lift-listing">
		<?php if($ride_list == 0):?>
			<div style="font-size:1.2em; font-weight:bold; border:1px solid #000; text-align:center; margin:10px 0; padding:20px;"><p>There are no route that match your criteria. Try some different places</p></div>
		<?php else:?>
			<ul>
				<?php 
				foreach($ride_list as $row):?>
				<li class="column">
					<p><?php echo $row['firstname'].' '.$row['lastname']?></p>
					<a href="<?php echo base_url().'rides/detail/'.$row['id']?>">
						<img src="<?php echo base_url('assets/images/page_template/no_car.jpg')?>" alt="Car"/>
					</a>
					<div>
						<label for="From"><strong>From: </strong></label>
						<span><?php echo $row['origin']?></span>
						
						<div class="clr"></div>
					</div>
					<div>
						<label for="To"><strong>To: </strong></label>
						<span><?php echo $row['destination']?></span>
						
						<div class="clr"></div>
					</div>
					<div>
						<label for="Date"><strong>On</strong></label>
						<span><?php echo date('M d', strtotime($row['date']))?></span>
						<label for="at">&nbsp;<strong>at</strong></label>
						<span><?php echo date('g A', strtotime($row['start_time']))?></span>
						
						<div class="clr"></div>
					</div>
					<div>
						<div class="fl" style="margin:0;">
							<label for="Available Seats"><strong>Available Seat/s:</strong></label>
							<span><?php echo $row['available']?></span>
						</div>
						<div class="fr" style="color:#678222; margin:-6px 0 0 0;">
							<label for="" style="font-size:1.5em;">&#128; </label>
							<span style="font-size: 1.5em;"><?php echo $row['amount']?></span>
						</div>
						
						<div class="clr"></div>
					</div>
					
					<div class="clr"></div>
				</li>
				<?php endforeach?>
			</ul>	
		<?php endif?>
		<div class="clr"></div>
	</div>
	
	<div class="clr"></div>
	
	<div>
		<?php echo $this->pagination->create_links()?>
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-modal.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-modalmanager.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/responsiveslides.js')?>"></script>
<?php echo modules::run('lift/auto_suggest_city')?>
<script type="text/javascript">function equalHeight(group) { tallest = 0; group.each(function() { thisHeight = $(this).height(); if(thisHeight > tallest) { tallest = thisHeight; } }); group.height(tallest); }$(function() { equalHeight($(".column")); $("#slider1").responsiveSlides({ maxwidth: "none", speed: 800 }); });</script>