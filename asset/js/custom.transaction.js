$( document ).ready(function() {
	if ($('#transaction-id').val() > 0) {
	    calculate_vehicle();
	    calculate_material();
	}

    $('#license-plate-id').change(function() {
		calculate_vehicle(true);
	});

    $('#material-id').change(function() {
		calculate_material(true);
	});

	$('#volume-id').keyup(function() {
		current_volume = $('#volume-id').val();
		calculate_total_price();
	});

});

function calculate_vehicle(user_action=false) {
	var license_plate = $('#license-plate-id').val();
	let vhc = vehicle.find(o => o.license_plate === license_plate);
	
	var volume = vhc['height'] * vhc['width'] * vhc['length'];
	volume = (volume/1000000).toFixed(2);
	current_volume = volume;

	$('#vehicle-dimensi-id').html(vhc['length'] + ' x ' + vhc['width'] + ' x ' + vhc['height']);
	if (user_action) {
		$('#receiver-name-id').val(vhc['owner_name']);
		$('#volume-id').val(volume);
		$('#vehicle-id').val(vhc['vehicle_id']);
		calculate_total_price();
	}
}

function calculate_material(user_action=false) {
	var material_id = $('#material-id').val();
	let mtr = material.find(o => o.material_id === material_id);
	current_price = mtr['price'];

	$('#material-price-id').html('*Harga/m<sup>3</sup>: ' + to_rupiah(mtr['price']));
	if (user_action) {
		calculate_total_price();
	}
}

function calculate_total_price() {
	var total_price = current_price * current_volume;
	total_price = total_price.toFixed(0)
	$('#item-price-id').val(current_price);
	$('#total-price-id').val(total_price);
	$('#resume-total-price-id').html(to_rupiah(total_price));
}