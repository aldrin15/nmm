<?php $this->load->view('header_content')?>
<style type="text/css">
.content-2 {padding-top:100px; height:550px;}
.content-3 {/* background:#00dcde; */ padding-top:100px; height:570px;}
.content-4 {padding-top:100px; height:550px;}
.content-5 {/* background:#00dcde; */ padding-top:100px; height:550px;}
</style>
		<div class="slideshow-search" style="position:relative;">
			<div class="slideshow">			
				<ul class="rslides" id="slider1">
					<li style="background:url('<?php echo base_url('assets/images/slideshow/1.jpg')?>') no-repeat; background-size:cover; width:100%; height:545px;"> </li>
					<li style="background:url('<?php echo base_url('assets/images/slideshow/2.jpg')?>') no-repeat; background-size:cover; width:100%; height:545px;"> </li>
					<li style="background:url('<?php echo base_url('assets/images/slideshow/3.jpg')?>') no-repeat; background-size:cover; width:100%; height:545px;"> </li>
					<li style="background:url('<?php echo base_url('assets/images/slideshow/4.jpg')?>') no-repeat; background-size:cover; width:100%; height:545px; "> </li>
				</ul>
				
				<div class="clr"></div>
			</div>
			
			<div class="search-lift" style="position:absolute; bottom:0; left:0; z-index:8; width:100%;">
				<?php echo modules::run('lift/search')?>
			</div>
		</div>
		
		<div class="m-center content-2">
			<aside class="span4 welcome fl">
				<h3>Velkommen til Nimm Mich Mit</h3>

				<p>
				"Westerhagen"<br /><br />

				Nimm mich mit, zeige mir den Weg.<br />
				Nimm mich mit, eh der Wind sich dreht.<br />
				Nimm mich mit uber den Horizont.<br />
				Nimm mich mit, die anderen warten schon.<br /><br />

				Tjen og spar penge med ligesindede,<br />
				alt imens du hjælper miljøet.
				</p>
			</aside>
			
			<div class="fr video span5">
				<a href="#" data-toggle="modal" data-target="#demo-video" class="fr"><img src="<?php echo base_url('assets/images/demo.jpg')?>" width="410" height="173" alt=""/></a>
				<div class="clr"></div>
			</div>
			
			<div class="clr"></div>
		</div>
		
		<div class="content-3">
			<div class="m-center">
				<div id="events" class="carousel slide">
					<!-- Carousel items -->
					<div class="carousel-inner">
						<div class="active item">
							<?php echo modules::run('event/featured_event');?>	
							<div class="clr"></div>
						</div>
						
						<div class="item">
							<?php echo modules::run('lift/featured_ride')?>
							
							<div class="clr"></div>
						</div>
						
						<div class="item">
							<div class="span2">
								<img src="<?php echo base_url('assets/images/dummy_car.jpg')?>" width="200" height="190" alt=""/>
								<div class="event-detail">
									<p>This is a test</p>
								</div>
							</div>
							<div class="span2">
								<img src="<?php echo base_url('assets/images/dummy_car.jpg')?>" width="200" height="190" alt=""/>
								<div class="event-detail">
									<p>This is a test</p>
								</div>
							</div>
							<div class="span2">
								<img src="<?php echo base_url('assets/images/dummy_car.jpg')?>" width="200" height="190" alt=""/>
								<div class="event-detail">
									<p>This is a test</p>
								</div>
							</div>
							<div class="span2">
								<img src="<?php echo base_url('assets/images/dummy_car.jpg')?>" width="200" height="190" alt=""/>
								<div class="event-detail">
									<p>This is a test</p>
								</div>
							</div>
							
							<div class="clr"></div>
						</div>
					</div>
					
						<div class="clr"></div>
						
					<!-- LINKED NAV -->
					<ul class="carousel-linked-nav">
						<li class="active"><a href="#1"></a></li>
						<li><a href="#2"></a></li>
						<li><a href="#3"></a></li>
					</ul>
					
					<div class="clr"></div>
				</div>
			</div>
		</div>
		
		<div class="m-center content-4">
			<div class="home-features">
				<h3>All the features you want</h3>
				
				<ul>
					<li><i></i>You can create your own lift<br /> or you can wish for a lift. <div class="clr"></div></li>
					<li><i></i>You can create an Events. <div class="clr"></li>
					<li><i></i>You can invite people/friends<br /> for a ride. <div class="clr"></li>
					<li><i></i>You can share it via Facebook. <div class="clr"></li>
				</ul>
				
				<div class="clr"></div>
			</div>
		</div>
		
		<div class="content-5">
			<div class="m-center">
				<?php echo modules::run('feedback')?>
			</div>
		</div>
		
		<div class="m-center content-6">
			<div class="subscription">
				<h3>Start by choosing your plan</h3>
				
				<div class="span2">
					<a href="javascript:void(0)">
						<span>14 DAYS FREE TRIAL</span>
						<span>FREE</span>
					</a>
				</div>
				<div class="span2">
					<a href="javascript:void(0)">
						<span>MONTHLY</span>
						<span>3.99</span>
						<span>EURO</span>
					</a>
				</div>
				<div class="span2">
					<a href="javascript:void(0)">
						<span>6 MONTHS</span>
						<span>12.99</span>
						<span>EURO</span>
					</a>
				</div>
				<div class="span2">
					<a href="javascript:void(0)">
						<span>12 MONTHS</span>
						<span>18.99</span>
						<span>EURO</span>
					</a>
				</div>
				
				<span class="clr" style="display:block;"></span>
			</div>
		</div>
		
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/responsiveslides.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
<script type="text/javascript">
// You can also use "$(window).load(function() {"
$(function () {
	$('#demo-video').on('show', function () {
		// $('div.modal-body').html('<iframe width="555px" height="315" src="//www.youtube.com/embed/L10Scjvn6aA" frameborder="0" allowfullscreen></iframe>'); 
		$('div.modal-body').html('Video Goes Here'); 
	});
	$('#demo-video').on('hide', function () { $('div.modal-body').html(''); });

	$("#slider1").responsiveSlides({ maxwidth: "none", speed: 800 });
	
	// Invoke the carousel
	$('#events').carousel({ interval: 3000 });

	/* Slide on Click */
	$('.carousel-linked-nav > li > a').click(function() {
		var item = Number($(this).attr('href').substring(1)); // grab href, remove pound sign, convert to number
		
		$('#events').carousel(item - 1); // slide to number -1 (account for zero indexing)
		
		$('.carousel-linked-nav .active').removeClass('active'); // remove current active class
		
		$(this).parent().addClass('active'); // add active class to just clicked on item
		
		return false; // don't follow the link
	});

	/* ========================
	 * AUTOPLAY NAV HIGHLIGHT 
	 * Bind 'slid' function
	 ======================= */
	$('#events').bind('slid', function() {
		$('.carousel-linked-nav .active').removeClass('active'); // remove active class
		
		var idx = $('#events .item.active').index(); // get index of currently active item
		
		$('.carousel-linked-nav li:eq(' + idx + ')').addClass('active'); // select currently active item and add active class
	});
	
	showNextQuote();
});

var quoteIndex = -1;

function showNextQuote() {
	++quoteIndex;
	$(".feedback-message").eq(quoteIndex % $(".feedback-message").length).fadeIn(1000).delay(5000).fadeOut(1000, showNextQuote);
}
</script>
<?php echo modules::run('lift/auto_suggest_city')?>