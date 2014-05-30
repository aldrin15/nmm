<script type="text/javascript">
$(function() {
	/*
	 * Get Route
	 */
	var from_route = $('#from-route'),
		to_route = $('#to-route');
	
	$(from_route).keyup(function(e) {
		e.preventDefault();
		
		if($(from_route).val().length < 3) {
			$('.from-suggestion ul').hide().empty();
		} else {
			$.ajax({
				'url'		: '<?php echo base_url('nmm/auto_suggest')?>',
				'type'		: 'GET',
				'data'		: {city: from_route.val()},
				'success'	: function(data) {
					$('.from-suggestion ul').empty().show();
					$('.from-suggestion ul').show().append(data);
									
					/*
					 * Get Value from Anchor 
					 * and Pass it to input
					 */
					$('.from-suggestion ul li a').click(function() {
						$('#from-route').val($(this).attr('data-city')).keyup();
						$('.from-suggestion ul').hide();
					});
				}
			});	
		}
	});
	
	$(to_route).keyup(function(e) {
		e.preventDefault();
		
		if($(to_route).val().length < 3) {
			$('.from-suggestion ul').hide().empty();
		} else {
			$.ajax({
				'url'		: '<?php echo base_url('nmm/auto_suggest')?>',
				'type'		: 'GET',
				'data'		: {city: to_route.val()},
				'success'	: function(data) {
					$('.from-suggestion ul').empty();
					$('.from-suggestion ul').show().append(data);
									
					/*
					 * Get Value from Anchor 
					 * and Pass it to input
					 */
					$('.from-suggestion ul li a').click(function() {
						$('#to-route').val($(this).attr('data-city')).keyup();
					});
				}
			});	
		}
	});
});
</script>