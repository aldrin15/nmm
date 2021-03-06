	<?php $this->load->view('includes/header_content');?>
	
	<?php $this->load->view('includes/sidebar_view')?>
	<!--main content start-->
	<section id="main-content">
		<section class="wrapper">
			<!-- page start-->
			<div class="row">
				<div class="col-lg-12">
					<section class="panel">
						<header class="panel-heading">List of Passengers</header>
						<div class="panel-body">
							<div class="adv-table">
								<table  class="display table table-bordered table-striped" id="example">
									<thead>
										<tr>
											<th>ID</th>
											<th>Passenger</th>
											<th>From &#10137; To</th>
											<th>Date</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php if($passenger != ''): ?>
										<tr>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<?php
										foreach($passenger as $wish): ?>
										<tr>
										  <td><?php echo $wish['id']?></td>
										  <td><?php echo $wish['firstname']?> <?php echo $wish['lastname']?></td>
										  <td><?php echo $wish['route_from']?> &#10137; <?php echo $wish['route_to']?></td>
										  <td><?php echo $wish['date']?></td>
										  <td><a href="<?php echo base_url('admin/passenger/')?>">View</a></td>
										</tr>
										<?php endforeach;
										endif?>									  
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
	<script type="text/javascript" src="<?php echo base_url('assets/admin/js/jquery.dcjqaccordion.2.7.js')?>" class="include"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/admin/js/jquery.scrollTo.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/admin/js/jquery.nicescroll.js')?>" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/admin/js/respond.min.js')?>" ></script>
	<script type="text/javascript" src="<?php echo base_url('assets/admin/plugins/data-tables/jquery.dataTables.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/admin/plugins/data-tables/DT_bootstrap.js')?>"></script>
	
	<!--common script for all pages-->
	<script src="<?php echo base_url('assets/admin/js/common-scripts.js')?>"></script>
	<script type="text/javascript" charset="utf-8">$(document).ready(function() { $('#example').dataTable( { "aaSorting": [[ 4, "desc" ]] }); });</script>