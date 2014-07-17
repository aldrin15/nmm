<?php $this->load->view('header_content')?>

<style type="text/css">
.profile-car {margin-left:10px;}
.p-frame-car {border:1px solid #adadad; padding:5px 10px;}

.p-car-heading {background: #75ca30; color:#fff; font-size: 1.3em; padding:10px; height:40px;}

.p-car-info ul li {}
.p-car-info ul li label, .p-car-info ul li span {float:left; display:block; padding:10px;}
.p-car-info ul li label {border-right:1px solid #d2d2d2; width:200px;}
.p-car-info ul li:nth-child(even) {background: #eaeaea;}
</style>

<div class="m-center-content">
	<?php echo modules::run('lift/search')?>
	
	<?php $this->load->view('member_sidebar_view')?>
	
	<?php foreach($car_data as $row):?>	
	<div class="span5 profile-car fl">
		<div class="p-frame-car">
			<img src="<?php echo ($row['image'] != '') ? base_url('assets/media_uploads/').'/'.$row['image'] : base_url('assets/images/page_template/no_car.jpg')?>" width="450" height="230" alt=""/>
		</div>
		
		<div class="p-car-info">
			<p class="p-car-heading">Car Specifications</p>
			<ul>
				<li>
					<label for="Car Model">Car Model</label>
					<span><?php echo $row['car']?></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="License Plate">License Plate</label>
					<span><?php echo $row['plate']?></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Year">Year</label>
					<span><?php echo $row['year']?></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Fuel">Fuel</label>
					<span><?php echo $row['fuel']?></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Fuel">Doors</label>
					<span><?php echo $row['door']?></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Fuel">Seats</label>
					<span><?php echo $row['seat']?></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Fuel">Transmission</label>
					<span><?php echo $row['transmission']?></span>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Fuel">Air Condition</label>
					<span><?php echo $row['air_condition']?></span>
					
					<div class="clr"></div>
				</li>
			</ul>
		</div>
	</div>
	
	<?php echo modules::run('members/status')?>
	
	<?php endforeach?>	

	<div class="clr"></div>
</div>


<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
<script type="text/javascript">
$(function() {
	$(".profile-nav ul li a").click(function(e){
		if(false == $(this).next().is(':visible')) { $('.profile-nav ul li ul').slideUp(300); }
		
		$(this).next().slideToggle(300);
		
		// e.preventDefault();
	});
	
	var count = 0;
	
	$('.profile-status ul li').each(function() {
		var percent = $(this).attr('data-val');
		
		count += Number(percent);
	});
	
	$( ".profile-progress" ).progressbar({ value: count });
});
</script>