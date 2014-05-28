<?php $this->load->view('header_content')?>
<br /><br /><br />
<div class="profile-sidebar fl">
	<ul>
		<li><a href="<?php echo base_url('members/index')?>">Dashboard</a></li>
		<li><a href="<?php echo base_url('members/edit')?>">Edit Profile</a></li>
		<li><a href="#">Manage Cars</a></li>
		<li><a href="<?php echo base_url('members/create_lift')?>">Create a lift</a></li>
		<li><a href="#">Balance</a></li>
		<li><a href="#">Transactions</a></li>
		<li><a href="#">Messages</a></li>
		<li><a href="#">Overview</a></li>
		<li><a href="<?php echo base_url('members/settings')?>">Settings</a></li>
	</ul>
</div>

<style type="text/css">
.create-lift {margin-left:100px;}
.create-lift ul {list-style:none;}
.profile-search ul li {float:left;}

.create-lift-form h3 {padding:10px 0;}
.create-lift-form ul li {margin-bottom:10px;}
.create-lift-form ul li label {width:100px;}
.create-lift-form ul li label, .create-lift-form ul li input, .create-lift-form ul li select {float:left;}

.create-lift-form ul li div {margin-right:10px;}
.create-lift-form ul li div input[type="checkbox"] {margin-top:3px;}
</style>

<div class="create-lift fl">
	<div class="profile-search">
		<form action="" method="post">
			<ul>
				<li>
					<?php echo form_error('from', '<div class="error">', '</div>')?>
						<div class="clr"></div>
					<label for="From">Search a lift From:</label>
					<input type="text" name="from" id="from-route" />
					
					<div class="from-suggestion">
						<ul>
						</ul>
					</div>
				</li>
				<li>
					<?php echo form_error('to', '<div class="error">', '</div>')?>
						<div class="clr"></div>
					<label for="To">To:</label>
					<input type="text" name="to" id="to-route"/>
				</li>
				<li>
					<input type="submit" name="ride_submit" value="Ride" class="chose fl"/>

					<div class="clr"></div>
				</li>
			</ul>
			
			<div class="clr"></div>
		</form>
	</div>
	
	<div class="create-lift-form">
		<form action="" method="post">
			<h3>Location: From and To</h3>
				<hr/><br />
			<ul>
				<li>
					<label for="Departure">From: </label>
					<input type="text" name="departure" id=""/>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Departure">To: </label>
					<input type="text" name="arrival" id=""/>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Via">Via</label>
					<input type="text" name="via" id=""/>
					
					<div class="clr"></div>
				</li>
			</ul>
			
			<h3>Date and Time of Lift</h3>
				<hr/><br />
			<ul>
				<li>
					<label for="Date">Date:</label>
					<input type="text" name="date" id=""/>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Time">Time:</label>
					<select name="hours" id="">
						<?php for($i = 1; $i < 25; $i++):?>
						<option value="<?php echo $i?>"><?php echo $i?></option>
						<?php endfor?>
					</select>
					
					<select name="minute" id="">
						<?php for($i = 1; $i < 61; $i++):?>
						<option value="<?php echo $i?>"><?php echo $i?></option>
						<?php endfor?>
					</select>
					
					<div class="clr"></div>
				</li>
			</ul>
			
			<h3>Car Preference</h3>
				<hr/><br />
			<ul>
				<li>
					<label for="Seat Available">Seat Available</label>
					<select name="seat_available" id="">
						<?php for($i = 1; $i < 12; $i++):?>
						<option value="<?php echo $i?>"><?php echo $i?></option>
						<?php endfor?>
					</select>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Storage">Storage</label>
					<select name="storage" id="">
						<option value="Small">Small</option>
						<option value="Medium">Medium</option>
						<option value="Large">Large</option>
					</select>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Preferences">Preferences:</label>
					
					<div class="fl">
						<input type="checkbox" name="" id=""/>	
						<span for="" class="fl">Talk</span>
					</div>
					<div class="fl">
						<input type="checkbox" name="" id=""/>					
						<span for="" class="fl">Music</span>
					</div>
					<div class="fl">
						<input type="checkbox" name="" id=""/>
						<span for="" class="fl">Pet</span>
					</div>
					<div class="fl">
						<input type="checkbox" name="" id=""/>					
						<span for="" class="fl">Smoke</span>
					</div>
					<div class="fl">
						<input type="checkbox" name="" id=""/>					
						<span for="" class="fl">Baby</span>
					</div>
					<div class="fl">
						<input type="checkbox" name="" id=""/>
						<span for="" class="fl">Only Women</span>
					</div>
					
					<div class="clr"></div>
				</li>
				<li>
					<label for="Remarks">Remarks:</label>
					<textarea name="remarks" id="" cols="30" rows="10"></textarea>
				</li>
			</ul>
			<h3>Payment</h3>
				<hr/><br />
			<ul>
				<li>
					<label for="Price Per Seat">Seat Amount:</label>
					<input type="text" name="seat_amount" id=""/>
					
					<div class="clr"></div>
				</li>
				<li>
					<input type="checkbox" name="" id="" style="margin-top:3px;"/>
					<label for="" style="width:150px;">Accept Cash Paymnet</label>
					
					<div class="clr"></div>
				</li>
			</ul>
			
			<h3>Other Options</h3>
				<hr/><br />
			<ul>
				<li style="float:none;">
					<input type="checkbox" name="re_route" id=""/>
					<label for="Allow Reroute">Allow Reroute</label>
					
					<div class="clr"></div>
				</li>
				<li style="float:none;">
					<input type="checkbox" name="quick_booking" id=""/>
					<label for="Quick Booking">Quick Booking</label>
					
					<div class="clr"></div>
				</li>
				<li>
					<input type="checkbox" name="offer_re_route" id=""/>
					<label for="Offer re-route">Offer re-route</label>
					
					<div class="clr"></div>
				</li>
			</ul>
			
			<input type="submit" name="create_lift" value="Create Lift"/>
		</form>
	</div>
</div>

<div class="clr"></div>