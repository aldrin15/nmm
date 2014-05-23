<?php $this->load->view('header_content')?>

<style type="text/css">
.error {color:#ff0000;}

search-option ul li {float:left;}
</style>


<div class="home">
	<div class="search-option">
		<form action="" method="post">
			<ul>
				<li>
					<label for="From">From: </label>
					<input type="text" name="from" id=""/>
				</li>
				<li>
					<label for="To">To: </label>
					<input type="text" name="to" id=""/>
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

<script type="text/javascript"></script>