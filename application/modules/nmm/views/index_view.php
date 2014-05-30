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
				<!-- 
				<li>
					<input type="text" name="date" id="datepicker"/>
				</li>
				-->
				<li>
					<input type="submit" name="ride_submit" value="Search"/>
				</li>
			</ul>
			
			<div class="clr"></div>
		</form>
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js')?>"></script>
<?php echo modules::run("lift/auto_suggest_city")?>