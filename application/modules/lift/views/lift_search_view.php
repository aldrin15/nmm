<?php 
$page = $_SERVER['REQUEST_URI'];

if($page == "/nmm/" || $page == "/nmm/nmm"):
?>
<div class="search-home m-center-content">
	<form action="" method="post">
		<ul>
			<li>
				<?php echo form_error('from', '<div class="error">', '</div>')?>
					<div class="clr"></div>
				<span><input type="text" name="from" id="from-route" autocomplete="off"/></span>
			</li>
			<li>
				<?php echo form_error('to', '<div class="error">', '</div>')?>
					<div class="clr"></div>
				<span><input type="text" name="to" id="to-route" autocomplete="off" /></span>
			</li>
			<li><span><input type="text" name="date" id="datepicker"/></span></li>
			<li>
				<input type="submit" name="ride_submit" value="    Search" class="btn-search"/>

				<div class="clr"></div>
			</li>
		</ul>
		
		<div class="clr"></div>
	</form>
</div>
<?php else: ?>

<form action="" method="post">
	<div class="search">
		<ul>
			<li>
				<?php echo form_error('from', '<div class="error">', '</div>')?>
					<div class="clr"></div>
				<span><input type="text" name="from" id="from-route" autocomplete="off"/></span>
			</li>
			<li>
				<?php echo form_error('to', '<div class="error">', '</div>')?>
					<div class="clr"></div>
				<span><input type="text" name="to" id="to-route" autocomplete="off" /></span>
			</li>
			<li>
				<input type="submit" name="ride_submit" value="    Search" class="btn-search"/>

				<div class="clr"></div>
			</li>
			<li>
				<input type="submit" name="option" value="Advance Option" class="btn-advance" style="margin-left:5px;"/>
				
				<div class="clr"></div>
			</li>
		</ul>
		
		<div class="clr"></div>
	</div>
	<!-- 
	<div class="advanced-search">
		<p>Search By:</p>
		<ul>
			<li>
				<div class="fl">
					<label for="Date">Date</label>
					<input type="text" name="date" value="" id="search-calendar"/>
				</div>
				
				<div class="fl">
					<label for="Time">Time</label>
					<select name="hour" id="">
						<?php //for($i = 1; $i < 25; $i++):?>
						<option><?php //echo $i?></option>
						<?php //endfor?>
					</select> -
					<select name="minute" id="">
						<?php //for($i = 1; $i < 61; $i++):?>
						<option><?php //echo $i?></option>
						<?php //endfor?>
					</select>
				</div>
				
				<div class="clr"></div>
			</li>
			<li>
				
			</li>
			<li>
				<label for="Search Preference">Preference</label>
				
				<div class="lift-preference">
					<div class="fl checkbox-1">
						<input type="checkbox" name="preference[]" value="1"/>
						<p>Talk <i></i></p>
					</div>
					<div class="fl checkbox-2">
						<input type="checkbox" name="preference[]" value="2"/>
						<p>Music <i></i></p>
					</div>
					<div class="fl checkbox-3">
						<input type="checkbox" name="preference[]" value="3"/>
						<p>Pet <i></i></p>
					</div>
					<div class="fl checkbox-4">
						<input type="checkbox" name="preference[]" value="4"/>
						<p>Smoke <i></i></p>
					</div>
					<div class="fl checkbox-5">
						<input type="checkbox" name="preference[]" value="5"/>
						<p>Baby <i></i></p>
					</div>
					<div class="fl checkbox-6">
						<input type="checkbox" name="preference[]" value="6"/>
						<p>Women Only <i></i></p>
					</div>
				</div>
				
				<div class="clr"></div>
			</li>
			<li>
				<label for="Price">Price</label>
				<select name="price" id="">
					<?php
					//for($x = 1; $x < 500; $x++):
					//	$x = $x + 29;
					?>
					<option><?php //echo $x?></option>
					<?php //endfor?>
				</select>
			</li>
		</ul>
	</div>
	-->
</form>
<?php endif?>

