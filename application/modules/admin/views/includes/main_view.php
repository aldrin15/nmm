<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">

    <title>Admin</title>

	<link type="text/css" rel="stylesheet" href="<?php echo base_url('css/style.css')?>"/>
    
	<!-- Bootstrap core CSS -->
    <link type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url('assets/css/bootstrap-reset.css')?>" rel="stylesheet">
    
	<!--external css-->
    <link type="text/css" href="<?php echo base_url('assets/plugins/font-awesome/css/font-awesome.css')?>" rel="stylesheet" />
    <link type="text/css" href="<?php echo base_url('assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css')?>" rel="stylesheet" type="text/css" media="screen"/>
    <link type="text/css" href="<?php echo base_url('assets/css/owl.carousel.css')?>" type="text/css" rel="stylesheet">
	<link type="text/css" href="<?php echo base_url('assets/plugins/advanced-datatable/media/css/demo_page.css')?>" rel="stylesheet" />
    <link type="text/css" href="<?php echo base_url('assets/plugins/advanced-datatable/media/css/demo_table.css')?>" rel="stylesheet" />
	
	<!-- Custom styles for this template -->
    <link type="text/css" href="<?php echo base_url('assets/css/style.css')?>" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url('assets/css/style-responsive.css')?>" rel="stylesheet" />
	
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
	<script src="<?php echo base_url()?>assets/js/jquery.js"></script>
	<script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
</head>
<body>
<?php $this->load->view('includes/header_view')?>
<?php $this->load->view($main_content)?>
<?php $this->load->view('includes/footer_view')?>
</body>
</html>