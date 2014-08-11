<?php $this->load->view('header_content')?>

<div class="member-billing m-center-content">
	<?php echo modules::run('lift/search')?>
	
	<?php $this->load->view('member_sidebar_view')?>

	<!-- invoice start-->
	<?php foreach($subscription_data as $row):?>
	<section class="fl">
		<div class="panel panel-primary span8">
			<div class="panel-body">
				<div class="row invoice-list">
					<div class="col-lg-4 col-sm-4">
						<h4>BILLING INFORMATION</h4>
						
						<ul class="unstyled">
							<li><strong>Invoice Number</strong>	: <strong>69626</strong></li>
							<li><strong>Invoice Date</strong> : <?php echo date('d-m-y', strtotime($row['start_date']))?></li>
							<li><strong>Due Date</strong> : <?php echo date('d-m-y', strtotime($row['end_date']))?></li>
							<li><strong>Invoice Status</strong>	: Paid</li>
						</ul>
					</div>
				</div>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th class="hidden-phone">Subscription Type</th>
							<th class="">Cost</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>John Doe</td>
							<td class="hidden-phone">Monthly</td>
							<td class="">&euro; 3.99</td>
						</tr>
					</tbody>
				</table>
				<div class="row">
					<div class="col-lg-4 invoice-block pull-right">
						<ul class="unstyled amounts">
							<li><strong>Sub - Total amount :</strong> &euro; 3.99</li>
							<li><strong>Discount :</strong>-----</li>
							<li><strong>VAT :</strong> -----</li>
							<li><strong>Grand Total :</strong> &euro; 3.99</li>
						</ul>
					</div>
				</div>
				<div class="text-center invoice-btn">
					<a class="btn btn-info btn-lg" onclick="javascript:window.print();"><i class="icon-print"></i> Print </a>
				</div>
			</div>
		</div>
	</section>
	<?php endforeach?>
	<!-- invoice end-->
	
	<div class="clr"></div>
</div>