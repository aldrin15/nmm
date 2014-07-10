<style type="text/css">
.feedback {text-align:center; margin:20px 0;}
.feedback-message span {display:block; text-align:left; margin-top:10px;}
.feedback .fl {margin-left:10px;}
.feedback .f-left {vertical-align:top}
.feedback .f-right {vertical-align:top; margin-top:25px;}
.feedback-message p {position:relative; background: #e6e6e6; border-radius:5px; -webkit-border-radius:5px; -moz-border-radius:5px; -ms-border-radius:5px; padding:10px 10px; width:450px;}
.feedback-message img {position:absolute; bottom:-9px; left:5px;}
</style>
<div class="feedback">
	<div class="f-left fl"><img src="<?php echo base_url('assets/images/quote/quote_left.jpg')?>" width="34" height="28" alt=""/></div>
	<?php foreach($feedback_data as $row):?>
	<div class="feedback-message fl">
		<p>
			<?php echo $row['comment']?>
			<img src="<?php echo base_url('assets/images/quote/arrow_bottom.jpg')?>" width="12" height="9" alt=""/>
		</p>
		<span><?php echo $row['firstname'].' '.$row['lastname']?></span>
	</div>
	<?php endforeach?>
	<div class="f-right fl"><img src="<?php echo base_url('assets/images/quote/quote_right.jpg')?>" width="34" height="28" alt=""/></div>
	
	<div class="clr"></div>
</div>