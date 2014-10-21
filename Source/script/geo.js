var geocoder;
var map;
function initialize() {
	geocoder = new google.maps.Geocoder();
}

function codeAddress() {

	var city = document.getElementById('city').value;
	var country = document.getElementById('country').value;
	var address = city.concat(", ", country);
	var coords = "";
	geocoder.geocode({
		'address' : address
	}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			coords = results[0].geometry.location;
		} else {
			coords = "0, 0";
		}

		document.getElementById('coordinates').value = coords;
		document.getElementById('registerform').submit();
	});
}

google.maps.event.addDomListener(window, 'load', initialize);