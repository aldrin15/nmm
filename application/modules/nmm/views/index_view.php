<?php $this->load->view('header_content')?>
<style type="text/css">
#events {padding-top:50px;}
#events .carousel-inner {margin-left:40px;}
</style>
		<section class="content-1 slideshow-search active" style="position:relative">
			<div class="slideshow">			
				<ul class="rslides" id="slider1">
					<li style="background:url('<?php echo base_url('assets/images/slideshow/1.jpg')?>') no-repeat; background-size:cover; width:100%; height:555px;"> </li>
					<li style="background:url('<?php echo base_url('assets/images/slideshow/2.jpg')?>') no-repeat; background-size:cover; width:100%; height:555px;"> </li>
					<li style="background:url('<?php echo base_url('assets/images/slideshow/3.jpg')?>') no-repeat; background-size:cover; width:100%; height:555px;"> </li>
					<li style="background:url('<?php echo base_url('assets/images/slideshow/4.jpg')?>') no-repeat; background-size:cover; width:100%; height:555px; "> </li>
				</ul>
				
				<div class="clr"></div>
			</div>
			
			<div class="search-lift">
				<?php echo modules::run('lift/search')?>
			</div>		
		</section>
		
		<section class="content-2">
			<div class="m-center">
				<aside class="span4 welcome fl">
					<h3>Velkommen til Nimm Mich Mit</h3>

					<p>
					"Lorem ipsum"<br /><br />
					
					Lorem ipsum dolor sit amet,<br /> 
					consectetur adipisicing elit, sed do<br /> 
					eiusmod tempor incididunt ut labore<br /> 
					et dolore magna aliqua. Ut enim ad minim<br /><br />
					
					veniam, quis nostrud exercitation<br /> 
					ullamco laboris nisi ut aliquip ex ea<br /> 
					commodo consequat. Duis aute irure<br /> 
					dolor in reprehenderit in voluptate velit<br /> 
					</p>
				</aside>
				
				<div class="fr video span5">
					<a href="#" data-toggle="modal" data-target="#demo-video" class="fr"><img src="<?php echo base_url('assets/images/demo.jpg')?>" width="410" height="173" alt=""/></a>
					<div class="clr"></div>
				</div>
				
				<div class="clr"></div>
			</div>		
		</section>
		
		<section class="content-3">
			<div class="m-center">
				<h2>Going Somewhere?</h2>
			</div>
		</section>
		
		<section class="content-4">
			<div class="m-center">
				<div id="events" class="carousel slide">
					<div class="carousel-wrapper">
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
									<img src="<?php echo base_url('assets/images/dummy_car.jpg')?>" alt=""/>
									<div class="event-detail">
										<p>This is a test</p>
									</div>
								</div>
								<div class="span2">
									<img src="<?php echo base_url('assets/images/dummy_car.jpg')?>" alt=""/>
									<div class="event-detail">
										<p>This is a test</p>
									</div>
								</div>
								<div class="span2">
									<img src="<?php echo base_url('assets/images/dummy_car.jpg')?>" alt=""/>
									<div class="event-detail">
										<p>This is a test</p>
									</div>
								</div>
								<div class="span2">
									<img src="<?php echo base_url('assets/images/dummy_car.jpg')?>" alt=""/>
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
				
				<?php echo modules::run('feedback')?>
			</div>
		</section>
		
		<section class="content-5">
			<div class="m-center">
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
				
				<div class="home-features">
					<h3>All the features you want</h3>
					
					<ul>
						<li><i></i>You can create your own lift or you can wish for a lift. <div class="clr"></div></li>
						<li><i></i>You can create an Events. <div class="clr"></li>
						<li><i></i>You can invite people/friends<br /> for a ride. <div class="clr"></li>
						<li><i></i>You can share it via Facebook. <div class="clr"></li>
					</ul>
					
					<div class="clr"></div>
				</div>
			</div>
		</div>
		
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/responsiveslides.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
<script type="text/javascript">
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

/* handle the mousewheel event together with 
 DOMMouseScroll to work on cross browser */
$(document).on('mousewheel DOMMouseScroll', function (e) {
	e.preventDefault();//prevent the default mousewheel scrolling
	
	var active = $('section.active');
	//get the delta to determine the mousewheel scrol UP and DOWN
	var delta = e.originalEvent.detail < 0 || e.originalEvent.wheelDelta > 0 ? 1 : -1;
	
	//if the delta value is negative, the user is scrolling down
	if (delta < 0) {
		//mousewheel down handler
		var next = active.next();
	   
		//check if the next section exist and animate the anchoring
		if (next.length) {
		   /*setTimeout is here to prevent the scrolling animation
			to jump to the topmost or bottom when 
			the user scrolled very fast.*/
			var timer = setTimeout(function () {
				console.log(next.offset().top);
				
				/* animate the scrollTop by passing 
				the elements offset top value */
				$("html, body").stop(true, false).animate({ scrollTop: next.offset().top }, "slow");
				
				// move the indicator 'active' class
				next.addClass('active').siblings().removeClass('active');
				
				clearTimeout(timer);
			}, 200);
		}

	} else {
		//mousewheel up handler
		/*similar logic to the mousewheel down handler 
		except that we are animate the anchoring 
		to the previous sibling element*/
		prev = active.prev();

		if (prev.length) {
			var timer = setTimeout(function () {
				$('body, html').animate({
					scrollTop: prev.offset().top
				}, 'slow');

				prev.addClass('active')
					.siblings().removeClass('active');
				
				clearTimeout(timer);
			}, 800);
		}

	}
	
	return false;
});

$(document).scroll(function(e){
	if($(window).width() <= 580) {
		if($(window).scrollTop() <= 1) {
			$('section').removeClass('active');
			$('section').first().addClass('active');
		} else if($(window).scrollTop() <= 402) {
			$('section').removeClass('active');
			$('.content-2').addClass('active');
		}
	} else {
		if($(window).scrollTop() <= 1) {
			$('section').removeClass('active');
			$('section').first().addClass('active');
		} else if($(window).scrollTop() <= 678) {
			$('section').removeClass('active');
			$('.content-2').addClass('active');
		} else if($(window).scrollTop() <= 1356) {
			$('section').removeClass('active');
			$('.content-3').addClass('active');
		} else if($(window).scrollTop() <= 2034) {
			$('section').removeClass('active');
			$('.content-4').addClass('active');
		}
	}
});
</script>
<?php echo modules::run('lift/auto_suggest_city')?>