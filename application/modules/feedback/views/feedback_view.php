<div class="feedback">
	<h3>Meet our happy clients</h3>
	<?php foreach($feedback_data as $row):?>
	<div class="feedback-message">
		<i class="quotes fl" style="display:block; background:url('<?php echo base_url('assets/images/page_template/quote_left.png')?>') no-repeat; width:49px; height:40px;"></i>
		<p>"<?php echo $row['comment']?>"</p>
		<i class="quotes fr" style="display:block; background:url('<?php echo base_url('assets/images/page_template/quote_right.png')?>') no-repeat; width:49px; height:40px;"></i>
		<div class="clr"></div>
		<p>by <?php echo $row['firstname'].' '.$row['lastname']?></p>
	</div>
	<?php endforeach?>
	
	<div class="clr"></div>
</div>