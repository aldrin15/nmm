	<nav class="profile-nav fl">
		<ul>
			<li <?php echo ($this->uri->segment(2) == '') ? 'style="background:#006200"' : ''?>><a href="<?php echo base_url('members')?>">Dashboard</a></li>
			<li <?php echo ($this->uri->segment(2) == 'inbox' || $this->uri->segment(2) == 'sent') ? 'style="background:#006200"' : ''?>>
				<a href="#">Email <i></i></a>
				<ul>
					<li><a href="<?php echo base_url('members/inbox')?>">Inbox</a></li>
					<li><a href="<?php echo base_url('members/sent')?>">Sent</a></li>
				</ul>
			</li>
			<li <?php echo ($this->uri->segment(2) == 'overview') ? 'style="background:#006200"' : ''?>><a href="<?php echo base_url('members/overview')?>">Overview</a></li>
			<li <?php echo ($this->uri->segment(2) == 'car' || $this->uri->segment(2) == 'car_edit') ? 'style="background:#006200"' : ''?>>
				<a href="#">Car Setting <i></i></a>
				
				<ul>
					<li><a href="<?php echo base_url('members/car')?>">Car</a></li>
					<li><a href="<?php echo base_url('members/car_edit')?>">Edit Car</a></li>
				</ul>
			</li>
			<li <?php echo ($this->uri->segment(2) == 'settings') ? 'style="background:#006200"' : ''?>><a href="<?php echo base_url('members/settings')?>">Settings</a></li>
		</ul>
	</nav>