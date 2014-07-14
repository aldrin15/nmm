<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&region=DE&libraries=places&language=de"></script>  
<script type="text/javascript">
$(window).load(function() {initialize();});

var destination, from;

function initialize() {
	from = new google.maps.places.Autocomplete((document.getElementById('from')), { types: ['geocode'] });
	destination = new google.maps.places.Autocomplete((document.getElementById('destination')), { types: ['geocode'] });
	google.maps.event.addListener(destination, 'place_changed', function() { fillInAddress(); });
}

function geolocate() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
			var geolocation = new google.maps.LatLng(
			
			position.coords.latitude, position.coords.longitude);
			destination.setBounds(new google.maps.LatLngBounds(geolocation, geolocation));
		});
	}
}

$(function() {
	$('#btn-advance').click(function() { $('.advanced-search').slideToggle(); });
	
	/* Get Route */ 
	$('#search-calendar').datepicker();
	var dateToday = new Date();
	
	$('#datepicker').datepicker({ minDate: dateToday }).datepicker("setDate", new Date());
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