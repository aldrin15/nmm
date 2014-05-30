<style type="text/css">
.error {color:#ff0000;}

.lift-search ul {list-style:none;}
.lift-search ul li {float:left;}
.lift-search ul li label, .lift-search ul li input {float:left;}
</style>

<div class="lift-search">
	<form action="" method="post">
		<ul>
			<li>
				<?php echo form_error('from', '<div class="error">', '</div>')?>
					<div class="clr"></div>
				<label for="From">Search a lift From:</label>
				<input type="text" name="from" id="from-route" autocomplete="off" />
				
				<div class="from-suggestion">
					<ul>
					</ul>
				</div>
			</li>
			<li>
				<?php echo form_error('to', '<div class="error">', '</div>')?>
					<div class="clr"></div>
				<label for="To">To:</label>
				<input type="text" name="to" id="to-route" autocomplete="off" />
			</li>
			<li>
				<input type="submit" name="ride_submit" value="Ride" class="chose fl"/>

				<div class="clr"></div>
			</li>
		</ul>
		
		<div class="clr"></div>
	</form>
</div>