<?php $this->load->view('header_content')?>

<div class="member-billing m-center-content">
	<?php echo modules::run('lift/search')?>
	
	<?php $this->load->view('member_sidebar_view')?>

	<!-- invoice start-->
	
	<section class="fl">
		<div class="panel panel-primary span8">
			<div class="panel-body">
				<?php if($billing_validate_data[0]['account_status'] == 'Not Activated'):?>
				<div class="row invoice-list">
					<div class="col-lg-4 col-sm-4">
						<h4>BILLING INFORMATION</h4>
						
						<?php foreach($subscription_status_data as $row):
							$date = date('d-m-Y', strtotime($row['end_date']));
							$today = date('d-m-Y');
						?>
						<ul class="unstyled">
							<li><strong>Invoice Date</strong> : <?php echo date('d-m-y', strtotime($row['start_date']))?></li>
							<li><strong>Due Date</strong> : <?php echo date('d-m-y', strtotime($row['end_date']))?></li>
							<li><strong>Invoice Status</strong>	: <?php echo (strtotime($date) < strtotime($today)) ? 'Paid' : 'Expired'?></li>
						</ul>
						<?php endforeach?>
					</div>
				</div><br /><br />
				<div style="background:#ff3500; color:#fff; text-align:center; border:1px solid #000; padding:10px 0;">Your account is already expired please renew your membership to continue our service.</div>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th class="hidden-phone">Subscription Type</th>
							<th class="">Cost</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($subscription_data as $row):?>
						<tr>
							<td><?php echo $row['firstname'].' '.$row['lastname']?></td>
							<td class="hidden-phone"><?php echo $row['type']?></td>
							<td class="">&euro; <?php echo $row['amount']?></td>
						</tr>
						<?php endforeach?>
					</tbody>
				</table><br /><br />
				<div class="row">
					<div class="col-lg-4 invoice-block pull-right">
						<?php foreach($subscription_total as $row):?>
						<ul class="unstyled amounts">
							<li><strong>Sub - Total amount :</strong> &euro; <?php echo $row['total']?></li>
							<li><strong>Discount :</strong>-----</li>
							<li><strong>VAT :</strong> -----</li>
							<li><strong>Grand Total :</strong> &euro; <?php echo $row['total']?></li>
						</ul>
						<?php endforeach?>
					</div>
				</div>
				<div class="text-center invoice-btn">
					<a class="btn btn-danger btn-lg" onclick="javascript:window.print();"><i class="icon-print"></i> Renew Account </a>
					<a class="btn btn-info btn-lg" onclick="javascript:window.print();"><i class="icon-print"></i> Print </a>
				</div>
				<?php else:?>
				<div class="row invoice-list">
					<div class="col-lg-4 col-sm-4">
						<h4>BILLING INFORMATION</h4>
						
						<?php foreach($subscription_status_data as $row):?>
						<ul class="unstyled">
							<li><strong>Invoice Date</strong> : <?php echo date('d-m-y', strtotime($row['start_date']))?></li>
							<li><strong>Due Date</strong> : <?php echo date('d-m-y', strtotime($row['end_date']))?></li>
							<li><strong>Invoice Status</strong>	: Paid</li>
						</ul>
						<?php endforeach?>
					</div>
				</div><br /><br />
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th class="hidden-phone">Subscription Type</th>
							<th class="">Cost</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($subscription_data as $row):?>
						<tr>
							<td><?php echo $row['firstname'].' '.$row['lastname']?></td>
							<td class="hidden-phone"><?php echo $row['type']?></td>
							<td class="">&euro; <?php echo $row['amount']?></td>
						</tr>
						<?php endforeach?>
					</tbody>
				</table><br /><br />
				<div class="row">
					<div class="col-lg-4 invoice-block pull-right">
						<?php foreach($subscription_total as $row):?>
						<ul class="unstyled amounts">
							<li><strong>Sub - Total amount :</strong> &euro; <?php echo $row['total']?></li>
							<li><strong>Discount :</strong>-----</li>
							<li><strong>VAT :</strong> -----</li>
							<li><strong>Grand Total :</strong> &euro; <?php echo $row['total']?></li>
						</ul>
						<?php endforeach?>
					</div>
				</div>
				<div class="text-center invoice-btn">
					<a class="btn btn-info btn-lg" onclick="javascript:window.print();"><i class="icon-print"></i> Print </a>
				</div>
				<?php endif?>
			</div>
		</div>
	</section>
	<!-- invoice end-->
	
	<div class="clr"></div>
</div>
<?php echo modules::run('lift/auto_suggest_city')?>