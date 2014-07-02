<?php $this->load->view('includes/sidebar_view')?>
<aside class="profile-info col-lg-12">
	<section id="main-content">
		<section class="panel">
			<div class="panel-body bio-graph-info">
			<?php foreach($details as $detail): ?>
				<div class="row">
				<div class="email-heading">
					<span>From: </span><?php echo $detail['firstname']?> <?php echo $detail['lastname']?></br>
					<span>To: </span><?php echo $detail['fullname']?></br>
					<span>Subject: </span><?php echo $detail['subject']?>
				</div>
				<div class="bio-row">
				<textarea rows="4" cols="50"><?php echo $detail['message']?></textarea>
				</div>
			<?php endforeach?>
			</div>
		</section>
	</section>
</aside>