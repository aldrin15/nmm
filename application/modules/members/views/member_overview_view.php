<?php $this->load->view('header_content')?>

<style type="text/css">
.overview {margin-left:10px; width:80%;}
.overview-tab-menu a {float:left; background:#e2e1e1; color:#656565; font-size:1.1em; font-weight:bold; vertical-align:middle; padding:6px 12px;}
.overview-tab-menu a:hover {text-decoration:none;}
.overview-tab-menu a:first-child {border-right:1px solid #d7d5d5; border-radius: 5px 0px 0px 0px; -webkit-border-radius: 4px 0px 0px 0px; -moz-border-radius: 4px 0px 0px 0px; -ms-border-radius: 4px 0px 0px 0px;}
.overview-tab-menu a:nth-child(2) {border-radius: 0px 5px 0px 0px; -webkit-border-radius: 0px 4px 0px 0px; -moz-border-radius: 0px 4px 0px 0px; -ms-border-radius: 0px 4px 0px 0px;}
.overview-tab-menu a.selected {background:#f4f2f2;}

.overview-passenger {display:none;}
</style>

<div class="profile-wrapper m-center-content">
	<?php echo modules::run('lift/search')?>
	
	<?php $this->load->view('member_sidebar_view')?>
	
	<div class="overview fl">
		<div class="overview-tab-menu">
			<a href="#overview-rides" class="selected">List of Rides</a>
			<a href="#overview-passenger" class="">List of Wish Lift</a>
			
			<div class="clr"></div>
		</div>
		
		<div class="overview-rides">
			<section class="wrapper">
				<section class="panel">
					<div class="panel-body">
						<a href="<?php echo base_url('lift/create')?>" class="fr btn btn-default">Post Ride</a>
							<div class="clr"></div>
						<div class="adv-table editable-table ">
							<table class="table table-striped table-hover table-bordered" id="ride-table">
								<thead>
									<tr>
										<th>Origin</th>
										<th>Destination</th>
										<th>Date and Time</th>
										<th>View</th>
										<th>Edit</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody>
									<?php if($rides_data == null):?>
									<tr class="">
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<?php else:?>
										<?php foreach($rides_data as $row):?>
										<tr class="">
												<td><?php echo $row['origins']?></td>
												<td><?php echo $row['destination']?></td>
												<td><?php echo date('F d', strtotime($row['date'])).' '.date('H:i A', strtotime($row['time']))?></td>
												<td><a class="edit" href="<?php echo base_url('members/ride-detail')?>/<?php echo $row['id']?>/<?php echo $row['date']?>">View</a></td>
												<td><a class="edit" href="<?php echo base_url('members/ride-edit')?>/<?php echo $row['id']?>">Edit</a></td>
												<td><a class="delete" href="javascript:;">Delete</a></td>
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
		<div class="overview-passenger">
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
										<th>View</th>
										<th>Edit</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody>
									<?php if($passenger_data == null):?>
									<tr class="">
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<?php else:?>
										<?php foreach($passenger_data as $row):?>
										<tr class="">
											<td><?php echo $row['origins']?></td>
											<td><?php echo $row['destination']?></td>
											<td><?php echo date('F d', strtotime($row['date'])).' '.date('H:i A', strtotime($row['start_time']))?></td>
											<td><a class="edit" href="<?php echo base_url('members/passenger-detail')?>/<?php echo $row['id']?>">View</a></td>
											<td><a class="edit" href="<?php echo base_url('members/passenger-edit')?>/<?php echo $row['id']?>">Edit</a></td>
											<td><a class="delete" href="javascript:;">Delete</a></td>
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
	
	<div class="clr"></div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.dcjqaccordion.2.7.js')?>" class="include"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.dataTables.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/DT_bootstrap.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/editable-table.js')?>"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.m-row').click(function() { var id = $(this).attr('data-id');window.location.href=base_url+"members/inbox_detail/"+id;});
	$('#ride-table, #passenger-table').dataTable();
	$('.overview-tab-menu a').click(function() { var div = $(this).attr('href').substring(1);$('.overview-tab-menu a').removeClass('selected');$('.overview-rides, .overview-passenger').hide();$(this).addClass('selected');$('.'+div).show();});	
	$(".profile-nav ul li a").click(function(e){ if(false == $(this).next().is(':visible')) { $('.profile-nav ul li ul').slideUp(300); } $(this).next().slideToggle(300);});
});
</script>
<?php echo modules::run('lift/auto_suggest_city')?>