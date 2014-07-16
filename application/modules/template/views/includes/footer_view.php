	</div>
</div>

<footer>
	<div class="line-separator m-center"></div>
	
	<div class="m-center">
		<div class="pull-left">
			<div class="fl">
				<h5>NMM</h5>
				<ul>
					<li><a href="<?php echo base_url('about-us')?>">About NMM</a></li>
					<li><a href="<?php echo base_url('privacy-policy')?>">Privacy Policy</a></li>
					<li><a href="<?php echo base_url('terms-and-condition')?>">Terms & Conditions</a></li>
				</ul>
			</div>
			<div class="fl">
				<h5>Help</h5>
				
				<ul>
					<li><a href="<?php echo base_url('support')?>">Support</a></li>
					<li><a href="<?php echo base_url('contact-us')?>">Contact Us</a></li>
				</ul>
			</div>
			<div class="fl">
				<h5>Connect</h5>
				
				<a href="#"><img src="<?php echo base_url('assets/images/page_template/icon_fb.jpg')?>" width="28" height="28" alt="Like us on Facebook" title="Like us on Facebook"/></a>
			</div>
			
			<div class="clr"></div>
		</div>
		
		<div class="pull-right">
			<div class="fl">
				<img src="<?php echo base_url('assets/images/page_template/icon_car.jpg')?>" width="38" height="32" alt=""/><br />
				<span><strong><?php echo modules::run('lift/rides_count')?></strong></span><br />
				<span>Lift today</span>
			</div>
			<div class="fl">
				<img src="<?php echo base_url('assets/images/page_template/icon_people.jpg')?>" width="49" height="32" alt=""/><br />
				<span><strong><?php echo modules::run('members/member_count')?></strong></span><br />
				<span>member in NMM</span>
			</div>
			<div class="fl">
				<img src="<?php echo base_url('assets/images/page_template/icon_leave.jpg')?>" width="28" height="32" alt=""/><br />
				<span><strong>8,888,888</strong></span><br />
				<span>CO2 saving in kg.</span>
			</div>
		</div>
		
		<div class="clr"></div>
	</div>
	<div class="copyrights"><p>&copy; 2014 NMM. All rights reserved.</p></div>
</footer>
</body>
</html>