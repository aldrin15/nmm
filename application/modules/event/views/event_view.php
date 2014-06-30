<?php $this->load->view('header_content');?>

<div class="m-center-content event-listings">
	<h1>Upcoming</h1>
	<h2>Events</h2>

	<?php if($event_data == null):?>
		<div style="font-size:1.2em; font-weight:bold; border:1px solid #000; text-align:center; margin-top:10px; padding:20px;"><p>There are no events at the moment</p></div>
	<?php else:?>
		<ul>
			<?php foreach($event_data as $row):?>
			<li>
				<a href="<?php echo base_url('event/detail'.'/'.$row['id'])?>">
					<img src="<?php echo base_url('assets/images/event_image.jpg')?>" width="220" height="135" alt=""/>
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