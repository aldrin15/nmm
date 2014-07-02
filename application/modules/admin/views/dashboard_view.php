	<?php $this->load->view('includes/sidebar_view')?>
	<!--sidebar end-->
	<!--main content start-->
	<section id="main-content">
	<section class="wrapper">
	
		<!--state overview start-->
		<?php foreach($analytics_count_data as $row):?>
		<div class="row state-overview">
			<div class="col-lg-2 col-sm-6">
				<section class="panel">
					<div class="symbol terques"><i class="icon-group"></i></div>
					<div class="value">
						<h3 class="count"><?php echo $row['user']?></h3>
						<p>Total Members</p>
					</div>
				</section>
			</div>
			<div class="col-lg-2 col-sm-6">
				<section class="panel">
					<div class="symbol red"><i class="icon-truck"></i></div>
					<div class="value">
						<h3 class=" count2"><?php echo $row['lift']?></h3>
						<p>Lift Created</p>
					</div>
				</section>
			</div>
			<div class="col-lg-2 col-sm-6">
				<section class="panel">
					<div class="symbol yellow"><i class="icon-male"></i></div>
					<div class="value">
						<h3 class=" count3"><?php echo $row['wish']?></h3>
						<p>Passenger Created</p>
					</div>
				</section>
			</div>
			<div class="col-lg-2 col-sm-6">
				<section class="panel">
					<div class="symbol blue"><i class="icon-calendar"></i></div>
					<div class="value">
						<h3 class=" count4"><?php echo $row['events']?></h3>
						<p>Event Created</p>
					</div>
				</section>
			</div>
			<div class="col-lg-2 col-sm-6">
				<section class="panel">
					<div class="symbol green"><i class="icon-euro"></i></div>
					<div class="value">
						<h3 class=" count5"> 0</h3>
						<p>Rent a Car created</p>
					</div>
				</section>
			</div>
			<div class="col-lg-2 col-sm-6">
				<section class="panel">
					<div class="symbol violet"><i class=" icon-shopping-cart"></i></div>
					<div class="value">
						<h3 class=" count6">0</h3>
						<p>Total Earnings</p>
					</div>
				</section>
			</div>
		</div>
		<!--state overview end-->
		<?php endforeach?>

		<div class="row">
			<div class="col-lg-12">
				<!--custom chart start-->
				<div class="border-head"><h3>Earning Graph</h3></div>
				<div class="custom-bar-chart">
					<ul class="y-axis">
						<li><span>100</span></li>
						<li><span>80</span></li>
						<li><span>60</span></li>
						<li><span>40</span></li>
						<li><span>20</span></li>
						<li><span>0</span></li>
					</ul>
					
					<?php 
					$month_array = array(
						'Jan' => '80%',
						'Feb' => '70%',
						'Mar' => '60%',
						'Apr' => '50%',
						'May' => '40%',
						'Jun' => '30%',
						'Jul' => '20%',
						'Aug' => '10%',
						'Sep' => '90%',
						'Oct' => '100%',
						'Nov' => '100%',
						'Dec' => '90%'
					);

					foreach($month_array as $key=>$val):
					?>
					<div class="bar">
						<div class="title"><?php echo $key?></div>
						<div class="value tooltips" data-original-title="100%" data-toggle="tooltip" data-placement="top"><?php echo $val?></div>
					</div>
					<?php endforeach?>
				</div>
				<!--custom chart end-->
			</div>
		</div>
			
		<div class="row">
			<div class="col-lg-5">
				<!--user info table start-->
				<section class="panel">
					<div class="panel-body">
						<div class="task-thumb-details"><h1>New Member:</h1></div>
					</div>
					<table class="table table-hover personal-task">
						<tbody>
							<?php foreach($latest as $new_member):?>
							<tr>
								<td><img alt="" src="<?php echo base_url('assets/img/avatar-mini4.jpg')?>"></td>
								<td><?php echo $new_member['firstname']?> <?php echo $new_member['lastname']?></td>
								<td><?php echo $new_member['city']?> <?php echo $new_member['country']?></td></a>
							</tr>
							<?php endforeach?>
						</tbody>
					</table>
				</section>
				<!--user info table end-->
			</div>

			<div class="col-lg-5">
				<!--user info table start-->
				<section class="panel">
					<div class="panel-body"><div class="task-thumb-details"><h1>New Member:</h1></div></div>
					<table class="table table-hover personal-task">
						<tbody>
							<tr>
								<td>
								 <img alt="" src="<?php echo base_url()?>assets/img/avatar-mini4.jpg">
								</td>
								<td>Member Fullname1</td>
								<td> view</td>
							</tr>
							<tr>
								<td>
									<img alt="" src="<?php echo base_url()?>assets/img/avatar-mini3.jpg">
								</td>
								<td>Member Fullname2</td>
								<td> 14</td>
							</tr>
							<tr>
								<td>
									<img alt="" src="<?php echo base_url()?>assets/img/avatar-mini2.jpg">
								</td>
								<td>Member Fullname3</td>
								<td> 45</td>
							</tr>
							<tr>
								<td>
									<img alt="" src="<?php echo base_url()?>assets/img/avatar-mini.jpg">
								</td>
								<td>Member Fullname4</td>
								<td> 09</td>
							</tr>
							<tr>
								<td>
									<img alt="" src="<?php echo base_url()?>assets/img/avatar-mini4.jpg">
								</td>
								<td>Member Fullname5</td>
								<td> 09</td>
							</tr>
						</tbody>
					</table>
				</section>
			</div>
		</div>
	</section>
	<!--user info table end-->              

	<!-- js placed at the end of the document so the pages load faster -->
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.dcjqaccordion.2.7.js')?>" class="include" ></script>
	<script src="<?php echo base_url('assets/js/jquery.nicescroll.js')?>" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js')?>"></script>
	<script src="<?php echo base_url('assets/js/respond.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.dcjqaccordion.2.7.js')?>" class="include"></script>

	<!--common script for all pages-->
	<script src="<?php echo base_url()?>assets/js/common-scripts.js"></script>

	<script type="text/javascript">
	//owl carousel
	$(document).ready(function() {
		$("#owl-demo").owlCarousel({ navigation : true, slideSpeed : 300,  paginationSpeed : 400, singleItem : true,  autoPlay:true });
	}
	//custom select box
	</script>