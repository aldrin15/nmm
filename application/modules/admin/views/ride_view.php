	<?php 
	$this->load->view('header_content');
	$this->load->view('includes/sidebar_view');
	?>
	<!--main content start-->
	<section id="main-content">
		<section class="wrapper">
			<!-- page start-->
			<div class="row">
				<div class="col-lg-12">
					<section class="panel">
						<header class="panel-heading">List of Lifts</header>
						<div class="panel-body">
							<div class="adv-table">
								<table  class="display table table-bordered table-striped" id="example">
									<thead>
										<tr>
											<th>ID</th>
											<th>Driver</th>
											<th>From &#10137; To</th>
											<th>Date & Time</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php foreach($lift as $rides): ?>
									<tr>
										<td><?php echo $rides['id']?></td>
										<td><?php echo $rides['firstname']?> <?php echo $rides['lastname']?></td>
										<td><?php echo $rides['route_from']?> &#10137; <?php echo $rides['route_to']?></td>
										<td><?php echo $rides['date']?></td>
										<td><a href="<?php echo base_url('admin/rides/detail/').'/'.$rides['id']?>">view</a></td>
									</tr>  
									<?php endforeach?>									  
									</tbody>
								</table>
							</div>
						</div>
					</section>
				</div>
			</div>
			<!-- page end-->
		</section>
	</section>
	<!--main content end-->					

	<!-- js placed at the end of the document so the pages load faster -->
	<!--<script src="js/jquery.js"></script>-->
	<script type="text/javascript" src="<?php echo base_url('assets/admin/plugins/advanced-datatable/media/js/jquery.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/admin/js/bootstrap.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/admin/js/jquery.dcjqaccordion.2.7.js')?>" class="include" ></script>
	<script type="text/javascript" src="<?php echo base_url('assets/admin/js/jquery.scrollTo.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/admin/js/jquery.nicescroll.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/admin/js/respond.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/admin/plugins/data-tables/jquery.dataTables.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/admin/plugins/data-tables/DT_bootstrap.js')?>"></script>


	<!--common script for all pages-->
	<script src="<?php echo base_url('assets/admin/js/common-scripts.js')?>"></script>

	<script type="text/javascript" charset="utf-8">
	$(document).ready(function() { $('#example').dataTable( { "aaSorting": [[ 5, "desc" ]] }); });
	</script>
