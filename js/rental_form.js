/**
* Rental Form js
* 
* @author   Gilang Gumilar
*   @version  0.1
*/
jQuery(document).ready(function($) {
  $("#rental_date").datepicker({ dateFormat: 'yy-mm-dd' }).datepicker("setDate", new Date());

  function getDevice(id) {
    for (var i = 0; i < devList.length; i++) {
      if (devList[i]['device_id'] == id) {
        return devList[i];
      }
    }
    return {};
  }

  function getDevicesByType(id) {
    var devs = []
    for (var i = 0; i < devList.length; i++) {
      if (devList[i]['type_id'] == id) {
        devs.push(devList[i]);
      }
    }
    return devs;
  }

  $("#device_type").change(function() {
    var devs = getDevicesByType($(this).val());
    $("#device_code").html('');
    $("button[type=submit]").prop('disabled', false);
    if (devs.length === 0) {
      $("#device_code").html('<option disabled>No device found</option>');
      $("button[type=submit]").prop('disabled', true);
    }
    for (var i = 0; i < devs.length; i++) {
      $("#device_code").append($('<option value="'+devs[i]["device_id"]+'">'+devs[i]["device_code"]+'</option>'));
    }
    $("#device_code").trigger('change');
  });

  $("#device_code").change(function() {
    var dev = getDevice($(this).val());

    $("#device_id").val('');
    $("#type_name").val('');
    $("#device_brand").val('');
    $("#device_model").val('');
    $("#device_serial").val('');
    $("#location_name").val('');

    $("#device_id").val(dev['device_id']);
    $("#type_name").val(dev['type_name']);
    $("#device_brand").val(dev['device_brand']);
    $("#device_model").val(dev['device_model']);
    $("#device_serial").val(dev['device_serial']);
    $("#location_name").val(dev['location_name']);
  });

  $("#device_type").trigger('change');

});

  