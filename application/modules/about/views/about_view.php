<?php $this->load->view('header_content')?>

<div class="m-center-content about">
	<div class="span5 fl">
		<h1>We are NMM</h1>
		
		<p>
		Westerhagen wrote Nimm Mich Mit zeigt mir den weg<br /><br />

		Vi hos NMM vil hjælpe vise vejen til et bedre miljø, på en sjov og profitabel måde og hele tiden udvikle og lancere nye måder for samkørsel så vi sammen kan hjælpe de næste generationer med et bæredygtig miljø.<br /><br />

		Derfor er det vigtigt for Nimm Mich Mit, vi ikke kun fokuserer på nye muligheder for samkørsel, men også giver dig som billist eller passager, en portal for samkørsel, hvor du føler, vi sætter dig i højsæde.
		</p>
	</div>
	<div class="span5 fr">
		<ul>
			<li><a href="#"><div></div></a></li>
			<li><a href="<?php echo base_url('about/mission_vision')?>"><div></div></a></li>
			<li><a href="<?php echo base_url('about/why')?>"><div></div></a></li>
		</ul>
	</div>
	
	<div class="clr"></div>
</div>

<script type="text/javascript">
$(function() {
	$('.about .fr ul li').mouseover(function() {
		$('div', this).fadeIn().show();
	});
	
	$('.about .fr ul li').mouseleave(function() {
		$('div', this).stop(true, true).fadeOut();
	});
});
</script>