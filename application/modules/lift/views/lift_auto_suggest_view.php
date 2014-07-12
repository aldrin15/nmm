
<script type="text/javascript">
$(function() {
	$('.btn-advance').click(function() {
		$('.advanced-search').slideToggle();
		// console.log('you clicked');
	});
	
	/* Get Route */ 
	$('#search-calendar').datepicker();
	var dateToday = new Date();
	
	$('#datepicker').datepicker({
		minDate: dateToday
	}).datepicker("setDate", new Date());
	 
	var from_route = $('#from-route'),
		to_route = $('#to-route');
	
	$(from_route).keyup(function(e) {
		e.preventDefault();
		
		if($(from_route).val().length < 1) {
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
		
		if($(to_route).val().length < 1) {
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
	
	$('input[name="ride_submit"]').click(function() {
		var from 	= $('input[name="from"]'),
			to		= $('input[name="to"]'),
			date	= $('input[name="date"]'),
			price	= $('input[name="price"]'),
			error	= 0;
		
		if(from.val() == '') {
			from.parent().css({border:'2px solid #ff0000'});
			error = 1;
		}
		
		if(to.val() == '') {
			to.parent().css({border:'2px solid #ff0000'});
			error = 1;
		}
		
		if(error == 0) {
			$(this).submit();
		} else {
			return false;
		}
	});	
});
</script>