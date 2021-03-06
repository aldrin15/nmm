<?php $this->load->view('header_content')?>

<div class="profile-wrapper m-center-content">
	<?php echo modules::run('lift/search')?>
	
	<?php $this->load->view('member_sidebar_view')?>
	
	<?php foreach($members_data as $row):?>	
	<div class="span8 profile-detail-information fl">
		<div class="fl span4">
			<div class="profile-name"><h3><?php echo $row['firstname'].' '.$row['lastname']?></h3></div>
			<div class="profile-address"><p><?php echo ($row['city'] != '' && $row['country']) ? $row['city'].', '.$row['country'] : ''?></p></div>
		</div>
		
		<div class="fr span2">
			<a href="<?php echo base_url('members/edit')?>" class="fr btn btn-default" style="margin-top:10px;">Edit Profile</a>
		</div>
		
		<div class="clr"></div>
		
		<hr/>
		
		<div class="profile-image-contact fl">
			<div class="profile-frame">
				<img src="<?php echo ($row['image'] != '') ? base_url('assets/media_uploads').'/'.$row['image'] : base_url('assets/images/page_template/no_photo.jpg')?>" width="160" height="160" alt=""/>
			</div>
			
			<div class="profile-online-status">
				<p>Last Login: <?php echo date('F d', strtotime($row['last_login']))?> | <?php echo date('H:m', strtotime($row['last_login']))?></p>
				<p><img src="<?php echo base_url('assets/images/page_template/icon_email.png')?>" width="15" height="10" alt=""/> <?php echo $row['email']?></p>
				<p><img src="<?php echo base_url('assets/images/page_template/icon_phone.png')?>" width="15" height="10" alt=""/> <?php echo $row['number']?></p>
			</div>
		</div>
		<div class="profile-information span3 fl">
			<ul>
				<li>
					<label for="Member Since">Member since</label>
					<span>: <?php echo date('F d, Y', strtotime($row['date']))?></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Hometown">Hometown</label>
					<span>: <?php echo $row['city']?></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Age">Age</label>
					<span>: <?php 
						$birthday = new DateTime($row['birthdate']);
						$interval = $birthday->diff(new DateTime);
						echo $interval->y;
					?></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="work">Work</label>
					<span>: <?php echo $row['job']?></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Car">Car</label>
					<span>: <?php echo $row['car']?></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Created rides">Created rides</label>
					<span>: <?php echo $row['created']?></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Nmm Status">Nmm Status</label>
					<span>:</span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Co2 saving total">Co2 saving total</label>
					<span>:</span>
					
					<div class="clr"></div>
				</li>
			</ul>		
		</div>
		<?php echo modules::run('members/status')?>
		
		<div class="clr"></div>
	</div>
	<?php endforeach?>

	<div class="clr"></div>
</div>


<script type="text/javascript" src="<?php echo base_url('assets/js/gmap3.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
<script type="text/javascript">
$(function() {
	$(".profile-nav ul li a").click(function(e){
		if(false == $(this).next().is(':visible')) { $('.profile-nav ul li ul').slideUp(300); }
		
		$(this).next().slideToggle(300);
		
		// e.preventDefault();
	});
	
	var count = 0;
	
	$('.profile-status ul li').each(function() {
		var percent = $(this).attr('data-val');
		
		count += Number(percent);
	});
	
	$( ".profile-progress" ).progressbar({ value: count });
});
</script>
<?php echo modules::run('lift/auto_suggest_city')?>