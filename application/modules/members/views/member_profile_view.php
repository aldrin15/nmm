<?php $this->load->view('header_content')?>

<style type="text/css">
.profile-overview {margin-left:10px; width:100%;}
.profile-overview-tab-menu a {float:left; background:#e2e1e1; color:#656565; font-size:1.1em; font-weight:bold; vertical-align:middle; padding:6px 12px;}
.profile-overview-tab-menu a:hover {text-decoration:none;}
.profile-overview-tab-menu a:first-child {border-right:1px solid #d7d5d5; border-radius: 5px 0px 0px 0px; -webkit-border-radius: 4px 0px 0px 0px; -moz-border-radius: 4px 0px 0px 0px; -ms-border-radius: 4px 0px 0px 0px;}
.profile-overview-tab-menu a:nth-child(2) {border-radius: 0px 5px 0px 0px; -webkit-border-radius: 0px 4px 0px 0px; -moz-border-radius: 0px 4px 0px 0px; -ms-border-radius: 0px 4px 0px 0px;}
.profile-overview-tab-menu a.selected {background:#f4f2f2;}

.profile-overview-passenger {display:none;}

.profile-information {padding:20px 0 50px;}
.profile-image {text-align:center; border:1px solid #c2c2c1; border-radius:5px; -moz-border-radius:5px; -webkit-border-radius:5px; padding:10px 0;}
.m-center-content .span4 {margin-left:20px;}
.profile-information ul li {margin-bottom:5px;}

.recommend { text-align:center; border-radius:5px; -webkit-border-radius:5px; -moz-border-radius:5px; -ms-border-radius:5px; border:1px solid #c2c2c1; padding:10px;}
.recommend p:nth-child(3) {margin-bottom:30px;}
</style>

<div class="m-center-content profile-view">
	<?php foreach($profile_data as $row):?>

	<div class="profile-name">
		<h2><?php echo $row['firstname'].' '.$row['lastname']?></h2>
		<p><?php echo ($row['city'] != null) ? $row['city'].', '.$row['country'] : ''?></p>
	</div>
	
	<hr/>
	
	<div class="profile-information">
		<div class="fl span2">
			<div class="profile-image">
				<img src="<?php echo ($row['image'] != '') ? base_url('assets/media_uploads/').'/'.$row['image'] : base_url('assets/images/page_template/blank_profile_large.jpg')?>" width="150" height="150" alt=""/>
			</div>
		</div>
		<div class="fl span4">
			<ul>
				<li>
					<label for="Member Since">Member Since</label>
					<span>: <?php echo date('F d, Y', strtotime($row['date_registered']))?></span>
				</li>
				<li>
					<label for="Hometown">Hometown</label>
					<span>: <?php echo ($row['city'] != null) ? $row['city'].', '.$row['country'] : 'Not specified'?></span>
				</li>
				<li>
					<label for="Hometown">Age</label>
					<span>: <?php if($row['birthdate'] != '') : 
								$birthday = new DateTime($row['birthdate']);
								$interval = $birthday->diff(new DateTime);
								echo $interval->y;
							else:
								echo 'Not specified';
							endif?></span>
				</li>
				<li>
					<label for="work:">Work:</label>
					<span>: <?php echo ($row['job'] != '') ? $row['job'] : 'Not specified'?></span>
				</li>
				<li>
					<label for="Car">Car:</label>
					<span>: <?php echo ($row['car'] != '') ? $row['car'] : 'Not specified'?></span>
				</li>
				<li>
					<label for="Created Rides">Created Rides:</label>
					<span>: <?php echo ($row['created_rides'] != '') ? $row['created_rides'] : 'No rides created'?></span>
				</li>
				<li>
					<label for="Status">Nmm Status:</label>
					<span>: Silver</span>
				</li>
				<li>
					<label for="Co2 saving total">Co2 saving total:</label>
					<span>: 0 kg.</span>
				</li>
			</ul>
		</div>
		<div class="fr span4">
			<div class="recommend">
				<h3>Recommendation</h3>
				
				<hr/>
				
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				<p><strong>Lambert Chrobeck</strong>  -  Developer</p>
				<p>Aixirivali, Andorra</p>
			</div>
		</div>
		
		<div class="clr"></div>
	</div>
	
	<?php endforeach?>
	
	<div class="profile-overview">
		<div class="profile-overview-tab-menu">
			<a href="javascript:void(0)" data-content="#profile-overview-rides" class="selected">List of Rides</a>
			<a href="javascript:void(0)" data-content="#profile-overview-passenger" class="">List of Wish Lift</a>
			
			<div class="clr"></div>
		</div>
		
		<div class="profile-overview-rides">
			<section class="wrapper">
				<section class="panel">
					<div class="panel-body">
						<div class="adv-table editable-table ">
							<table class="table table-striped table-hover table-bordered" id="ride-table">
								<thead>
									<tr>
										<th>Origin</th>
										<th>Destination</th>
										<th>Date and Time</th>
									</tr>
								</thead>
								<tbody>
									<?php if($rides_data == null):?>
									<tr class="">
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<?php 
									else:
										foreach($rides_data as $row):?>
									<tr class="m-row" data="<?php echo $row['id']?>">
											<td><?php echo $row['origins']?></td>
											<td><?php echo $row['destination']?></td>
											<td><?php echo date('F d - H:i A', strtotime($row['time']))?></td>
									</tr>
									<?php endforeach;
									endif?>
								</tbody>
							</table>
						</div>
					</div>
				</section>
			</section>
		</div>
		<div class="profile-overview-passenger">
			<section class="wrapper">
				<section class="panel">
					<div class="panel-body">
						<a href="<?php echo base_url('passenger/create')?>" class="fr btn btn-default">Post Wish Lift</a>
							<div class="clr"></div>
						<div class="adv-table editable-table ">
							<table class="table table-striped table-hover table-bordered" id="passenger-table">
								<thead>
									<tr>
										<th>Origin</th>
										<th>Destination</th>
										<th>Date and Time</th>
									</tr>
								</thead>
								<tbody>
									<?php if($passenger_data == null):?>
									<tr class="">
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<?php else:?>
										<?php foreach($passenger_data as $row):?>
										<tr class="p-row">
											<td><?php echo $row['origins']?></td>
											<td><?php echo $row['destination']?></td>
											<td><?php echo date('F d - H:i A', strtotime($row['time']))?></td>
										</tr>
										<?php endforeach?>
									<?php endif?>
								</tbody>
							</table>
						</div>
					</div>
				</section>
			</section>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.dcjqaccordion.2.7.js')?>" class="include"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.dataTables.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/DT_bootstrap.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/editable-table.js')?>"></script>
<script type="text/javascript">
$(document).ready(function() { 
	$('.m-row').click(function() { var id = $(this).attr('data'); window.location.href="<?php echo base_url('rides/detail/')?>/"+id; });
	$('.p-row').click(function() { var id = $(this).attr('data'); window.location.href="<?php echo base_url('rides/detail/')?>/"+id; });
	
	$('#ride-table, #passenger-table').dataTable();
	
	$('.profile-overview-tab-menu a').click(function() {
		var div = $(this).attr('data-content').substring(1);
		
		$('.profile-overview-tab-menu a').removeClass('selected');
		$('.profile-overview-rides, .profile-overview-passenger').hide();
		
		$(this).addClass('selected');
		
		
		$('.'+div).show();
	});
});
</script>