<?php $this->load->view('header_content')?>

<style type="text/css">
.overview-detail {margin-left:10px;}
</style>

<div class="m-center-content">
	<?php echo modules::run('lift/search')?>
	
	<?php $this->load->view('member_sidebar_view')?>
	
	<div class="fl overview-detail">
		<?php foreach($ride_detail_data as $row):?>
			<h4><?php echo $row['origins']?> to <?php echo $row['destination']?></h4>
			<h5><?php echo $row['via']?></h5>
		
			<ul>
				<li>
					<label for=""></label>
				</li>
			</ul>
			
			
			
			<?php echo $row['available']?>
			<?php echo $row['storage']?>
			<?php echo $row['remarks']?>
			<?php echo $row['amount']?>
			<?php echo $row['re_route']?>
			<?php echo $row['offer_re_route']?>
			<?php echo $row['start_time']?>
		<?php endforeach?>	
	</div>
	
	<div class="clr"></div>
</div>