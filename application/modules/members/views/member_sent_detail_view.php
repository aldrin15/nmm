<?php $this->load->view('header_content')?>

<style type="text/css">
.inbox-detail {margin-left:10px; width:80%;}
</style>

<div class="m-center-content">
	<?php echo modules::run('lift/search')?>
	
	<?php $this->load->view('member_sidebar_view')?>
	
	<div class="inbox-detail fl">
		<?php foreach($user_sent_data as $row):?>
		<section class="wrapper">
			<div>
				<a href="<?php echo base_url('members/inbox')?>" class="btn btn-primary"><i class="glyphicon glyphicon-arrow-left"></i> REPLY</a>
				<a href="<?php echo base_url('members/message_delete').'/'.$row['message_id']?>" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
			</div><br />
			<section class="panel">
				<div class="panel-body">
					<div class="col-table-row">
						<div class="col-app col-unscrollable">
							<div class="col-app">

								<div class="innerAll border-bottom">
									<div class="span3">
										<img src="<?php echo base_url('assets/media_uploads')?>/<?php echo $row['image']?>" alt="70" width="90" class="pull-left">
										
										<div class="pull-left span2" style="margin-left:10px;">
											<h5 style="color:#898989;"><strong>Me</strong></h5>
											<h5 style="color:#a2a2a2;">To: <?php echo $row['firstname'].' '.$row['lastname']?></h5>
										</div>
									</div>
									
									<small class="text-muted pull-right"><?php echo date('d F Y', strtotime($row['date']))?></small>
									<div class="clearfix"></div>

									<h4 class="margin-none"><i class="fa fa-fw fa-circle-o text-success"></i> Subject: <?php echo $row['subject']?></h4>
								</div>
								<hr/>
								<div class="innerAll">
									<div class="innerAll">
										<?php echo $row['message']?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</section>
		<?php endforeach?>
	</div>
	
	<div class="clr"></div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
<script type="text/javascript">
$(function() {
	$('.overview-tab-menu a').click(function() {
		var div = $(this).attr('href').substring(1);
		
		$('.overview-tab-menu a').removeClass('selected');
		$('.overview-rides, .overview-passenger').hide();
		
		$(this).addClass('selected');
		
		
		$('.'+div).show();
	});
	
	$(".profile-nav ul li a").click(function(e){
		if(false == $(this).next().is(':visible')) { $('.profile-nav ul li ul').slideUp(300); }
		
		$(this).next().slideToggle(300);
		
		// e.preventDefault();
	});
	
	var count = 0;
	
	$('.profile-status ul li').each(function() {
		var percent = $(this).attr('data-val');
		
		count += Number(percent);
	});
	
	$( ".profile-progress" ).progressbar({ value: count });
});
</script>