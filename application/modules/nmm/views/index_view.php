<?php $this->load->view('header_content')?>
		
		<div class="slideshow-search" style="position:relative;">
			<div class="slideshow">			
				<ul class="rslides" id="slider1">
					<li><img src="<?php echo base_url('assets/images/slideshow/1.jpg')?>" alt=""></li>
					<li><img src="<?php echo base_url('assets/images/slideshow/2.jpg')?>" alt=""></li>
					<li><img src="<?php echo base_url('assets/images/slideshow/3.jpg')?>" alt=""></li>
				</ul>
				
				<div class="clr"></div>
			</div>
			
			<div class="search-lift" style="position:absolute; bottom:0; left:0; z-index:1000; width:100%;">
				<?php echo modules::run('lift/search')?>
			</div>
		</div>
		
		<div class="m-center">
			<aside class="span4 welcome">
				<h2>Welcome to NMM</h2>

				<p>
				Lorem ipsum dolor sit amet, 
				consectetur adipisicing elit,  
				sed do eiusmod tempor incidi
				ut labore et dolore magna
				aliqua.Ut enim ad minim veniam,
				quis nostrud exercitation
				ullamco laboris nisi ut aliquip
				ex ea commodo consequat. 
				</p>
				
				<a href="#" class="button-gray">Join us now!</a>
			</aside>
			
			<div class="events-quote fr">
				<div id="events" class="carousel slide">
					<!-- Carousel items -->
					<div class="carousel-inner">
						<div class="active item">
							<div class="span2">
								<img src="<?php echo base_url('assets/images/events/events.jpg')?>" width="163" height="141" alt=""/>
								<div class="event-detail">
									<p>This is a test</p>
								</div>
							</div>
							<div class="span2">
								<img src="<?php echo base_url('assets/images/events/events.jpg')?>" width="163" height="141" alt=""/>
								<div class="event-detail">
									<p>This is a test</p>
								</div>
							</div>
							<div class="span2">
								<img src="<?php echo base_url('assets/images/events/events.jpg')?>" width="163" height="141" alt=""/>
								<div class="event-detail">
									<p>This is a test</p>
								</div>
							</div>
							
							<div class="clr"></div>
						</div>
						
						<div class="item">
							<div class="span2">
								<img src="<?php echo base_url('assets/images/events/events.jpg')?>" width="163" height="141" alt=""/>
								<div class="event-detail">
									<p>This is a test</p>
								</div>
							</div>
							<div class="span2">
								<img src="<?php echo base_url('assets/images/events/events.jpg')?>" width="163" height="141" alt=""/>
								<div class="event-detail">
									<p>This is a test</p>
								</div>
							</div>
							<div class="span2">
								<img src="<?php echo base_url('assets/images/events/events.jpg')?>" width="163" height="141" alt=""/>
								<div class="event-detail">
									<p>This is a test</p>
								</div>
							</div>
							
							<div class="clr"></div>
						</div>
						
						<div class="item">
							<div class="span2">
								<img src="<?php echo base_url('assets/images/events/events.jpg')?>" width="163" height="141" alt=""/>
								<div class="event-detail">
									<p>This is a test</p>
								</div>
							</div>
							<div class="span2">
								<img src="<?php echo base_url('assets/images/events/events.jpg')?>" width="163" height="141" alt=""/>
								<div class="event-detail">
									<p>This is a test</p>
								</div>
							</div>
							<div class="span2">
								<img src="<?php echo base_url('assets/images/events/events.jpg')?>" width="163" height="141" alt=""/>
								<div class="event-detail">
									<p>This is a test</p>
								</div>
							</div>
							
							<div class="clr"></div>
						</div>
					</div>
				</div>
				
					<div class="clr"></div>
					
				<!-- LINKED NAV -->
				<ul class="carousel-linked-nav pagination">
					<li class="active"><a href="#1"></a></li>
					<li><a href="#2"></a></li>
					<li><a href="#3"></a></li>
				</ul>
				
					<div class="clr"></div>
				
				<div class="quote">
					<div class="q-left fl"><img src="<?php echo base_url('assets/images/quote/quote_left.jpg')?>" width="34" height="28" alt=""/></div>
					<div class="q-message fl">
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
							<img src="<?php echo base_url('assets/images/quote/arrow_bottom.jpg')?>" width="12" height="9" alt=""/>
						</p>
						<span>John Doe</span>
					</div>
					<div class="q-right fl"><img src="<?php echo base_url('assets/images/quote/quote_right.jpg')?>" width="34" height="28" alt=""/></div>
					
					<div class="clr"></div>
				</div>
			</div>
		</div>
		
		<div class="clr"></div>
		
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/responsiveslides.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
<script type="text/javascript">
// You can also use "$(window).load(function() {"
$(function () {
	$("#slider1").responsiveSlides({ maxwidth: "none", speed: 800 });
	
	// invoke the carousel
	$('#events').carousel({ interval: 3000 });

	/* SLIDE ON CLICK */
	$('.carousel-linked-nav > li > a').click(function() {
		var item = Number($(this).attr('href').substring(1)); // grab href, remove pound sign, convert to number
		
		$('#events').carousel(item - 1); // slide to number -1 (account for zero indexing)
		
		$('.carousel-linked-nav .active').removeClass('active'); // remove current active class
		
		$(this).parent().addClass('active'); // add active class to just clicked on item
		
		return false; // don't follow the link
	});

	/* AUTOPLAY NAV HIGHLIGHT */
	// bind 'slid' function
	$('#events').bind('slid', function() {
		$('.carousel-linked-nav .active').removeClass('active'); // remove active class
		
		var idx = $('#events .item.active').index(); // get index of currently active item
		
		$('.carousel-linked-nav li:eq(' + idx + ')').addClass('active'); // select currently active item and add active class
	});
});
</script>
<?php echo modules::run('lift/auto_suggest_city')?>