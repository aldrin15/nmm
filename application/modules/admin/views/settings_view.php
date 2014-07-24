	<?php $this->load->view('includes/header_content')?>

	<?php $this->load->view('includes/sidebar_view')?>
	
	<section id="main-content">
		<section class="wrapper">
			<!-- page start-->
			<div class="row">
				<aside class="profile-nav col-lg-3">
					<section class="panel">
						<div class="user-heading round">
							<p>Admin</p>
							<a href="#">
							<img src="<?php echo base_url()?>assets/admin/img/profile-avatar.jpg" alt="">
							</a>
							<p>Level</p>
						</div>                   
					</section>
				</aside>
				<aside class="profile-info col-lg-9">
					<section class="panel">
						<div class="bio-graph-heading">
							Profile
						</div>
						<div class="panel-body bio-graph-info">
							<form class="form-horizontal" role="form" method="post" action="" >
							<?php foreach($details as $detail):?>
								<div class="form-group">
								<label  class="col-lg-2 control-label">Name</label>
								<div class="col-lg-10"><input type="text" class="form-control" value="<?php echo $detail['display_name']?>"/>	</div>
								</div>
								<div class="form-group">
								<label  class="col-lg-2 control-label">Username</label>
								<div class="col-lg-10"><input type="text" class="form-control" value="<?php echo $detail['username']?>"/>	</div>
								</div>
								<div class="form-group">
								<label  class="col-lg-2 control-label">Password</label>
								<div class="col-lg-10"><input type="password" class="form-control" value=""/>	</div>
								</div>
								<div class="form-group">
								<label  class="col-lg-2 control-label">Change Password</label>
								<div class="col-lg-10"><input type="password" class="form-control" value=""/>	</div>
								</div>
								<div class="form-group">
								<label  class="col-lg-2 control-label">Confirm Password</label>
								<div class="col-lg-10"><input type="password" class="form-control" value=""/>	</div>
								</div>	
								<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button type="submit" class="btn btn-send">Save Edit</button>
								</div>
								</div>
							<?php endforeach?>
							</form>
						</div>		
							
						</div>
					</section>
				  
					
				</aside>
			</div>
			<!-- page end-->
		</section>
	</section>

