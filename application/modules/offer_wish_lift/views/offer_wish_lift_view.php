<?php $this->load->view('header_content')?>

<div class="offer-and-wish-lift m-center-content">
	<div class="span4 fl">
		<p>Hos Nimm Mich Mit forsøger vi konstant, at finde ny muligheder for samkørsel, så vi sammen kan hjælpe miljøet.</p><br />

		<p>Biler udleder gennemsnitlig fra 120 - 160 g co2 pr km, derfor hjælper du miljøet blot ved at oprette eller ønske et enkelt lift, event eller tur til udlandet.</p><br />
		
		<p>Du kan vælge lige præcis den medpassager eller billist du ønsker, gennem vores rating system, specificerede krav til turen, billisten/ medpassageren, at du er sikker på turen til arbejde, besøge familien, den længe ventede tur til udlandet eller koncert er præcis som du vil have det.</p>
	</div>
	
	<div class="span6 fr">
		<ul>
			<li><div><a href="<?php echo base_url('lift/create')?>"></a></div></li>
			<li><div><a href="<?php echo base_url('event/create')?>"></a></div></li>
			<li><div><a href="<?php echo base_url('passenger/create')?>"></a></div></li>
			<!--<li><div><a href="#"></a></div></li>-->
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