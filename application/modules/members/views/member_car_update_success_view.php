<?php $this->load->view('header_content')?>

<div class="profile-wrapper m-center-content">
	<?php echo modules::run('lift/search')?>
	
	<?php $this->load->view('member_sidebar_view')?>
	
	<div class="profile-car span5">
		<div class="success-message" style="width:560px;">
			<p>You have successfully update your car</p>
		</div>
	</div>
	
	<?php echo modules::run('members/status')?>

	<div class="clr"></div>
</div>


<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
<script type="text/javascript">
$(function() {
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