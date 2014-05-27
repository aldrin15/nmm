<?php $this->load->view('header_content')?>
<br /><br /><br />

<style type="text/css">
.error {color:#ff0000;}

.passenger-view ul {list-style:none;}
.passenger-view ul li {float:left;}
.passenger-listing ul li:hover {border:1px solid #000;}
.passenger-listing ul li a {color:#000;}
.passenger-listing ul li span {display:block; width:200px;}
</style>

<div class="passenger-view">
	<div class="passenger-search">
		<form action="" method="post">
			<ul>
				<li>
					<?php echo form_error('from', '<div class="error">', '</div>')?>
					<label for="From">From: </label>
					<input type="text" name="from" id=""/>
				</li>
				<li>
					<?php echo form_error('to', '<div class="error">', '</div>')?>
					<label for="To">To: </label>
					<input type="text" name="to" id=""/>
				</li>
				<!-- 
				<li>
					<input type="text" name="" id="datepicker"/>
				</li>
				-->
				<li>
					<input type="submit" name="ride_submit" value="Search"/>
				</li>
			</ul>
			
			<div class="clr"></div>
		</form>
	</div>

	<div class="passenger-listing">
		<?php 
		if($passenger_list == 0):
		?>
			<div style="font-size:26px; font-weight:bold; border:1px solid #000; text-align:center; margin-top:10px; padding:20px; width:1024px;">No records found</div>
		<?php	
		else:
		?>
			<ul>
				<?php foreach($passenger_list as $row): ?>
				<li>
					<a href="#">
						<span><img src="<?php echo base_url('assets/images/user.jpg')?>" width="150" height="150" alt="Car"/></span>
						<span><strong>Passenger: </strong><?php echo $row['firstname'].' '.$row['lastname']?></span>
						<span><strong>From: </strong><?php echo $row['route_from']?></span>
						<span><strong>To: </strong> <?php echo $row['route_to']?></span>
						<span><strong>Date: </strong> <?php echo date('M d, Y', strtotime($row['date']))?></span>
						<span><strong>Time: </strong> <?php echo date('H:i:s A', strtotime($row['date']))?></span>
					</a>
					
					<div class="clr"></div>
				</li>
				<?php endforeach?>
			</ul>
		<?php endif?>
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
<script type="text/javascript">
$(function() {
	$('#datepicker').datepicker();
});
</script>