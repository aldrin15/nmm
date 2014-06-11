<?php $this->load->view('header_content')?>

<div class="m-center-content about">
	<div class="span5 fl">
		<h1>Mission and Vision</h1>
		
		<p>
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
		sed do eiusmod tempor incididunt ut labore et dolore 
		magna aliqua. Ut enim ad minim veniam, quis nostrud 
		exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in 
		voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
		Excepteur sint occaecat cupidatat non proident, sunt in 
		culpa qui officia deserunt mollit anim id est laborum.
		</p>
		
		<p>
		Sed ut perspiciatis unde omnis iste natus error sit 
		voluptatem accusantium doloremque laudantium, totam 
		rem aperiam, eaque ipsa quae ab illo inventore veritatis 
		et quasi architecto beatae vitae dicta sunt explicabo. 
		Nemo enim ipsam voluptatem quia voluptas sit 
		aspernatur aut odit aut fugit, sed quia consequuntur 
		magni dolores eos qui ratione voluptatem sequi nesciunt. 
		Neque porro quisquam est, qui dolorem ipsum quia dolor
		sit amet, consectetur, adipisci velit, sed quia non 
		numquam eius modi tempora incidunt ut labore et dolore 
		magnam aliquam quaerat voluptatem.
		</p>
	</div>
	<div class="span5 fr">
		<ul>
			<li><a href="<?php echo base_url('about')?>"><div></div></a></li>
			<li><a href="#"><div></div></a></li>
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