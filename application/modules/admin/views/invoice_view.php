	<?php $this->load->view('includes/header_content')?>

	<?php $this->load->view('includes/sidebar_view')?>
	
	<section id="main-content">
		<section class="wrapper">
			<!-- invoice start-->
			<section>
				<div class="panel panel-primary">
					<!--<div class="panel-heading navyblue"> INVOICE</div>-->
					<div class="panel-body">
						<div class="row invoice-list">
							<div class="col-lg-4 col-sm-4">
								<h4>INVOICE INFO</h4>
								
								<ul class="unstyled">
									<li>Invoice Number		: <strong>69626</strong></li>
									<li>Invoice Date		: 2013-03-17</li>
									<li>Due Date			: 2013-03-20</li>
									<li>Invoice Status		: Paid</li>
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
			<!-- invoice end-->
		</section>
	</section>

