<?php $this->load->view('header_content')?>
<style type="text/css">
#events {/*padding-top:50px;*/}
#events .carousel-inner {margin-left:40px;}
html, body {background: #fdfdfb  url('<?php echo base_url('assets/images/page_template/background.jpg')?>') repeat !important;}
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
					<a href="#" data-toggle="modal" data-target="#demo-video" class="fr"><img src="<?php echo base_url('assets/images/demo.jpg')?>" alt=""/></a>
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
			<div class="c-4-topborder" style="background:#c8de8d; width:100%; height:150px;"></div>
			<div class="m-center">
				<div id="events" class="carousel slide">
					<div class="carousel-wrapper">
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
								<?php echo modules::run('passenger/featured_passenger')?>
								
								<div class="clr"></div>
							</div>
						</div>
						
						<div class="clr"></div>
					</div>
				</div>
			</div>
			
			<!-- LINKED NAV -->
			<div class="c-4-topborder" style="background:#c8de8d; width:100%; height:150px;">
				<!-- LINKED NAV -->
				<ul class="carousel-linked-nav">
					<li class="active"><a href="#1"></a></li>
					<li><a href="#2"></a></li>
					<li><a href="#3"></a></li>
				</ul>
				
				<div class="clr"></div>			
			</div>
			<?php echo modules::run('feedback')?>
		</section>
		
		<section class="content-5">
			<div class="m-center">
				<div class="subscription">
					<h3>Start by choosing your plan</h3>
					
					<div class="span2">
						<a href="<?php echo base_url('register/?type=1')?>">
							<span>14 DAYS FREE TRIAL</span>
							<span>FREE</span>
						</a>
					</div>
					<div class="span2">
						<a href="<?php echo base_url('register/?type=2')?>">
							<span>MONTHLY</span>
							<span>3.99</span>
							<span>EURO</span>
						</a>
					</div>
					<div class="span2">
						<a href="<?php echo base_url('register/?type=3')?>">
							<span>6 MONTHS</span>
							<span>12.99</span>
							<span>EURO</span>
						</a>
					</div>
					<div class="span2">
						<a href="<?php echo base_url('register/?type=4')?>">
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

		<div class="modal fade" id="demo-video" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
					</div>
					<div class="modal-body">
						...
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		
<script type="text/javascript" src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.0.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/responsiveslides.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
<script type="text/javascript">
$(function () {
	$('#demo-video').on('show', function () {
		// $('div.modal-body').html('<iframe width="555px" height="315" src="//www.youtube.com/embed/L10Scjvn6aA" frameborder="0" allowfullscreen></iframe>'); 
		$('div.modal-body').html('Video goes here');
	});
	
	$('#demo-video').on('hide', function () { $('div.modal-body').html(''); }); $("#slider1").responsiveSlides({ maxwidth: "none", speed: 800 }); $('#events').carousel({ interval: 3000 }); $('.carousel-linked-nav > li > a').click(function() { var item = Number($(this).attr('href').substring(1)); $('#events').carousel(item - 1); $('.carousel-linked-nav .active').removeClass('active'); $(this).parent().addClass('active'); return false; }); $('#events').bind('slid', function() { $('.carousel-linked-nav .active').removeClass('active'); var idx = $('#events .item.active').index(); $('.carousel-linked-nav li:eq(' + idx + ')').addClass('active'); }); $('.feedback-message p:gt(0)').hide(); setInterval(function() { $('.feedback-message > p:first-child').fadeOut().next().fadeIn().end().appendTo('.feedback-message'); }, 5000); $('.next').click(function() { $('.feedback-message p:first-child').fadeOut().next().fadeIn().end().appendTo('.feedback-message'); }); $('.prev').click(function() {$('.feedback-message p:first-child').fadeOut();$('.feedback-message p:last-child').prependTo('.feedback-message').fadeOut();$('.feedback-message p:first-child').fadeIn();});
});
</script>
<?php echo modules::run('lift/auto_suggest_city')?>