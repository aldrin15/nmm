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
				<span><input type="text" name="from" value="From" id="from" onfocus="if(this.value==this.defaultValue) this.value = ''" onblur="if (this.value=='') this.value = this.defaultValue" autocomplete="off"/></span>
			</li>
			<li>
				<?php echo form_error('to', '<div class="error">', '</div>')?>
					<div class="clr"></div>
				<span><input type="text" name="to" value="Destination" id="destination" onfocus="if(this.value==this.defaultValue) this.value = ''" onblur="if (this.value=='') this.value = this.defaultValue" autocomplete="off" /></span>
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
<style type="text/css">.advanced-search {background:#d6d6d6; border-top:1px solid #000; border-bottom:1px solid #000; padding:10px 50px; width:100%;}.advanced-search ul li {margin-bottom:10px;}.advanced-search ul li label {display:block; font-weight:bold; width:100px;}.advanced-search ul li input[type="text"] {border:1px solid #9b9b9b; margin-right:10px; padding:0 10px; height:30px;}.advanced-search ul li select {height:30px;}.advanced-search ul li .lift-preference div {margin-bottom:10px;}</style>
<form action="" method="post">
	<div class="search">
		<ul>
			<li>
				<?php echo form_error('from', '<div class="error">', '</div>')?>
					<div class="clr"></div>
				<span><input type="text" name="from" id="from" onfocus="if(this.value==this.defaultValue) this.value = ''" onblur="if (this.value=='') this.value = this.defaultValue" value="From" autocomplete="off" /></span>
			</li>
			<li>
				<?php echo form_error('to', '<div class="error">', '</div>')?>
					<div class="clr"></div>
				<span><input type="text" name="to" id="destination" onfocus="if(this.value==this.defaultValue) this.value = ''" onblur="if (this.value=='') this.value = this.defaultValue" value="Destination" autocomplete="off" /></span>
			</li>
			<li>
				<input type="submit" name="ride_submit" value="    Search" class="btn-search"/>

				<div class="clr"></div>
			</li>
			<li>
				<a href="javascript:void(0)" class="btn-advance" id="btn-advance">Advance Option</a>
				
				<div class="clr"></div>
			</li>
		</ul>
		
		<div class="clr"></div>
	</div>
	<div class="advanced-search" style="display:none;">
		<h4>Search By:</h4>
		<ul>
			<li>
				<div class="fl">
					<label for="Date">Date</label>
					<input type="text" name="date" value="" id="search-calendar"/>
				</div>
				
				<div class="fl">
					<label for="Time">Time</label>
					<select name="hour" id="">
						<?php for($i = 1; $i < 25; $i++):?>
						<option><?php echo ($i > 10) ? '0'.$i : $i?></option>
						<?php endfor?>
					</select> -
					<select name="minute" id="">
						<?php for($i = 1; $i < 60; $i++):?>
						<option><?php echo $i?></option>
						<?php endfor?>
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
					<option value="5 AND 25">&euro;5 - &euro;25</option>
					<option value="25 AND 50">&euro;25 - &euro;50</option>
					<option value="50 AND 75">&euro;50 - &euro;75</option>
					<option value="75 AND 100">&euro;75 - &euro;100</option>
				</select>
			</li>
		</ul>
	</div>
</form>
<?php endif?>

