<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="description" content="NMM">
	<meta name="keywords" content="Lift service, Wish Lift Service, Car rental">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex, nofollow">
	
	<title>Nimm Mich Mit</title>
	
	<link rel="icon" type="image/png" href="<?php echo base_url('favicon.png')?>">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,300,700&subset=latin,cyrillic-ext,greek-ext' rel='stylesheet' type='text/css'>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css')?>"/>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css')?>" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/jquery-ui.css')?>"/>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/rateit.css')?>"/>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/style.css')?>"/>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/editor.css')?>"/>
	
	<?php if($this->uri->segment(2) == 'create' || $this->uri->segment(2) == 'ride-edit'):?>
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.7.2.js')?>"></script>
	<?php else:?>
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.11.0.min.js')?>"></script>
	<?php endif?>
	<script type="text/javascript">
    document.createElement('section');
    document.createElement('aside');
    document.createElement('nav');
    document.createElement('header'); 
    document.createElement('footer');
	
	var height = $(window).height(), base_url = '<?php echo base_url()?>', pathArray = window.location.pathname.split('/');
	
	$(function() { $('.login a:first-child').hover(function(){ $('.login ul').stop(true,false).fadeIn().show(); },function(){ $('.login ul').fadeOut(); }); $('.nav-dropdown').click(function(){ $('.menu ul').slideToggle(); });});
	</script>
</head>
<body>
<div id="fb-root"></div>
<div id="main-container">