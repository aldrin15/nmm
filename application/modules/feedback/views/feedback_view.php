<div class="feedback">
	<div class="feedback-message">
	<?php foreach($feedback_data as $row):?>
		<p>"<?php echo $row['comment']?>" <br /><br />- <?php echo $row['firstname'].' '.$row['lastname']?></p>
	<?php endforeach?>
	</div>
	
	<img src="<?php echo base_url('assets/images/page_template/nav_left.png')?>" width="35" height="49" alt="" class="f-prev-nav" />
	<img src="<?php echo base_url('assets/images/page_template/nav_right.png')?>" width="35" height="49" alt="" class="f-next-nav" />
	
	<div class="clr"></div>
</div>