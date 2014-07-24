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
									  <th>Event Title</th>
									  <th>Event Place</th>
									  <th>Date & Time</th>
								  </tr>
								  </thead>
								  <tbody>
								  <?php foreach($event as $show): ?>
								  <tr>
									  <td><?php echo $show['id']?></td>
									  <td><?php echo $show['title']?></td>
									  <td><?php echo $show['city_country']?></td>
									  <td><?php echo $show['date']?></td>
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
	<script type="text/javascript" src="<?php echo base_url('assets/admin/plugins/advanced-datatable/media/js/jquery.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/admin/js/jquery.dcjqaccordion.2.7.js')?>" class="include"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/admin/js/jquery.scrollTo.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/admin/js/jquery.nicescroll.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/admin/js/respond.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/admin/plugins/data-tables/jquery.dataTables.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/admin/plugins/data-tables/DT_bootstrap.js')?>"></script>

	<!--common script for all pages-->
	<script src="<?php echo base_url('assets/admin/js/common-scripts.js')?>"></script>
	<script type="text/javascript" charset="utf-8">$(document).ready(function() { $('#example').dataTable( { "aaSorting": [[ 4, "desc" ]] }); });</script>
