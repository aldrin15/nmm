<?php $this->load->view('header_content')?>

<div class="offer-and-wish-lift m-center-content">
	<div class="span4 fl">
		<p>
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
		sed do eiusmodtempor incididunt ut labore et dolore 
		magna aliqua. Ut enim ad minimveniam, quis nostrud 
		exercitation ullamco laboris nisi ut aliquip ex ea commodo 
		consequat. Duis aute irure dolor in reprehenderit in 
		voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
		Excepteur sint occaecat cupidatat non proident, sunt in 
		culpa qui officia deserunt mollit anim id est laborum.
		<br /><br />
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
		sed do eiusmodtempor incididunt ut labore et dolore 
		magna aliqua. Ut enim ad minimveniam, quis nostrud 
		exercitation ullamco laboris nisi ut aliquip ex ea commodo 
		consequat. Duis aute irure dolor in reprehenderit in 
		voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
		Excepteur sint occaecat cupidatat non proident, sunt in 
		culpa qui officia deserunt mollit anim id est laborum.
		</p>
	</div>
	
	<div class="span6 fr">
		<ul>
			<li><div></div></li>
			<li><div></div></li>
			<li><div></div></li>
			<li><div></div></li>
		</ul>
	</div>
	
	<div class="clr"></div>
</div>

<script type="text/javascript">
$(function() {
	$('.offer-and-wish-lift .fr ul li').mouseover(function() { $('div', this).stop(true, true).fadeIn().show(); });
	$('.offer-and-wish-lift .fr ul li').mouseleave(function() { $('div', this).fadeOut(); });
});
</script>