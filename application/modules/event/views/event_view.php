<?php $this->load->view('header_content');?>

<div class="slideshow-search" style="position:relative;">
	<div class="slideshow">			
		<ul class="rslides" id="slider1">
			<li><img src="<?php echo base_url('assets/images/events/1.jpg')?>" width="100%" alt=""></li>
			<li><img src="<?php echo base_url('assets/images/events/2.jpg')?>" width="100%" alt=""></li>
			<li><img src="<?php echo base_url('assets/images/events/3.jpg')?>" width="100%" alt=""></li>
		</ul>
		
		<div class="clr"></div>
	</div>
</div>

<div class="m-center-content event-listings">
	<h3 class="fl">Upcoming events:</h3>
	
	<?php 
	if($this->session->userdata('validated') == true):
		echo '<a href="'.base_url('event/create').'" class="btn-create-lift fr btn-advance">Create Event</a>';
	endif;
	?>	

		<div class="clr"></div>

	<?php if($event_data == null):?>
		<div style="font-size:1.2em; font-weight:bold; border:1px solid #000; text-align:center; margin-top:10px; padding:20px;"><p>There are no events at the moment</p></div>
	<?php else:?>
		<ul>
			<?php foreach($event_data as $row):?>
			<li>
				<a href="<?php echo base_url('event/detail'.'/'.$row['id'])?>">
					<img src="<?php echo ($row['image'] != '') ? base_url('assets/media_uploads/events').'/'.$row['image'] : base_url('assets/images/page_template/no_event.jpg')?>" width="220" height="135" alt=""/>
					<div class="event-details">
						<div class="event-date">
							<?php
								$month 	= date('F', strtotime($row['date_created']));
								$date	= date('j', strtotime($row['date_created']));
								$year	= date('Y', strtotime($row['date_created']));
								
							
								echo $month.' '.$date;
								if($date == '1'):
									echo '<sup>ST</sup>';
								elseif($date == '2'):
									echo '<sup>ND</sup>';
								else:
									echo '<sup>TH</sup>';
								endif;
								echo ' '.$year;
							?>
						</div>
						<div class="event-title"><?php echo $row['title']?></div>
						<div class="event-address"><?php echo $row['address']?></div>
						<div class="event-btn"><img src="<?php echo base_url('assets/images/page_template/btn_view_events.png')?>" width="141" height="27" alt=""/></div>
					</div>
				</a>
			</li>
			<?php endforeach?>
		</ul>
	<?php endif?>
	
	<div class="clr"></div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/responsiveslides.js')?>"></script>
<script type="text/javascript">$(function() {$("#slider1").responsiveSlides({ maxwidth: "none", speed: 800 });})</script>