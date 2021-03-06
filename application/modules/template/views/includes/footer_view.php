	</div>
</div>
<?php
$url = $this->uri->segment(1);

if($url == ''):
?>
<div class="modal fade" id="demo-video" tabindex="-1" role="dialog" aria-hidden="true" style="display:none; top:15%; z-index:9999;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				&nbsp;
			</div>
			<div class="modal-body">
				
			</div>
		</div>
	</div>
</div>
<?php endif?>
<footer>
	<div class="line-separator m-center"></div>
	
	<div class="m-center">
		<div class="pull-left">
			<div class="fl">
				<h5>NMM</h5>
				<ul>
					<li><a href="<?php echo base_url('about-us')?>"><?php echo $translate['about_nmm']?></a></li>
					<li><a href="<?php echo base_url('privacy-policy')?>"><?php echo $translate['privacy_policy']?></a></li>
					<li><a href="<?php echo base_url('terms-and-condition')?>"><?php echo $translate['terms_condition']?></a></li>
				</ul>
			</div>
			<div class="fl">
				<h5>Help</h5>
				
				<ul>
					<li><a href="<?php echo base_url('support')?>"><?php echo $translate['support']?></a></li>
					<li><a href="<?php echo base_url('contact-us')?>"><?php echo $translate['contact_us']?></a></li>
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
				<span><strong><?php echo modules::run('lift/co2_daily')?></strong></span><br />
				<span>CO2 saving in kg.</span>
			</div>
		</div>
		
		<div class="clr"></div>
	</div>
	<div class="copyrights"><p>&copy; 2014 NMM. All rights reserved.</p></div>
</footer>
</body>
</html>