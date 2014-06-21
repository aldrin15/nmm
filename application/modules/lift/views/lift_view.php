<?php $this->load->view('header_content')?>

<div class="m-center lift-view">
	<?php echo modules::run('lift/search')?>
	
	<!--<p class="lift-text">Upcoming lift near you:</p>-->
	<h3>Upcoming lift near you:</h3><br />
	
	<div class="lift-listing fl">
		<?php if($ride_list == 0):?>
			<div style="font-size:1.2em; font-weight:bold; border:1px solid #000; text-align:center; margin-top:10px; padding:20px; width:850px;"><p>There are no route that match your criteria. Try some different places</p></div>
		<?php else:?>
			<ul>
				<?php 
				foreach($ride_list as $row):?>
				<li class="column">
					<p><?php echo $row['firstname'].' '.$row['lastname']?></p>
					<a href="<?php echo base_url().'lift/detail/'.$row['id']?>">
						<img src="<?php echo base_url('assets/images/car.jpg')?>" width="250" height="169" alt="Car"/>
					</a>
					<div>
						<label for="From"><strong>From: </strong></label>
						<span><?php echo $row['origin']?></span>
						
						<div class="clr"></div>
					</div>
					<div>
						<label for="To"><strong>To: </strong></label>
						<span><?php echo $row['destination']?></span>
						
						<div class="clr"></div>
					</div>
					<div>
						<label for="Date"><strong>On</strong></label>
						<span><?php echo date('M d', strtotime($row['date']))?></span>
						<label for="at">&nbsp;<strong>at</strong></label>
						<span><?php echo date('g A', strtotime($row['start_time']))?></span>
						
						<div class="clr"></div>
					</div>
					<div>
						<div class="fl" style="margin:0;">
							<label for="Available Seats"><strong>Available Seat/s:</strong></label>
							<span><?php echo $row['available']?></span>
						</div>
						<div class="fr" style="color:#678222; margin:-6px 0 0 0;">
							<label for="" style="font-size:1.5em;">&#128; </label>
							<span style="font-size: 1.5em;"><?php echo $row['amount']?></span>
						</div>
						
						<div class="clr"></div>
					</div>
					
					<div class="clr"></div>
				</li>
				<?php endforeach?>
			</ul>	
		<?php endif?>
		
		<div class="clr"></div>
	</div>
	
	<div class="ads fr">
		<img src="<?php echo base_url('assets/images/page_template/ads.jpg')?>" width="120" height="240" alt=""/>
	</div>
	
	<div class="clr"></div>
</div>


<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-modal.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-modalmanager.js')?>"></script>
<?php echo modules::run('lift/auto_suggest_city')?>
<script type="text/javascript">
function equalHeight(group) {
   tallest = 0;
   group.each(function() {
      thisHeight = $(this).height();
      if(thisHeight > tallest) {
         tallest = thisHeight;
      }
   });
   group.height(tallest);
}

$(function() {
	equalHeight($(".column")); //Equal Height
});
</script>