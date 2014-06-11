	<header>
		<div class="login-status-wrapper">
			<div class="login-status m-center">
				<?php 
				if($this->session->userdata('validated') == TRUE):
					$firstname = $this->session->userdata('firstname');
				?>
				<a href="<?php echo base_url('members')?>">Hi! <?php echo $firstname?></a> |
				<a href="<?php echo base_url('login/logout')?>">Logout</a>
				<?php else:?>
				<a href="<?php echo base_url('login')?>">Log in</a> |
				<a href="<?php echo base_url('register')?>">Sign up!</a>
				<?php endif?>
			</div>
		</div>
		
		<div class="logo-nav m-center">
			<div class="logo pull-left"><a href="<?php echo base_url('nmm')?>"><img src="<?php echo base_url('assets/images/page_template/logo.jpg')?>" width="49" height="83" alt=""/></a></div>
			
			<nav class="pull-right">
				<ul>
					<li><a href="<?php echo base_url('lift')?>">Lift</a></li>
					<li><a href="<?php echo base_url('passenger')?>">Passenger</a></li>
					<li><a href="<?php echo base_url('event')?>">Events</a></li>
					<li><a href="<?php echo base_url('abroad')?>">Abroad</a></li>
					<li><a href="<?php echo base_url('rent')?>">Rent a car</a></li>
					<li><a href="<?php echo base_url('offer')?>">Offer / Make a wish lift</a></li>
				</ul>
			</nav>
			
			<div class="clr"></div>
			
			<div class="line-separator"></div>
		</div>	
	</header>
	
	<div id="main-wrapper">