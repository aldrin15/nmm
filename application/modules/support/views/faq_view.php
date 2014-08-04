<?php $this->load->view('header_content');?>

<div class="m-center-content">
	<div class="fl span7">
		<h2>Frequently Asked Question</h2>
		<div class="faq-menu">
			<ul>
				<li><a href="#1">I have a question?</a></li>
				<li><a href="#2">I have a question?</a></li>
				<li><a href="#3">I have a question?</a></li>
				<li><a href="#4">I have a question?</a></li>
				<li><a href="#5">I have a question?</a></li>
			</ul>
		</div>
		<ul>
			<?php for($i = 0; $i < 5; $i++):?>
			<li id="<?php echo $i?>">
				<h3>I have a question?</h3>
				<p><strong>Answer:</strong> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. </p>
			</li>
			<?php endfor?>
		</ul>
		<br /><br /><br /><br />
		<div class="support-sub-links">
			<ul>
				<li>
					<h5><?php echo $translate['rides_booking']?></h5>
					<p><a href="<?php echo base_url('support/driver')?>"><?php echo $translate['for_driver']?></a></p>
					<p><a href="<?php echo base_url('support/rules')?>"><?php echo $translate['rules_rides_booking']?></a></p>
					<p><a href="<?php echo base_url('support/payment')?>"><?php echo $translate['payment']?></a></p>
					<p><a href="<?php echo base_url('support/tax')?>"><?php echo $translate['tax_legislation']?></a></p>
					<p><a href="<?php echo base_url('support/faq')?>"><?php echo $translate['general_question']?></a></p>
				</li>
			</ul>
		</div>
	</div>
	<div class="fr support-ads">
		<img src="<?php echo base_url('assets/images/support_ads.jpg')?>" width="235" height="522" alt=""/>
	</div>
	
	<div class="clr"></div>
</div>