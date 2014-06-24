<?php $this->load->view('header_content')?>

<div class="slideshow-search" style="position:relative;">
	<div class="slideshow">			
		<ul class="rslides" id="slider1">
			<li><img src="<?php echo base_url('assets/images/slideshow/1.jpg')?>" alt=""></li>
			<li><img src="<?php echo base_url('assets/images/slideshow/2.jpg')?>" alt=""></li>
			<li><img src="<?php echo base_url('assets/images/slideshow/3.jpg')?>" alt=""></li>
		</ul>

		<div class="clr"></div>
	</div>
</div>

<div class="m-center-content">
	<?php echo modules::run('lift/search')?>

	<select name="" id="" class="category">
		<?php foreach($countries_data as $country):?>

		<option value="<?php echo $country['code']?>"><?php echo $country['name']?></option>

		<?php endforeach?>
	</select>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/responsiveslides.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-select.js')?>"></script>
<script type="text/javascript">
$(function() {
	$('.category').selectpicker();
});
</script>