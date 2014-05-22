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
	</header>
	
	<div id="main-wrapper">