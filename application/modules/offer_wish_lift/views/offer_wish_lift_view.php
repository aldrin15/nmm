<?php $this->load->view('header_content')?>

<div class="offer-and-wish-lift m-center-content">
	<div class="span4 fl">
		<p>Hos Nimm Mich Mit forsøger vi konstant, at finde ny muligheder for samkørsel, så vi sammen kan hjælpe miljøet.</p><br />

		<p>Biler udleder gennemsnitlig fra 120 - 160 g co2 pr km, derfor hjælper du miljøet blot ved at oprette eller ønske et enkelt lift, event eller tur til udlandet.</p><br />
		
		<p>Du kan vælge lige præcis den medpassager eller billist du ønsker, gennem vores rating system, specificerede krav til turen, billisten/ medpassageren, at du er sikker på turen til arbejde, besøge familien, den længe ventede tur til udlandet eller koncert er præcis som du vil have det.</p>
	</div>
	
	<div class="span5 fr">
		<ul>
			<li>
				<a href="<?php echo base_url('lift/create')?>">
					<p>Create an Event</p>
					<div><span></span></div>
					
					<p class="clr"></p>
				</a>
			</li>
			<li>
				<a href="<?php echo base_url('event/create')?>">
					<div><span></span></div>
					<p>Create a Ride</p>
					
					<p class="clr"></p>
				</a>
			</li>
			<li>
				<a href="<?php echo base_url('passenger/create')?>">
					<p>Create a Wish Lift</p>
					<div><span></span></div>
					
					<p class="clr"></p>
				</a>
			</li>
		</ul>
	</div>
	
	<div class="clr"></div>
</div>

<script type="text/javascript">
$(function() {
	// $('.offer-and-wish-lift .fr ul li').mouseleave(function() { $('span', this).stop(true, true).fadeIn(function() {$(this).css({display:'block'});}); });
	$('.offer-and-wish-lift .fr ul li').mouseover(function() { $('span', this).fadeOut(); });
	$('.offer-and-wish-lift .fr ul li').mouseleave(function() { $('span', this).stop(true,true).fadeIn(); });
});
</script>