	<header>
		<div class="header-wrapper">
			<div class="login-status-wrapper">
				<div class="login-status m-center">
					<?php echo ($this->session->userdata('validated') == TRUE ? "<div class='login'><a href='javascript:void(0)' class='login-link'>Hi! ".$this->session->userdata('firstname')." <i class='fa fa-chevron-circle-down'></i></a> | <a href='".base_url('login/logout')."'>LOGOUT</a><ul style='display:none;'><li><a href='".base_url('members')."'>View Profile</a></li> <li><a href='".base_url('members/inbox')."'>Message</a></li> <li><a href='".base_url('members/overview')."'>Rides</a></li> <li><a href='".base_url('members/overview')."#overview-passenger'>Wish Lift</a></li></ul></div>" : '<a href="'.base_url('login').'">LOGIN</a> | <a href="'.base_url('register').'" class="try-it-free">TRY IT FREE</a>')?>
				</div>
			</div>
			
			<div class="logo-nav m-center">
				<div class="logo pull-left"><a href="<?php echo base_url()?>"><img src="<?php echo base_url('assets/images/page_template/logo.png')?>" width="49" height="83" alt=""/></a></div>
				
				<nav class="pull-right">
					<ul>
						<li><a href="<?php echo base_url('rides')?>"><i class="fa fa-car <?php echo ($this->uri->segment(1) == 'rides') ? 'selected' : ''?>"></i><span>Lift</span></a></li>
						<li><a href="<?php echo base_url('passenger')?>"><i class="fa fa-group <?php echo ($this->uri->segment(1) == 'passenger') ? 'selected' : ''?>"></i><span>Passenger</span></a></li>
						<li><a href="<?php echo base_url('event')?>"><i class="fa fa-calendar <?php echo ($this->uri->segment(1) == 'event') ? 'selected' : ''?>"></i><span>Events</span></a></li>
						<li><a href="<?php echo base_url('abroad')?>"><i class="fa fa fa-globe <?php echo ($this->uri->segment(1) == 'abroad') ? 'selected' : ''?>"></i><span>Abroad</span></a></li>
						<li><a href="<?php echo base_url('offer_wish_lift')?>"><i class="fa fa-pencil-square-o <?php echo ($this->uri->segment(1) == 'offer_wish_lift') ? 'selected' : ''?>"></i><span>Ride/ Wish Lift</span></a></li>
					</ul>
				</nav>
				
				<div class="clr"></div>
				
				<div class="line-separator"></div>
			</div>
		</div>	
	</header>
	
	<div id="main-wrapper">