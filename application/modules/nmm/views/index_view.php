<?php $this->load->view('header_content')?>
<style type="text/css">
.event-detail p {background:#000; width:190px;}

.video {padding-top:55px;}
.home-features {font-size:1.3em; margin:70px auto; width:710px;}
.home-features h3 {text-align:center; text-transform:uppercase;}
.home-features ul li:nth-child(2n+2) {float:right;}
.home-features ul li {float:left; margin-bottom:50px; width:300px;}
.home-features ul li i {float:left; margin-right:10px;}
.home-features ul li:nth-child(1) i {display:block; background: url('<?php echo base_url('assets/images/page_template/home_icon.png')?>') no-repeat; width:71px; height:70px;}
.home-features ul li:nth-child(2) i {display:block; background: url('<?php echo base_url('assets/images/page_template/home_icon.png')?>') no-repeat 0 -70px; width:71px; height:70px;}
.home-features ul li:nth-child(3) i {display:block; background: url('<?php echo base_url('assets/images/page_template/home_icon.png')?>') no-repeat 0 -140px; width:71px; height:70px;}
.home-features ul li:nth-child(4) i {display:block; background: url('<?php echo base_url('assets/images/page_template/home_icon.png')?>') no-repeat 0 -210px; width:71px; height:70px;}

.subscription {color:#678222; text-align:center; margin:90px 0;}
.subscription h3 {text-transform:uppercase; color:#000;}
.subscription a {color:#678222;}
.subscription a:hover {text-decoration:none;}
.subscription div {background:#e9fdb5; display:inline-block; text-align:center; border:1px solid #ccc; border-radius:5px; -webkit-border-radius:5px; -moz-border-radius:5px; vertical-align:top; padding:10px; min-height:130px;}
.subscription div:hover {background:#d6fd75;}
.subscription div span {display:block;}
.subscription div span:nth-child(2) {font-size:3.5em;}
</style>
	
		<div class="slideshow-search" style="position:relative;">
			<div class="slideshow">			
				<ul class="rslides" id="slider1">
					<li><img src="<?php echo base_url('assets/images/slideshow/1.jpg')?>" alt=""></li>
					<li><img src="<?php echo base_url('assets/images/slideshow/2.jpg')?>" alt=""></li>
					<li><img src="<?php echo base_url('assets/images/slideshow/3.jpg')?>" alt=""></li>
					<li><img src="<?php echo base_url('assets/images/slideshow/4.jpg')?>" alt=""></li>
				</ul>
				
				<div class="clr"></div>
			</div>
			
			<div class="search-lift" style="position:absolute; bottom:0; left:0; z-index:1000; width:100%;">
				<?php echo modules::run('lift/search')?>
			</div>
		</div>
		
		<div class="m-center">
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
				<a href="#"><img src="<?php echo base_url('assets/images/video.jpg')?>" width="410" height="173" alt=""/></a>
			</div>
			
			<div class="clr"></div>
			
			<div id="events" class="carousel slide">
				<!-- Carousel items -->
				<div class="carousel-inner">
					<div class="active item">
						<div class="span2">
							<img src="<?php echo base_url('assets/images/events/events.jpg')?>" width="200" height="190" alt=""/>
							<div class="event-detail">
								<p>The Late Night Show</p>
							</div>
						</div>
						<div class="span2">
							<img src="<?php echo base_url('assets/images/events/events.jpg')?>" width="200" height="190" alt=""/>
							<div class="event-detail">
								<p>The Early Morning Show</p>
							</div>
						</div>
						<div class="span2">
							<img src="<?php echo base_url('assets/images/events/events.jpg')?>" width="200" height="190" alt=""/>
							<div class="event-detail">
								<p>First Concert of John Doe</p>
							</div>
						</div>
						<div class="span2">
							<img src="<?php echo base_url('assets/images/events/events.jpg')?>" width="200" height="190" alt=""/>
							<div class="event-detail">
								<p>Second Concert of John Doe</p>
							</div>
						</div>
						
						<div class="clr"></div>
					</div>
					
					<div class="item">
						<div class="span2">
							<img src="<?php echo base_url('assets/images/page_template/blank_profile_large.jpg')?>" width="200" height="190" alt=""/>
							<div class="event-detail">
								<p>John Doe</p>
							</div>
						</div>
						<div class="span2">
							<img src="<?php echo base_url('assets/images/page_template/blank_profile_large.jpg')?>" width="200" height="190" alt=""/>
							<div class="event-detail">
								<p>Michael Jordan</p>
							</div>
						</div>
						<div class="span2">
							<img src="<?php echo base_url('assets/images/page_template/blank_profile_large.jpg')?>" width="200" height="190" alt=""/>
							<div class="event-detail">
								<p>Connor Kenway</p>
							</div>
						</div>
						<div class="span2">
							<img src="<?php echo base_url('assets/images/page_template/blank_profile_large.jpg')?>" width="200" height="190" alt=""/>
							<div class="event-detail">
								<p>John Connor</p>
							</div>
						</div>
						
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
			
			<?php echo modules::run('feedback')?>
			
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
		
		<div class="clr"></div>
		
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/responsiveslides.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
<script type="text/javascript">
// You can also use "$(window).load(function() {"
$(function () {
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