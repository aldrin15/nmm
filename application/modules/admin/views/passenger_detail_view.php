<?php $this->load->view('includes/sidebar_view')?>
<aside class="profile-info col-lg-12">
	<section id="main-content">
		<section class="panel">

			<div class="panel-body bio-graph-info">
				<?php foreach($details as $detail): ?>
					<div class="row">
						<div class="bio-graph-heading">
							<?php echo $detail['route_from']?> &#10137; <?php echo $detail['route_to']?>
						</div>
						<div class="info-detail">
						<p><span>Passenger Name </span>: <?php echo $detail['firstname']?> <?php echo $detail['lastname']?></p>
						<p><span>Storage </span>: <?php echo $detail['storage']?></p>
						<p><span>Available seat(s) </span>: <?php echo $detail['available']?></p>
						<p><span>Remarks </span>: <?php echo $detail['remarks']?></p>
						<p><span>Mobile </span>: no data</p>
						</div>
					</div>
				<?php endforeach?>
			</div>
		</section>
	</section>
</aside>
