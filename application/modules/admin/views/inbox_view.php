	<?php $this->load->view('includes/header_content')?>
	<?php $this->load->view('includes/sidebar_view')?>
	
	<!--main content start-->
	<section id="main-content">
		<section class="wrapper">
		
			<!--mail inbox start-->
			<div class="mail-box">
				<aside class="sm-side">
					<div class="user-head">
						<a href="javascript:;" class="inbox-avatar"><img src="<?php echo base_url()?>assets/img/mail-avatar.jpg" alt=""></a>
						<div class="user-name"><h5><a href="#">fullname</a></h5><span><a href="#">jsmith@gmail.com</a></span></div>
					</div>
					
					<div class="inbox-body">
						<a class="btn btn-compose" data-toggle="modal" href="#myModal">Compose</a>
					</div>
					
					<ul class="inbox-nav inbox-divider">
						<li class="active">
						<?php foreach($new_email as $new):?>					
							<a href="#"><i class="icon-inbox"></i> Inbox <span class="label label-danger pull-right"><?php echo $new['new_mail'] ?></span></a>
						<?php endforeach?>
						</li>
						<li>
							<a href="#"><i class="icon-envelope-alt"></i> Sent Mail</a>
						</li>                       
					</ul>
				</aside>
				
				<aside class="lg-side">
					<div class="inbox-head"><h3>Inbox</h3></div>
					<div class="panel-body">
						<table  class="table table-inbox table-hover" id="mail">
							<thead>
								<tr>
									<th>&nbsp;</th>
									<th>Sender</th>
									<th>Subject</th>
									<th>Date</th>
								</tr>
							</thead>
							<tbody>
								<?php if($inbox != null):?>
									<?php foreach($inbox as $message): ?>
										<?php if($message['is_read'] == 0){?>
											<tr class="unread">									
												<td class="inbox-small-cells"><input type="checkbox" class="mail-checkbox"></td>
												<td class="view-message dont-show"><?php echo $message['firstname']?> <?php echo $message['lastname']?></td>
												<td class="view-message"><a href="<?php echo base_url('admin/inbox/detail').'/'.$message['message_id']?>"><?php echo $message['subject']?></a></td>
												<td ><?php echo $message['date']?></td>
											</tr>
										<?php }else{ ?>							  
											<tr class="">
												<td class="inbox-small-cells"><input type="checkbox" class="mail-checkbox"></td>
												<td class="view-message dont-show"><?php echo $message['firstname']?> <?php echo $message['lastname']?></td>
												<td class="view-message"><?php echo $message['subject']?></td>
												<td ><?php echo $message['date']?></td>
											</tr>
										<?php } ?>
									<?php endforeach?>
								<?php else:?>
								<tr class="unread">									
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<?php endif?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</section>
	</section>
	<!--main content end-->		

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Compose</h4>
				</div>
					<div class="modal-body">
						<form class="form-horizontal" role="form">
							<div class="form-group">
								<label  class="col-lg-2 control-label">To</label>
								<div class="col-lg-10"><input type="text" class="form-control" id="inputEmail1" placeholder=""></div>
							</div>
							<div class="form-group">
								<label  class="col-lg-2 control-label">Cc / Bcc</label>
								<div class="col-lg-10"><input type="text" class="form-control" id="cc" placeholder=""></div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Subject</label>
								<div class="col-lg-10"><input type="text" class="form-control" id="inputPassword1" placeholder=""></div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Message</label>
								<div class="col-lg-10"><textarea name="" id="" class="form-control" cols="30" rows="10"></textarea></div>
							</div>

							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button type="submit" class="btn btn-send">Send</button>
								</div>
							</div>
						</form>
					</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->	

	<!-- js placed at the end of the document so the pages load faster -->
	<script type="text/javascript" src="<?php echo base_url('assets/admin/plugins/advanced-datatable/media/js/jquery.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/admin/js/jquery.dcjqaccordion.2.7.js')?>" class="include"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/admin/js/jquery.scrollTo.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/admin/js/jquery.nicescroll.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/admin/js/respond.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/admin/plugins/data-tables/jquery.dataTables.js')?>"></script>

	<!--common script for all pages-->
	<script src="<?php echo base_url('assets/admin/js/common-scripts.js')?>"></script>
	<script type="text/javascript" charset="utf-8">$(document).ready(function() { $('#mail').dataTable( { "bServerSide": true, "bSort": false }); });</script>