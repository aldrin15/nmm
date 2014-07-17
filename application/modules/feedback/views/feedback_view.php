<div class="feedback">
	<?php foreach($feedback_data as $row):?>
	<div class="feedback-message">
		<p><?php echo $row['comment']?></p>
		
		<p>by <?php echo $row['firstname'].' '.$row['lastname']?></p>
	</div>
	<?php endforeach?>
	
	<div class="clr"></div>
</div>