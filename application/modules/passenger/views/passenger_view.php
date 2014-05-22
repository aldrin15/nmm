<?php $this->load->view('header_content')?>
<br /><br /><br />

<style type="text/css">
.passenger-view ul {list-style:none;}
.passenger-view ul li {float:left;}
.passenger-view ul li:hover {border:1px solid #000;}
.passenger-view ul li a {color:#000;}
.passenger-view ul li span {display:block; width:200px;}
</style>

<div class="passenger-view">
	<ul>
		<?php 
		foreach($passenger_list as $row):?>
		<li>
			<a href="#">
				<span><img src="<?php echo base_url('assets/images/car.jpg')?>" width="180" height="120" alt="Car"/></span>
				<span><strong>From: </strong><?php echo $row['route_from']?></span>
				<span><strong>To: </strong> <?php echo $row['route_to']?></span>
				<span><strong>Date: </strong> <?php echo date('M d, Y', strtotime($row['date']))?></span>
				<span><strong>Amount: </strong> &#128;<?php echo $row['amount']?></span>
			</a>
			
			<div class="clr"></div>
		</li>
		<?php endforeach?>
	</ul>
</div>