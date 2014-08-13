		<?php foreach($members_data as $row):?>
		<div class="profile-status span3 fr">
			<p>Profile Status</p>
			
			<div class="profile-progress"></div>
			
			<ul>
				<li <?php echo ($row['firstname'] != '' && $row['lastname'] != '') ? 'class="p-checked" data-val="14"' : ''?>><p>Name</p></li>
				<li <?php echo ($row['image'] != '') ? 'class="p-checked" data-val="14"' : ''?>><p>Profile picture</p></li>
				<li <?php echo ($row['email'] != '') ? 'class="p-checked" data-val="14"' : ''?>><p>Email</p></li>
				<li <?php echo ($row['job'] != '') ? 'class="p-checked" data-val="14"' : ''?>><p>Work</p></li>
				<li <?php echo ($row['city'] != '' && $row['city'] != '') ? 'class="p-checked" data-val="14"' : ''?>><p>Address</p></li>
				<li <?php echo ($row['about_me'] != '') ? 'class="p-checked" data-val="14"' : ''?>><p>Profile text</p></li>
				<li <?php echo ($row['number']) ? 'class="p-checked" data-val="14"' : ''?>><p>Mobile Number</p></li>
			</ul>
		</div>
		<?php endforeach?>