<?php $this->load->view('header_content')?>
<br /><br /><br />

<style type="text/css">
.lift-detail-view span {display:block;}

.lift-details ul {list-style:none;}
.lift-details ul li {float:left; text-align:center;}
.lift-details ul li:nth-child(1) {background:red; width:20px;}
.lift-details ul li:nth-child(2) {background:blue; width:20px;}
.lift-details ul li:nth-child(3) {background:yellow; width:20px;}
.lift-details ul li:nth-child(4) {background:green; width:20px;}
.lift-details ul li:nth-child(5) {background:pink; width:20px;}
</style>

<div class="lift-detail-view">
	<?php foreach($lift_information as $row):?>
	<div class="lift-information">
		<div class="profile-image fl"><img src="<?php echo base_url('assets/images/car.jpg')?>" width="180" height="120" alt="Car"/></div>
		
		<div class="lift-details fl">
			<span><strong>From: </strong><?php echo $row['origin']?></span>
			<span><strong>To: </strong> <?php echo $row['destination']?></span>
			<span><strong>Date: </strong> <?php echo date('M d, Y', strtotime($row['date']))?></span>
			<span><strong>Car Model: </strong> <?php echo $row['car']?></span>
			<span><strong>License Plate: </strong> <?php echo $row['plate']?></span>
			<span><strong>Storage: </strong> <?php echo $row['storage']?></span>
			<span><strong>Amount: </strong> &#128;<?php echo $row['amount']?></span>
			<span><strong>Available Seats: </strong> <?php echo $row['available']?></span>
			<span>
				<div class="fl"><strong>Preference: </strong>&nbsp;</div> 
				<div class="fl">
					<ul>
						<?php 
						$p_id 	= $row['p_id'];
						$p_data = explode(', ', $p_id);
						
						for($i = 0; $i < count($p_data); $i++):
							echo '<li>'.$p_data[$i].'</li>';
						endfor;
						?>
					</ul>
					
					<div class="clr"></div>
				</div>
				
				<div class="clr"></div>
			</span>
		</div>
		
		<div class="clr"></div>
	</div>
	<?php endforeach?>
</div>