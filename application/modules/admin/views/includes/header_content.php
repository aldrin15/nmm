		<!--header start-->
		<header class="header white-bg">
			<div class="sidebar-toggle-box">
				<a href="<?php echo base_url('admin/dashboard')?>"><img alt="Logo" src="<?php echo base_url('assets/admin/img/logo.png')?>" height="60" width="35"></a>
			</div>
			
			<a href="<?php echo base_url('admin/dashboard')?>" class="logo"> Nimm&nbsp;Mich&nbsp;Mit</a>
			
			<div class="top-nav ">
				<!--search & user info start-->
				<ul class="nav pull-right top-menu">
					<li>
						<input type="text" class="form-control search" placeholder="Search">
					</li>
					<!-- user login dropdown start-->
					<li class="dropdown">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">
							<img alt="" src="<?php echo base_url('assets/admin/img/avatar1_small.jpg')?>">
							<span class="username">Ivan G.</span>
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu extended logout">
							<div class="log-arrow-up"></div>
							<li><a href="#"><i class=" icon-suitcase"></i>Profile</a></li>
							<li><a href="#"><i class="icon-cog"></i> Settings</a></li>

							<?php foreach($new_email as $newmail): ?>
							<li><a href="<?php echo base_url('admin/inbox')?>"><i class="icon-envelope"><div class="notify-mail"><div class="badge bg-important"><?php echo $newmail['new_mail']?></div></div></i> Messages</a></li>
							<?php endforeach?>
							<li><a href="#"><i class="icon-key"></i> Log Out</a></li>
						</ul>
					</li>
					<!-- user login dropdown end -->
				</ul>
				<!--search & user info end-->
			</div>
		</header>
		<!--header end-->