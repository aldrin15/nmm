<?php $this->load->view('header_content')?>
<br /><br /><br />

<style type="text/css">
.error {color:#ff0000;}

.passenger-view ul {list-style:none;}
.passenger-view ul li {float:left;}

.passenger-listing {margin-top:20px;}
.passenger-listing ul li {border:1px solid #000;}
.passenger-listing ul li:hover {border:1px solid #ff0000;}
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
				<li>
					<input type="submit" name="ride_submit" value="Search"/>
				</li>
			</ul>
			
			<div class="clr"></div>
		</form>
	</div>

	<div class="passenger-listing">
		<ul>
			<?php foreach($wish_lift_data as $wish_lift):?>
			<li>
				<span><img src="<?php echo base_url('assets/images/user.jpg')?>" width="150" height="150" alt="User"/></span>
				<span>From: <?php echo $wish_lift['origin']?></span>
				<span>To: <?php echo $wish_lift['destination']?></span>
				<span>Date Posted: <?php echo $wish_lift['posted']?></span>
				<span>Requested seat(s): <?php echo $wish_lift['available']?></span>
				<span>Requested by: <?php echo $wish_lift['firstname']." ".$wish_lift['lastname']?></span>
			</li>
			<?php endforeach?>
		</ul>
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
<script type="text/javascript">
$(function() {
	$('#datepicker').datepicker();
});
</script>