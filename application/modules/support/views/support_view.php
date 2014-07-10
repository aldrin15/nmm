<?php echo $this->load->view('header_content')?>

<style type="text/css">
.support ul {padding-top:80px;}
.support ul li {float:left; margin-right:20px;}
</style>

<div class="m-center-content support">
	<div class="fl demo-videos">
		<img src="<?php echo base_url('assets/images/demo_video.jpg')?>" width="563" height="269" alt=""/>
		
		<div class="support-sub-links">
			<ul>
				<li>
					<h5>Rides & Bookings</h5>
					<p><a href="<?php echo base_url('support/menu_subtopic')?>">Menu with subtopic</a></p>
					<p><a href="<?php echo base_url('support/driver')?>">For the driver</a></p>
					<p><a href="<?php echo base_url('support/rules')?>">Rules for Rides & Booking</a></p>
					<p><a href="<?php echo base_url('support/payment')?>">Payment</a></p>
					<p><a href="<?php echo base_url('support/tax')?>">Tax & legislation</a></p>
					<p><a href="<?php echo base_url('support/faq')?>">General questions</a></p>
				</li>
			</ul>
		</div>
		
		<div class="clr"></div>
	</div>
	<div class="fr support-ads">
		<img src="<?php echo base_url('assets/images/support_ads.jpg')?>" width="235" height="522" alt=""/>
	</div>
	
	<div class="clr"></div>
</div>