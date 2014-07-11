<style type="text/css">
.feedback { font-size:2em; text-align:center; /*padding:100px;*/ position:relative; height:180px;}
.feedback .feedback-message:first-child { display:block; }
.feedback .feedback-message { position:absolute; display:none; width:100%;}
.feedback-message span {display:block; text-align:left; margin-top:10px;}
.feedback .fl {margin-left:10px;}
.feedback .f-left {vertical-align:top}
.feedback .f-right {vertical-align:top; margin-top:25px;}
.feedback-message p {position:relative; /*background: #e6e6e6;*/ font-style:italic; border-radius:5px; -webkit-border-radius:5px; -moz-border-radius:5px; -ms-border-radius:5px; padding:10px 10px; /*width:450px;*/}
.feedback-message img {position:absolute; bottom:-9px; left:5px;}
</style>
<div class="feedback">
	<?php foreach($feedback_data as $row):?>
	<div class="feedback-message">
		<p><?php echo $row['comment']?></p>
		
		<p>by <?php echo $row['firstname'].' '.$row['lastname']?></p>
	</div>
	<?php endforeach?>
	
	<div class="clr"></div>
</div>