	<header>
		<div class="login-status-wrapper">
			<div class="login-status m-center">
				<?php echo ($this->session->userdata('validated') == TRUE ? "<div class='login'><a href='javascript:void(0)' class='login-link'>Hi! ".$this->session->userdata('firstname')." <i class='fa fa-chevron-circle-down'></i></a> | <a href='".base_url('login/logout')."'>LOGOUT</a><ul style='display:none;'><li><a href='".base_url('members')."'>View Profile</a></li> <li><a href='".base_url('members/inbox')."'>Message</a></li> <li><a href='".base_url('members/overview')."'>Rides</a></li> <li><a href='".base_url('members/overview')."#overview-passenger'>Wish Lift</a></li></ul></div>" : '<a href="'.base_url('login').'">LOGIN</a> | <a href="'.base_url('register').'" class="try-it-free">TRY IT FREE</a>')?>
			</div>
		</div>
		
		<div class="logo-nav m-center">
			<div class="logo pull-left"><a href="<?php echo base_url()?>"><img src="<?php echo base_url('assets/images/page_template/logo.png')?>" width="49" height="83" alt=""/></a></div>
			
			<nav class="pull-right">
				<ul>
					<li><a href="<?php echo base_url('lift')?>">Lift</a></li>
					<li><a href="<?php echo base_url('passenger')?>">Passenger</a></li>
					<li><a href="<?php echo base_url('event')?>">Events</a></li>
					<li><a href="<?php echo base_url('abroad')?>">Abroad</a></li>
					<li><a href="<?php echo base_url('offer_wish_lift')?>">Offer / Make a wish lift</a></li>
				</ul>
			</nav>
			
			<div class="clr"></div>
			
			<div class="line-separator"></div>
		</div>	
	</header>
	
	<div id="main-wrapper">