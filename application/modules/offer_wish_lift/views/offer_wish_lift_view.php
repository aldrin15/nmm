<?php $this->load->view('header_content')?>

<div class="offer-and-wish-bg"></div>

<div class="offer-and-wish-lift m-center-content">
	<ul>
		<li><a href="<?php echo base_url('rides/create')?>"><img src="<?php echo base_url('assets/images/page_template/offer_create_lift.png')?>" alt="Create Lift" title=""/></a></li>
		<li><a href="<?php echo base_url('passenger/create')?>"><img src="<?php echo base_url('assets/images/page_template/offer_wish_lift.png')?>" alt="Wish a Lift" title=""/></a></li>
		<li><a href="<?php echo base_url('event/create')?>"><img src="<?php echo base_url('assets/images/page_template/offer_create_event.png')?>" alt="Create Event" title=""/></a></li>
	</ul>
	
	<p>
	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra elit a magna dapibus fermentum. Mauris vitae orci nulla. In vel sapien at turpis auctor pharetra et eget velit. Nunc nec dolor commodo, dictum nulla ac, venenatis elit. Quisque nec tortor vel nunc condimentum dapibus. Praesent ut magna eget leo mattis luctus. Nulla euismod justo eget libero ultrices, ut aliquet lacus ullamcorper.<br /><br />

	Proin ultricies eget odio sed consectetur. Fusce urna enim, rutrum at scelerisque id, venenatis id est. Duis
	ullamcorper leo in ante congue ultrices. Vivamus id quam ac velit porta pharetra ut eget nisl. In nunc tellus,
	condimentum ullamcorper lacinia sed, porta quis sem.<br /><br />

	In hac habitasse platea dictumst. Aliquam lectus ipsum, ornare ac gravida nec, dictum sed lorem.
	</p>
</div>

<script type="text/javascript">
$(function() {
	// $('.offer-and-wish-lift .fr ul li').mouseleave(function() { $('span', this).stop(true, true).fadeIn(function() {$(this).css({display:'block'});}); });
	$('.offer-and-wish-lift .fr ul li').mouseover(function() { $('span', this).fadeOut(); });
	$('.offer-and-wish-lift .fr ul li').mouseleave(function() { $('span', this).stop(true,true).fadeIn(); });
});
</script>