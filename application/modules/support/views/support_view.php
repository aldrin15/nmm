<?php echo $this->load->view('header_content')?>

<style type="text/css">
.support ul {padding-top:80px;}
.support ul li {float:left; margin-right:20px;}
</style>

<div class="m-center-content support">
	<div class="fl demo-videos">
		<img src="<?php echo base_url('assets/images/testing.jpg')?>" width="563" height="269" alt=""/>
		<p>If you have any questions or inquiries you can chat our <a href="//nmm-nmm.de/chat/phplive.php?d=0&onpage=livechatimagelink&title=Live+Chat+Image+Link" onclick="window.open(this.href, 'targetWindow', 'toolbar=no, location=no, menubar=no, scrollbar=yes, resizable=yes, width=530, height=450'); return false"><img src="//nmm-nmm.de/chat/ajax/image.php?d=0" border=0></a></p>
		
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
		
		<div class="clr"></div>
	</div>
	<div class="fr support-ads">
		<img src="<?php echo base_url('assets/images/support_ads.jpg')?>" width="235" height="522" alt=""/>
	</div>
	
	<div class="clr"></div>
</div>

<script type="text/javascript">
(function() {
var phplive_e_1406771936 = document.createElement("script") ;
phplive_e_1406771936.type = "text/javascript" ;
phplive_e_1406771936.async = true ;
phplive_e_1406771936.src = "//nmm-nmm.de/chat/js/phplive_v2.js.php?v=0|1406771936|0|" ;
document.getElementById("phplive_btn_1406771936").appendChild( phplive_e_1406771936 ) ;
})() ;
</script>