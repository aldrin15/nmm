<?php $this->load->view('header_content')?>

<style type="text/css">.message-inbox {margin-left:10px; width:80%;}.m-row {cursor:pointer}.profile-nav ul li:nth-child(2) ul {display:block;}</style>

<div class="profile-wrapper m-center-content">
	<?php echo modules::run('lift/search')?>
	
	<?php $this->load->view('member_sidebar_view')?>
	
	<div class="message-inbox fl">
		<section class="wrapper">
			<div class="span5">
				<a href="#" id="btn-delete" class="btn btn-danger" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
				<div class="clr"></div>
			</div><br />
			
			<section class="panel">
				<div class="panel-body">
					<div class="adv-table editable-table ">
						<form action="" method="post">
							<table class="table table-striped table-hover table-bordered" id="message">
								<thead>
									<tr>
										<th>&nbsp;</th>
										<th>Subject</th>
										<th>Message</th>
										<th>Date</th>
									</tr>
								</thead>
								<tbody>
									<?php if($user_sent_data != false):
										foreach($user_sent_data as $row):
									?>
									<tr>
										<td><input type="checkbox" name="message[]" value="<?php echo $row['message_id']?>" id=""/></td>
										<td class="m-row" data-id="<?php echo $row['message_id']?>"><?php echo substr($row['subject'], 0, 20)?></td>
										<td class="m-row" data-id="<?php echo $row['message_id']?>"><?php echo substr($row['message'], 0, 70)?></td>
										<td class="m-row" data-id="<?php echo $row['message_id']?>"><?php echo date('F d', strtotime($row['date']))?></td>
									</tr>	
									<?php 
										endforeach;
									else:?>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<?php endif?>									
								</tbody>
							</table>
						</form>
					</div>
				</div>
			</section>
		</section>	
	</div>
	
	<div class="clr"></div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.dcjqaccordion.2.7.js')?>" class="include"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.dataTables.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/DT_bootstrap.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/editable-table.js')?>"></script>
<script type="text/javascript">
$(function() {
	$('#message').dataTable();
	$('.m-row').click(function() {var id = $(this).attr('data-id');window.location.href=base_url+"members/sent_detail/"+id;});
	
	$('#btn-delete').click(function() {
		var m_delete = [];
		
		if(confirm("Are you sure? you want to delete")) {
			if($('input[name="message[]"]').is(':checked')) {$('input[name="message[]"]').each(function() {if($(this).is(':checked')) {m_delete.push($(this).val());}});
			
				$.ajax({url:base_url+'members/inbox_delete',data:{id:m_delete},type:'POST',success:function(data){location.reload();}});}else{alert('Please check first');}
		}
	});
	
	$(".profile-nav ul li a").click(function(e){if(false == $(this).next().is(':visible')){$('.profile-nav ul li ul').slideUp(300);}$(this).next().slideToggle(300);});
});
</script>
<?php echo modules::run('lift/auto_suggest_city')?>