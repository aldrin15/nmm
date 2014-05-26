<?php $this->load->view('header_content')?>
<br /><br /><br />

<style type="text/css">
.lift-detail-view span {display:block;}
</style>

<div class="lift-detail-view">
	<?php foreach($lift_information as $row):?>
	<div class="lift-information">
		<div class="profile-image fl"><img src="<?php echo base_url('assets/images/car.jpg')?>" width="180" height="120" alt="Car"/></div>
		
		<div class="lift-details fl">
			<span><strong>From: </strong><?php echo $row['route_from']?></span>
			<span><strong>To: </strong> <?php echo $row['route_to']?></span>
			<span><strong>Date: </strong> <?php echo date('M d, Y', strtotime($row['date']))?></span>
			<span><strong>Amount: </strong> &#128;<?php echo $row['amount']?></span>
			<span><strong>Available Seats: </strong> <?php echo $row['available']?></span>
		</div>
		
		<div class="clr"></div>
	</div>
	<?php endforeach?>
</div>