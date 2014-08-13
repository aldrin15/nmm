<?php $this->load->view('header_content')?>

<div class="profile-wrapper m-center-content">
	<?php echo modules::run('lift/search')?>
	
	<?php $this->load->view('member_sidebar_view')?>
	
	<div class="fl overview-detail">
		<div id="successful-message" style="padding:0;">
			<p>You have successfully edited your post.</p>
		</div>
	</div>
	
	<div class="clr"></div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-select.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.ui.core.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.ui.datepicker.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.multidatespicker.js')?>"></script>
<script type="text/javascript">
$('.bt-dropdown').selectpicker();
$('.lift-preference div').click(function(){var input=$('input',this);if(input.attr('checked')){input.attr('checked',false);$(this).removeClass('selected')}else{input.attr('checked',true);$(this).addClass('selected')}});
$('.lift-preference div').mouseover(function() { $('p', this).stop(true, true).fadeIn().css({display:'block'}); });
$('.lift-preference div').mouseleave(function() { $('p', this).fadeOut(); });
</script>
<?php echo modules::run('lift/auto_suggest_city')?>