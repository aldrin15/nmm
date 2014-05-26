<?php $this->load->view('header_content')?>

<style type="text/css">
.error {color:#ff0000;}

.search-option ul {list-style:none;}
.search-option ul li {float:left;}

.from-suggestion {position:relative;}
.from-suggestion ul {display:none; position:absolute; background:#fff; top:0; left:40px; border:1px solid #000; z-index:2; overflow-y: scroll; height:100px;}
.from-suggestion ul li {float:none; border:1px solid #000;}
</style>


<div class="home">
	<div class="search-option">
		<form action="" method="post">
			<ul>
				<li>
					<?php echo form_error('from', '<div class="error">', '</div>')?>
					<label for="From">From: </label>
					<input type="text" name="from" id="from-route"/>
					
					<div class="from-suggestion">
						<ul>
						</ul>
					</div>
				</li>
				<li>
					<?php echo form_error('to', '<div class="error">', '</div>')?>
					<label for="To">To: </label>
					<input type="text" name="to" id="to-route"/>
				</li>
				<li>
					<input type="text" name="" id="datepicker"/>
				</li>
				<li>
					<input type="submit" name="ride_submit" value="Search"/>
				</li>
			</ul>
			
			<div class="clr"></div>
		</form>
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
<script type="text/javascript">
$(function() {
	$('#datepicker').datepicker();
	
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
				'url'		: '<?php echo base_url('members/test')?>',
				'type'		: 'GET',
				'data'		: {city: from_route.val()},
				'success'	: function(data) {
					$('.from-suggestion ul').empty();
					$('.from-suggestion ul').show().append(data);
									
					/*
					 * Get Value from Anchor 
					 * and Pass it to input
					 */
					$('.from-suggestion ul li a').click(function() {
						$('#from-route').val($(this).attr('data-city')).keyup();
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
				'url'		: '<?php echo base_url('members/test')?>',
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