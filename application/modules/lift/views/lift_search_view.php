<?php 
$page = $_SERVER['REQUEST_URI'];

if($page == "/nmm/" || $page == "/nmm/nmm"):
?>
<div class="search-home m-center">
	<form action="" method="post">
		<ul>
			<li>
				<?php echo form_error('from', '<div class="error">', '</div>')?>
					<div class="clr"></div>
				<input type="text" name="from" id="from-route" autocomplete="off"/>
			</li>
			<li>
				<?php echo form_error('to', '<div class="error">', '</div>')?>
					<div class="clr"></div>
				<input type="text" name="to" id="to-route" autocomplete="off" />
			</li>
			<li><input type="text" name="" id="datepicker"/></li>
			<li>
				<input type="submit" name="ride_submit" value="" class="btn-search"/>

				<div class="clr"></div>
			</li>
		</ul>
		
		<div class="clr"></div>
	</form>
</div>
<?php else: ?>
<div class="search">
	<form action="" method="post">
		<ul>
			<li>
				<?php echo form_error('from', '<div class="error">', '</div>')?>
					<div class="clr"></div>
				<input type="text" name="from" id="from-route" autocomplete="off"/>
				
				<div class="from-suggestion">
					<ul>
					</ul>
				</div>
			</li>
			<li>
				<?php echo form_error('to', '<div class="error">', '</div>')?>
					<div class="clr"></div>
				<input type="text" name="to" id="to-route" autocomplete="off" />
			</li>
			<li>
				<input type="submit" name="ride_submit" value="" class="btn-search"/>

				<div class="clr"></div>
			</li>
			<li>
				<input type="submit" name="option" value="" class="btn-advance" style="margin-left:5px;"/>
				
				<div class="clr"></div>
			</li>
		</ul>
		
		<div class="clr"></div>
	</form>
</div>
<?php endif?>

