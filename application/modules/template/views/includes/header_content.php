<style type="text/css">
nav {margin-bottom:20px;}
nav ul li {float:left; border-right:1px solid #000;}
nav ul li:last-child {border:none;}
nav ul li a {padding:0 10px;}
</style>

	<header>
		<div class="login-register">
			<a href="<?php echo base_url('login')?>">Login</a>
			<a href="<?php echo base_url('register')?>">Register</a>
		</div>
		
		<div class="status">
		Hi! 
		<?php 
			if($this->session->userdata('validated') == TRUE):
				$firstname = $this->session->userdata('firstname');
				
				echo $firstname." "."<a href='".base_url('login/logout')."'>Logout</a>";
				echo '<br />';
				echo '<a href="'.base_url('members').'">Profile Account</a>';
			else:
				echo "Guest";
			endif;
		?>
		</div>
	
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