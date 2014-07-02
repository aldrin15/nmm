<?php $this->load->view('includes/sidebar_view')?>
<aside class="profile-info col-lg-12">
	<section id="main-content">
		<section class="panel">

			<div class="panel-body bio-graph-info">
				<?php foreach($details as $detail): ?>
					<div class="row">
						<div class="bio-graph-heading">
							<img alt="" src="<?php echo base_url('assets/img/follower-avatar.jpg')?>">
							<?php echo $detail['firstname']?> <?php echo $detail['lastname']?>
						</div>                                  
						<div class="bio-row">
							<p><span>Country </span>: <?php echo $detail['country']?></p>
						</div>								                                
						<div class="bio-row">
							<p><span>City </span>: <?php echo $detail['city']?></p>
						</div>
						<div class="bio-row">
							<p><span>Street </span>: <?php echo $detail['street']?></p>
						</div>
						<div class="bio-row">
							<p><span>Birthday</span>: no data</p>
						</div>
						<div class="bio-row">
							<p><span>Occupation </span>: no data</p>
						</div>
						<div class="bio-row">
							<p><span>Email </span>: <?php echo $detail['email']?></p>
						</div>
						<div class="bio-row">
							<p><span>Mobile </span>: no data</p>
						</div>
						<div class="bio-row">
							<p><span>Phone </span>: no data</p>
						</div>
					</div>
				<?php endforeach?>
			</div>
		</section>
	</section>
</aside>
