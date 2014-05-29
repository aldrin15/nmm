<style type="text/css">
nav {margin-bottom:20px;}
nav ul li {float:left; border-right:1px solid #000;}
nav ul li:last-child {border:none;}
nav ul li a {padding:0 10px;}
</style>

	<header>
		<div class="fr">
			<?php 
			if($this->session->userdata('validated') == TRUE):
					$firstname = $this->session->userdata('firstname');
			?>
				<div class="status">
					<p class="fl">Hi! <?php echo $firstname?>&nbsp;</p> <a href="<?php echo base_url('login/logout')?>">Logout</a><br />
					<a href="<?php echo base_url('members')?>">Profile Account</a>
					
					<div class="clr"></div>
				</div>
			<?php else:?>
			<div class="login-register">
				<p class="fl">Hi! Guest&nbsp;</p>
				<a href="<?php echo base_url('login')?>">Login</a> |
				<a href="<?php echo base_url('register')?>">Register</a>
			</div>
			<?php endif?>
		</div>
		
		<div class="clr"></div>
	
		<nav>
			<ul>
				<li><a href="<?php echo base_url('nmm')?>">Home</a></li>
				<li><a href="<?php echo base_url('lift')?>">Lift</a></li>
				<li><a href="<?php echo base_url('passenger')?>">Passenger</a></li>
				<li><a href="<?php echo base_url('contact')?>">Contact Us</a></li>
			</ul>
			
			<div class="clr"></div>
		</nav>
	</header>
	
	<div id="main-wrapper">