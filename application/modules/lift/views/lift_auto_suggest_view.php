
<script type="text/javascript">
$(function() {
	/*
	 * Get Route
	 */
	var dateToday = new Date();
	
	$('#datepicker').datepicker({
		minDate: dateToday
	});
	 
	var from_route = $('#from-route'),
		to_route = $('#to-route');
	
	$(from_route).keyup(function(e) {
		e.preventDefault();
		
		if($(from_route).val().length < 2) {
			$('.from-suggestion ul').hide().empty();
		} else {
			$.ajax({
				'url'		: '<?php echo base_url('lift/auto_suggest')?>',
				'type'		: 'GET',
				'data'		: {city: from_route.val()},
				'success'	: function(data) {
					var city_array = [];
				
					$.each($.parseJSON(data), function(index, value) {
						city_array.push(value.combined);
					});
					
					var city = city_array;
					
					$('#from-route').autocomplete({
						source:city,
						open: function(){
							setTimeout(function () {
								$('.ui-autocomplete').css('z-index', 99999999999999);
							}, 0);
						}
					});
				}
			});	
		}
	});
	
	$(to_route).keyup(function(e) {
		e.preventDefault();
		
		if($(to_route).val().length < 2) {
			$('.from-suggestion ul').hide().empty();
		} else {
			$.ajax({
				'url'		: '<?php echo base_url('lift/auto_suggest')?>',
				'type'		: 'GET',
				'data'		: {city: to_route.val()},
				'success'	: function(data) {
					var city_array = [];
				
					$.each($.parseJSON(data), function(index, value) {
						city_array.push(value.combined);
					});
					
					var city = city_array;
					
					$('#to-route').autocomplete({source:city});
				}
			});	
		}
	});
});
</script>